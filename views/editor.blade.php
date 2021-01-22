<div class="mt-5">
    @foreach ($post->blocks as $block)
        @livewire("cms::blocks.{$block->type}", ['postBlock' => $block], key($block->id . '-' . $block->type))
    @endforeach

    <div class="btn-group" role="group">
        <button id="btn-addBlock" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Add Block
        </button>
        <div class="dropdown-menu">
            @foreach (\CMS\Models\PostBlock::getRegisteredBlocks() as $type => $class)
                <button type="button" class="dropdown-item" wire:click="addBlock('{{$type}}')">{{ucfirst($type)}}</button>
            @endforeach
        </div>
    </div>
</div>