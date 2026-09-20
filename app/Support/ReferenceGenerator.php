<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReferenceGenerator
{
    /**
     * Generate unique reference number in format: PREFIX-YYYY-XXXXXX
     * E.g. VISA-2026-000001, TOUR-2026-000001, TKT-2026-000001, INQ-2026-000001
     */
    public static function generate(string $table, string $prefix = 'REF', string $column = 'reference_number'): string
    {
        $year = Carbon::now()->format('Y');
        $pattern = "{$prefix}-{$year}-%";

        return DB::transaction(function () use ($table, $column, $prefix, $year, $pattern) {
            // Find latest reference for current year with pessimistic lock
            $latest = DB::table($table)
                ->where($column, 'LIKE', $pattern)
                ->lockForUpdate()
                ->orderByDesc('id')
                ->value($column);

            $sequence = 1;
            if ($latest && preg_match("/{$prefix}-{$year}-(\d+)/", $latest, $matches)) {
                $sequence = (int) $matches[1] + 1;
            }

            $sequencePadded = str_pad((string) $sequence, 6, '0', STR_PAD_LEFT);
            return "{$prefix}-{$year}-{$sequencePadded}";
        });
    }

    public static function forVisaApplication(): string
    {
        return self::generate('visa_applications', 'VISA');
    }

    public static function visa(): string
    {
        return self::forVisaApplication();
    }

    public static function forTourInquiry(): string
    {
        return self::generate('tour_inquiries', 'TOUR');
    }

    public static function forTicketRequest(): string
    {
        return self::generate('ticket_requests', 'TKT');
    }
}
