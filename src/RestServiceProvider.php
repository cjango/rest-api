<?php

namespace Jason\Rest;

use Illuminate\Support\ServiceProvider;

class RestServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()], 'restful-api-config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/restful.php', 'restful');
    }

    public function provides(): array
    {
        return ['restful'];
    }

}
