<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_group_id',
        'title',
        'category',
        'description',
        'image',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
    ];

    public function group()
    {
        return $this->belongsTo(PortfolioGroup::class, 'portfolio_group_id');
    }
}
