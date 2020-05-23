<?php

namespace App\Blog;

interface PostRepository
{
    /**
     * @param string $slug
     * @return Post
     */
    public function find(string $slug): Post;

    /**
     * @return Post|null
     */
    public function first(): ?Post;

    /**
     * @return Post[]
     */
    public function all(): iterable;

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post;
}
