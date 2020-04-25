<?php

namespace App;


class PostFactory
{
    /**
     * @param string $slug
     * @param string $content
     * @return Post
     */
    public function make($slug, $content)
    {
        return new Post($slug, $slug, $content);
    }
}