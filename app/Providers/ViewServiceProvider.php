<?php

namespace App\Providers;

use App\Composers\CategoryComposer;
use App\Models\Catagory;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
        $this->app->singleton(CategoryComposer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('*', CategoryComposer::class);
    }
}
