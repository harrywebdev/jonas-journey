<?php

namespace App\Blog;

interface PostContentRenderer
{
    /**
     * @param string $content
     * @return string
     */
    public function render(string $content): string;
}