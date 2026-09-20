@extends('layouts.app')

@section('title', 'Visa Assistance & Consultancy — Emisha Tours & Travels')
@section('meta_description', 'Fast, hassle-free visa processing for Bangladeshi citizens traveling to Thailand, Malaysia, Dubai, Singapore, UK, USA, Europe, Japan, Canada, Australia and Sri Lanka.')

@section('content')
<!-- Hero Section -->
<div class="bg-[#0B1F3A] text-white py-14 lg:py-20 relative overflow-hidden">
    <!-- Ambient Gold Glow & Radial Gradients -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#D4AF37]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#071527] via-[#0B1F3A] to-[#071527] opacity-95"></div>

    <div class="container-custom relative z-10">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-4">
                <a href="{{ route('home') }}" class="hover:underline text-white/80">Home</a>
                <span class="text-white/40">/</span>
                <span>Visa Assistance Desk</span>
            </div>
            
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 font-serif tracking-tight leading-tight">
                Global Visa Assistance <br class="hidden sm:inline">
                <span class="text-gradient-gold">& Embassy Consultancy</span>
            </h1>
            
            <p class="text-sm sm:text-base text-slate-200 leading-relaxed font-light mb-8 max-w-2xl">
                Get certified document scrutiny, bank solvency review, verified embassy checklists, and seamless online e-Visa application support with our dedicated visa specialists.
            </p>

            <!-- 4 Trust Pills -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <div>
                        <div class="font-bold text-white">99% Approval</div>
                        <div class="text-[10.5px] text-slate-300">High Success Record</div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <div>
                        <div class="font-bold text-white">24-72h Turnaround</div>
                        <div class="text-[10.5px] text-slate-300">Fast E-Visa Processing</div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    <div>
                        <div class="font-bold text-white">Official Checklist</div>
                        <div class="text-[10.5px] text-slate-300">100% Embassy Compliant</div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <div>
                        <div class="font-bold text-white">Dedicated Officer</div>
                        <div class="text-[10.5px] text-slate-300">Personalized Guidance</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Visa Countries Explorer Section with Instant Search & Region Filter -->
<section class="section-padding bg-[#F8FAFC]" x-data="{ search: '', region: 'all' }">
    <div class="container-custom">
        <!-- Filter Controls Bar -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-[0_4px_20px_rgba(11,31,58,0.04)] mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Region Pills -->
            <div class="flex items-center gap-1.5 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 scrollbar-none text-xs">
                <button 
                    @click="region = 'all'" 
                    :class="region === 'all' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="px-4 py-2 rounded-xl transition-all whitespace-nowrap"
                >
                    All Destinations
                </button>
                <button 
                    @click="region = 'asia'" 
                    :class="region === 'asia' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="px-4 py-2 rounded-xl transition-all whitespace-nowrap inline-flex items-center gap-1.5"
                >
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Asia</span>
                </button>
                <button 
                    @click="region = 'middle-east'" 
                    :class="region === 'middle-east' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="px-4 py-2 rounded-xl transition-all whitespace-nowrap inline-flex items-center gap-1.5"
                >
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Middle East</span>
                </button>
                <button 
                    @click="region = 'europe'" 
                    :class="region === 'europe' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="px-4 py-2 rounded-xl transition-all whitespace-nowrap inline-flex items-center gap-1.5"
                >
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Europe & Schengen</span>
                </button>
                <button 
                    @click="region = 'americas-oceania'" 
                    :class="region === 'americas-oceania' ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="px-4 py-2 rounded-xl transition-all whitespace-nowrap inline-flex items-center gap-1.5"
                >
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Americas & Oceania</span>
                </button>
            </div>

            <!-- Instant Search Input -->
            <div class="relative w-full md:w-72">
                <input 
                    type="text" 
                    x-model="search" 
                    placeholder="Search country (e.g. Thailand, UK)..."
                    class="w-full bg-slate-50 border border-slate-200/90 rounded-xl pl-9 pr-4 py-2 text-xs text-[#0B1F3A] focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] transition"
                >
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <button 
                    x-show="search.length > 0" 
                    @click="search = ''" 
                    class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 text-xs"
                >
                    ✕
                </button>
            </div>
        </div>

        <!-- Visa Cards Grid (3 Columns on Laptop Screens) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse($countries as $country)
                @php
                    $countryRegion = in_array($country->slug, ['thailand', 'malaysia', 'singapore', 'sri-lanka', 'japan']) 
                        ? 'asia' 
                        : (in_array($country->slug, ['uae-dubai', 'dubai', 'united-arab-emirates-dubai']) 
                            ? 'middle-east' 
                            : (in_array($country->slug, ['europe', 'schengen', 'europe-schengen', 'uk', 'united-kingdom']) 
                                ? 'europe' 
                                : 'americas-oceania'));
                @endphp
                <div 
                    x-show="(region === 'all' || region === '{{ $countryRegion }}') && ('{{ strtolower($country->country_name) }}'.includes(search.toLowerCase()))"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="h-full flex flex-col"
                >
                    <x-visa-card :country="$country" />
                </div>
            @empty
                <div class="col-span-4 text-center py-16 text-slate-500 card-base p-8 rounded-[24px]">
                    No visa countries listed at this time.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 4-Step Seamless Visa Processing Workflow -->
<section class="section-padding bg-white border-t border-slate-200/60">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-2">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                <span>Simple & Transparent Workflow</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-[#0B1F3A] mb-2">
                How Our Visa Consultancy Works
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                Step-by-step guidance from initial document collection to official embassy approval.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-200/70 relative">
                <span class="text-3xl font-black text-[#D4AF37]/30 absolute top-4 right-4 font-serif">01</span>
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold mb-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[#0B1F3A] mb-1.5">1. Check Requirements</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Review specific profession checklists (Job holder, Businessman, Student) for your destination.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-200/70 relative">
                <span class="text-3xl font-black text-[#D4AF37]/30 absolute top-4 right-4 font-serif">02</span>
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold mb-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[#0B1F3A] mb-1.5">2. Submit Documents</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Upload your digital scans online via our wizard or drop physical documents at our office.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-200/70 relative">
                <span class="text-3xl font-black text-[#D4AF37]/30 absolute top-4 right-4 font-serif">03</span>
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold mb-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[#0B1F3A] mb-1.5">3. Solvency & Audit</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Our senior visa officer audits bank statements, NOCs, and fills embassy forms flawlessly.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-200/70 relative">
                <span class="text-3xl font-black text-[#D4AF37]/30 absolute top-4 right-4 font-serif">04</span>
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold mb-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h3 class="text-sm font-bold text-[#0B1F3A] mb-1.5">4. Visa Granted</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Receive your approved E-Visa directly on email/WhatsApp or collect your passport from our desk.
                </p>
            </div>
        </div>

        <!-- Consultation Banner -->
        <div class="mt-12 rounded-[24px] bg-[#0B1F3A] text-white p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 border border-[#D4AF37]/30 shadow-xl">
            <div>
                <h3 class="text-xl sm:text-2xl font-bold font-serif text-white mb-1">
                    Need Custom Visa Consultancy or Urgent Submission?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300">
                    Connect directly with our senior visa consultants for tailored guidance and appointment scheduling.
                </p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text=Hello%20Emisha%20Tours,%20I%20need%20visa%20consultancy%20assistance." target="_blank" class="btn btn-whatsapp btn-sm rounded-xl px-5 py-3 text-xs font-bold flex items-center gap-2 shadow-md">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>WhatsApp Visa Desk</span>
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-white btn-sm rounded-xl px-5 py-3 text-xs font-bold">
                    <span>Contact Us</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
