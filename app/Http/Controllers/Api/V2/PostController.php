<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * API v2 Post Controller
 *
 * Improvements over v1:
 * - GraphQL-style field selection
 * - Cursor-based pagination
 * - Better performance
 * - Enhanced filtering
 */
class PostController extends Controller
{
    public function __construct(
        protected readonly PostService $postService,
    ) {
    }

    /**
     * List posts with cursor-based pagination
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fields' => 'sometimes|string', // Comma-separated fields
            'include' => 'sometimes|string', // Comma-separated relations
            'cursor' => 'sometimes|string',
            'limit' => 'sometimes|integer|min:1|max:100',
            'search' => 'sometimes|string|min:2|max:100',
            'category_slug' => 'sometimes|string',
            'sort' => 'sometimes|in:published_at,view_count,created_at',
            'direction' => 'sometimes|in:asc,desc',
        ]);

        // Build query
        $query = Post::query()
            ->where('status', 'published');

        // Apply search
        if (!empty($validated['search'])) {
            $query->search($validated['search']);
        }

        // Apply category filter
        if (!empty($validated['category_slug'])) {
            $query->whereHas('category', fn($q) => $q->where('slug', $validated['category_slug']));
        }

        // Dynamic includes (relations)
        $includes = !empty($validated['include'])
            ? explode(',', $validated['include'])
            : ['category', 'author'];
        $query->with($includes);

        // Sorting
        $sortField = $validated['sort'] ?? 'published_at';
        $direction = $validated['direction'] ?? 'desc';
        $query->orderBy($sortField, $direction);

        // Cursor pagination (more efficient than offset)
        $limit = $validated['limit'] ?? 20;
        $posts = $query->cursorPaginate($limit);

        return PostResource::collection($posts)
            ->additional([
                'meta' => [
                    'version' => '2.0',
                    'cursor' => [
                        'next' => $posts->nextCursor()?->encode(),
                        'prev' => $posts->previousCursor()?->encode(),
                    ],
                ],
            ])
            ->response();
    }

    /**
     * Get single post
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $validated = $request->validate([
            'fields' => 'sometimes|string',
            'include' => 'sometimes|string',
        ]);

        $post = Post::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Dynamic includes
        $includes = !empty($validated['include'])
            ? explode(',', $validated['include'])
            : ['category', 'author', 'tags'];
        $post->loadMissing($includes);

        // Track view
        $post->incrementViews();

        return PostResource::make($post)
            ->additional([
                'meta' => [
                    'version' => '2.0',
                ],
            ])
            ->response();
    }
}
