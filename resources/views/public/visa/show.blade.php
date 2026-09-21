@extends('layouts.app')

@section('title', "{$country->localized_country_name} " . __('visa.visa_requirements_title'))
@section('meta_description', $country->localized_short_description ?: "Comprehensive {$country->localized_country_name} visa requirements, document checklist, embassy fees, and online application assistance for Bangladeshi travelers.")
@section('canonical_url', route('visa.show', $country->slug))
@section('og_image', $country->flag_url ?: asset('images/logo.png'))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- Visa Country Header -->
<div class="bg-[#0B1F3A] text-white py-12 lg:py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#071527] to-[#0B1F3A] opacity-90"></div>
    <div class="container-custom relative z-10">
        <div class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:underline">{{ __('nav.home') }}</a> / 
            <a href="{{ route('visa.index') }}" class="hover:underline">{{ __('nav.visa') }}</a> / 
            <span class="text-white/60">{{ $country->localized_country_name }}</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl sm:rounded-[24px] bg-white/10 flex items-center justify-center shadow-inner border border-white/20 backdrop-blur-md overflow-hidden p-2 sm:p-2.5 flex-shrink-0">
                    <img 
                        src="{{ $country->flag_url }}" 
                        alt="{{ $country->localized_country_name }} Flag" 
                        class="w-full h-full object-cover rounded-xl shadow-inner drop-shadow"
                        loading="lazy"
                    >
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-white mb-2">
                        <span class="text-white">{{ $country->localized_country_name }} {{ __('visa.visa') }}</span>
                    </h1>
                    <p class="text-sm text-slate-200 max-w-xl leading-relaxed font-normal">{{ $country->localized_short_description }}</p>
                </div>
            </div>

            <div>
                <a href="{{ route('visa.apply') }}?country={{ $country->id }}" class="btn btn-gold btn-lg shadow-lg">
                    <span>{{ __('visa.start_application') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Visa Requirements & Profession Switcher -->
<section class="section-padding bg-[#F8FAFC]" x-data="{ activeVisaType: {{ $country->visaTypes->first()->id ?? 0 }}, activeProfession: 'salaried' }">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left 2-Columns: Types, General Requirements & Profession Checklist -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Visa Types Tabs -->
                <div class="flex flex-wrap gap-2 pb-2 border-b border-slate-200">
                    @foreach($country->visaTypes as $vt)
                    <button 
                        type="button" 
                        @click="activeVisaType = {{ $vt->id }}" 
                        :class="activeVisaType === {{ $vt->id }} ? 'bg-[#0B1F3A] text-[#D4AF37] shadow-lg shadow-[#0B1F3A]/20 border-[#0B1F3A]' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200'"
                        class="px-5 py-3 rounded-xl font-bold text-sm transition-all border"
                    >
                        {{ $vt->localized_name }}
                    </button>
                    @endforeach
                </div>

                <!-- Visa Type Details -->
                @foreach($country->visaTypes as $vt)
                <div x-show="activeVisaType === {{ $vt->id }}" class="space-y-8">
                    <!-- Key Parameters Box -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-white p-6 rounded-[24px] border border-slate-100 shadow-[0_10px_30px_rgba(11,31,58,0.04)] text-center">
                        <div class="p-4 bg-[#F8FAFC] rounded-[18px]">
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">{{ __('visa.processing_time') }}</div>
                            <div class="text-base font-extrabold text-[#0B1F3A]">{{ $vt->processing_time }} {{ $vt->localized_processing_time_unit }}</div>
                        </div>
                        <div class="p-4 bg-[#F8FAFC] rounded-[18px]">
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">{{ __('visa.validity') }}</div>
                            <div class="text-base font-extrabold text-[#0B1F3A]">{{ $vt->validity_bn && app()->getLocale() === 'bn' ? $vt->validity_bn : ($vt->validity ?: '90 Days') }}</div>
                        </div>
                        <div class="p-4 bg-[#F8FAFC] rounded-[18px]">
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">{{ __('visa.max_stay') }}</div>
                            <div class="text-base font-extrabold text-[#0B1F3A]">{{ $vt->stay_period_bn && app()->getLocale() === 'bn' ? $vt->stay_period_bn : ($vt->stay_period ?: '30-60 Days') }}</div>
                        </div>
                        <div class="p-4 bg-[#F8FAFC] rounded-[18px]">
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">{{ __('visa.total_fee') }}</div>
                            <div class="text-base font-extrabold text-[#D4AF37]">৳{{ number_format($vt->starting_fee + $vt->service_fee, 0) }}</div>
                        </div>
                    </div>

                    <!-- General Required Documents -->
                    <div class="card-base p-8 rounded-[24px]">
                        <h3 class="text-xl font-extrabold text-[#0B1F3A] mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-[#D4AF37]/20 text-[#D4AF37] flex items-center justify-center font-bold text-xs">1</span>
                            <span>{{ __('visa.general_docs_title') }}</span>
                        </h3>
                        <ul class="space-y-3 text-sm text-slate-600">
                            @foreach($vt->requirements as $req)
                            <li class="flex items-start gap-2.5">
                                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $req->localized_title }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Profession-Based Requirements Interactive Checklist -->
                    <div id="vue-visa-requirements">
                        @if($vt->professionRequirements->isNotEmpty())
                        <div class="card-base p-8 rounded-[24px] border border-[#D4AF37]/40 shadow-md">
                            <h3 class="text-xl font-extrabold text-[#0B1F3A] mb-2 flex items-center gap-2">
                                <span class="w-7 h-7 rounded-full bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold text-xs">2</span>
                                <span>{{ __('visa.profession_docs_title') }}</span>
                            </h3>
                            <p class="text-xs text-slate-500 mb-6">{{ __('visa.profession_docs_sub') }}</p>

                            <!-- Profession Switcher Buttons -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($professions as $prof)
                                    @if($vt->professionRequirements->where('profession_type_id', $prof->id)->isNotEmpty())
                                    <button 
                                        type="button" 
                                        @click="activeProfession = '{{ $prof->slug }}'"
                                        :class="activeProfession === '{{ $prof->slug }}' ? 'bg-[#0B1F3A] text-[#D4AF37] font-bold shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                        class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all"
                                    >
                                        {{ $prof->localized_name }}
                                    </button>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Document Lists By Profession -->
                            @foreach($professions as $prof)
                                @php
                                    $pReqs = $vt->professionRequirements->where('profession_type_id', $prof->id);
                                @endphp
                                @if($pReqs->isNotEmpty())
                                <div x-show="activeProfession === '{{ $prof->slug }}'" class="space-y-3 bg-[#F8FAFC] p-6 rounded-[20px] border border-slate-100">
                                    <h4 class="font-bold text-sm text-[#0B1F3A] mb-3">{{ __('visa.additional_docs_for', ['prof' => $prof->localized_name]) }}</h4>
                                    <ul class="space-y-2.5 text-xs text-slate-600">
                                        @foreach($pReqs as $pr)
                                        <li class="flex items-start gap-2">
                                            <svg class="w-3.5 h-3.5 text-[#D4AF37] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            <span>{{ $pr->localized_title }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

                <!-- Disclaimer Notice -->
                <div class="p-6 bg-amber-50/70 rounded-[20px] border border-amber-200/80 text-xs text-amber-900 leading-relaxed">
                    <span class="font-bold text-amber-800">{{ __('visa.advisory_title') }}:</span> {{ __('visa.advisory_text') }}
                </div>
            </div>

            <!-- Right Column: Quick Apply Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <div class="card-base p-8 sticky top-24 border border-[#D4AF37]/40 shadow-xl bg-white text-center rounded-[24px]">
                    <div class="w-16 h-16 rounded-full bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center mx-auto mb-4 shadow-md border border-gold/20">
                        <svg class="w-8 h-8 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>

                    <h3 class="text-xl font-extrabold text-[#0B1F3A] mb-2">{{ __('visa.apply_online_fast') }}</h3>
                    <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                        {{ __('visa.apply_online_sub') }}
                    </p>

                    <a href="{{ route('visa.apply') }}?country={{ $country->id }}" class="btn btn-gold w-full font-bold shadow-md mb-3 py-3 text-xs uppercase tracking-wider">
                        <span>{{ __('visa.start_application') }}</span>
                    </a>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text=Hello%20Emisha%20Tours,%20I%20need%20assistance%20with%20{{ urlencode($country->country_name) }}%20visa." target="_blank" class="btn btn-outline w-full text-xs py-2.5">
                        <span>{{ __('visa.ask_on_whatsapp') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

