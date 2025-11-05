<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Monitoring Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for application monitoring, alerting, and performance tracking.
    |
    */

    'enabled' => env('MONITORING_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Alert Thresholds
    |--------------------------------------------------------------------------
    |
    | Define thresholds for triggering alerts
    |
    */

    'thresholds' => [
        // Response time threshold in milliseconds
        'response_time' => env('MONITORING_RESPONSE_TIME_THRESHOLD', 1000),

        // Error rate threshold (errors per minute)
        'error_rate' => env('MONITORING_ERROR_RATE_THRESHOLD', 10),

        // Queue size threshold
        'queue_size' => env('MONITORING_QUEUE_SIZE_THRESHOLD', 1000),

        // Memory usage threshold in MB
        'memory_usage' => env('MONITORING_MEMORY_THRESHOLD', 512),

        // Cache hit ratio threshold (0-1)
        'cache_hit_ratio' => env('MONITORING_CACHE_HIT_RATIO_THRESHOLD', 0.7),
    ],

    /*
    |--------------------------------------------------------------------------
    | Metrics Collection
    |--------------------------------------------------------------------------
    */

    'metrics' => [
        // Enable metrics collection
        'enabled' => env('METRICS_ENABLED', true),

        // Metrics retention in seconds
        'retention' => env('METRICS_RETENTION', 3600),

        // Sample rate (1 = 100%, 0.1 = 10%)
        'sample_rate' => env('METRICS_SAMPLE_RATE', 1.0),
    ],

    /*
    |--------------------------------------------------------------------------
    | Slow Query Detection
    |--------------------------------------------------------------------------
    */

    'slow_query' => [
        // Enable slow query detection
        'enabled' => env('SLOW_QUERY_DETECTION', true),

        // Threshold in milliseconds
        'threshold' => env('SLOW_QUERY_THRESHOLD', 1000),
    ],

    /*
    |--------------------------------------------------------------------------
    | Alerting Channels
    |--------------------------------------------------------------------------
    */

    'alerting' => [
        'slack' => env('ALERTING_SLACK_ENABLED', false),
        'discord' => env('ALERTING_DISCORD_ENABLED', false),
        'email' => env('ALERTING_EMAIL_ENABLED', false),
        'log' => env('ALERTING_LOG_ENABLED', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance Monitoring
    |--------------------------------------------------------------------------
    */

    'performance' => [
        // Track request performance
        'track_requests' => env('TRACK_REQUEST_PERFORMANCE', true),

        // Track database queries
        'track_queries' => env('TRACK_QUERY_PERFORMANCE', true),

        // Track cache operations
        'track_cache' => env('TRACK_CACHE_PERFORMANCE', true),
    ],

];
