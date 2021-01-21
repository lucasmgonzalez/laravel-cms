<?php
namespace CMS\Blocks\YoutubeBlock;

use CMS\Livewire\BlockComponent;

class YoutubeBlockComponent extends BlockComponent
{
    protected $blockModel = YoutubeBlock::class;

    protected $type = "youtube";

    protected $rules = [
        'block.data.url' => 'required|string'
    ];
}