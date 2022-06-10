<?php

namespace App\Blog;


class PostMeta
{
    /**
     * @var string
     */
    public $previousPostSlug;

    /**
     * @var string
     */
    public $nextPostSlug;

    /**
     * PostMeta constructor.
     * @param string $previousPostSlug
     * @param string $nextPostSlug
     */
    public function __construct(string $previousPostSlug = null, string $nextPostSlug = null)
    {
        $this->previousPostSlug = $previousPostSlug;
        $this->nextPostSlug     = $nextPostSlug;
    }

    /**
     * @param string $previousPostSlug
     */
    public function setPreviousPostSlug(string $previousPostSlug)
    {
        $this->previousPostSlug = $previousPostSlug;
    }

    /**
     * @param string $nextPostSlug
     */
    public function setNextPostSlug(string $nextPostSlug)
    {
        $this->nextPostSlug = $nextPostSlug;
    }
}