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
        return $this->decorateWithPostMeta(Post::where('slug', $slug)->firstOrFail());
    }

    /**
     * @return Post|null
     */
    public function first(): ?Post
    {
        return $this->decorateWithPostMeta(Post::first());
    }

    /**
     * @param Post|null $post
     * @return Post|null
     */
    private function decorateWithPostMeta(?Post $post): ?Post
    {
        if (!$post) {
            return null;
        }

        $previous = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $next     = Post::where('id', '>', $post->id)->orderBy('id')->first();

        // get prev + next post slugs
        $postMeta = new PostMeta();
        if ($previous) {
            $postMeta->setPreviousPostSlug($previous->slug);
        }

        if ($next) {
            $postMeta->setNextPostSlug($next->slug);
        }

        $post->meta = $postMeta;

        return $post;
    }
}