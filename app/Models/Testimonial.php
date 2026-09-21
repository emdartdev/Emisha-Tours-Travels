<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'customer_name',
        'customer_name_bn',
        'photo',
        'destination',
        'destination_bn',
        'service',
        'service_bn',
        'review',
        'review_bn',
        'rating',
        'source',
        'featured',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }
}
