<?php

namespace App\Blog\Markdown;


use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\ConfigurationInterface;
use League\CommonMark\Util\RegexHelper;

class VideoRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{

    /**
     * @var ConfigurationInterface
     */
    protected $config;

    /**
     * @param AbstractInline           $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return HtmlElement|string|null
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Video)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . \get_class($inline));
        }

        $attrs = $inline->getData('attributes', ['type' => 'video/mp4']);

        $forbidUnsafeLinks = !$this->config->get('allow_unsafe_links');
        if ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($inline->getUrl())) {
            $attrs['src'] = '';
        } else {
            $attrs['src'] = asset('storage/media/' . basename($inline->getUrl()));
        }

        $videoSourceElement = new HtmlElement('source', $attrs);

        // prepare figure contents
        $figureElements = [
            $video = new HtmlElement('video', ['controls' => true], [$videoSourceElement]),
        ];

        // add caption
        if (isset($inline->data['title'])) {
            $figureElements [] = new HtmlElement('figcaption', [], $inline->data['title']);
        }

        return new HtmlElement('figure', [], $figureElements);
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->config = $configuration;
    }
}