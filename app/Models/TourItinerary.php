<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasTranslations;

class TourItinerary extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'tour_id',
        'day_number',
        'title',
        'title_bn',
        'description',
        'description_bn',
        'meals',
        'meals_bn',
        'stay',
        'stay_bn',
        'sort_order',
    ];

    protected $casts = [
        'day_number' => 'integer',
        'sort_order' => 'integer',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
