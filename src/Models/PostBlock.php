<?php
namespace CMS\Models;

use CMS\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Model;

class PostBlock extends Model
{
    protected $table = "post_block";

    protected $with = ['blockable'];
    
    protected $guarded = [];
    
    protected $hidden = ['blockable', 'blockable_type', 'blockable_id'];

    protected $appends = ['type', 'data'];
    
    protected static $registeredBlocks = [];
    
    public static function registerBlock(string $type, string $class)
    {
        if (isset(self::$registeredBlocks[$type])) {
            throw new Exception("Type {$type} has already been registered for ".self::$registeredBlocks[$type]);
        }
        self::$registeredBlocks[$type] = $class;

        // Maybe update Relation morphMap here
    }

    public static function getRegisteredBlocks()
    {
        return self::$registeredBlocks;
    }
    
    public function blockable()
    {
        return $this->morphTo();
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function getTypeAttribute()
    {
        return $this->blockable->type;
    }

    public function getDataAttribute()
    {
        return $this->blockable->data;
    }

    public function setDataAttribute($value)
    {
        $this->blockable->data = $value;
    }

    public static function resolveBlockType($type)
    {
        if (!isset(self::$registeredBlocks[$type])) {
            throw new Exception("Block Type {$type} has not been registered");
        }

        return self::$registeredBlocks[$type];
    }

    public static function build(Post $post, string $type, array $data) 
    {
        $postBlock = new static(['post_id' => $post->id]);

        $blockType = self::resolveBlockType($type);

        $block = new $blockType(['data' => $data]);

        $block->save();

        $block->postBlock()->save($postBlock);

        return $postBlock;
    }
}