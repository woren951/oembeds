<?php

namespace Woren951\OEmbeds\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Woren951\OEmbeds\Managers\OEmbeds;

class OEmbedsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('oembeds', function (Application $application) {
            $config = $application->get('config');

            $manager = new OEmbeds();

            foreach ($config->get('oembeds.drivers') as $driver) {
                $manager->registerDriver(
                    new $driver($config->get("oembeds.configs.{$driver}", []))
                );
            }

            return $manager;
        });
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../resources/config/oembeds.php' => config_path('oembeds.php')
        ], 'oebmeds');
    }
}
