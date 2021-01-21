<?php
namespace CMS\Blocks\GalleryBlock;

use CMS\Models\Block;

class GalleryBlock extends Block
{
    protected $attributes = ['type' => 'gallery'];

    public function toHTML()
    {
        return '';
    }
}