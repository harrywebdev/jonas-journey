<?php

namespace App\Blog;

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
        $environment->addBlockRenderer(Heading::class, new IncrementHeadingsRenderer(), 50);
        $environment->addInlineRenderer(Image::class, new ImageCaptionsRenderer(), 50);
    }
}