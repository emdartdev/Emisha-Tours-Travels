<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\AnalyticsEvent;
use App\Models\ActivityLog;
use App\Services\TrackingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class AnalyticsTrackingAdminController extends Controller
{
    public function __construct(
        protected TrackingService $trackingService
    ) {}

    /**
     * Display the centralized Analytics & Marketing Tracking Management dashboard
     */
    public function index(): View
    {
        $settingsRaw = Setting::all()->pluck('value', 'key')->toArray();

        // Bi-directional alias sync between form keys and TrackingService provider keys
        $aliases = [
            'google_analytics_id' => 'ga4_measurement_id',
            'google_analytics_enabled' => 'tracking_ga4_enabled',
            'google_tag_manager_id' => 'gtm_container_id',
            'google_tag_manager_enabled' => 'tracking_gtm_enabled',
            'facebook_pixel_id' => 'meta_pixel_id',
            'facebook_pixel_enabled' => 'tracking_meta_enabled',
            'clarity_enabled' => 'tracking_clarity_enabled',
            'hotjar_enabled' => 'tracking_hotjar_enabled',
            'plausible_enabled' => 'tracking_plausible_enabled',
            'posthog_enabled' => 'tracking_posthog_enabled',
            'tiktok_pixel_enabled' => 'tracking_tiktok_enabled',
            'linkedin_enabled' => 'tracking_linkedin_enabled',
            'snapchat_pixel_enabled' => 'tracking_snapchat_enabled',
            'pinterest_enabled' => 'tracking_pinterest_enabled',
            'twitter_pixel_enabled' => 'tracking_twitter_enabled',
            'reddit_pixel_enabled' => 'tracking_reddit_enabled',
            'quora_pixel_enabled' => 'tracking_quora_enabled',
            'google_ads_enabled' => 'tracking_google_ads_enabled',
            'bing_ads_enabled' => 'tracking_microsoft_ads_enabled',
            'bing_ads_tag_id' => 'bing_uet_tag_id',
            'taboola_pixel_enabled' => 'tracking_taboola_enabled',
            'outbrain_pixel_enabled' => 'tracking_outbrain_enabled',
        ];

        foreach ($aliases as $formKey => $serviceKey) {
            if (!isset($settingsRaw[$formKey]) && isset($settingsRaw[$serviceKey])) {
                $settingsRaw[$formKey] = $settingsRaw[$serviceKey];
            }
            if (!isset($settingsRaw[$serviceKey]) && isset($settingsRaw[$formKey])) {
                $settingsRaw[$serviceKey] = $settingsRaw[$formKey];
            }
        }

        $settings = new \Illuminate\Support\Fluent($settingsRaw);
        $health = $this->trackingService->getTrackingHealthSummary();
        
        // Metrics Summary
        $eventsToday = AnalyticsEvent::today()->count();
        $conversionsToday = AnalyticsEvent::today()->conversions()->count();
        $totalEvents = AnalyticsEvent::count();

        // Recent Telemetry Events
        $recentEvents = AnalyticsEvent::with('user')
            ->latest()
            ->limit(20)
            ->get();

        // Recent Audit Logs for Tracking Changes
        $auditLogs = ActivityLog::where('action', 'like', '%tracking%')
            ->orWhere('action', 'like', '%pixel%')
            ->orWhere('action', 'like', '%analytics%')
            ->latest()
            ->limit(10)
            ->get();

        // Provider Definitions
        $providers = TrackingService::PROVIDERS;

        // Analytics Health & Metrics Summary
        $summary = [
            'health_score' => $health['health_score'] ?? 0,
            'active_count' => $health['enabled_count'] ?? 0,
            'total_providers' => $health['total_supported'] ?? count($providers),
            'events_today' => $eventsToday,
            'events_total' => $totalEvents,
            'conversions_today' => $conversionsToday,
        ];

        return view('admin.settings.analytics', compact(
            'settings',
            'health',
            'summary',
            'eventsToday',
            'conversionsToday',
            'totalEvents',
            'recentEvents',
            'auditLogs',
            'providers'
        ));
    }

    /**
     * Update tracking configurations with audit logging
     */
    public function update(Request $request): RedirectResponse
    {
        $data = $request->except(['_token', '_method']);
        $changedKeys = [];

        foreach ($data as $key => $value) {
            $oldValue = Setting::get($key);
            $newValue = is_string($value) ? trim($value) : $value;

            if ($oldValue !== $newValue) {
                Setting::set($key, $newValue ?? '', 'tracking', 'string');
                $changedKeys[$key] = [
                    'old' => $oldValue ? substr($oldValue, 0, 8) . '...' : null,
                    'new' => $newValue ? substr($newValue, 0, 8) . '...' : null,
                ];
            }
        }

        // Sync form aliases to TrackingService canonical provider keys
        $aliases = [
            'google_analytics_id' => 'ga4_measurement_id',
            'google_analytics_enabled' => 'tracking_ga4_enabled',
            'google_tag_manager_id' => 'gtm_container_id',
            'google_tag_manager_enabled' => 'tracking_gtm_enabled',
            'facebook_pixel_id' => 'meta_pixel_id',
            'facebook_pixel_enabled' => 'tracking_meta_enabled',
            'clarity_enabled' => 'tracking_clarity_enabled',
            'hotjar_enabled' => 'tracking_hotjar_enabled',
            'plausible_enabled' => 'tracking_plausible_enabled',
            'posthog_enabled' => 'tracking_posthog_enabled',
            'tiktok_pixel_enabled' => 'tracking_tiktok_enabled',
            'linkedin_enabled' => 'tracking_linkedin_enabled',
            'snapchat_pixel_enabled' => 'tracking_snapchat_enabled',
            'pinterest_enabled' => 'tracking_pinterest_enabled',
            'twitter_pixel_enabled' => 'tracking_twitter_enabled',
            'reddit_pixel_enabled' => 'tracking_reddit_enabled',
            'quora_pixel_enabled' => 'tracking_quora_enabled',
            'google_ads_enabled' => 'tracking_google_ads_enabled',
            'bing_ads_enabled' => 'tracking_microsoft_ads_enabled',
            'bing_ads_tag_id' => 'bing_uet_tag_id',
            'taboola_pixel_enabled' => 'tracking_taboola_enabled',
            'outbrain_pixel_enabled' => 'tracking_outbrain_enabled',
        ];

        foreach ($aliases as $formKey => $serviceKey) {
            if (isset($data[$formKey])) {
                Setting::set($serviceKey, $data[$formKey]);
            }
        }

        // Clear tracking scripts cache so changes apply immediately
        Cache::forget('tracking_head_scripts_html');

        // Record Audit Trail
        if (!empty($changedKeys)) {
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'updated_tracking_settings',
                'description' => 'Updated marketing pixels & analytics configuration (' . count($changedKeys) . ' parameters changed).',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'properties' => $changedKeys,
            ]);
        }

        return redirect()->route('admin.settings.analytics')
            ->with('success', 'Analytics & Marketing Tracking settings updated successfully. Client cache refreshed.');
    }

    /**
     * AJAX verify a provider's ID format & connection readiness
     */
    public function verifyProvider(Request $request): JsonResponse
    {
        $provider = $request->input('provider');
        $value = $request->input('value', '');

        $result = $this->trackingService->verifyProviderConnection($provider, $value);

        return response()->json($result);
    }

    /**
     * AJAX test-fire an event simulator
     */
    public function testEvent(Request $request): JsonResponse
    {
        $eventName = $request->input('event_name', 'test_ping');
        $eventValue = (float) $request->input('event_value', 15000);
        $metadata = $request->input('metadata', ['source' => 'Admin Simulator', 'test_mode' => true]);

        $event = $this->trackingService->recordEvent($eventName, [
            'value' => $eventValue,
            'category' => 'conversion',
            'metadata' => is_array($metadata) ? $metadata : (json_decode($metadata, true) ?: []),
            'page_title' => 'Admin Event Simulator Test',
            'page_url' => url('/admin/settings/analytics'),
        ], $request);

        return response()->json([
            'status' => 'success',
            'message' => "Simulated event '{$eventName}' recorded successfully!",
            'event' => [
                'id' => $event->id,
                'name' => $event->event_name,
                'category' => $event->event_category,
                'value' => $event->event_value,
                'created_at' => $event->created_at->format('H:i:s d M Y'),
            ],
        ]);
    }

    /**
     * Clear telemetry event logs
     */
    public function clearEvents(): RedirectResponse
    {
        AnalyticsEvent::truncate();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'cleared_analytics_events',
            'description' => 'Truncated all telemetry analytics events.',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('admin.settings.analytics')
            ->with('success', 'Telemetry events log cleared successfully.');
    }

    /**
     * Endpoint for client-side beacon/AJAX micro-interactions
     */
    public function trackClientEvent(Request $request): JsonResponse
    {
        $payload = $request->all();
        $eventName = $payload['event_name'] ?? 'custom_interaction';

        $this->trackingService->recordEvent($eventName, [
            'page_url' => $payload['page_url'] ?? $request->headers->get('referer'),
            'page_title' => $payload['page_title'] ?? null,
            'metadata' => $payload['metadata'] ?? [],
            'value' => $payload['value'] ?? null,
        ], $request);

        return response()->json(['status' => 'ok']);
    }
}
