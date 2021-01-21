<?php
namespace CMS\Blocks\YoutubeBlock;

use CMS\Models\Block;

class YoutubeBlock extends Block
{
    protected string $type = 'youtube';

    public static $component = YoutubeBlockComponent::class;
    public static $componentViews = __DIR__ . '/views';
}