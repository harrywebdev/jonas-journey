<?php

namespace App\Blog;

use App\Blog\Markdown\CustomMarkdownExtension;
use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
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
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new CustomMarkdownExtension());

        $this->converter = new CommonMarkConverter([], $environment);
        $this->parser    = new DocParser($environment);
    }

    /**
     * @param string        $content
     * @param string        $title
     * @param string        $slug
     * @param PostMeta|null $meta
     * @return Post
     */
    public function make(string $content, string $title = '', string $slug = '', PostMeta $meta = null): Post
    {
        $title   = $title ?: $this->getTitleFromContent($content);
        $slug    = $slug ?: Str::slug($title);
        $content = $this->converter->convertToHtml($content);

        $meta = $meta ?: new PostMeta();

        return new Post($title, $content, $slug, $meta);
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