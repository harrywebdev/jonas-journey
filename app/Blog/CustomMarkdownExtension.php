<?php

namespace App\Blog;

use League\CommonMark\Block\Element\Heading;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;

class CustomMarkdownExtension implements ExtensionInterface
{

    /**
     * @param ConfigurableEnvironmentInterface $environment
     *
     * @return void
     */
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addBlockRenderer(Heading::class, new IncrementHeadingsBlockRenderer(), 50);
    }
}