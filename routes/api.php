<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;

// Health check endpoint for monitoring
Route::get('/health', function () {
    $health = [
        'status' => 'healthy',
        'timestamp' => now()->toIso8601String(),
        'services' => [],
    ];

    // Check database connection
    try {
        DB::connection()->getPdo();
        $health['services']['database'] = 'ok';
    } catch (\Exception $e) {
        $health['status'] = 'unhealthy';
        $health['services']['database'] = 'error';
    }

    // Check cache
    try {
        Cache::store()->getStore();
        $health['services']['cache'] = 'ok';
    } catch (\Exception $e) {
        $health['services']['cache'] = 'error';
    }

    // Check queue size (warning if > 1000)
    try {
        $queueSize = Queue::size();
        $health['services']['queue'] = $queueSize < 1000 ? 'ok' : 'warning';
        $health['services']['queue_size'] = $queueSize;
    } catch (\Exception $e) {
        $health['services']['queue'] = 'error';
    }

    $statusCode = $health['status'] === 'healthy' ? 200 : 503;

    return response()->json($health, $statusCode);
})->middleware('throttle:60,1');

// Simple search endpoint for landing page
Route::get('/search', function (Request $request) {
    // Validate and sanitize input
    $validated = $request->validate([
        'q' => 'required|string|min:2|max:100',
    ]);

    // Sanitize HTML and special characters
    $query = strip_tags($validated['q']);

    // Use FULLTEXT search (safe from SQL injection)
    $posts = Post::query()
        ->where('status', 'published')
        ->search($query) // Using scopeSearch with parameter binding
        ->with('category') // Eager load to prevent N+1
        ->orderBy('published_at', 'desc')
        ->limit(10)
        ->get()
        ->map(function($post) {
            return [
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'category' => $post->category->name ?? 'Uncategorized',
                'date' => $post->published_at?->format('d M Y') ?? '',
            ];
        });

    return response()->json(['data' => $posts]);
})->middleware('throttle:public-content'); // Use rate limit from config

Route::prefix('v1')
    ->name('api.v1.')
    ->middleware(['api'])
    ->group(function (): void {
        Route::prefix('auth')->group(function (): void {
            Route::post('register', [AuthController::class, 'register'])
                ->middleware('throttle:60,1')
                ->name('auth.register');
            Route::post('login', [AuthController::class, 'login'])
                ->middleware('throttle:5,5') // 5 attempts per 5 minutes
                ->name('auth.login');

            Route::middleware(['auth:sanctum', 'active'])->group(function (): void {
                Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
                Route::get('profile', [AuthController::class, 'profile'])->name('auth.profile');
            });
        });

        Route::get('posts', [PostController::class, 'index'])
            ->middleware(['throttle:public-content', 'cache.response:600'])
            ->name('posts.index');
        Route::get('posts/{post:slug}', [PostController::class, 'show'])
            ->middleware(['throttle:public-content', 'cache.response:1800'])
            ->name('posts.show');

        Route::get('pages', [PageController::class, 'index'])
            ->middleware(['throttle:public-content', 'cache.response:3600'])
            ->name('pages.index');
        Route::get('pages/{slug}', [PageController::class, 'show'])
            ->middleware(['throttle:public-content', 'cache.response:3600'])
            ->name('pages.show');

        Route::middleware(['auth:sanctum', 'active', 'abilities:posts:write', 'throttle:content-write'])->group(function (): void {
            Route::post('posts', [PostController::class, 'store'])->name('posts.store');
            Route::match(['put', 'patch'], 'posts/{post}', [PostController::class, 'update'])->name('posts.update');
            Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        });

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('categories/{category:slug}/posts', [CategoryController::class, 'posts'])->name('categories.posts');

        Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
        Route::get('posts/{post:slug}/comments', [CommentController::class, 'forPost'])->name('posts.comments.index');
        Route::post('posts/{post:slug}/comments', [CommentController::class, 'store'])
            ->middleware('throttle:comments')
            ->name('posts.comments.store');

        Route::middleware(['auth:sanctum', 'active', 'abilities:comments:moderate'])->group(function (): void {
            Route::post('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
            Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
        });
    });
