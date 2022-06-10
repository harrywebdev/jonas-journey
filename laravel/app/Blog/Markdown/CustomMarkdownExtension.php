<?php

namespace App\Blog\Markdown;

use League\CommonMark\Block\Element\Heading;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Inline\Element\Image;

class CustomMarkdownExtension implements ExtensionInterface
{

    /**
     * @param ConfigurableEnvironmentInterface $environment
     *
     * @return void
     */
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addBlockParser(new PrivateBlockParser(), 50);
        $environment->addBlockRenderer(PrivateBlock::class, new PrivateBlockRenderer(), 10);
        $environment->addBlockRenderer(Heading::class, new IncrementHeadingsRenderer(), 50);
        $environment->addInlineRenderer(Image::class, new ImageCaptionsRenderer(), 50);
        $environment->addInlineParser(new VideoParser(), 10);
        $environment->addInlineRenderer(Video::class, new VideoRenderer(), 50);
    }
}