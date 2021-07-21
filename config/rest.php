<?php

return [

    'guard' => env('REST_API_GUARD', 'passport'),

    /**
     * Passport Cache Config
     */
    'cache' => [
        // Cache key prefix
        'prefix'     => 'passport_',
        // The lifetime of token cache,
        // Unit: second
        'expires_in' => 300,
        // Cache tags
        'tags'       => [],
    ],
];
