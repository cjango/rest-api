<?php

namespace Jason\Rest\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptHeader
{

    /**
     * Notes   : 增加默认头信息
     * @Date   : 2021/7/21 3:37 下午
     * @Author : < Jason.C >
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }

}
