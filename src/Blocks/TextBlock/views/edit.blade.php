<x-cms::edit-block>
    <form wire:submit.prevent="save">
        @include('cms::edit-button-group', ['block' => $block])

        <div class="form-group">
            <textarea class="form-control" name="text" cols="30" rows="10" wire:model="block.data.text"></textarea>
        </div>
    </form>
</x-cms::edit-block>