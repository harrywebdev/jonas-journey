<?php

namespace App\Blog\Markdown;


use League\CommonMark\Inline\Parser\InlineParserInterface;
use League\CommonMark\InlineParserContext;

class VideoParser implements InlineParserInterface
{

    /**
     * @return string[]
     */
    public function getCharacters(): array
    {
        return ['!'];
    }

    /**
     * @param InlineParserContext $inlineContext
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();

        // The ! symbol must not have any other characters immediately prior
        $previousChar = $cursor->peek(-1);
        if ($previousChar !== null && $previousChar !== ' ') {
            return false;
        }

        // syntax for video is
        // !video[title](file_url)
        if (!preg_match('/^!video\[(?P<title>.*)\]\((?P<url>.+)\)$/', $cursor->getLine(), $matches)) {
            return false;
        }

        $inlineContext->getContainer()->appendChild(new Video($matches['url'], $matches['title']));
        
        $cursor->advanceToEnd();

        return true;
    }
}