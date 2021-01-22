<div 
    class="position-relative clearfix" 
    style="min-height: 150px;padding-right: 4rem;"
    x-data="blockControls()"
    x-on:mouseover="showToolbar" 
    x-on:mouseout="hideToolbar"
>
    <x-cms::block-button-group :block="$block" :mode="$mode"/>

    @if ($mode === "edit")
        <form wire:submit.prevent="save">
            @include("cms-blocks-{$block->type}::edit")

            <input id="block-save-{{$block->id}}" type="submit" class="d-none">
        </form>
    @elseif ($mode === 'preview')
        @include("cms::block-preview")
    @endif

    <script>
        function blockControls ()
        {
            return {
                toolbar: false, 
                showToolbar: function() {
                    this.toolbar = true;
                },
                hideToolbar: function() {
                    this.toolbar = false;
                }
            }
        }
    </script>
</div>