<?php

namespace Jason\Rest\Routing;

use Exception;
use Jason\Rest\Http\Response\Factory;

trait Helper
{

    /**
     * Notes   : 返回数据
     * @Date   : 2021/7/26 5:32 下午
     * @Author : < Jason.C >
     * @return \Jason\Rest\Http\Response\Factory
     */
    protected function response(): Factory
    {
        return app(Factory::class);
    }

    /**
     * Magically handle calls to certain properties.
     * @param  string  $key
     * @return mixed
     * @throws \Exception
     */
    public function __get(string $key)
    {
        $callable = [
            'response',
        ];

        if (in_array($key, $callable) && method_exists($this, $key)) {
            return $this->$key();
        }

        throw new Exception('Undefined property ' . get_class($this) . '::' . $key);
    }

}