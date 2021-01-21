<?php
namespace CMS\Blocks\YoutubeBlock;

use CMS\Livewire\BlockComponent;

class YoutubeBlockComponent extends BlockComponent
{
    protected $rules = [
        'block.data.url' => 'required|string'
    ];
}