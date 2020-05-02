<?php

namespace App\Blog;


class EloquentPostRepository implements PostRepository
{

    /**
     * @param string $slug
     * @return Post
     */
    public function find(string $slug): Post
    {
        return Post::where('slug', $slug)->firstOrFail();
    }

    /**
     * @return Post|null
     */
    public function first(): ?Post
    {
        return Post::first();
    }
}