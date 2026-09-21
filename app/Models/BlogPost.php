<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasTranslations;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'blog_category_id',
        'author_id',
        'destination_id',
        'title',
        'title_bn',
        'slug',
        'excerpt',
        'excerpt_bn',
        'content',
        'content_bn',
        'featured_image',
        'reading_time',
        'status',
        'published_at',
    ];

    protected $casts = [
        'reading_time' => 'integer',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }
}
