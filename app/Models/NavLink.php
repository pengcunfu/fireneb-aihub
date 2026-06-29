<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NavLink extends Model
{
    protected $fillable = [
        'nav_category_id', 'name', 'url', 'description', 'tags',
        'is_featured', 'is_domestic', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_domestic' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NavCategory::class, 'nav_category_id');
    }
}
