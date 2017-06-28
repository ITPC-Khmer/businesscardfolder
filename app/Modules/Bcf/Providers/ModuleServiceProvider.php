<?php

namespace App\Modules\Bcf\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'bcf');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'bcf');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'bcf');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
