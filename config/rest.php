<?php

return [

    'guard' => env('REST_API_GUARD', 'passport'),

    'tokens_expire_time'            => 1,
    'refresh_tokens_expire'         => 10,
    'personal_access_tokens_expire' => 10,

    /**
     * Passport Cache Config
     */
    'passport_cache'                => [
        'enable'     => env('REST_PASSPORT_CACHE', false),
        // Cache key prefix
        'prefix'     => 'passport_',
        // The lifetime of token cache,
        // Unit: second
        'expires_in' => 300,
        // Cache tags
        'tags'       => [],
    ],
];
