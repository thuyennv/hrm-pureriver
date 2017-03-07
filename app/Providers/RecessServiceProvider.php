<?php

namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;

class RecessServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Nht\Hocs\Recesses\RecessRepository', 'Nht\Hocs\Recesses\DbRecessRepository');
    }
}
