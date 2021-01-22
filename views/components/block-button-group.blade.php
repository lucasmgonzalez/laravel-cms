<div 
    class="btn-group-vertical position-absolute" 
    style="top: 0px; right: 0;"
    x-show.transition="toolbar"
>
    <div class="btn-group">
        <button title="Add Block" id="btn-addBlock-{{$block->id}}" type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi-plus"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="btn-changeBlockType-{{$block->id}}">
            <button type="button" class="dropdown-item" wire:click="addBlock('above')">Above</button>
            <button type="button" class="dropdown-item" wire:click="addBlock('below')">Below</button>
        </div>
    </div>

    <button title="Move Block Up" type="button" class="btn btn-secondary" wire:click="moveBlock('up')">
        <i class="bi-arrow-up"></i>
    </button>
    <button title="Move Block Down" type="button" class="btn btn-secondary" wire:click="moveBlock('down')">
        <i class="bi-arrow-down"></i>
    </button>

    @if ($mode === 'preview')
        <button title="Edit" type="button" class="btn btn-primary" wire:click='setEditMode'>
            <i class="bi-pencil-square"></i>
        </button>
    @elseif ($mode === 'edit')
        <div class="btn-group" role="group">
            <button title="Change Block Type" id="btn-changeBlockType-{{$block->id}}" type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi-collection"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="btn-changeBlockType-{{$block->id}}">
                @foreach (\CMS\Models\PostBlock::getRegisteredBlocks() as $type => $class)
                    @if ($type !== $block->type)
                        <button type="button" class="dropdown-item" wire:click="changeBlockType('{{$type}}')">{{ucfirst($type)}}</button>
                    @endif
                @endforeach
            </div>
        </div>

        <label title="Save" for="block-save-{{$block->id}}" class="btn btn-success mb-0">
            <i class="bi-save"></i>
        </label>

        <button title="Preview" type="button" class="btn btn-primary" wire:click='setPreviewMode'>
            <i class="bi-eye"></i>
        </button>
    @endif
</div>