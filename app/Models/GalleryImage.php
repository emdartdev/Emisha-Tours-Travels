<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_category_id',
        'title',
        'image_path',
        'thumbnail_path',
        'alt_text',
        'location',
        'caption',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image_path ?: ($this->thumbnail_path ?: '');
    }

    public function setImageUrlAttribute(?string $value): void
    {
        $this->attributes['image_path'] = $value;
    }
}
