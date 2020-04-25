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
    private $posts;

    /**
     * PostRepository constructor.
     * @param MdPostFactory $postFactory
     */
    public function __construct(MdPostFactory $postFactory)
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
                $content = Storage::get($filename);
                $slug    = preg_replace('/blog-posts\\' . DIRECTORY_SEPARATOR . '|\.md/', '', $filename);

                return $this->postFactory->make($content, '', $slug);
            });

        return $posts;
    }
}