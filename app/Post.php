<?php

namespace App;


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
     * BlogPost constructor.
     * @param string $slug
     * @param string $title
     * @param string $content
     */
    public function __construct($slug, $title, $content)
    {
        $this->slug    = $slug;
        $this->title   = $title;
        $this->content = $content;
    }
}