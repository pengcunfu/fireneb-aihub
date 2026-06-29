<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Benefit extends Model
{
    protected $fillable = ['name'];

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_benefit');
    }
}
