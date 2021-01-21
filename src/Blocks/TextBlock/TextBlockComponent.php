<?php
namespace CMS\Blocks\TextBlock;

use CMS\Livewire\BlockComponent;

class TextBlockComponent extends BlockComponent
{
    protected $rules = [
        'block.data.text' => 'required|string'
    ];
}