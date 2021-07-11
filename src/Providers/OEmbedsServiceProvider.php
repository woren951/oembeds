<?php

namespace Woren951\OEmbeds\Providers;

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
        $this->app->singleton('oembeds', OEmbeds::class);
    }
}
