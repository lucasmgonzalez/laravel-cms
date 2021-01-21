<x-cms::edit-block>
    <form wire:submit.prevent="save">
        @include('cms::edit-button-group', ['block' => $block])
        <div class="form-group">
            <label class="control-label">Youtube URL</label>
            <input type="text" class="form-control" name="url" wire:model="block.data.url">
        </div>
    </form>
</x-cms::edit-block>