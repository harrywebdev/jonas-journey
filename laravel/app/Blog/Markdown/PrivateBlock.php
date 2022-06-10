<?php

namespace App\Blog\Markdown;


use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Cursor;

class PrivateBlock extends AbstractBlock
{

    /**
     * Returns true if this block can contain the given block as a child node
     *
     * @param AbstractBlock $block
     *
     * @return bool
     */
    public function canContain(AbstractBlock $block): bool
    {
        return true;
    }

    /**
     * Whether this is a code block
     *
     * Code blocks are extra-greedy - they'll try to consume all subsequent
     * lines of content without calling matchesNextLine() each time.
     *
     * @return bool
     */
    public function isCode(): bool
    {
        return false;
    }

    /**
     * @param Cursor $cursor
     *
     * @return bool
     */
    public function matchesNextLine(Cursor $cursor): bool
    {
        if (!$cursor->match('/^@endprivate$/')) {
            return true;
        }

        return false;
    }
}