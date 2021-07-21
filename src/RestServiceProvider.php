<?php

namespace Jason\Rest;

use Illuminate\Support\ServiceProvider;

class RestServiceProvider extends ServiceProvider
{

    /**
     * 命令操作
     * @var array
     */
    protected $commands = [
        Console\RestCommand::class,
    ];

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => $this->app->configPath()], 'rest-api-config');
        }
    }

    public function register()
    {
        // 合并配置文件
        $this->mergeConfigFrom(__DIR__ . '/../config/rest.php', 'rest');

        // 修改默认看守器的配置
        $this->app['config']->set('auth.guards.api', $this->config['rest']->get('rest.guard'));

        // 注册命令行工具
        $this->commands($this->commands);
    }

    public function provides(): array
    {
        return ['rest'];
    }

}
