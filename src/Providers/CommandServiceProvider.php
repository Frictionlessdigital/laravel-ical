<?php

namespace Betta\Npi\Providers;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * List Commands to register
     *
     * @var Array
     */
    protected $commands = [
    ];

    /**
     * Register Commands
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
