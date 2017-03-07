<?php

namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;

class WorkdayServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Nht\Hocs\Workdays\WorkdayRepository', 'Nht\Hocs\Workdays\DbWorkdayRepository');
    }
}
