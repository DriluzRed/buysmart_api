<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $categories = Category::with('subcategories')->get();
            $config = Setting::all()->pluck('value', 'key')->toArray();
            $view->with('categories', $categories)
            ->with('config', $config);
        });

    }
}
