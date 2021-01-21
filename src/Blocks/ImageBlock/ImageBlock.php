<?php
namespace CMS\Blocks\ImageBlock;

use CMS\Models\Block as BaseBlock;

class ImageBlock extends BaseBlock
{
    protected string $type = 'image';

    public static $component = ImageBlockComponent::class;
}