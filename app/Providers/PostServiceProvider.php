<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\PostFactory;
use App\MdPostFactory;
use App\PostRepository;
use App\LocalMdPostRepository;

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
