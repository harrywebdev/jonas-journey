<?php

namespace App\Providers;

use App\Blog\EloquentPostRepository;
use App\Blog\MarkdownPostContentRenderer;
use App\Blog\PostContentRenderer;
use Illuminate\Support\ServiceProvider;
use App\Blog\PostRepository;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostContentRenderer::class, function () {
            return new MarkdownPostContentRenderer();
        });

        $this->app->singleton(PostRepository::class, function ($app) {
            return new EloquentPostRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
