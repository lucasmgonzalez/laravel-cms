<?php
namespace CMS\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = [];

    public function blocks()
    {
        return $this->hasMany(PostBlock::class)->orderBy('index_position', 'asc');
    }

    public function categories()
    {
        return $this->belongsToMany(PostBlock::class, 'post_category', 'post_id', 'category_id');
    }

    public function buildBlock(string $type, array $data)
    {
        return PostBlock::build($this, $type, $data);
    }
}