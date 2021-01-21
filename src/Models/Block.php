<?php
namespace CMS\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Block extends Model
{
    protected $table = 'blocks';

    protected string $type;

    protected $fillable = ['data'];

    public function toHTML()
    {
        return view("cms-blocks-{$this->type}::html")->with($this->data);
    }

    public function toAMP()
    {
        return view("cms-blocks-{$this->type}::amp")->with($this->data);
    }

    public function __construct(array $attributes = [])
    {
        $this->bootIfNotBooted();

        $this->registerBlockType();

        $this->initializeTraits();

        $this->syncOriginal();

        $this->fill($attributes);
    }

    protected function registerBlockType()
    {
        $type = $this->type;
        
        // Save the type when creating this model
        static::creating(function ($model) use ($type){
            $model->forceFill([
                'type' => $type,
            ]);
        });
    }

    public function getDataAttribute()
    {
        if (!isset($this->attributes['data']) || empty($this->attributes['data'])) {
            return [];
        }

        return json_decode($this->attributes['data'], true);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function postBlock()
    {
        return $this->morphOne(PostBlock::class, 'blockable');
    }
}