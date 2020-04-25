<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Blog\PostFactory;
use App\Blog\MdPostFactory;
use App\Blog\PostRepository;
use App\Blog\LocalMdPostRepository;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostFactory::class, function () {
            return new MdPostFactory();
        });

        $this->app->singleton(PostRepository::class, function ($app) {
            return new LocalMdPostRepository($app->make(PostFactory::class));
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
