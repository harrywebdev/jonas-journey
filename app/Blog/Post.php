<?php

namespace App\Blog;

class Post
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var PostMeta
     */
    public $meta;

    /**
     * BlogPost constructor.
     * @param string   $title
     * @param string   $content
     * @param string   $slug
     * @param PostMeta $meta
     */
    public function __construct(string $title, string $content, string $slug, PostMeta $meta)
    {
        $this->title   = $title;
        $this->content = $content;
        $this->slug    = $slug;
        $this->meta    = $meta;
    }
}