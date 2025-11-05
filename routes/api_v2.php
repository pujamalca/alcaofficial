<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V2 Routes
|--------------------------------------------------------------------------
|
| API v2 routes for future enhancements and breaking changes.
| This provides a clean separation for versioning strategy.
|
*/

Route::get('/', function () {
    return response()->json([
        'version' => '2.0',
        'status' => 'available',
        'message' => 'API v2 is ready for development',
        'documentation' => url('/api/documentation'),
    ]);
});

// Placeholder for v2 endpoints
// When ready, create v2 controllers and routes here
// Example:
// Route::get('posts', [V2\PostController::class, 'index']);
