<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingAdminController extends Controller
{
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->except(['_token', '_method']);

        // Handle legacy alias mappings if needed
        if (isset($data['phone']) && !isset($data['contact_phone'])) {
            $data['contact_phone'] = $data['phone'];
        }
        if (isset($data['whatsapp_number']) && !isset($data['contact_whatsapp'])) {
            $data['contact_whatsapp'] = $data['whatsapp_number'];
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Platform settings and contact hotlines updated successfully.');
    }
}
