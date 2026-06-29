<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'action_url',
        'first_month_price',
        'monthly_price',
        'quarterly_price',
        'yearly_price',
        'hourly_requests',
        'monthly_requests',
        'note',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'first_month_price' => 'float',
        'monthly_price' => 'float',
        'quarterly_price' => 'float',
        'yearly_price' => 'float',
        'is_active' => 'boolean',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function aiModels(): BelongsToMany
    {
        return $this->belongsToMany(AiModel::class, 'plan_ai_model');
    }

    public function benefits(): BelongsToMany
    {
        return $this->belongsToMany(Benefit::class, 'plan_benefit');
    }
}
