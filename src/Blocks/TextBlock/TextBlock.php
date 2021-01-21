<?php
namespace CMS\Blocks\TextBlock;

use CMS\Models\Block as BaseBlock;

class TextBlock extends BaseBlock
{
    protected string $type = 'text';

    public static $component = TextBlockComponent::class;
    public static $componentViews = __DIR__ . '/views';
}