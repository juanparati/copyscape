<?php

namespace Juanparati\Copyscape;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;


/**
 * Class CopyscapeServiceProvider.
 *
 * @package Juanparati\Copyscape
 */
class CopyscapeServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole())
            $this->publishes([__DIR__ . '/../config/copyscape.php' => config_path('copyscape.php')]);
        elseif ($this->app instanceof LumenApplication)
            $this->app->configure('copyscape');
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/copyscape.php',
            'copyscape'
        );

        $this->app->singleton(CopyscapeClient::class, function ($app)
        {
            return new CopyscapeClient($app['config']['copyscape']);
        });

        $this->app->alias(CopyscapeClient::class, class_basename(CopyscapeClient::class));
    }
}
