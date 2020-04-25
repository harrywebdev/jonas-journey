<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class PostRepository
{
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var Collection
     */
    private $posts;

    /**
     * PostRepository constructor.
     * @param PostFactory $postFactory
     */
    public function __construct(PostFactory $postFactory)
    {
        $this->postFactory = $postFactory;
        $this->posts       = $this->retrievePostsFromFilesystem();
    }

    /**
     * @return Post[]
     */
    public function all()
    {
        return $this->posts->toArray();
    }

    /**
     * @return Collection
     */
    private function retrievePostsFromFilesystem()
    {
        $posts = collect(Storage::allFiles('blog-posts'))
            ->filter(function ($filename) {
                return preg_match('/\.md$/', $filename);
            })
            ->map(function ($filename) {
                $slug = preg_replace('/blog-posts\\' . DIRECTORY_SEPARATOR . '|\.md/', '', $filename);

                return $this->postFactory->make($slug, Storage::get($filename));
            });

        return $posts;
    }
}