<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_application_id',
        'document_type',
        'document_code',
        'required',
        'original_filename',
        'stored_filename',
        'mime_type',
        'file_size',
        'storage_path',
        'status',
        'review_status',
        'rejection_reason',
        'review_note',
        'uploaded_at',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'required' => 'boolean',
        'uploaded_at' => 'datetime',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(VisaApplication::class, 'visa_application_id');
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        return number_format($bytes / 1024, 0) . ' KB';
    }

    public function getReviewBadgeClassAttribute(): string
    {
        return match ($this->review_status) {
            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'needs_replacement' => 'bg-amber-50 text-amber-700 border-amber-200',
            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-blue-50 text-blue-700 border-blue-200',
        };
    }
}
