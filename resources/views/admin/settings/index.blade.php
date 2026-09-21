@extends('layouts.admin')

@section('title', 'Platform & Agency Settings')
@section('page_title', 'Agency Contact & Platform Master Settings')

@section('content')
<div class="space-y-6 max-w-4xl">
    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <div class="border-b border-[var(--admin-card-border)] pb-4">
                <h3 class="text-base font-extrabold text-[var(--admin-text-main)] tracking-tight">Corporate Information & Live Hotlines</h3>
                <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">These contact details synchronize across the header, footer, floating buttons, schemas, and booking leads.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Company Name</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? $settings['company_name'] ?? 'Emisha Tours & Travels') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Official WhatsApp Hotline</label>
                    <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? $settings['whatsapp_number'] ?? '+880 1805-464291') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-mono">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hotline 1 (Air Ticketing & Primary)</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? $settings['phone'] ?? '+880 1805-464291') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-mono">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hotline 2 (Hajj & Umrah Desk)</label>
                    <input type="text" name="contact_phone_2" value="{{ old('contact_phone_2', $settings['contact_phone_2'] ?? '+880 1805-464292') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-mono">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hotline 3 (Emisha Academy)</label>
                    <input type="text" name="contact_phone_3" value="{{ old('contact_phone_3', $settings['contact_phone_3'] ?? '+880 1805-464293') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-mono">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hotline 4 (VISA Services Desk)</label>
                    <input type="text" name="contact_phone_4" value="{{ old('contact_phone_4', $settings['contact_phone_4'] ?? '+880 1805-464294') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-mono">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Corporate Support Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? $settings['email'] ?? 'info@emishatours.com') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Office Operating Hours</label>
                    <input type="text" name="office_hours" value="{{ old('office_hours', $settings['office_hours'] ?? 'Saturday – Thursday: 10:00 AM – 6:30 PM') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Headquarters Address</label>
                    <input type="text" name="office_address" value="{{ old('office_address', $settings['office_address'] ?? $settings['address'] ?? 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Nearest Landmark (Metro Station / Pillar)</label>
                    <input type="text" name="office_landmark" value="{{ old('office_landmark', $settings['office_landmark'] ?? 'Kazipara Metro Station (Pillar No. 267)') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Google Maps URL</label>
                    <input type="url" name="google_maps_url" value="{{ old('google_maps_url', $settings['google_maps_url'] ?? 'https://maps.app.goo.gl/yVBQmUfCS57Esag76') }}"
                        placeholder="https://maps.app.goo.gl/..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Facebook Page URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? 'https://facebook.com/emishatravels') }}"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)] flex items-center justify-end">
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition text-center">
                    Save & Update Platform Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
