<?php

namespace Betta\LaravelIcal;

use Illuminate\Support\ServiceProvider;

class ICalendarServiceProvider extends ServiceProvider
{
    /**
     * Store the shared name value
     *
     * @var string
     */
    protected $name = 'laravel-ical';

    /**
     * Base package path
     *
     * @var string
     */
    protected $baseDir = __DIR__.'/../';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
    }
}
