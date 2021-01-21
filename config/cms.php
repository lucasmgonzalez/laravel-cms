<?php

use CMS\Blocks\ImageBlock\ImageBlock;
use CMS\Blocks\TextBlock\TextBlock;
use CMS\Blocks\YoutubeBlock\YoutubeBlock;
use CMS\Models\PostBlock;

return [
    'post_blocks' => [
        PostBlock::registerBlock('text', TextBlock::class),
        PostBlock::registerBlock('image', ImageBlock::class),
        PostBlock::registerBlock('youtube', YoutubeBlock::class),
    ]
];