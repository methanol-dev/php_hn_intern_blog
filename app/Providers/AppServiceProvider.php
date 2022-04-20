<?php

namespace App\Providers;

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
        $this->app->singleton(
            \App\Repositories\Comment\CommentRepositoryInterface::class,
            \App\Repositories\Comment\CommentRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Admin\AdminRepositoryInterface::class,
            \App\Repositories\Admin\AdminRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Home\HomeRepositoryInterface::class,
            \App\Repositories\Home\HomeRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Post\PostRepositoryInterface::class,
            \App\Repositories\Post\PostRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );
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
