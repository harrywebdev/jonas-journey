<?php

namespace App\Blog;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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
        $iterator = $this->postsIndex->getIterator();

        // find our post + prev/next ones
        while ($iterator->valid()) {
            $postCursor = $iterator->current();

            if ($postCursor['slug'] === $slug) {
                $content = Storage::get($postCursor['filename']);

                // get prev + next post slugs
                $postMeta = new PostMeta();
                if ($iterator->offsetExists($iterator->key() - 1)) {
                    $postMeta->setPreviousPostSlug($iterator->offsetGet($iterator->key() - 1)['slug']);
                }

                if ($iterator->offsetExists($iterator->key() + 1)) {
                    $postMeta->setNextPostSlug($iterator->offsetGet($iterator->key() + 1)['slug']);
                }

                return $this->postFactory->make($content, '', $slug, $postMeta);
            }

            $iterator->next();
        }

        throw new \Exception("Post '$slug' not found");
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
        if (Cache::has('blog_posts_index')) {
            return Cache::get('blog_posts_index');
        }

        return Cache::remember('blog_posts_index', 60 * 60 * 2, function () {
            return collect(Storage::allFiles('blog-posts'))
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
        });
    }

}