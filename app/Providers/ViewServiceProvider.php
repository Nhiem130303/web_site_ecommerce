<?php

namespace App\Providers;

use App\View\Composers\Menu;
use App\View\Composers\MiniCart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Menu::class);
        $this->app->singleton(MiniCart::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('web.*', Menu::class);
        View::composer('web.*', MiniCart::class);
    }
}
