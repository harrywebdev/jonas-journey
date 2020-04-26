<?php

namespace App\Blog;

interface PostFactory
{
    /**
     * @param string        $content
     * @param string        $title
     * @param string        $slug
     * @param PostMeta|null $meta
     * @return Post
     */
    public function make(string $content, string $title = '', string $slug = '', PostMeta $meta = null): Post;
}