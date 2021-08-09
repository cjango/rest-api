<?php

namespace Jason\Rest\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;

class AuthCheck extends Authenticate
{

    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('api')->check()) {
            return $this->auth->shouldUse('api');
        }

        $this->unauthenticated($request, $guards);
    }

}