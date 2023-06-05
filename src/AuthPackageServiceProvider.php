<?php

namespace ReesMcIvor\Auth;

use Illuminate\Support\ServiceProvider;

class AuthPackageServiceProvider extends ServiceProvider
{

    protected $namespace = 'ReesMcIvor\Auth\Http\Controllers';

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/tenant' => database_path('migrations/tenant'),
                //__DIR__ . '/../database/factories' => database_path('factories'),
                __DIR__ . '/../publish/tests' => base_path('tests/Auth'),
            ], 'laravel-tenancy-auth');
        }

        /*
        $this->commands([
            \ReesMcIvor\Forms\Console\Commands\SeedForms::class,
        ]);
        */

        $this->loadRoutesFrom(__DIR__.'/routes/tenant.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'forms');
    }

    public function map()
    {
        $this->mapTenantRoutes();
    }

    protected function mapTenantRoutes()
    {
        Route::middleware(['web', 'tenant'])
            ->namespace($this->namespace)
            ->group($this->modulePath('routes/tenant.php'));
    }

    private function modulePath($path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
