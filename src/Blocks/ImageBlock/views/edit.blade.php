<x-cms::edit-block>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        @include('cms::edit-button-group', ['block' => $block])

        <div class="form-row">
            <div class="col">
                @if ($file)
                    <div>
                        <img src="{{$file->temporaryUrl()}}">
                    </div>
                @elseif (!empty($block->data['src']))
                    <div>
                        <img src="{{Storage::url($block->data['src'])}}">
                    </div>
                @endif
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="upload-image-{{$block->id}}" class="btn btn-info">Upload</label> 
                    <p>{{$file ? $file->getClientOriginalName() : ''}}</p>
                    <input type="file" class="form-control d-none" name="image" id="upload-image-{{$block->id}}" wire:model="file">
                </div>
            
                <div class="form-group">
                    <label class="control-label">Alt</label>
                    <input class="form-control" type="text" name="alt" wire:model="block.data.alt">
                </div>
            </div>
        </div>
    </form>
</x-cms::edit-block>