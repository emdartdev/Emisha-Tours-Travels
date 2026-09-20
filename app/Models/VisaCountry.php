<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;

class VisaCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'slug',
        'flag',
        'hero_image',
        'short_description',
        'description',
        'status',
        'featured',
        'sort_order',
        'information_updated_at',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'sort_order' => 'integer',
        'information_updated_at' => 'datetime',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function visaTypes(): HasMany
    {
        return $this->hasMany(VisaType::class)->orderBy('sort_order', 'asc');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(VisaApplication::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getIsoCodeAttribute(): string
    {
        $map = [
            'thailand' => 'th',
            'malaysia' => 'my',
            'singapore' => 'sg',
            'sri-lanka' => 'lk',
            'japan' => 'jp',
            'usa' => 'us',
            'united-states' => 'us',
            'canada' => 'ca',
            'uk' => 'gb',
            'united-kingdom' => 'gb',
            'australia' => 'au',
            'europe' => 'eu',
            'schengen' => 'eu',
            'europe-schengen' => 'eu',
            'uae-dubai' => 'ae',
            'dubai' => 'ae',
            'united-arab-emirates-dubai' => 'ae',
        ];

        return $map[$this->slug] ?? 'un';
    }

    public function getFlagUrlAttribute(): string
    {
        return "https://flagcdn.com/w160/{$this->iso_code}.png";
    }
}
