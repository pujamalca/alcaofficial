<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SourceCode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'short_description',
        'price',
        'discount_price',
        'currency',
        'upload_type',
        'file_path',
        'external_link',
        'preview_images',
        'thumbnail',
        'demo_link',
        'documentation_link',
        'tech_stack',
        'features',
        'version',
        'requirements',
        'meta_title',
        'meta_description',
        'downloads_count',
        'views_count',
        'rating',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'preview_images' => 'array',
        'tech_stack' => 'array',
        'features' => 'array',
        'downloads_count' => 'integer',
        'views_count' => 'integer',
        'rating' => 'decimal:1',
        'is_active' => 'bool',
        'is_featured' => 'bool',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(SourceCodeCategory::class, 'category_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(SourceCodeOrder::class, 'source_code_id');
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    // Accessors
    public function getEffectivePriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getHasDiscountAttribute(): bool
    {
        return $this->discount_price !== null && $this->discount_price < $this->price;
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->has_discount) {
            return null;
        }

        return (int) round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    // Helper Methods
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementDownloads(): void
    {
        $this->increment('downloads_count');
    }
}
