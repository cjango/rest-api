<?php

namespace Jason\Rest;

use Illuminate\Foundation\Application;

class Factory
{

    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Notes   : 当前登录用户
     * @Date   : 2021/7/21 5:30 下午
     * @Author : < Jason.C >
     * @return mixed
     */
    public function user()
    {
        return $this->app['auth']->user();
    }

    /**
     * Notes   : 当前登录用户ID
     * @Date   : 2021/7/21 5:31 下午
     * @Author : < Jason.C >
     * @return mixed
     */
    public function userId()
    {
        return $this->app['auth']->id();
    }

}