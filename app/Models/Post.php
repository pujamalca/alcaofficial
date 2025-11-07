<?php

namespace App\Models;

use App\Jobs\IncrementPostViewCount;
use App\Traits\SanitizesHtml;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
// use Laravel\Scout\Searchable; // Commented out - install laravel/scout if search functionality is needed
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;
    use LogsActivity;
    use SanitizesHtml;
    // use Searchable; // Commented out - install laravel/scout if search functionality is needed

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'gallery',
        'type',
        'status',
        'published_at',
        'scheduled_at',
        'is_featured',
        'is_sticky',
        'view_count',
        'reading_time',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image',
        'metadata',
    ];

    protected $casts = [
        'gallery' => 'array',
        'metadata' => 'array',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_sticky' => 'boolean',
    ];

    protected $appends = [
        'author_post_count',
        'word_count',
        'comment_count_cached',
    ];

    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $this->sanitizeHtml($value),
        );
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value === null
                ? null
                : Str::of($value)->stripTags()->squish()->toString(),
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function publish(): void
    {
        $this->forceFill([
            'status' => 'published',
            'published_at' => now(),
            'scheduled_at' => null,
        ])->save();
    }

    public function unpublish(): void
    {
        $this->forceFill([
            'status' => 'draft',
            'published_at' => null,
        ])->save();
    }

    public function schedule(?string $datetime): void
    {
        $this->forceFill([
            'status' => 'scheduled',
            'scheduled_at' => $datetime,
        ])->save();
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function incrementViews(): void
    {
        $key = $this->getKey();

        if ($key === null) {
            return;
        }

        IncrementPostViewCount::dispatch($key);
    }

    public function getExcerptAttribute(?string $value): ?string
    {
        if ($value) {
            return $value;
        }

        return Str::limit(strip_tags((string) $this->content), 160);
    }

    public function getReadingTimeAttribute(?int $value): ?int
    {
        if ($value) {
            return $value;
        }

        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags((string) $this->content));

        return (int) max(1, ceil($wordCount / $wordsPerMinute));
    }

    public function getAuthorPostCountAttribute(): int
    {
        if (! $this->author_id) {
            return 0;
        }

        return cache()->remember(
            "author:{$this->author_id}:published_posts_count",
            now()->addHour(),
            fn () => static::where('author_id', $this->author_id)
                ->published()
                ->count()
        );
    }

    public function getWordCountAttribute(): int
    {
        return cache()->remember(
            "post:{$this->id}:word_count",
            now()->addHour(),
            fn () => str_word_count(strip_tags((string) $this->content))
        );
    }

    public function getCommentCountCachedAttribute(): int
    {
        return cache()->remember(
            "post:{$this->id}:comment_count",
            now()->addMinutes(10),
            fn () => $this->comments()->count()
        );
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByAuthor(Builder $query, int $userId): Builder
    {
        return $query->where('author_id', $userId);
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        // Use full-text search for better performance
        return $query->whereRaw(
            'MATCH(title, content, excerpt) AGAINST(? IN NATURAL LANGUAGE MODE)',
            [$term]
        );
    }

    public function scopeSearchRelevance(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        // Full-text search with relevance score
        return $query
            ->selectRaw('*, MATCH(title, content, excerpt) AGAINST(? IN NATURAL LANGUAGE MODE) as relevance', [$term])
            ->whereRaw('MATCH(title, content, excerpt) AGAINST(? IN NATURAL LANGUAGE MODE)', [$term])
            ->orderByDesc('relevance');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->singleFile();

        $this
            ->addMediaCollection('gallery')
            ->useFallbackUrl('https://via.placeholder.com/800x600.png?text=Gallery');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('post')
            ->logOnly([
                'title',
                'status',
                'published_at',
                'scheduled_at',
                'category_id',
                'author_id',
            ])
            ->logOnlyDirty();
    }

    /**
     * Get the indexable data array for the model (Meilisearch).
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => strip_tags($this->content), // Remove HTML for search
            'status' => $this->status,
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            'is_featured' => $this->is_featured,
            'view_count' => $this->view_count,
            'published_at' => $this->published_at?->timestamp,
            'created_at' => $this->created_at->timestamp,
        ];
    }

    /**
     * Determine if the model should be searchable.
     */
    public function shouldBeSearchable(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        // Clear caches when post is saved
        static::saved(function (Post $post) {
            cache()->forget("post:{$post->id}:related_posts");
            cache()->forget("post:{$post->id}:word_count");
            cache()->forget("post:{$post->id}:comment_count");
            cache()->forget('blog:categories:with_counts');

            if ($post->author_id) {
                cache()->forget("author:{$post->author_id}:published_posts_count");
            }
        });

        // Clear caches when post is deleted
        static::deleted(function (Post $post) {
            cache()->forget("post:{$post->id}:related_posts");
            cache()->forget("post:{$post->id}:word_count");
            cache()->forget("post:{$post->id}:comment_count");
            cache()->forget('blog:categories:with_counts');

            if ($post->author_id) {
                cache()->forget("author:{$post->author_id}:published_posts_count");
            }
        });
    }
}
