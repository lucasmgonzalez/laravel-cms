<?php
namespace CMS\Blocks\ImageBlock;

use CMS\Livewire\BlockComponent;
use Livewire\WithFileUploads;

class ImageBlockComponent extends BlockComponent
{
    use WithFileUploads;

    protected $rules = [
        'block.data.src' => 'required|string',
        'block.data.alt' => 'required|string',
    ];

    public $file;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'image|max:5120', // 1MB Max
        ]);
    }

    public function save()
    {
        if (!empty($this->file)) {
            $filename = $this->file->store("/public/uploads/media-library");
    
            $this->block->data = array_merge($this->block->data, ['src' => $filename]);
        }

        $this->block->save();
    }
}