<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference_number',
        'trip_type',
        'origin',
        'destination',
        'departure_date',
        'return_date',
        'adults',
        'children',
        'infants',
        'cabin_class',
        'preferred_airline',
        'additional_requirements',
        'full_name',
        'email',
        'phone',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
        'infants' => 'integer',
    ];
}
