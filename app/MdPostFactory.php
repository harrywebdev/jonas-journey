<?php

namespace App;

use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\Inline\Element\Text;

class MdPostFactory implements PostFactory
{
    /**
     * @var CommonMarkConverter
     */
    private $converter;

    /**
     * @var DocParser
     */
    private $parser;

    /**
     * MdPostFactory constructor.
     */
    public function __construct()
    {
        $environment     = Environment::createCommonMarkEnvironment();
        $this->converter = new CommonMarkConverter();
        $this->parser    = new DocParser($environment);
    }

    /**
     * @param string $content
     * @param string $title
     * @param string $slug
     * @return Post
     */
    public function make($content, $title = '', $slug = '')
    {
        $title   = $title ?: $this->getTitleFromContent($content);
        $slug    = $slug ?: Str::slug($title);
        $content = $this->converter->convertToHtml($content);

        return new Post($title, $content, $slug);
    }

    /**
     * @param string $content
     * @return string
     * @throws \Exception
     */
    private function getTitleFromContent($content)
    {
        $document = $this->parser->parse($content);

        $heading = $document->firstChild();
        if ($heading instanceof Heading) {
            $headingTexgt = $document->firstChild()->firstChild();

            if ($headingTexgt instanceof Text) {
                return $headingTexgt->getContent();
            }
        }

        throw new \Exception('No heading present in content');
    }
}