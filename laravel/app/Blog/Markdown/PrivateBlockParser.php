<?php

namespace App\Blog\Markdown;


use Illuminate\Support\Facades\Gate;
use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

class PrivateBlockParser implements BlockParserInterface
{

    /**
     * @param ContextInterface $context
     * @param Cursor           $cursor
     *
     * @return bool
     */
    public function parse(ContextInterface $context, Cursor $cursor): bool
    {
        // check if we reached a private block
        $private = $cursor->match('/^@(end)?private$/');
        if ($private === null) {
            return false;
        }

        // ignore, so everything gets parsed as usual
        if (Gate::allows('sees-private')) {
            return false;
        }

        // skip to the end
        $context->addBlock(new PrivateBlock());
        return true;
    }
}