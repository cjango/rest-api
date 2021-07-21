<?php

namespace Jason\Rest;

use Illuminate\Support\ServiceProvider;

class RestServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => $this->app->configPath()], 'rest-api-config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rest.php', 'rest');

        $this->app['config']->set('auth.guards.api', $this->config['rest']->get('rest.guard'));
    }

    public function provides(): array
    {
        return ['rest'];
    }

}
