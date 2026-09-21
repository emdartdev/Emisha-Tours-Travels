<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Switch application language between English and Bangla.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $supportedLocales = ['en', 'bn'];

        if (in_array($locale, $supportedLocales, true)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
            Cookie::queue('emisha_locale', $locale, 60 * 24 * 365); // 1 year

            if ($request->user()) {
                $request->user()->update(['preferred_locale' => $locale]);
            }
        }

        // Return back or to home page safely
        return redirect()->back();
    }
}
