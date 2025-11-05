<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'header_image',
        'category',
        'description',
        'images',
        'url',
        'rating',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
        'images' => 'array',
        'rating' => 'decimal:1',
    ];
}
