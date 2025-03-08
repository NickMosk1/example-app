<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $colors = require resource_path('theme/theme.php');
        view()->composer('*', function ($view) use ($colors) {
            $view->with('colors', $colors);
        });
    }

    public function register()
    {
        //
    }
}
