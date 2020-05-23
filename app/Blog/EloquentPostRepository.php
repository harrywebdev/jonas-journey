<?php

namespace App\Blog;

use Illuminate\Support\Str;

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
        return $this->decorateWithPostMeta(Post::orderBy('published_on')->first());
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

    /**
     * @return Post[]
     */
    public function all(): iterable
    {
        return Post::orderBy('published_on')->get();
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        if (!isset($data['slug'])) {
            $data['slug'] = isset($data['title']) && $data['title'] ? Str::slug($data['title']) : $data['published_on'];
        }

        return Post::create($data);
    }

    /**
     * @param string $slug
     * @param array  $data
     * @return Post
     */
    public function update(string $slug, array $data): Post
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->fill($data);
        $post->save();

        return $post;
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function delete(string $slug): bool
    {
        return Post::where('slug', $slug)->firstOrFail()->delete();
    }
}
