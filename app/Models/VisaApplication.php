<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class VisaApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference_number',
        'visa_country_id',
        'visa_type_id',
        'profession_type_id',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'nationality',
        'passport_number',
        'applicant_profile',
        'passport_details',
        'travel_purpose',
        'travel_date',
        'stay_duration',
        'travelers_count',
        'travel_details',
        'employment_details',
        'financial_details',
        'travel_history',
        'co_travelers',
        'accommodation_details',
        'flight_details',
        'pricing_breakdown',
        'workflow_type',
        'payment_status',
        'total_service_fee',
        'currency',
        'draft_session_id',
        'submission_token',
        'idempotency_key',
        'status',
        'admin_notes',
        'applicant_notes',
        'submitted_at',
        'processed_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'travel_date' => 'date',
        'travelers_count' => 'integer',
        'submitted_at' => 'datetime',
        'processed_at' => 'datetime',
        'applicant_profile' => 'array',
        'passport_details' => 'array',
        'travel_details' => 'array',
        'employment_details' => 'array',
        'financial_details' => 'array',
        'travel_history' => 'array',
        'co_travelers' => 'array',
        'accommodation_details' => 'array',
        'flight_details' => 'array',
        'pricing_breakdown' => 'array',
        'total_service_fee' => 'decimal:2',
    ];

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(VisaCountry::class, 'visa_country_id');
    }

    public function visaType(): BelongsTo
    {
        return $this->belongsTo(VisaType::class);
    }

    public function professionType(): BelongsTo
    {
        return $this->belongsTo(ProfessionType::class, 'profession_type_id');
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(ProfessionType::class, 'profession_type_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(VisaDocument::class);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'received', 'draft' => 'bg-blue-50 text-blue-700 border-blue-200',
            'under_review', 'documents_required' => 'bg-amber-50 text-amber-700 border-amber-200',
            'embassy_submitted', 'submitted', 'processing' => 'bg-purple-50 text-purple-700 border-purple-200',
            'approved', 'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'rejected', 'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }

    public function getFormattedStatusAttribute(): string
    {
        return match ($this->status) {
            'received' => 'Application Received',
            'under_review' => 'Documents Under Review',
            'documents_required' => 'Additional Documents Required',
            'embassy_submitted' => 'Submitted to Embassy / VFS',
            'submitted' => 'Official Submission Completed',
            'processing' => 'Under Consular Processing',
            'approved' => 'Visa Approved / Ready',
            'completed' => 'Delivered / Completed',
            'rejected' => 'Visa Refused / Rejected',
            'cancelled' => 'Application Cancelled',
            default => ucwords(str_replace('_', ' ', $this->status)),
        };
    }
}
