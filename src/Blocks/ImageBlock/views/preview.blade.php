<x-cms::preview-block>
    @include('cms::preview-button-group', ['block' => $block])
    
    {!! $block->toHTML() !!}
</x-cms::preview-block>