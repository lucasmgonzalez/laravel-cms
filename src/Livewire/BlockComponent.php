<?php
namespace CMS\Livewire;

use CMS\Models\PostBlock;
use Exception;
use Livewire\Component;

class BlockComponent extends Component
{
    const EDIT_MODE = 'edit';
    const PREVIEW_MODE = 'preview';

    public $mode = 'preview';
    
    public $postBlock;
    public $block;

    public function setPreviewMode()
    {
        $this->mode = self::PREVIEW_MODE;
    }

    public function setEditMode()
    {
        $this->mode = self::EDIT_MODE;
    }

    public function mount($postBlock)
    {
        $this->postBlock = $postBlock;
        $this->block = $postBlock->blockable;
    }

    public function render()
    {
        return view("cms::block")->with([
            'mode' => $this->mode,
            'block' => $this->block
        ]);
    }

    public function save()
    {
        $this->block->save();

        $this->mode = self::PREVIEW_MODE;

        $this->emitUp('saved');
    }

    public function moveBlock($direction = 'down')
    {
        if ($direction === 'up') {
            $this->emitUp('moveBlock', $this->postBlock, -1);
        } elseif ($direction === 'down') {
            $this->emitUp('moveBlock', $this->postBlock, 1);
        }
    }

    public function addBlock($position, $type = 'text')
    {
        if ($position === 'above') {
            $this->emitUp('addBlockAbove', $this->postBlock, $type);
        } else if($position === 'below') {
            $this->emitUp('addBlockBelow', $this->postBlock, $type);
        }
    }

    public function changeBlockType($newType)
    {
        $newBlockTypeClass = PostBlock::resolveBlockType($newType);

        if (empty($newBlockTypeClass)) {
            throw new Exception("New Block Type not found");
        }
        
        $this->block->type = $newType;
        $this->block->data = [];

        $this->block->save();

        $this->block->postBlock->blockable_type = $newType;
        $this->block->postBlock->save();

        $this->block = $newBlockTypeClass::find($this->block->id);

        $this->emitUp('block-type-changed');
    }
}