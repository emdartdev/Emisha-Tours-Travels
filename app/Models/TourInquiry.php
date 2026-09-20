<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourInquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference_number',
        'tour_id',
        'tour_title',
        'full_name',
        'email',
        'phone',
        'travel_date',
        'adults',
        'children',
        'message',
        'status',
        'assigned_to',
        'admin_notes',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
