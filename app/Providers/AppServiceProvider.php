<?php

namespace App\Providers;

use App\PostFactory;
use App\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostFactory::class, function () {
            return new PostFactory();
        });

        $this->app->singleton(PostRepository::class, function ($app) {
            return new PostRepository($app->make(PostFactory::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
