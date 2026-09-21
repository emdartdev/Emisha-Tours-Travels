<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request and set application locale.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'bn'];
        $defaultLocale = config('app.locale', 'en');

        // 1. Query parameter override (e.g. ?lang=bn or ?lang=en)
        if ($request->has('lang') && in_array($request->query('lang'), $supportedLocales, true)) {
            $locale = $request->query('lang');
            Session::put('locale', $locale);
            Cookie::queue('emisha_locale', $locale, 60 * 24 * 365); // 1 year cookie
        }
        // 2. Session value
        elseif (Session::has('locale') && in_array(Session::get('locale'), $supportedLocales, true)) {
            $locale = Session::get('locale');
        }
        // 3. Cookie value
        elseif ($request->hasCookie('emisha_locale') && in_array($request->cookie('emisha_locale'), $supportedLocales, true)) {
            $locale = $request->cookie('emisha_locale');
            Session::put('locale', $locale);
        }
        // 4. Authenticated user profile preference (if applicable)
        elseif ($request->user() && !empty($request->user()->preferred_locale) && in_array($request->user()->preferred_locale, $supportedLocales, true)) {
            $locale = $request->user()->preferred_locale;
            Session::put('locale', $locale);
        }
        // 5. Default fallback
        else {
            $locale = $defaultLocale;
        }

        App::setLocale($locale);

        $response = $next($request);

        return $response;
    }
}
