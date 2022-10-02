<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('fullinfo', function ($expression) {
            return "<?php if(auth()->user()->mobile_no): ?>";
        });

        Blade::directive('endfullinfo', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
