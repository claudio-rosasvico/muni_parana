<?php

namespace App\Providers;

use App\Models\Emprendedor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            $emprendedoresInactivos = Emprendedor::where('activo', 0)->count();
            $view->with('emprendedoresInactivos', $emprendedoresInactivos);
        });
    }
}
