@extends('layouts.app')

@section('title', __('ticketing.title'))
@section('meta_description', __('ticketing.meta_description'))
@section('canonical_url', route('ticketing.index'))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- Hero Section -->
<div class="bg-[#0B1F3A] py-14 lg:py-18 text-white relative overflow-hidden">
    <!-- Ambient Blur Backgrounds -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#D4AF37]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#071527] via-[#0B1F3A] to-[#071527] opacity-95"></div>

    <div class="container-custom relative z-10 text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 border border-white/20 text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-4">
            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            <span>{{ __('ticketing.iata_badge') }}</span>
        </div>
        
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 text-white font-serif tracking-tight leading-tight">
            {{ __('ticketing.hero_title') }} <br class="hidden sm:inline">
            <span class="text-gradient-gold">{{ __('ticketing.hero_title_highlight') }}</span>
        </h1>
        
        <p class="text-slate-200 text-xs sm:text-sm md:text-base leading-relaxed font-light mb-8 max-w-2xl mx-auto">
            {{ __('ticketing.hero_subtitle') }}
        </p>

        <!-- 4 Quick Trust Badges -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3 text-left">
            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3 flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0 text-xs">
                    500+
                </span>
                <div>
                    <div class="font-bold text-white text-xs">{{ __('ticketing.badge_airlines') }}</div>
                    <div class="text-[10px] text-slate-300">{{ __('ticketing.badge_airlines_sub') }}</div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3 flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </span>
                <div>
                    <div class="font-bold text-white text-xs">{{ __('ticketing.badge_best_rates') }}</div>
                    <div class="text-[10px] text-slate-300">{{ __('ticketing.badge_best_rates_sub') }}</div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3 flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </span>
                <div>
                    <div class="font-bold text-white text-xs">{{ __('ticketing.badge_reissue') }}</div>
                    <div class="text-[10px] text-slate-300">{{ __('ticketing.badge_reissue_sub') }}</div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3 flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <div>
                    <div class="font-bold text-white text-xs">{{ __('ticketing.badge_sla') }}</div>
                    <div class="text-[10px] text-slate-300">{{ __('ticketing.badge_sla_sub') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Ticketing Container -->
<section class="section-padding bg-[#F8FAFC]" x-data="{
    tripType: 'round-trip',
    origin: '{{ old('origin', 'Dhaka (DAC)') }}',
    destination: '{{ old('destination', '') }}',
    isSubmitting: false,
    swapAirports() {
        let temp = this.origin;
        this.origin = this.destination;
        this.destination = temp;
    },
    setRoute(from, to) {
        this.origin = from;
        this.destination = to;
    }
}">
    <div class="container-custom">
        <!-- Popular Quick Routes Strip -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-[0_2px_16px_rgba(11,31,58,0.03)] mb-8">
            <div class="flex items-center justify-between gap-2 mb-3">
                <span class="text-xs font-bold text-[#0B1F3A] uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                    <span>{{ __('ticketing.popular_routes') }}</span>
                </span>
                <span class="text-[11px] text-slate-400 hidden sm:inline">{{ __('ticketing.daily_flights') }}</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 text-xs">
                <button type="button" @click="setRoute('Dhaka (DAC)', 'Bangkok (BKK)')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-[#0B1F3A] hover:text-white border border-slate-200/70 text-left transition group">
                    <span class="font-bold block text-[#0B1F3A] group-hover:text-white">DAC ⇄ BKK</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-slate-300 truncate block">🇹🇭 Bangkok, Thailand</span>
                </button>

                <button type="button" @click="setRoute('Dhaka (DAC)', 'Dubai (DXB)')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-[#0B1F3A] hover:text-white border border-slate-200/70 text-left transition group">
                    <span class="font-bold block text-[#0B1F3A] group-hover:text-white">DAC ⇄ DXB</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-slate-300 truncate block">🇦🇪 Dubai, UAE</span>
                </button>

                <button type="button" @click="setRoute('Dhaka (DAC)', 'Singapore (SIN)')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-[#0B1F3A] hover:text-white border border-slate-200/70 text-left transition group">
                    <span class="font-bold block text-[#0B1F3A] group-hover:text-white">DAC ⇄ SIN</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-slate-300 truncate block">🇸🇬 Singapore Changi</span>
                </button>

                <button type="button" @click="setRoute('Dhaka (DAC)', 'Kuala Lumpur (KUL)')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-[#0B1F3A] hover:text-white border border-slate-200/70 text-left transition group">
                    <span class="font-bold block text-[#0B1F3A] group-hover:text-white">DAC ⇄ KUL</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-slate-300 truncate block">🇲🇾 Kuala Lumpur</span>
                </button>

                <button type="button" @click="setRoute('Dhaka (DAC)', 'London (LHR)')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-[#0B1F3A] hover:text-white border border-slate-200/70 text-left transition group">
                    <span class="font-bold block text-[#0B1F3A] group-hover:text-white">DAC ⇄ LHR</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-slate-300 truncate block">🇬🇧 London Heathrow</span>
                </button>

                <button type="button" @click="setRoute('Dhaka (DAC)', 'Jeddah (JED)')" class="p-2.5 rounded-xl bg-slate-50 hover:bg-[#0B1F3A] hover:text-white border border-slate-200/70 text-left transition group">
                    <span class="font-bold block text-[#0B1F3A] group-hover:text-white">DAC ⇄ JED</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-slate-300 truncate block">🇸🇦 Jeddah, KSA</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Flight Request Form Column -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[26px] shadow-[0_4px_24px_rgba(11,31,58,0.04)] border border-slate-200/80 p-6 sm:p-9">
                    
                    <!-- Form Header -->
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold shadow-xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold font-serif text-[#0B1F3A]">{{ __('ticketing.form_title') }}</h2>
                                <p class="text-xs text-slate-500">{{ __('ticketing.form_subtitle') }}</p>
                            </div>
                        </div>

                        <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-[11px] font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>{{ __('ticketing.live_desk') }}</span>
                        </span>
                    </div>

                    <form action="{{ route('ticketing.store') }}" method="POST" class="space-y-6" id="ticket-request-form" @submit="if(isSubmitting) { $event.preventDefault(); return false; } isSubmitting = true;">
                        @csrf

                        <!-- 1. Trip Type Segmented Control -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2.5">{{ __('ticketing.select_trip_type') }}</label>
                            <div class="grid grid-cols-3 gap-2 sm:gap-3 p-1.5 bg-slate-100/80 rounded-2xl border border-slate-200/70">
                                <label class="cursor-pointer">
                                    <input type="radio" name="trip_type" value="round-trip" x-model="tripType" class="sr-only">
                                    <div :class="tripType === 'round-trip' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'text-slate-600 hover:text-[#0B1F3A] font-medium'"
                                         class="py-2.5 text-center text-xs rounded-xl transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                        <span>{{ __('ticketing.round_trip') }}</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="trip_type" value="one-way" x-model="tripType" class="sr-only">
                                    <div :class="tripType === 'one-way' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'text-slate-600 hover:text-[#0B1F3A] font-medium'"
                                         class="py-2.5 text-center text-xs rounded-xl transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        <span>{{ __('ticketing.one_way') }}</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="trip_type" value="multi-city" x-model="tripType" class="sr-only">
                                    <div :class="tripType === 'multi-city' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'text-slate-600 hover:text-[#0B1F3A] font-medium'"
                                         class="py-2.5 text-center text-xs rounded-xl transition-all flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                                        <span>{{ __('ticketing.multi_city') }}</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 2. Origin & Destination with Swap Button -->
                        <div class="grid grid-cols-1 md:grid-cols-11 gap-3 items-center">
                            <!-- Departure -->
                            <div class="md:col-span-5">
                                <label for="origin" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                    <span>{{ __('ticketing.departure_from') }} *</span>
                                </label>
                                <input type="text" id="origin" name="origin" x-model="origin" required placeholder="{{ __('ticketing.departure_from_placeholder') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white min-h-[44px]">
                                @error('origin')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Swap Button -->
                            <div class="md:col-span-1 flex justify-center py-1 md:pt-5">
                                <button type="button" @click="swapAirports()" title="Swap Departure & Destination"
                                    class="w-10 h-10 rounded-full bg-slate-100 hover:bg-[#0B1F3A] text-slate-600 hover:text-white border border-slate-200 flex items-center justify-center transition-all duration-300 shadow-2xs hover:rotate-180 cursor-pointer active:scale-95"
                                    aria-label="Swap Origin and Destination">
                                    <svg class="w-4 h-4 md:rotate-0 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                </button>
                            </div>

                            <!-- Destination -->
                            <div class="md:col-span-5">
                                <label for="destination" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                    <span>{{ __('ticketing.flying_to') }} *</span>
                                </label>
                                <input type="text" id="destination" name="destination" x-model="destination" required placeholder="{{ __('ticketing.flying_to_placeholder') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white min-h-[44px]">
                                @error('destination')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 3. Travel Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="departure_date" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.departure_date') }} *</label>
                                <div class="relative">
                                    <input type="date" id="departure_date" name="departure_date" value="{{ old('departure_date', date('Y-m-d', strtotime('+7 days'))) }}" required
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white">
                                </div>
                                @error('departure_date')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-show="tripType !== 'one-way'" x-transition>
                                <label for="return_date" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.return_date') }}</label>
                                <div class="relative">
                                    <input type="date" id="return_date" name="return_date" value="{{ old('return_date', date('Y-m-d', strtotime('+14 days'))) }}"
                                        :required="tripType !== 'one-way'"
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white">
                                </div>
                                @error('return_date')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 4. Passengers & Cabin Class Grid -->
                        <div class="bg-slate-50/80 rounded-2xl p-4 sm:p-5 border border-slate-200/70">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#0B1F3A] mb-3">{{ __('ticketing.passengers_cabin') }}</label>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <div>
                                    <span class="block text-[11px] text-slate-500 font-medium mb-1">{{ __('ticketing.adults') }}</span>
                                    <input type="number" id="adults" name="adults" min="1" max="50" value="{{ old('adults', 1) }}" required
                                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-[#D4AF37] text-xs font-bold text-[#0B1F3A]">
                                </div>
                                <div>
                                    <span class="block text-[11px] text-slate-500 font-medium mb-1">{{ __('ticketing.children') }}</span>
                                    <input type="number" id="children" name="children" min="0" max="50" value="{{ old('children', 0) }}"
                                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-[#D4AF37] text-xs font-bold text-[#0B1F3A]">
                                </div>
                                <div>
                                    <span class="block text-[11px] text-slate-500 font-medium mb-1">{{ __('ticketing.infants') }}</span>
                                    <input type="number" id="infants" name="infants" min="0" max="20" value="{{ old('infants', 0) }}"
                                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-[#D4AF37] text-xs font-bold text-[#0B1F3A]">
                                </div>
                                <div>
                                    <span class="block text-[11px] text-slate-500 font-medium mb-1">{{ __('ticketing.cabin_class') }}</span>
                                    <select id="cabin_class" name="cabin_class"
                                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-[#D4AF37] text-xs font-bold text-[#0B1F3A] cursor-pointer">
                                        <option value="Economy" {{ old('cabin_class') == 'Economy' ? 'selected' : '' }}>{{ __('ticketing.economy') }}</option>
                                        <option value="Premium Economy" {{ old('cabin_class') == 'Premium Economy' ? 'selected' : '' }}>{{ __('ticketing.premium_economy') }}</option>
                                        <option value="Business" {{ old('cabin_class') == 'Business' ? 'selected' : '' }}>{{ __('ticketing.business') }}</option>
                                        <option value="First" {{ old('cabin_class') == 'First' ? 'selected' : '' }}>{{ __('ticketing.first_class') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Airline Preference & Flexible Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                            <div>
                                <label for="preferred_airline" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.preferred_airline') }}</label>
                                <input type="text" id="preferred_airline" name="preferred_airline" value="{{ old('preferred_airline') }}" placeholder="{{ __('ticketing.preferred_airline_placeholder') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] transition bg-slate-50/50 focus:bg-white">
                            </div>
                            <div class="pt-2 md:pt-6">
                                <label class="inline-flex items-center gap-2 cursor-pointer p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/70 w-full transition">
                                    <input type="checkbox" name="flexible_dates" value="1" class="w-4 h-4 rounded text-[#D4AF37] focus:ring-[#D4AF37] border-slate-300">
                                    <span class="text-xs font-medium text-slate-700">{{ __('ticketing.flexible_dates') }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- 6. Passenger Contact Details -->
                        <div class="border-t border-slate-100 pt-6">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#0B1F3A] mb-4 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>{{ __('ticketing.contact_section_title') }}</span>
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="full_name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.full_name') }} *</label>
                                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required placeholder="{{ __('ticketing.full_name_placeholder') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white">
                                    @error('full_name')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.email') }} *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('ticketing.email_placeholder') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white">
                                    @error('email')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.phone') }} *</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="{{ __('ticketing.phone_placeholder') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] font-medium transition bg-slate-50/50 focus:bg-white">
                                    @error('phone')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 7. Special Notes / Preferences -->
                        <div>
                            <label for="additional_requirements" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">{{ __('ticketing.special_notes') }}</label>
                            <textarea id="additional_requirements" name="additional_requirements" rows="2" placeholder="{{ __('ticketing.special_notes_placeholder') }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs sm:text-sm text-[#0B1F3A] transition bg-slate-50/50 focus:bg-white">{{ old('additional_requirements') }}</textarea>
                        </div>

                        <!-- 8. Submit Button -->
                        <div>
                            <button type="submit" :disabled="isSubmitting" class="btn btn-gold w-full py-4 rounded-xl shadow-lg text-sm sm:text-base font-extrabold uppercase tracking-wider flex items-center justify-center gap-2 hover:brightness-105 transition disabled:opacity-75 disabled:cursor-not-allowed">
                                <template x-if="!isSubmitting">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                        <span>{{ __('ticketing.submit_btn') }}</span>
                                    </div>
                                </template>
                                <template x-if="isSubmitting">
                                    <div class="flex items-center gap-2">
                                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span>{{ __('ticketing.submitting_btn') }}</span>
                                    </div>
                                </template>
                            </button>
                            <div class="text-center text-[11px] text-slate-400 flex items-center justify-center gap-1.5 mt-3">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span>{{ __('ticketing.no_payment_notice') }}</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Sidebar / Assurance Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Urgent Hotline Card -->
                <div class="bg-[#0B1F3A] rounded-[26px] p-6 sm:p-7 text-white text-center shadow-xl border border-[#D4AF37]/30 relative overflow-hidden">
                    <div class="w-14 h-14 bg-[#D4AF37]/20 text-[#D4AF37] rounded-2xl flex items-center justify-center mx-auto mb-3.5 border border-[#D4AF37]/40 shadow-inner">
                        <svg class="w-7 h-7 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-[10.5px] font-semibold mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ __('ticketing.desk_online') }}</span>
                    </span>

                    <h3 class="text-lg font-bold font-serif mb-1 text-white">{{ __('ticketing.urgent_card_title') }}</h3>
                    <p class="text-slate-300 text-xs mb-5 leading-relaxed">{{ __('ticketing.urgent_card_subtitle') }}</p>
                    
                    <div class="space-y-2.5">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', App\Models\Setting::get('contact_phone', '+8801805464291')) }}" class="w-full py-3 bg-[#D4AF37] hover:bg-[#c49e28] text-[#0B1F3A] font-extrabold rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ __('ticketing.call_btn') }}: {{ App\Models\Setting::get('contact_phone', '+880 1805-464291') }}</span>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text=Hello%20Emisha%20Tours,%20I%20need%20urgent%20flight%20ticket%20assistance." target="_blank" class="block w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs shadow-md transition flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>{{ __('ticketing.whatsapp_chat') }}</span>
                        </a>
                    </div>
                </div>

                <!-- Why Book With Emisha -->
                <div class="bg-white rounded-[26px] p-6 border border-slate-200/80 shadow-[0_4px_20px_rgba(11,31,58,0.03)] space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[#0B1F3A] border-b border-slate-100 pb-3 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ __('ticketing.why_book_title') }}</span>
                    </h3>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-50 border border-slate-200/80 flex items-center justify-center flex-shrink-0 mt-0.5 text-[#D4AF37]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">{{ __('ticketing.why_1_title') }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ __('ticketing.why_1_desc') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-50 border border-slate-200/80 flex items-center justify-center flex-shrink-0 mt-0.5 text-[#D4AF37]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">{{ __('ticketing.why_2_title') }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ __('ticketing.why_2_desc') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-50 border border-slate-200/80 flex items-center justify-center flex-shrink-0 mt-0.5 text-[#D4AF37]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">{{ __('ticketing.why_3_title') }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ __('ticketing.why_3_desc') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-50 border border-slate-200/80 flex items-center justify-center flex-shrink-0 mt-0.5 text-[#D4AF37]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">{{ __('ticketing.why_4_title') }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ __('ticketing.why_4_desc') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Partner Airlines -->
                <div class="bg-white rounded-[26px] p-6 border border-slate-200/80 shadow-[0_4px_20px_rgba(11,31,58,0.03)] text-center">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">{{ __('ticketing.partner_airlines') }}</h4>
                    <div class="flex flex-wrap items-center justify-center gap-1.5 text-xs font-semibold text-slate-600">
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Biman Bangladesh</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Emirates</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Qatar Airways</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Singapore Airlines</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">US-Bangla</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Saudia</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Turkish Airlines</span>
                        <span class="px-2.5 py-1 bg-slate-50 rounded-lg border border-slate-200/80 text-[11px]">Air Arabia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     FLIGHT CONFIRMATION POPUP MODAL (Aviation Lead Receipt & Live Quotation SLA)
     ========================================================================= -->
<div 
    x-data="{ 
        showModal: {{ session('ticket_success_modal') ? 'true' : 'false' }},
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
    aria-labelledby="ticket-modal-title" 
    role="dialog" 
    aria-modal="true"
>
    <!-- Backdrop Overlay with Sapphire Glow Blur -->
    <div 
        x-show="showModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-[#071324]/85 backdrop-blur-md transition-opacity"
        @click="showModal = false"
    ></div>

    <!-- Modal Dialog Frame -->
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
            <!-- Top Golden Aviation Stripe -->
            <div class="h-2 bg-gradient-to-r from-[#D4AF37] via-amber-300 to-[#D4AF37]"></div>

            <div class="p-6 sm:p-8">
                <!-- Close Button -->
                <button 
                    type="button" 
                    @click="showModal = false" 
                    class="absolute top-5 right-5 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-[#0B1F3A] flex items-center justify-center transition-colors cursor-pointer"
                    aria-label="Close modal"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Top Animated Aviation Icon Header -->
                <div class="text-center mb-6">
                    <div class="relative inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#0B1F3A] text-[#D4AF37] border border-[#D4AF37]/40 mb-4 shadow-md">
                        <span class="absolute inset-0 rounded-2xl bg-[#D4AF37]/20 animate-ping"></span>
                        <svg class="w-8 h-8 relative z-10 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>

                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                        <span>{{ __('ticketing.modal_badge') }}</span>
                    </div>

                    <h3 class="text-2xl font-extrabold font-serif text-[#0B1F3A]" id="ticket-modal-title">
                        {{ __('ticketing.modal_title') }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto leading-relaxed">
                        {{ __('ticketing.modal_subtitle', ['name' => session('ticket_passenger', 'Traveler')]) }}
                    </p>
                </div>

                <!-- Structured Boarding Pass / Quotation Slip -->
                <div class="bg-slate-50/90 rounded-2xl p-4 sm:p-5 border border-slate-200/90 mb-6 space-y-3.5">
                    
                    <!-- Reference Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200/70">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('ticketing.modal_ref') }}</span>
                            <span class="text-xs sm:text-sm font-mono font-bold text-[#0B1F3A]">
                                {{ session('ticket_reference', 'EMT-TKT-REQ') }}
                            </span>
                        </div>
                        <button 
                            type="button"
                            @click="copyRef('{{ session('ticket_reference', 'EMT-TKT-REQ') }}')"
                            class="text-[11px] font-bold text-[#D4AF37] hover:text-[#0B1F3A] flex items-center gap-1 bg-white px-2.5 py-1 rounded-lg border border-slate-200 shadow-2xs transition-colors cursor-pointer"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span x-text="copied ? '{{ __('ticketing.modal_copied') }}' : '{{ __('ticketing.modal_copy') }}'">{{ __('ticketing.modal_copy') }}</span>
                        </button>
                    </div>

                    <!-- Flight Route & Details Matrix -->
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('ticketing.modal_route') }}</span>
                            <span class="font-bold text-[#0B1F3A] text-xs sm:text-sm block truncate">
                                {{ session('ticket_route', 'DAC ⇄ Requested Destination') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('ticketing.modal_trip_cabin') }}</span>
                            <span class="font-semibold text-slate-800 text-xs block">
                                {{ session('ticket_trip_type', 'Round-trip') }} ({{ session('ticket_cabin_class', 'Economy') }})
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('ticketing.modal_travel_dates') }}</span>
                            <span class="font-medium text-slate-700 text-xs block">
                                {{ session('ticket_departure_date', 'Selected Date') }}
                                @if(session('ticket_return_date'))
                                    <span class="text-slate-400">to</span> {{ session('ticket_return_date') }}
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">{{ __('ticketing.modal_response_window') }}</span>
                            <span class="font-semibold text-emerald-700 text-xs flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>{{ __('ticketing.modal_response_time') }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Instant Action Triggers: WhatsApp Desk & Urgent Call -->
                @php
                    $tktRef = session('ticket_reference', 'EMT-TKT-REQ');
                    $tktPax = session('ticket_passenger', 'Traveler');
                    $tktRoute = session('ticket_route', 'Flight Booking');
                    $tktDate = session('ticket_departure_date', 'Upcoming');
                    $tktWaMsg = urlencode("Hello Emisha Air Ticketing Desk! I just submitted a flight quotation request on your website for {$tktRoute} departing on {$tktDate} under name: {$tktPax} (Ref: {$tktRef}). Could you please share the lowest available airfares with me?");
                @endphp

                <div class="space-y-2.5">
                    <a 
                        href="https://wa.me/8801805464291?text={{ $tktWaMsg }}" 
                        target="_blank" 
                        rel="noopener"
                        class="w-full py-3.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>{{ __('ticketing.modal_wa_action', ['phone' => '+880 1805-464291']) }}</span>
                    </a>

                    <div class="grid grid-cols-2 gap-2">
                        <a 
                            href="tel:+8801805464291" 
                            class="py-2.5 px-3 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center gap-1.5 transition"
                        >
                            <svg class="w-3.5 h-3.5 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ __('ticketing.modal_call_action') }}</span>
                        </a>

                        <button 
                            type="button" 
                            @click="showModal = false" 
                            class="py-2.5 px-3 rounded-xl bg-[#0B1F3A] hover:bg-[#071527] text-[#D4AF37] font-bold text-xs transition cursor-pointer"
                        >
                            <span>{{ __('ticketing.modal_done') }}</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

