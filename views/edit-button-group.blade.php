<div class="btn-group-vertical position-absolute" style="right: -200px;">
    <button type="button" class="btn btn-primary" wire:click='setPreviewMode'>Preview</button>
    <button type="submit" class="btn btn-primary">Save</button>

    <div class="btn-group" role="group">
        <button id="btn-changeBlockType-{{$block->id}}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Change Block Type
        </button>
        <div class="dropdown-menu" aria-labelledby="btn-changeBlockType-{{$block->id}}">
            @foreach (\CMS\Models\PostBlock::getRegisteredBlocks() as $type => $class)
                @if ($type !== $block->type)
                    <button type="button" class="dropdown-item" wire:click="changeBlockType('{{$type}}')">{{ucfirst($type)}}</button>
                @endif
            @endforeach
        </div>
    </div>
</div>