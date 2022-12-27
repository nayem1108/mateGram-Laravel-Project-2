<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // Paginator::useBootstrapFive();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();
        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            $view->with('user', auth()->user());
            $view->with('posts', Post::all());
        });

    }
}
