<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class AnalyticsEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'event_name',
        'event_category',
        'page_url',
        'page_title',
        'referrer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'event_value',
        'currency',
        'metadata',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
        'event_value' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', now()->today());
    }

    public function scopeConversions(Builder $query): Builder
    {
        return $query->whereIn('event_name', [
            'tour_inquiry',
            'visa_application',
            'ticket_request',
            'contact_message',
            'booking_completed',
            'whatsapp_click',
            'call_click',
            'newsletter_subscribe',
        ]);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('event_category', $category);
    }
}
