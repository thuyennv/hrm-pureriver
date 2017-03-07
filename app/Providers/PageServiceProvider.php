<?php

namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Nht\Hocs\Pages\PageRepository', 'Nht\Hocs\Pages\DbPageRepository');
    }
}
