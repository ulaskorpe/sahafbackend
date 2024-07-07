<?php

namespace App\Providers;

use App\Http\Services\FrontEndServices;
use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Blog;
use App\Observers\BlogObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FrontEndServices::class, function($app){
            return new FrontEndServices();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
      //  Blog::observe(BlogObserver::class);
    }
}
