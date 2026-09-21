@extends('layouts.app')

@section('title', __('contact.title'))
@section('meta_description', __('contact.meta_description'))
@section('canonical_url', route('contact.index'))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- Hero Section (Optimistic & Airy Minimal Luxury) -->
<div class="bg-[#0B1F3A] py-16 sm:py-20 text-white relative overflow-hidden">
    <!-- Ambient Background Glow -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -top-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-[#D4AF37]/15 text-[#D4AF37] uppercase tracking-widest mb-3.5 border border-[#D4AF37]/30 backdrop-blur-md">
            <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
            <span>{{ __('contact.badge_hero') }}</span>
        </span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold font-serif mb-4 text-white tracking-tight leading-tight">
            {{ __('contact.hero_title') }}
        </h1>
        <p class="text-slate-200 max-w-2xl mx-auto text-sm sm:text-base md:text-lg font-normal leading-relaxed">
            {{ __('contact.hero_subtitle') }}
        </p>

        <!-- Quick Proof Badges Strip -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 mt-8 text-xs text-white/80 font-medium">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span>{{ __('contact.proof_response') }}</span>
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span>{{ __('contact.proof_hotline') }}</span>
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>{{ __('contact.proof_certified') }}</span>
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ __('contact.proof_office') }}</span>
            </span>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">
        
        <!-- Left Column: Interactive Minimal Inquiry Studio (lg:col-span-7) -->
        <div class="lg:col-span-7">
            <div 
                class="bg-white rounded-[32px] p-7 sm:p-10 md:p-12 border border-slate-200/90 shadow-[0_15px_45px_rgba(11,31,58,0.05)] relative overflow-hidden"
                x-data="{
                    selectedSubject: '{{ old('subject', __('contact.subject_tour')) }}',
                    isSubmitting: false,
                    subjects: [
                        { id: '{{ __('contact.subject_tour') }}', label: '{{ __('contact.subject_tour') }}' },
                        { id: '{{ __('contact.subject_visa') }}', label: '{{ __('contact.subject_visa') }}' },
                        { id: '{{ __('contact.subject_flight') }}', label: '{{ __('contact.subject_flight') }}' },
                        { id: '{{ __('contact.subject_corp') }}', label: '{{ __('contact.subject_corp') }}' },
                        { id: '{{ __('contact.subject_general') }}', label: '{{ __('contact.subject_general') }}' }
                    ]
                }"
            >
                <div class="mb-8">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-1">
                        <span>{{ __('contact.form_badge') }}</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold font-serif text-[#0B1F3A]">
                        {{ __('contact.form_title') }}
                    </h2>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">
                        {{ __('contact.form_subtitle') }}
                    </p>
                </div>

                <!-- Interactive Subject Category Selector Pills -->
                <div class="mb-8">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">
                        {{ __('contact.assist_question') }} *
                    </label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="item in subjects" :key="item.id">
                            <button 
                                type="button"
                                @click="selectedSubject = item.id"
                                :class="selectedSubject === item.id 
                                    ? 'bg-[#0B1F3A] text-[#D4AF37] border-[#0B1F3A] shadow-sm ring-2 ring-[#D4AF37]/30' 
                                    : 'bg-slate-50 text-slate-700 border-slate-200/80 hover:bg-slate-100/80'"
                                class="px-3.5 py-2 rounded-xl text-xs font-bold border transition-all duration-200 flex items-center gap-1.5 cursor-pointer"
                                x-text="item.label"
                            >
                            </button>
                        </template>
                    </div>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" @submit="if(isSubmitting) { $event.preventDefault(); return false; } isSubmitting = true;">
                    @csrf

                    <!-- Hidden Synced Service/Department Input -->
                    <input type="hidden" name="service" :value="selectedSubject">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('contact.name') }} *</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="{{ __('contact.name_placeholder') }}"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm text-[#0B1F3A] transition-all"
                            >
                            @error('name')
                                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('contact.email') }} *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                placeholder="{{ __('contact.email_placeholder') }}"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm text-[#0B1F3A] transition-all"
                            >
                            @error('email')
                                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('contact.phone') }} *</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}" 
                                required 
                                placeholder="{{ __('contact.phone_placeholder') }}"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm text-[#0B1F3A] transition-all"
                            >
                            @error('phone')
                                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('contact.selected_department') }}</label>
                            <div class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-100/70 text-xs font-bold text-[#0B1F3A] truncate flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                                <span x-text="selectedSubject"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">{{ __('contact.message') }} *</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="5" 
                            required 
                            placeholder="{{ __('contact.message_placeholder') }}"
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm text-[#0B1F3A] transition-all leading-relaxed"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                        <span class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>{{ __('contact.privacy_notice') }}</span>
                        </span>

                        <button type="submit" :disabled="isSubmitting" class="btn btn-gold btn-xl w-full sm:w-auto px-8 py-3.5 text-xs uppercase tracking-wider font-bold rounded-xl shadow-lg flex items-center justify-center gap-2 disabled:opacity-75 disabled:cursor-not-allowed">
                            <template x-if="!isSubmitting">
                                <div class="flex items-center gap-2">
                                    <span>{{ __('contact.send_btn') }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </div>
                            </template>
                            <template x-if="isSubmitting">
                                <div class="flex items-center gap-2">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span>{{ __('contact.sending_btn') }}</span>
                                </div>
                            </template>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Direct Hotlines & Corporate Concierge Hub (lg:col-span-5) -->
        <div class="lg:col-span-5 space-y-7">
            
            @php
                $cPhone1 = App\Models\Setting::get('contact_phone', '+880 1805-464291');
                $cPhone2 = App\Models\Setting::get('contact_phone_2', '+880 1805-464292');
                $cPhone3 = App\Models\Setting::get('contact_phone_3', '+880 1805-464293');
                $cPhone4 = App\Models\Setting::get('contact_phone_4', '+880 1805-464294');
                $cWhatsApp = App\Models\Setting::get('contact_whatsapp', '+880 1805-464291');
                $cEmail = App\Models\Setting::get('contact_email', 'info@emishatours.com');
                $cAddress = App\Models\Setting::get('office_address', 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka');
                $cLandmark = App\Models\Setting::get('office_landmark', 'Kazipara Metro Station (Pillar No. 267)');
                $cHours = App\Models\Setting::get('office_hours', 'Saturday – Thursday: 10:00 AM – 6:30 PM');
            @endphp

            <!-- Direct Hotline & Instant Desk Card -->
            <div class="bg-white rounded-[28px] p-7 sm:p-8 border border-slate-200/90 shadow-[0_12px_35px_rgba(11,31,58,0.04)] relative overflow-hidden">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <span class="text-[10.5px] uppercase tracking-wider font-extrabold text-[#D4AF37] block">{{ __('contact.hotline_badge') }}</span>
                        <h3 class="text-xl font-bold font-serif text-[#0B1F3A]">{{ __('contact.hotline_title') }}</h3>
                    </div>
                    <span class="w-9 h-9 rounded-xl bg-[#D4AF37]/15 text-[#0B1F3A] flex items-center justify-center font-bold text-sm border border-[#D4AF37]/30">
                        <svg class="w-4 h-4 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </span>
                </div>

                <div class="space-y-2.5">
                    <!-- Line 1: Air Ticketing & Primary Hotline -->
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $cPhone1) }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-[#D4AF37]/10 border border-slate-200/70 hover:border-[#D4AF37]/40 transition-all group">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center text-xs font-bold">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                            </span>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] block transition-colors">{{ $cPhone1 }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">{{ __('contact.line_1_sub') }}</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-[#D4AF37] text-[#0B1F3A] px-2 py-0.5 rounded shadow-2xs">{{ __('contact.line_1_tag') }}</span>
                    </a>

                    <!-- Line 2: Hajj & Umrah Desk -->
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $cPhone2) }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-[#D4AF37]/10 border border-slate-200/70 hover:border-[#D4AF37]/40 transition-all group">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </span>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] block transition-colors">{{ $cPhone2 }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">{{ __('contact.line_2_sub') }}</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">{{ __('contact.line_2_tag') }}</span>
                    </a>

                    <!-- Line 3: Emisha Academy -->
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $cPhone3) }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-[#D4AF37]/10 border border-slate-200/70 hover:border-[#D4AF37]/40 transition-all group">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                            </span>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] block transition-colors">{{ $cPhone3 }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">{{ __('contact.line_3_sub') }}</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-200">{{ __('contact.line_3_tag') }}</span>
                    </a>

                    <!-- Line 4: VISA Services -->
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $cPhone4) }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-[#D4AF37]/10 border border-slate-200/70 hover:border-[#D4AF37]/40 transition-all group">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </span>
                            <div>
                                <span class="text-xs sm:text-sm font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] block transition-colors">{{ $cPhone4 }}</span>
                                <span class="text-[10px] text-slate-500 font-medium">{{ __('contact.line_4_sub') }}</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">{{ __('contact.line_4_tag') }}</span>
                    </a>
                </div>

                <!-- Instant WhatsApp Live Chat Banner -->
                <button 
                    type="button"
                    onclick="window.dispatchEvent(new CustomEvent('open-whatsapp-modal'))" 
                    class="mt-4 w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 shadow-md transition-all hover:shadow-lg cursor-pointer"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>{{ __('contact.whatsapp_hub_btn') }}</span>
                </button>
            </div>

            <!-- Corporate Head Office Info Card -->
            <div class="bg-white rounded-[28px] p-7 sm:p-8 border border-slate-200/90 shadow-[0_12px_35px_rgba(11,31,58,0.04)] space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3.5">
                    <h3 class="text-base font-bold font-serif text-[#0B1F3A]">{{ __('contact.visiting_details') }}</h3>
                    <span class="text-xs text-slate-400 font-medium">{{ __('contact.city_country') }}</span>
                </div>

                <div class="flex items-start space-x-3.5">
                    <div class="w-9 h-9 rounded-xl bg-slate-50 text-[#0B1F3A] flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ __('contact.office_location') }}</h4>
                        <p class="text-xs sm:text-sm font-semibold text-[#0B1F3A] leading-snug">
                            {{ $cAddress }}
                        </p>
                        <div class="flex items-center gap-1.5 text-xs text-[#D4AF37] font-bold bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200/70 inline-flex mt-1">
                            <svg class="w-3.5 h-3.5 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4 8v3m-5-3h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zm-1-6h.01M16 14h.01"/>
                            </svg>
                            <span>{{ __('contact.landmark_prefix') }}: {{ $cLandmark }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-start space-x-3.5">
                    <div class="w-9 h-9 rounded-xl bg-slate-50 text-[#0B1F3A] flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ __('contact.email_inquiries') }}</h4>
                        <p class="text-xs sm:text-sm font-semibold text-[#0B1F3A] mt-0.5">
                            <a href="mailto:{{ $cEmail }}" class="hover:text-[#D4AF37] transition-colors">{{ $cEmail }}</a>
                        </p>
                    </div>
                </div>

                <div class="flex items-start space-x-3.5">
                    <div class="w-9 h-9 rounded-xl bg-slate-50 text-[#0B1F3A] flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ __('contact.visiting_hours') }}</h4>
                        <p class="text-xs sm:text-sm font-semibold text-[#0B1F3A] mt-0.5">
                            {{ $cHours }}
                        </p>
                        <span class="text-[11px] text-emerald-600 font-semibold block mt-0.5">{{ __('contact.friday_notice') }}</span>
                    </div>
                </div>
            </div>

            <!-- Map Embed Card & High-Contrast Direct Action Button -->
            <div class="rounded-[28px] overflow-hidden border border-slate-200/90 bg-white shadow-[0_15px_40px_rgba(11,31,58,0.06)] p-5 sm:p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-[#D4AF37]/15 text-[#0B1F3A] flex items-center justify-center text-xs font-bold border border-[#D4AF37]/30">
                            <svg class="w-4 h-4 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold font-serif text-[#0B1F3A]">{{ __('contact.map_title') }}</h3>
                            <span class="text-[10.5px] text-slate-500 font-medium">{{ __('contact.map_location') }}</span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ __('contact.live_location') }}</span>
                    </span>
                </div>

                <!-- Google Map Iframe Frame -->
                <div class="h-60 sm:h-64 rounded-2xl overflow-hidden border border-slate-200/90 shadow-inner relative group">
                    <iframe 
                        title="Emisha Tours & Travels Head Office Location"
                        class="w-full h-full border-0"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.7788480399387!2d90.370344!3d23.790938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0cd5c3b1235%3A0x8898b9588bf33215!2sKazipara%20Metro%20Station!5e0!3m2!1sen!2sbd!4v1700000000000">
                    </iframe>
                </div>

                <!-- Prominent, High-Contrast Google Maps Action Buttons Strip -->
                <div class="space-y-2.5 pt-1">
                    <a 
                        href="{{ App\Models\Setting::get('google_maps_url', 'https://maps.app.goo.gl/yVBQmUfCS57Esag76') }}" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#0B1F3A] via-[#0E284D] to-[#0B1F3A] hover:from-[#D4AF37] hover:via-amber-400 hover:to-[#D4AF37] text-white hover:text-[#0B1F3A] border border-[#D4AF37]/40 hover:border-[#D4AF37] text-xs sm:text-sm font-extrabold transition-all duration-300 flex items-center justify-center gap-2.5 shadow-[0_8px_20px_rgba(11,31,58,0.15)] hover:shadow-[0_10px_25px_rgba(212,175,55,0.35)] hover:-translate-y-0.5 group"
                        title="Open Emisha Tours on Google Maps App"
                    >
                        <svg class="w-4 h-4 text-[#D4AF37] group-hover:text-[#0B1F3A] transition-colors flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span class="tracking-wide">{{ __('contact.open_maps_btn') }}</span>
                        <svg class="w-4 h-4 text-[#D4AF37] group-hover:text-[#0B1F3A] transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between text-xs text-slate-600">
                        <div class="flex items-center gap-2 min-w-0">
                            <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4 8v3m-5-3h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zm-1-6h.01M16 14h.01"/>
                            </svg>
                            <span class="truncate font-semibold text-slate-800">{{ $cLandmark }}</span>
                        </div>
                        <span class="text-[11px] text-[#0B1F3A] font-bold uppercase tracking-wider bg-amber-100 px-2 py-0.5 rounded flex-shrink-0">{{ __('contact.walk_time') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Reassurance & Quick Support Strip -->
    <div class="mt-16 p-8 rounded-[28px] bg-gradient-to-r from-slate-50 via-white to-slate-50 border border-slate-200/90 shadow-[0_10px_35px_rgba(11,31,58,0.03)] grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200/60 text-amber-600 flex items-center justify-center flex-shrink-0 text-xl shadow-2xs">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <h4 class="text-sm font-bold font-serif text-[#0B1F3A]">{{ __('contact.strip_1_title') }}</h4>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    {{ __('contact.strip_1_desc') }}
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200/60 text-emerald-600 flex items-center justify-center flex-shrink-0 text-xl shadow-2xs">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div>
                <h4 class="text-sm font-bold font-serif text-[#0B1F3A]">{{ __('contact.strip_2_title') }}</h4>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    {{ __('contact.strip_2_desc') }}
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200/60 text-blue-600 flex items-center justify-center flex-shrink-0 text-xl shadow-2xs">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg>
            </div>
            <div>
                <h4 class="text-sm font-bold font-serif text-[#0B1F3A]">{{ __('contact.strip_3_title') }}</h4>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    {{ __('contact.strip_3_desc') }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     CONFIRMATION POPUP MODAL (Luxury Travel Lead Submission Receipt)
     ========================================================================= -->
<div 
    x-data="{ 
        showModal: {{ session('contact_success_modal') ? 'true' : 'false' }},
        copied: false,
        copyRef(text) {
            navigator.clipboard.writeText(text);
            this.copied = true;
            setTimeout(() => this.copied = false, 2500);
        }
    }"
    x-show="showModal"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
>
    <!-- Backdrop Overlay with Deep Sapphire Blur -->
    <div 
        x-show="showModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-[#071324]/80 backdrop-blur-md transition-opacity"
        @click="showModal = false"
    ></div>

    <!-- Modal Dialog Positioner -->
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6 z-10 relative">
        <div 
            x-show="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-[32px] bg-white text-left shadow-2xl transition-all w-full max-w-lg border border-slate-200/90"
            @click.stop
        >
            <!-- Top Ambient Glow Bar -->
            <div class="h-2 bg-gradient-to-r from-[#D4AF37] via-amber-300 to-[#D4AF37]"></div>

            <div class="p-6 sm:p-8">
                <!-- Close Icon Button -->
                <button 
                    type="button" 
                    @click="showModal = false" 
                    class="absolute top-5 right-5 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-[#0B1F3A] flex items-center justify-center transition-colors cursor-pointer"
                    aria-label="Close modal"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Animated Success Badge Header -->
                <div class="text-center mb-6">
                    <div class="relative inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200/80 mb-4 shadow-sm">
                        <span class="absolute inset-0 rounded-2xl bg-emerald-400/20 animate-ping"></span>
                        <svg class="w-8 h-8 relative z-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ __('contact.modal_badge') }}</span>
                    </div>

                    <h3 class="text-2xl font-extrabold font-serif text-[#0B1F3A]" id="modal-title">
                        {{ __('contact.modal_title') }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto leading-relaxed">
                        {{ __('contact.modal_subtitle', ['name' => session('contact_name', 'Traveler')]) }}
                    </p>
                </div>

                <!-- Structured Ticket / Reference Receipt Card -->
                <div class="bg-slate-50/80 rounded-2xl p-4 sm:p-5 border border-slate-200/80 mb-6 space-y-3">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200/60">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('contact.modal_ref') }}</span>
                            <span class="text-xs sm:text-sm font-mono font-bold text-[#0B1F3A]">
                                {{ session('contact_reference', 'EMT-MSG-' . strtoupper(substr(uniqid(), -6))) }}
                            </span>
                        </div>
                        <button 
                            type="button"
                            @click="copyRef('{{ session('contact_reference', 'EMT-MSG-SUCCESS') }}')"
                            class="text-[11px] font-bold text-[#D4AF37] hover:text-[#0B1F3A] flex items-center gap-1 bg-white px-2.5 py-1 rounded-lg border border-slate-200 shadow-2xs transition-colors cursor-pointer"
                        >
                            <svg class="w-3.5 h-3.5 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span x-text="copied ? '{{ __('ticketing.modal_copied') }}' : '{{ __('ticketing.modal_copy') }}'">{{ __('ticketing.modal_copy') }}</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('contact.modal_dept') }}</span>
                            <span class="font-semibold text-slate-800 text-xs">
                                {{ session('contact_service', 'Holiday Tour Package') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('contact.modal_response_window') }}</span>
                            <span class="font-semibold text-emerald-700 text-xs flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>{{ __('contact.modal_response_time') }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Instant Actions: WhatsApp Fast Forward & Hotline -->
                @php
                    $waRef = session('contact_reference', 'EMT-INQUIRY');
                    $waName = session('contact_name', 'Guest');
                    $waService = session('contact_service', 'Tour & Travel');
                    $waMsg = urlencode("Hello Emisha Tours! I just submitted an inquiry on your website under name: {$waName} for {$waService} (Ref: {$waRef}). Could you please share the details with me?");
                @endphp

                <div class="space-y-2.5">
                    <a 
                        href="https://wa.me/8801805464291?text={{ $waMsg }}" 
                        target="_blank" 
                        rel="noopener"
                        class="w-full py-3.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>{{ __('contact.modal_wa_action', ['phone' => '+880 1805-464291']) }}</span>
                    </a>

                    <div class="grid grid-cols-2 gap-2">
                        <a 
                            href="tel:+8801805464291" 
                            class="py-2.5 px-3 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center gap-1.5 transition"
                        >
                            <svg class="w-3.5 h-3.5 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ __('contact.modal_call_action') }}</span>
                        </a>

                        <button 
                            type="button" 
                            @click="showModal = false" 
                            class="py-2.5 px-3 rounded-xl bg-[#0B1F3A] hover:bg-[#071527] text-[#D4AF37] font-bold text-xs transition cursor-pointer"
                        >
                            <span>{{ __('contact.modal_done') }}</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

