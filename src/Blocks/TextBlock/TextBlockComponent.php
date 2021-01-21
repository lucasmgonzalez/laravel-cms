<?php
namespace CMS\Blocks\TextBlock;

use CMS\Livewire\BlockComponent;

class TextBlockComponent extends BlockComponent
{
    protected $blockModel = TextBlock::class;

    protected $type = "text";

    protected $rules = [
        'block.data.text' => 'required|string'
    ];
}