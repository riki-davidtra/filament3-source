<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ConfigItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('configItems', function () {
            if (Schema::hasTable('config_items')) {
                return ConfigItem::all()->keyBy('key');
            }
            return collect();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $configItems = app('configItems');
            $view->with('configItems', $configItems);
        });
    }
}
