<?php

return [

    'guard'                         => env('REST_API_GUARD', 'passport'),

    /**
     * 重新登录后，自动作废以前的token
     */
    'token_auto_revoke'             => env('TOKEN_AUTO_REVOKE', true),
    /**
     * TOKEN 过期时间，这个不确定是啥
     */
    'tokens_expire_time'            => env('TOKENS_EXPIRE_TIME', 60),
    /**
     * 可用的刷新时间
     */
    'refresh_tokens_expire'         => env('REFRESH_TOKENS_EXPIRE', 60 * 24 * 7),
    /**
     * 个人TOKEN过期时间
     */
    'personal_access_tokens_expire' => env('PERSONAL_ACCESS_TOKENS_EXPIRE', 60),

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
