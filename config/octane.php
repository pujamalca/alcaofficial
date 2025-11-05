<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Octane Server
    |--------------------------------------------------------------------------
    |
    | This value determines the default "server" that will be used by Octane
    | when starting, restarting, or stopping your server via the CLI. You
    | are free to change this to the supported server of your choice.
    |
    | Supported: "roadrunner", "swoole", "frankenphp"
    |
    */

    'server' => env('OCTANE_SERVER', 'roadrunner'),

    /*
    |--------------------------------------------------------------------------
    | Force HTTPS
    |--------------------------------------------------------------------------
    |
    | When this configuration value is set to "true", Octane will inform the
    | framework that all absolute links must be generated using the HTTPS
    | protocol. Otherwise, your links may be generated using plain HTTP.
    |
    */

    'https' => env('OCTANE_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Octane Listeners
    |--------------------------------------------------------------------------
    |
    | All of the event listeners for Octane's events are defined below. These
    | listeners are responsible for resetting your application's state for
    | the next request. You may even add your own listeners to the list.
    |
    */

    'listeners' => [
        \Laravel\Octane\Events\WorkerStarting::class => [
            \Laravel\Octane\Listeners\EnsureUploadedFilesAreValid::class,
            \Laravel\Octane\Listeners\EnsureUploadedFilesCanBeMoved::class,
        ],

        \Laravel\Octane\Events\RequestReceived::class => [
            // Custom listeners for request received
        ],

        \Laravel\Octane\Events\RequestHandled::class => [],

        \Laravel\Octane\Events\RequestTerminated::class => [],

        \Laravel\Octane\Events\TaskReceived::class => [],

        \Laravel\Octane\Events\TaskTerminated::class => [],

        \Laravel\Octane\Events\TickReceived::class => [],

        \Laravel\Octane\Events\TickTerminated::class => [],

        \Laravel\Octane\Events\OperationTerminated::class => [
            \Laravel\Octane\Listeners\FlushTemporaryContainerInstances::class,
        ],

        \Laravel\Octane\Events\WorkerErrorOccurred::class => [
            \Laravel\Octane\Listeners\ReportException::class,
            \Laravel\Octane\Listeners\StopWorkerIfNecessary::class,
        ],

        \Laravel\Octane\Events\WorkerStopping::class => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Warm / Flush Bindings
    |--------------------------------------------------------------------------
    |
    | The bindings listed below will either be pre-warmed when a worker boots
    | or they will be flushed before every new request is handled so that
    | no information from a previous request is leaked into a new request.
    |
    */

    'warm' => [
        'auth',
        'auth.driver',
        'blade.compiler',
        'cache',
        'cache.store',
        'config',
        'db',
        'encrypter',
        'files',
        'hash',
        'hash.driver',
        'log',
        'queue',
        'router',
        'session',
        'session.store',
        'translator',
        'url',
        'view',
    ],

    'flush' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Octane Cache Table
    |--------------------------------------------------------------------------
    |
    | This table is used to store the cached data for your application. You
    | may configure the table that should be used when storing cache data
    | or you may use the default table that ships with Laravel Octane.
    |
    */

    'cache' => [
        'rows' => 1000,
    ],

    /*
    |--------------------------------------------------------------------------
    | Octane Swoole Tables
    |--------------------------------------------------------------------------
    |
    | Here you may define any Swoole tables that your application needs. The
    | tables will be created on worker start and will be available in your
    | application via the `app('swoole.table.{name}')` container binding.
    |
    */

    'tables' => [
        'example:1000' => [
            'name' => 'string:1000',
            'votes' => 'int',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File Watching
    |--------------------------------------------------------------------------
    |
    | The following list of files and directories will be watched when using
    | the --watch option. If any of these files are changed, Octane will
    | automatically reload your workers, making development a breeze.
    |
    */

    'watch' => [
        'app',
        'bootstrap',
        'config',
        'database',
        'public/**/*.php',
        'resources/**/*.php',
        'routes',
        'composer.lock',
        '.env',
    ],

    /*
    |--------------------------------------------------------------------------
    | Garbage Collection Threshold
    |--------------------------------------------------------------------------
    |
    | After a certain number of requests, Octane will trigger a full garbage
    | collection cycle. This will help to reduce memory consumption and will
    | also help to prevent memory leaks from occurring in long-running apps.
    |
    */

    'garbage_collection' => [
        'threshold' => env('OCTANE_GC_THRESHOLD', 500),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maximum Execution Time
    |--------------------------------------------------------------------------
    |
    | The following setting configures the maximum execution time of a single
    | request that Octane will allow before terminating the request. This
    | setting is useful to prevent long-running requests from blocking the
    | entire application from handling new requests.
    |
    */

    'max_execution_time' => env('OCTANE_MAX_EXECUTION_TIME', 30),

];
