<?php

namespace App\Blog;

use App\Blog\Markdown\CustomMarkdownExtension;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class MarkdownPostContentRenderer implements PostContentRenderer
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
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new CustomMarkdownExtension());

        $this->converter = new CommonMarkConverter([], $environment);
        $this->parser    = new DocParser($environment);
    }

    /**
     * @param string $content
     * @return string
     */
    public function render(string $content): string
    {
        return $this->converter->convertToHtml($content);
    }
}