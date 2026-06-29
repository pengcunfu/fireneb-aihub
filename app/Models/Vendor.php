<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    protected $fillable = ['name', 'sort_order'];

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class)->orderBy('sort_order');
    }
}
