<?php
namespace CMS\Livewire;

use CMS\Models\PostBlock;
use Livewire\Component;

class Editor extends Component
{
    public $post;

    protected $listeners = ['block-type-changed' => 'refreshBlocks'];

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addBlock($type = 'text')
    {
        $this->post->blocks = PostBlock::build($this->post, $type, []);
    }

    public function refreshBlocks()
    {
        $this->post->block = $this->post->blocks()->get();
    }

    public function render()
    {
        return view('cms::editor');
    }
}