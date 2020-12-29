<?php
namespace Alexmilde\Scaffolder;

use Illuminate\Support\ServiceProvider;
use Alexmilde\Scaffolder\Commands\ScaffoldCommand;

class ScaffolderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/Stubs/' => database_path('migrations') . '/stubs'
            ], 'scaffolder');

            $this->publishes([
                __DIR__.'/Scaffolds/' => database_path('migrations') . '/scaffolds'
            ], 'scaffolder');

            $this->commands([
                ScaffoldCommand::class,
            ]);
        }
    }
}
