<?php

namespace App\Http\Resources\V2;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * API v2 Post Resource
 *
 * Improvements:
 * - Field selection support
 * - Conditional loading
 * - Optimized payload size
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get requested fields (default: all)
        $fields = $this->getRequestedFields($request);

        $data = [];

        // Only include requested fields
        if ($this->shouldInclude('id', $fields)) {
            $data['id'] = $this->id;
        }

        if ($this->shouldInclude('title', $fields)) {
            $data['title'] = $this->title;
        }

        if ($this->shouldInclude('slug', $fields)) {
            $data['slug'] = $this->slug;
        }

        if ($this->shouldInclude('excerpt', $fields)) {
            $data['excerpt'] = $this->excerpt;
        }

        if ($this->shouldInclude('content', $fields)) {
            $data['content'] = $this->content;
        }

        if ($this->shouldInclude('featured_image', $fields)) {
            $data['featured_image'] = $this->featured_image;
        }

        if ($this->shouldInclude('status', $fields)) {
            $data['status'] = $this->status;
        }

        if ($this->shouldInclude('view_count', $fields)) {
            $data['view_count'] = (int) $this->view_count;
        }

        if ($this->shouldInclude('reading_time', $fields)) {
            $data['reading_time'] = $this->reading_time;
        }

        if ($this->shouldInclude('published_at', $fields)) {
            $data['published_at'] = optional($this->published_at)->toIso8601String();
        }

        if ($this->shouldInclude('created_at', $fields)) {
            $data['created_at'] = optional($this->created_at)->toIso8601String();
        }

        if ($this->shouldInclude('updated_at', $fields)) {
            $data['updated_at'] = optional($this->updated_at)->toIso8601String();
        }

        // Relations (only if loaded)
        if ($this->shouldInclude('category', $fields)) {
            $data['category'] = $this->whenLoaded('category', fn() => CategoryResource::make($this->category));
        }

        if ($this->shouldInclude('author', $fields)) {
            $data['author'] = $this->whenLoaded('author', fn() => UserResource::make($this->author));
        }

        if ($this->shouldInclude('tags', $fields)) {
            $data['tags'] = $this->whenLoaded('tags', fn() => TagResource::collection($this->tags));
        }

        // HATEOAS links (always included)
        $data['_links'] = [
            'self' => [
                'href' => route('api.v2.posts.show', $this->slug),
            ],
            'category' => $this->when(
                $this->relationLoaded('category') && $this->category,
                fn() => [
                    'href' => route('api.v2.categories.show', $this->category->slug),
                ],
            ),
            'author' => [
                'href' => route('api.v2.users.show', $this->author_id),
            ],
        ];

        return $data;
    }

    /**
     * Get requested fields from query parameter
     */
    protected function getRequestedFields(Request $request): ?array
    {
        $fields = $request->query('fields');

        if (!$fields) {
            return null; // Return all fields
        }

        return array_map('trim', explode(',', $fields));
    }

    /**
     * Check if field should be included
     */
    protected function shouldInclude(string $field, ?array $requestedFields): bool
    {
        // If no specific fields requested, include all
        if ($requestedFields === null) {
            return true;
        }

        return in_array($field, $requestedFields, true);
    }
}
