<?php

namespace App;

interface PostFactory
{
    /**
     * @param string $content
     * @param string $title
     * @param string $slug
     * @return Post
     */
    public function make($content, $title = '', $slug = '');
}