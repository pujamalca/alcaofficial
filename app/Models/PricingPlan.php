<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'price_suffix',
        'badge',
        'is_featured',
        'description',
        'cta_text',
        'cta_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'bool',
        'is_active' => 'bool',
    ];

    public function features()
    {
        return $this->hasMany(PricingFeature::class)->orderBy('sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
