<?php

namespace Jason\Rest\Routing;

use Exception;
use Jason\Rest\Http\Response\Factory;

trait Helper
{

    protected function response()
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