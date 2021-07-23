<?php

namespace Jason\Rest;

use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Jason\Rest\Http\Middleware\AcceptHeader;
use Jason\Rest\Listeners\RevokeOldTokens;
use Laravel\Passport\Http\Middleware\CheckForAnyScope;
use Laravel\Passport\Http\Middleware\CheckScopes;
use Laravel\Passport\Passport;

class RestServiceProvider extends IlluminateServiceProvider
{

    /**
     * 命令行操作
     * @var array
     */
    protected array $commands = [
        Console\RestCommand::class,
    ];

    /**
     * 路由中间件
     * @var array
     */
    protected array $routeMiddleware = [
        'accept' => AcceptHeader::class,
        'scopes' => CheckScopes::class,
        'scope'  => CheckForAnyScope::class,
    ];

    /**
     * Notes   : 部署时运行
     * @Date   : 2021/7/21 4:17 下午
     * @Author : < Jason.C >
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => $this->app->configPath()], 'rest-api-config');
        }
        // 合并配置文件
        $this->mergeConfigFrom(__DIR__ . '/../config/rest.php', 'rest');
        // 修改默认看守器的配置
        $this->app['config']->set('auth.guards.api.driver', $this->app['config']->get('rest.guard'));
        // Passport 的缓存配置
        if ($this->app['config']->get('rest.passport_cache.enable')) {
            $this->app['config']->set('passport.cache', $this->app['config']->get('rest.cache'));
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes($this->app['config']->get('rest.tokens_expire_time')));
        Passport::refreshTokensExpireIn(Carbon::now()
                                              ->addMinutes($this->app['config']->get('rest.refresh_tokens_expire')));
        Passport::personalAccessTokensExpireIn(Carbon::now()
                                                     ->addMinutes($this->app['config']->get('rest.personal_access_tokens_expire')));
        // 注册令牌作用域
        Passport::tokensCan($this->app['config']->get('rest.scopes'));
        Passport::setDefaultScope($this->app['config']->get('rest.default_scopes'));

        $this->app['events']->subscribe(RevokeOldTokens::class);
    }

    /**
     * Notes   : 注册组件
     * @Date   : 2021/7/21 4:17 下午
     * @Author : < Jason.C >
     */
    public function register(): void
    {
        $this->commands($this->commands);

        $this->registerRouteMiddleware();

        $this->app->singleton('rest', function (Application $app) {
            return new Factory($app);
        });
    }

    /**
     * Notes   : 注册路由中间件
     * @Date   : 2021/7/21 3:29 下午
     * @Author : < Jason.C >
     */
    public function registerRouteMiddleware(): void
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            Route::aliasMiddleware($key, $middleware);
        }
    }

    public function provides(): array
    {
        return ['rest'];
    }

}
