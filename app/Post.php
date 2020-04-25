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
     * @param string $title
     * @param string $content
     * @param string $slug
     */
    public function __construct($title, $content, $slug)
    {
        $this->title   = $title;
        $this->content = $content;
        $this->slug    = $slug;
    }
}