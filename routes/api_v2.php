<?php

use App\Http\Controllers\Api\V2\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V2 Routes
|--------------------------------------------------------------------------
|
| API v2 routes with improvements:
| - Cursor-based pagination
| - Field selection (GraphQL-style)
| - Better performance
| - Enhanced filtering
|
*/

Route::get('/', function () {
    return response()->json([
        'version' => '2.0',
        'status' => 'production',
        'message' => 'API v2 with cursor pagination, field selection, and performance improvements',
        'features' => [
            'cursor_pagination' => 'Efficient pagination for large datasets',
            'field_selection' => 'Request only fields you need (?fields=id,title,slug)',
            'dynamic_includes' => 'Choose which relations to load (?include=category,author)',
            'optimized_queries' => 'Better database performance',
        ],
        'documentation' => url('/api/documentation'),
        'endpoints' => [
            'posts' => '/api/v2/posts',
            'post_detail' => '/api/v2/posts/{slug}',
        ],
    ]);
});

// Posts endpoints
Route::get('posts', [PostController::class, 'index'])
    ->middleware(['throttle:public-content', 'cache.response:300'])
    ->name('posts.index');

Route::get('posts/{slug}', [PostController::class, 'show'])
    ->middleware(['throttle:public-content', 'cache.response:900'])
    ->name('posts.show');

// Placeholder for future v2 endpoints
// Route::apiResource('categories', CategoryController::class);
// Route::apiResource('users', UserController::class);
