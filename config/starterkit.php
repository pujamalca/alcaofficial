<?php

return [
    'cache' => [
        'pages_ttl' => env('STARTERKIT_CACHE_PAGES_TTL', 600),
        'settings_ttl' => env('STARTERKIT_CACHE_SETTINGS_TTL', 300),
    ],
    'rate_limit' => [
        'public' => env('STARTERKIT_RATE_LIMIT_PUBLIC', 60), // Reduced from 120 for better security
        'content_write' => env('STARTERKIT_RATE_LIMIT_CONTENT_WRITE', 10), // Reduced from 30 to prevent abuse
        'comments' => env('STARTERKIT_RATE_LIMIT_COMMENTS', 20),
        'login' => env('STARTERKIT_RATE_LIMIT_LOGIN', 5), // 5 attempts per 5 minutes for login
    ],
];
