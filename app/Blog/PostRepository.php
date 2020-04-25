<?php

namespace App\Blog;

interface PostRepository
{
    /**
     * @return Post[]
     */
    public function all();
}