<?php

namespace App\Blog;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class LocalMdPostRepository implements PostRepository
{
    /**
     * @var MdPostFactory
     */
    private $postFactory;

    /**
     * @var Collection
     */
    private $postsIndex;

    /**
     * PostRepository constructor.
     * @param MdPostFactory $postFactory
     */
    public function __construct(MdPostFactory $postFactory)
    {
        $this->postFactory = $postFactory;
        $this->postsIndex  = $this->retrievePostsFromFilesystem();
    }

    /**
     * @param string $slug
     * @return Post
     * @throws \Exception
     */
    public function find(string $slug): Post
    {
        $postCursor = $this->postsIndex->first(function ($p) use ($slug) {
            return $p['slug'] === $slug;
        });

        if (!$postCursor) {
            throw new \Exception("Post '$slug' not found");
        }

        $content = Storage::get($postCursor['filename']);

        return $this->postFactory->make($content, '', $slug);
    }

    /**
     * @return Post|null
     */
    public function first()
    {
        $post = $this->postsIndex->first();

        if (!$post) {
            return null;
        }

        return $this->find($post['slug']);
    }

    /**
     * @return Collection
     */
    private function retrievePostsFromFilesystem(): Collection
    {
        $posts = collect(Storage::allFiles('blog-posts'))
            ->filter(function ($filename) {
                return preg_match('/\.md$/', $filename);
            })
            ->sort()
            ->map(function ($filename) {
                return [
                    'filename' => $filename,
                    'slug'     => preg_replace('/blog-posts\\' . DIRECTORY_SEPARATOR . '|\.md/', '', $filename),
                ];
            });

        return $posts;
    }

}