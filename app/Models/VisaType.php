<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class VisaType extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_country_id',
        'name',
        'slug',
        'description',
        'validity',
        'stay_period',
        'entry_type',
        'processing_time',
        'processing_time_unit',
        'starting_fee',
        'service_fee',
        'currency',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'starting_fee' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(VisaCountry::class, 'visa_country_id');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(VisaRequirement::class)->orderBy('sort_order', 'asc');
    }

    public function professionRequirements(): HasMany
    {
        return $this->hasMany(VisaProfessionRequirement::class)->orderBy('sort_order', 'asc');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(VisaApplication::class);
    }

    public function getTotalFeeAttribute(): float
    {
        return (float) ($this->starting_fee + $this->service_fee);
    }
}
