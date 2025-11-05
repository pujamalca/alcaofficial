<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SourceCodeCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
    ];

    // Relationships
    public function sourceCodes(): HasMany
    {
        return $this->hasMany(SourceCode::class, 'category_id');
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}
