<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackUtmAndReferrer
{
    /**
     * Handle an incoming request and capture UTM tags into session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid', 'ttclid'];

        foreach ($utmKeys as $key) {
            if ($request->has($key) && !empty($request->query($key))) {
                session()->put($key, substr(trim($request->query($key)), 0, 100));
            }
        }

        // Store landing referrer if first arrival
        if (!session()->has('initial_referrer') && $request->headers->get('referer')) {
            $ref = $request->headers->get('referer');
            $host = parse_url($ref, PHP_URL_HOST);
            if ($host && !str_contains($host, $request->getHost())) {
                session()->put('initial_referrer', substr($ref, 0, 255));
            }
        }

        return $next($request);
    }
}
