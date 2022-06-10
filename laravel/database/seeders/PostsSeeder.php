<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $posts = $this->retrievePostsFromFilesystem();

        $posts->each(function ($post) {
            \App\Post::firstOrCreate(['slug' => $post['slug']], [
                'published_on' => $post['published_on'],
                'content'      => $post['content'],
                'status'       => 'published',
            ]);
        });
    }

    /**
     * @return Collection
     */
    private function retrievePostsFromFilesystem(): Collection
    {
        return collect(Storage::allFiles('blog-posts'))
            ->filter(function ($filename) {
                return preg_match('/\.md$/', $filename);
            })
            ->sort()
            ->map(function ($filename) {
                $content = explode("\n", Storage::get($filename));
                $title   =
                    \Illuminate\Support\Str::of(array_shift($content))->match('/([\d]{1,2}\/[\d]{1,2}\/[\d]{4})/');

                $title   = \Carbon\Carbon::createFromFormat('d/m/Y', $title);
                $content = trim(implode("\n", $content));
                $slug    = preg_replace('/blog-posts\\' . DIRECTORY_SEPARATOR . '|\.md/', '', $filename);

                return [
                    'published_on' => $title->format('Y-m-d'),
                    'content'      => $content,
                    'slug'         => $title->format('Y-m-d'),
                ];
            });
    }

}
