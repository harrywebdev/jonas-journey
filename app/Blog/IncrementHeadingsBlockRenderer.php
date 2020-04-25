<?php

namespace App\Blog;


use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;

class IncrementHeadingsBlockRenderer implements BlockRendererInterface
{

    /**
     * @param AbstractBlock            $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement|string|null
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!($block instanceof Heading)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . \get_class($block));
        }

        $headingLevel = $block->getLevel() + 1;

        $tag = 'h' . ($headingLevel <= 6 ? $headingLevel : 6);

        $attrs = $block->getData('attributes', []);
        return new HtmlElement($tag, $attrs, $htmlRenderer->renderInlines($block->children()));
    }
}