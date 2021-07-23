<?php

return [

    'guard'                         => env('REST_API_GUARD', 'passport'),

    /**
     * 重新登录后，自动作废以前的token
     */
    'token_auto_revoke'             => env('TOKEN_AUTO_REVOKE', true),
    /**
     * TOKEN 过期时间，这个不确定是啥，单位 分钟
     */
    'tokens_expire_time'            => env('TOKENS_EXPIRE_TIME', 0),
    /**
     * 可用的刷新时间，单位 分钟
     */
    'refresh_tokens_expire'         => env('REFRESH_TOKENS_EXPIRE', 0),
    /**
     * 个人TOKEN过期时间，单位 分钟
     */
    'personal_access_tokens_expire' => env('PERSONAL_ACCESS_TOKENS_EXPIRE', 0),

    /**
     * 作用域的配置
     */
    'scopes'                        => [],
    /**
     * 默认作用域
     */
    'default_scopes'                => [],

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
