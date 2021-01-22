<?php
namespace CMS\Livewire;

use CMS\Models\PostBlock;
use Illuminate\Support\Collection;
use Livewire\Component;

class Editor extends Component
{
    public $post;

    protected $listeners = [
        'block-type-changed' => 'refreshBlocks',
        'addBlockAbove' => 'addBlockAbove',
        'addBlockBelow' => 'addBlockBelow',
        'moveBlock' => 'moveBlock',
        'saved' => 'savePositions'
    ];

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addBlock($type = 'text')
    {
        $this->post->blocks[] = PostBlock::build($this->post, $type, []);
    }

    public function moveBlock($postBlock, $direction)
    {
        $index = $postBlock['index_position'];

        if (isset($this->post->blocks[$index + $direction])) {
            $temp = $this->post->blocks[$index + $direction];
    
            $this->post->blocks[$index + $direction] = $this->post->blocks[$index];
            $this->post->blocks[$index] = $temp;
    
            $this->savePositions();
        }

    }

    public function addBlockAbove($postBlock, $type = 'text')
    {
        $firstChunk = $this->post->blocks->slice(0, $postBlock['index_position']);
        $secondChunk = $this->post->blocks->slice($postBlock['index_position']);

        $this->post->blocks = collect($firstChunk)
            ->merge(
                [PostBlock::build($this->post, $type, [])]
            )->merge(
                $secondChunk
            );

        $this->savePositions();
    }

    public function addBlockBelow($postBlock, $type = 'text')
    {
        $firstChunk = $this->post->blocks->slice(0, $postBlock['index_position'] + 1);
        $secondChunk = $this->post->blocks->slice($postBlock['index_position'] + 1);

        $this->post->blocks = collect($firstChunk)
            ->merge(
                [PostBlock::build($this->post, $type, [])]
            )->merge(
                $secondChunk
            );
        
        $this->savePositions();
    }

    public function refreshBlocks()
    {
        $this->post->blocks = $this->post->blocks()->get();
    }

    public function savePositions()
    {
        $this->post->blocks->each(function ($block, $index) {
            $block->index_position = $index;
            $block->save();
        });
    }

    public function render()
    {
        return view('cms::editor');
    }
}