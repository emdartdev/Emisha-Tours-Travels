<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FormSubmissionService
{
    /**
     * Generate or retrieve a persistent submission token for a draft session.
     */
    public function getOrCreateSessionToken(string $formType, ?string $currentToken = null): string
    {
        if (!empty($currentToken) && strlen($currentToken) >= 16) {
            return $currentToken;
        }

        $sessionKey = "form_token_{$formType}";
        if (session()->has($sessionKey)) {
            return session()->get($sessionKey);
        }

        $token = 'SUB_' . strtoupper(Str::random(6)) . '_' . bin2hex(random_bytes(8));
        session()->put($sessionKey, $token);
        return $token;
    }

    /**
     * Clear the submission token from session when starting a clean new application.
     */
    public function rotateSessionToken(string $formType): string
    {
        $sessionKey = "form_token_{$formType}";
        session()->forget($sessionKey);
        
        $newToken = 'SUB_' . strtoupper(Str::random(6)) . '_' . bin2hex(random_bytes(8));
        session()->put($sessionKey, $newToken);
        return $newToken;
    }

    /**
     * Atomic lock to prevent concurrent double-click requests.
     */
    public function acquireSubmissionLock(string $token, int $ttlSeconds = 15): bool
    {
        $lockKey = "submission_lock_{$token}";
        return (bool) Cache::add($lockKey, 1, $ttlSeconds);
    }

    /**
     * Release atomic submission lock.
     */
    public function releaseSubmissionLock(string $token): void
    {
        $lockKey = "submission_lock_{$token}";
        Cache::forget($lockKey);
    }
}
