<?php

namespace Jdecano\EventsStarter;

use Illuminate\Support\ServiceProvider;

class EventsStarterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('RecurringEvent', function() {
            return new RecurringEvent();
        });
    }
}