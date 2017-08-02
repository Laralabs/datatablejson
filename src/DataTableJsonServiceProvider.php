<?php

namespace Laralabs\DataTableJson;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class DataTableJsonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('DataTableJsonFacade', function ($app) {
            $view = config('datatablejson.bind_js_vars_to_this_view');
            $namespace = config('datatablejson.js_namespace');

            $binder = new DataTableJsonViewBinder($app['events'], $view);

            return new DataTableJsonConverter($binder, $namespace);
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/datatablejson.php', 'datatablejson'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/datatablejson.php'  =>  config_path('datatablejson.php')
        ], 'config');

        AliasLoader::getInstance()->alias(
            'DataTableJsonFacade',
            'Laralabs\DataTableJson\Facade\DataTableJsonFacade'
        );
    }
}