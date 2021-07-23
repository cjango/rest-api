<?php

namespace Jason\Rest\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RestCommand extends Command
{

    /**
     * artisan 执行的命令
     * @var string
     */
    protected $signature = 'rest:install';

    /**
     * 命令介绍
     * @var string
     */
    protected $description = 'Install the RESTful API package';

    /**
     * Notes   : 主执行程序
     * @Date   : 2021/7/23 11:40 上午
     * @Author : < Jason.C >
     */
    public function handle()
    {
        // 迁移passport的数据库
        Artisan::call('migrate --path=vendor/laravel/passport/database/migrations');
        // 安装passport，初始化客户端和key等操作
        Artisan::call('passport:install');
        // 发布配置文件
        Artisan::call('vendor:publish --tag=rest-api-config');
    }

}