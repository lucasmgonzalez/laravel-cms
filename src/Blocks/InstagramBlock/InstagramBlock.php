<?php
namespace CMS\Blocks\InstagramBlock;

use CMS\Models\Block;

class InstagramBlock extends Block
{
    protected $attributes = ['type' => 'instagram'];

    public function toHTML()
    {
        return '';
    }
}
