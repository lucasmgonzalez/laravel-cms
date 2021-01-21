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
        switch ($this->mode) {
            case self::PREVIEW_MODE:
                return view("cms-blocks-{$this->block->type}::preview");
            case self::EDIT_MODE:
            default:
                return view("cms-blocks-{$this->block->type}::edit");
        }
    }

    public function save()
    {
        $this->block->save();
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