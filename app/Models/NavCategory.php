<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'description', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(NavLink::class)->where('is_active', true)->orderBy('sort_order');
    }

    public function allLinks(): HasMany
    {
        return $this->hasMany(NavLink::class)->orderBy('sort_order');
    }
}
