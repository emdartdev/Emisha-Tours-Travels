<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasTranslations;

class Tour extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'destination_id',
        'tour_category_id',
        'title',
        'title_bn',
        'slug',
        'short_description',
        'short_description_bn',
        'description',
        'description_bn',
        'duration_days',
        'duration_nights',
        'price',
        'discount_price',
        'currency',
        'status',
        'featured',
        'popular',
        'cover_image',
        'gallery',
        'published_at',
    ];

    protected $casts = [
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'featured' => 'boolean',
        'popular' => 'boolean',
        'gallery' => 'array',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->where('popular', true);
    }

    public function scopeByDestination(Builder $query, int $destinationId): Builder
    {
        return $query->where('destination_id', $destinationId);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(TourItinerary::class)->orderBy('day_number', 'asc');
    }

    public function inclusions(): HasMany
    {
        return $this->hasMany(TourInclusion::class)->orderBy('sort_order', 'asc');
    }

    public function exclusions(): HasMany
    {
        return $this->hasMany(TourExclusion::class)->orderBy('sort_order', 'asc');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(TourInquiry::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getRegularPriceAttribute(): ?float
    {
        return $this->price !== null ? (float) $this->price : null;
    }

    public function setRegularPriceAttribute($value): void
    {
        $this->attributes['price'] = $value;
    }

    public function getFeaturedImageAttribute(): ?string
    {
        return $this->cover_image;
    }

    public function setFeaturedImageAttribute($value): void
    {
        $this->attributes['cover_image'] = $value;
    }

    public function getFormattedPriceAttribute(): string
    {
        $symbol = $this->currency === 'BDT' ? '৳' : $this->currency . ' ';
        return $symbol . number_format($this->discount_price ?: $this->price, 0);
    }

    public function getDurationStringAttribute(): string
    {
        if (app()->getLocale() === 'bn') {
            return "{$this->duration_days} দিন / {$this->duration_nights} রাত";
        }
        return "{$this->duration_days} Days / {$this->duration_nights} Nights";
    }
}
