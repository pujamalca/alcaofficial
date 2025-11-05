<?php

return [
    /*
     * When calling `optimize` the package will automatically determine which optimizers
     * should run for the given image.
     */
    'optimizers' => [

        Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
            '-m85', // Set maximum quality to 85%
            '--strip-all', // Strip all metadata
            '--all-progressive', // Make all JPEGs progressive
        ],

        Spatie\ImageOptimizer\Optimizers\Pngquant::class => [
            '--force', // Force overwrite
            '--quality=85-100', // Quality range
        ],

        Spatie\ImageOptimizer\Optimizers\Optipng::class => [
            '-i0', // Non-interlaced
            '-o2', // Optimization level 2
            '-quiet', // Suppress output
        ],

        Spatie\ImageOptimizer\Optimizers\Svgo::class => [
            '--disable=cleanupIDs', // Disable cleanup IDs
        ],

        Spatie\ImageOptimizer\Optimizers\Gifsicle::class => [
            '-b', // Batch mode
            '-O3', // Optimization level 3
        ],

        Spatie\ImageOptimizer\Optimizers\Cwebp::class => [
            '-m 6', // Compression method 6 (slowest)
            '-pass 10', // Number of passes
            '-mt', // Multi-threading
            '-q 90', // Quality 90
        ],

    ],

    /*
     * The default timeout for each optimizer in seconds.
     */
    'timeout' => 60,

    /*
     * If set to `true` all output of the optimizer binaries will be appended to the default log.
     * You can also set this to a class that implements `Psr\Log\LoggerInterface`.
     */
    'log_optimizer_activity' => false,
];
