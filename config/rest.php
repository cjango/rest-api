<?php

return [

    'guard'                         => env('REST_API_GUARD', 'passport'),

    /**
     * TOKEN 过期时间，这个不确定是啥
     */
    'tokens_expire_time'            => env('tokens_expire_time', 60),
    /**
     * 可用的刷新时间
     */
    'refresh_tokens_expire'         => env('refresh_tokens_expire', 60 * 24 * 7),
    /**
     * 个人TOKEN过期时间
     */
    'personal_access_tokens_expire' => env('personal_access_tokens_expire', 60),

    /**
     * Passport Cache Config
     */
    'passport_cache'                => [
        'enable'     => env('REST_PASSPORT_CACHE', true),
        // Cache key prefix
        'prefix'     => 'passport_',
        // The lifetime of token cache,
        // Unit: second
        'expires_in' => 300,
        // Cache tags
        'tags'       => [],
    ],
];
