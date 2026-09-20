@extends('layouts.app')

@section('title', 'About Us | Emisha Tours & Travels')
@section('meta_description', 'Learn about Emisha Tours & Travels, Bangladesh premier travel management agency dedicated to premium holiday packages, visa processing, and air ticketing.')

@section('content')
<!-- Hero Section -->
<div class="bg-[#0B1F3A] py-20 md:py-24 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#D4AF37]/15 text-[#D4AF37] uppercase tracking-widest mb-3 border border-[#D4AF37]/30">Our Legacy & Mission</span>
        <h1 class="text-3xl md:text-6xl font-extrabold mb-6 text-white tracking-tight">
            <span class="text-white">Crafting Unforgettable Journeys</span>
        </h1>
        <p class="text-slate-200 max-w-3xl mx-auto text-base md:text-xl leading-relaxed font-normal">
            Emisha Tours & Travels is committed to making international and domestic travel effortless, transparent, and memorable for travelers across Bangladesh.
        </p>
    </div>
</div>

<!-- Story Section (Who We Are - Creative Optimistic Minimal UI Design) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 relative">
    <!-- Ambient Backdrop Gradient Elements -->
    <div class="absolute -top-10 left-1/4 w-72 h-72 bg-[#D4AF37]/8 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-10 right-1/4 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        
        <!-- Left Column: Editorial Storytelling & Key Proof Points (lg:col-span-6) -->
        <div class="lg:col-span-6 space-y-7">
            <!-- Section Pill Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#D4AF37]/15 text-[#0B1F3A] uppercase tracking-widest border border-[#D4AF37]/30 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span>Who We Are • Established Excellence</span>
            </div>
            
            <!-- Headline -->
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold font-serif text-[#0B1F3A] leading-tight tracking-tight">
                Your Trusted Travel Partner in Bangladesh
            </h2>

            <!-- Editorial Narrative -->
            <div class="space-y-4 text-slate-600 text-sm sm:text-base leading-relaxed font-normal">
                <p>
                    Founded with a passion for world exploration and excellence in hospitality, <strong class="text-[#0B1F3A] font-semibold">Emisha Tours & Travels</strong> has grown into one of Dhaka’s most reliable and comprehensive full-service travel management agencies.
                </p>
                <p>
                    From hand-crafted leisure vacations across Southeast Asia, Europe, and the Middle East, to complex multi-destination business visas and group flight bookings, our certified team handles every nuance with unmatched precision.
                </p>
            </div>

            <!-- Modern KPI Stats Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3.5 sm:gap-4 pt-1">
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-md hover:border-[#D4AF37]/40 transition-all duration-300 group">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="text-xl sm:text-2xl md:text-3xl font-black font-serif text-[#0B1F3A] tracking-tight group-hover:text-[#D4AF37] transition-colors">10,000+</span>
                    </div>
                    <span class="text-[11px] sm:text-xs text-slate-500 font-bold uppercase tracking-wider block">Happy Travelers</span>
                </div>

                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-md hover:border-emerald-300 transition-all duration-300 group">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="text-xl sm:text-2xl md:text-3xl font-black font-serif text-emerald-600 tracking-tight">98.5%</span>
                    </div>
                    <span class="text-[11px] sm:text-xs text-slate-500 font-bold uppercase tracking-wider block">Visa Success Rate</span>
                </div>

                <div class="col-span-2 sm:col-span-1 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-md hover:border-[#D4AF37]/40 transition-all duration-300 group">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="text-xl sm:text-2xl md:text-3xl font-black font-serif text-[#0B1F3A] tracking-tight group-hover:text-[#D4AF37] transition-colors">24/7</span>
                    </div>
                    <span class="text-[11px] sm:text-xs text-slate-500 font-bold uppercase tracking-wider block">Dedicated Care</span>
                </div>
            </div>

            <!-- Interactive Action Row -->
            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                <a href="{{ route('tours.index') }}" class="btn btn-gold px-6 py-3.5 text-xs uppercase tracking-wider font-bold rounded-xl shadow-md flex items-center gap-2">
                    <span>Explore Tour Packages</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('visa.index') }}" class="btn btn-outline px-6 py-3.5 text-xs uppercase tracking-wider font-bold rounded-xl flex items-center gap-2">
                    <span>Visa Consultancy</span>
                </a>
            </div>
        </div>

        <!-- Right Column: Creative Destination Mosaic Gallery (lg:col-span-6) -->
        <div class="lg:col-span-6 relative">
            
            <!-- Mosaic Container Grid -->
            <div class="grid grid-cols-2 gap-3.5 sm:gap-5">
                
                <!-- Left Column of Mosaic -->
                <div class="space-y-3.5 sm:space-y-5">
                    <!-- Card 1: Exotic Beach -->
                    <div class="relative group rounded-[26px] overflow-hidden shadow-[0_12px_35px_rgba(11,31,58,0.07)] border border-slate-200/80 bg-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&auto=format&fit=crop&q=80" 
                            alt="Exotic Island Beach" 
                            class="h-56 sm:h-64 w-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A]/90 via-[#0B1F3A]/30 to-transparent"></div>
                        <div class="absolute bottom-3.5 left-3.5 right-3.5">
                            <span class="text-[10px] uppercase tracking-wider font-bold bg-[#D4AF37] text-[#0B1F3A] px-2 py-0.5 rounded-md inline-block mb-1">Leisure Escape</span>
                            <h4 class="text-white font-bold text-xs sm:text-sm">Exotic Beach</h4>
                        </div>
                    </div>

                    <!-- Card 2: Bangkok Temples -->
                    <div class="relative group rounded-[26px] overflow-hidden shadow-[0_12px_35px_rgba(11,31,58,0.07)] border border-slate-200/80 bg-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1528181304800-259b08848526?w=800&auto=format&fit=crop&q=80" 
                            alt="Bangkok Temples" 
                            class="h-40 sm:h-48 w-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A]/90 via-[#0B1F3A]/30 to-transparent"></div>
                        <div class="absolute bottom-3.5 left-3.5 right-3.5">
                            <span class="text-[10px] uppercase tracking-wider font-bold bg-white/20 backdrop-blur-md text-white px-2 py-0.5 rounded-md inline-block mb-1">Cultural Discovery</span>
                            <h4 class="text-white font-bold text-xs sm:text-sm">Bangkok Temples</h4>
                        </div>
                    </div>
                </div>

                <!-- Right Column of Mosaic (Staggered Downwards) -->
                <div class="space-y-3.5 sm:space-y-5 pt-5 sm:pt-7">
                    <!-- Card 3: Dubai City -->
                    <div class="relative group rounded-[26px] overflow-hidden shadow-[0_12px_35px_rgba(11,31,58,0.07)] border border-slate-200/80 bg-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&auto=format&fit=crop&q=80" 
                            alt="Dubai City" 
                            class="h-40 sm:h-48 w-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A]/90 via-[#0B1F3A]/30 to-transparent"></div>
                        <div class="absolute bottom-3.5 left-3.5 right-3.5">
                            <span class="text-[10px] uppercase tracking-wider font-bold bg-white/20 backdrop-blur-md text-white px-2 py-0.5 rounded-md inline-block mb-1">Modern Wonder</span>
                            <h4 class="text-white font-bold text-xs sm:text-sm">Dubai City</h4>
                        </div>
                    </div>

                    <!-- Card 4: Bali Retreat -->
                    <div class="relative group rounded-[26px] overflow-hidden shadow-[0_12px_35px_rgba(11,31,58,0.07)] border border-slate-200/80 bg-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&auto=format&fit=crop&q=80" 
                            alt="Bali Retreat" 
                            class="h-56 sm:h-64 w-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A]/90 via-[#0B1F3A]/30 to-transparent"></div>
                        <div class="absolute bottom-3.5 left-3.5 right-3.5">
                            <span class="text-[10px] uppercase tracking-wider font-bold bg-[#D4AF37] text-[#0B1F3A] px-2 py-0.5 rounded-md inline-block mb-1">Tropical Serenity</span>
                            <h4 class="text-white font-bold text-xs sm:text-sm">Bali Retreat</h4>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Floating Verified Agency Badge -->
            <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur-xl px-4 sm:px-5 py-2.5 sm:py-3 rounded-2xl border border-slate-200/90 shadow-[0_10px_30px_rgba(11,31,58,0.12)] flex items-center gap-3 z-20 whitespace-nowrap">
                <div class="w-8 h-8 rounded-xl bg-[#D4AF37]/15 text-[#0B1F3A] flex items-center justify-center border border-[#D4AF37]/30">
                    <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-[#0B1F3A] block">100% Verified Agency</span>
                    <span class="text-[10px] text-slate-500 font-medium">IATA & Govt. Authorized Facilitator</span>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Values Section (Minimal Luxury Redesign) -->
<section class="py-20 md:py-28 bg-slate-50/70 border-y border-slate-200/80 relative overflow-hidden">
    <!-- Ambient Subtle Glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-[#D4AF37]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#D4AF37]/15 text-[#0B1F3A] uppercase tracking-widest mb-3 border border-[#D4AF37]/30">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span>The Emisha Standard • Our Core Values</span>
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold font-serif text-[#0B1F3A] tracking-tight leading-tight">
                Why Discerning Travelers Choose Us
            </h2>
            <p class="text-slate-600 text-sm md:text-base mt-3 leading-relaxed font-normal">
                Built upon absolute transparency, meticulous travel curation, and an uncompromising commitment to your peace of mind.
            </p>
        </div>

        <!-- 3-Column Values Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Value 1: Complete Transparency -->
            <div class="bg-white rounded-[28px] p-8 sm:p-9 border border-slate-200/80 shadow-[0_10px_35px_rgba(11,31,58,0.04)] hover:shadow-[0_22px_50px_rgba(11,31,58,0.09)] hover:-translate-y-1.5 transition-all duration-300 relative flex flex-col justify-between group overflow-hidden">
                
                <!-- Watermark Number -->
                <div class="absolute right-6 top-6 text-slate-100 font-serif font-black text-6xl select-none pointer-events-none group-hover:text-[#D4AF37]/10 transition-colors">
                    01
                </div>

                <div>
                    <!-- Icon Box -->
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#D4AF37]/20 to-[#D4AF37]/5 text-[#0B1F3A] flex items-center justify-center font-bold mb-6 border border-[#D4AF37]/30 shadow-xs group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-7 h-7 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>

                    <!-- Title & Summary -->
                    <h3 class="text-xl sm:text-2xl font-bold font-serif text-[#0B1F3A] mb-3">
                        Complete Transparency
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                        Zero hidden charges. Itemized quotes for visa fees, embassy submissions, hotel taxes, and flight luggage allowances upfront.
                    </p>
                </div>

                <!-- Feature Badges Checklist -->
                <div class="pt-5 border-t border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>100% Itemized Official Quotations</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>No Surprise Taxes or Embassy Markups</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Clear Refund & Cancellation Policies</span>
                    </div>
                </div>

                <!-- Bottom Glow Stripe on Hover -->
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#D4AF37] via-amber-300 to-[#D4AF37] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>

            <!-- Value 2: Tailored Itineraries -->
            <div class="bg-white rounded-[28px] p-8 sm:p-9 border border-slate-200/80 shadow-[0_10px_35px_rgba(11,31,58,0.04)] hover:shadow-[0_22px_50px_rgba(11,31,58,0.09)] hover:-translate-y-1.5 transition-all duration-300 relative flex flex-col justify-between group overflow-hidden">
                
                <!-- Watermark Number -->
                <div class="absolute right-6 top-6 text-slate-100 font-serif font-black text-6xl select-none pointer-events-none group-hover:text-[#D4AF37]/10 transition-colors">
                    02
                </div>

                <div>
                    <!-- Icon Box -->
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#D4AF37]/20 to-[#D4AF37]/5 text-[#0B1F3A] flex items-center justify-center font-bold mb-6 border border-[#D4AF37]/30 shadow-xs group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-7 h-7 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>

                    <!-- Title & Summary -->
                    <h3 class="text-xl sm:text-2xl font-bold font-serif text-[#0B1F3A] mb-3">
                        Tailored Itineraries
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                        No cookie-cutter trips. Every family vacation, honeymoon package, or executive trip is customized to your pace and interests.
                    </p>
                </div>

                <!-- Feature Badges Checklist -->
                <div class="pt-5 border-t border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Customized Daily Pace & Flight Routing</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Handpicked 4-Star & 5-Star Hotel Stays</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Private AC Transfers & Certified Guides</span>
                    </div>
                </div>

                <!-- Bottom Glow Stripe on Hover -->
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#D4AF37] via-amber-300 to-[#D4AF37] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>

            <!-- Value 3: 24/7 Dedicated Support -->
            <div class="bg-white rounded-[28px] p-8 sm:p-9 border border-slate-200/80 shadow-[0_10px_35px_rgba(11,31,58,0.04)] hover:shadow-[0_22px_50px_rgba(11,31,58,0.09)] hover:-translate-y-1.5 transition-all duration-300 relative flex flex-col justify-between group overflow-hidden">
                
                <!-- Watermark Number -->
                <div class="absolute right-6 top-6 text-slate-100 font-serif font-black text-6xl select-none pointer-events-none group-hover:text-[#D4AF37]/10 transition-colors">
                    03
                </div>

                <div>
                    <!-- Icon Box -->
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#D4AF37]/20 to-[#D4AF37]/5 text-[#0B1F3A] flex items-center justify-center font-bold mb-6 border border-[#D4AF37]/30 shadow-xs group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-7 h-7 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 0a5 5 0 010-7.072m0 0L5.636 5.636M3 3l18 18"/></svg>
                    </div>

                    <!-- Title & Summary -->
                    <h3 class="text-xl sm:text-2xl font-bold font-serif text-[#0B1F3A] mb-3">
                        24/7 Dedicated Support
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                        From your initial passport document check until you land safely back in Dhaka, our emergency helpline is always active.
                    </p>
                </div>

                <!-- Feature Badges Checklist -->
                <div class="pt-5 border-t border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Direct WhatsApp Concierge & Support</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Emergency Ticket Changes & Airport Assistance</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Active Monitoring Across Flight Schedules</span>
                    </div>
                </div>

                <!-- Bottom Glow Stripe on Hover -->
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#D4AF37] via-amber-300 to-[#D4AF37] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>

        </div>

        <!-- Trust Guarantee Strip -->
        <div class="mt-14 p-6 rounded-[22px] bg-white border border-slate-200/80 shadow-[0_8px_30px_rgba(11,31,58,0.03)] flex flex-col md:flex-row items-center justify-around gap-6 text-center md:text-left">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200/60 flex items-center justify-center flex-shrink-0 font-bold">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#0B1F3A]">Govt. Certified Travel Facilitator</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Licensed agency adhering to civil aviation & immigration standards.</p>
                </div>
            </div>

            <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200/60 flex items-center justify-center flex-shrink-0 font-bold">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#0B1F3A]">Best Value Price Match</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Competitive holiday packages without compromising luxury.</p>
                </div>
            </div>

            <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-200/60 flex items-center justify-center flex-shrink-0 font-bold">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#0B1F3A]">Dedicated Trip Concierge</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Assigned personal travel consultant for your journey.</p>
                </div>
            </div>
        </div>

    </div>
</section>



<!-- Testimonials Section (Minimal Luxury Redesign) -->
<section class="py-20 md:py-28 bg-gradient-to-b from-slate-50/70 via-white to-slate-50/70 border-b border-slate-200/80 relative overflow-hidden">
    <!-- Ambient Subtle Background Glow -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#D4AF37]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#0B1F3A_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-14">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#D4AF37]/15 text-[#0B1F3A] uppercase tracking-widest mb-3 border border-[#D4AF37]/30">
                    <svg class="w-3.5 h-3.5 text-[#D4AF37] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span>Client Trust & Stories</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-extrabold font-serif text-[#0B1F3A] tracking-tight leading-tight">
                    Loved By Over 10,000+ Explorers
                </h2>
                <p class="text-slate-600 text-sm md:text-base mt-2.5 font-normal leading-relaxed">
                    Authentic feedback from families, couples, and corporate travelers who trusted Emisha Tours & Travels for their international journeys, visa processing, and air ticketing.
                </p>
            </div>

            <!-- Google Rating & Trust Metric Badge -->
            <div class="inline-flex items-center gap-4 bg-white px-5 py-3 rounded-2xl border border-slate-200/90 shadow-sm flex-shrink-0 self-start lg:self-auto">
                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center font-black text-sm text-[#0B1F3A] shadow-inner">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <div class="flex items-center text-[#D4AF37]">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-xs font-extrabold text-[#0B1F3A]">4.9 / 5.0</span>
                    </div>
                    <span class="text-[11px] text-slate-500 font-medium">Google Verified Client Reviews</span>
                </div>
            </div>
        </div>

        <!-- Reviews Cards Grid -->
        @php
            $displayTestimonials = (isset($testimonials) && $testimonials->count() > 0) ? $testimonials : collect([
                (object)[
                    'customer_name' => 'Tanvir Ahmed',
                    'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80',
                    'destination' => 'Thailand Escape',
                    'service' => 'Tour Package',
                    'review' => 'Our 5-day Bangkok and Pattaya tour was flawlessly organized by Emisha Tours. From hotel transfers to dinner cruise tickets, everything was on time and stress-free. Highly recommended!',
                    'rating' => 5,
                    'source' => 'Google Review'
                ],
                (object)[
                    'customer_name' => 'Nusrat Jahan & Farhan',
                    'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
                    'destination' => 'Maldives Honeymoon',
                    'service' => 'Honeymoon Tour',
                    'review' => 'The overwater villa experience in the Maldives arranged by Emisha was pure magic! They took care of our speedboat transfers, candlelight dinner, and green taxes without any hidden costs.',
                    'rating' => 5,
                    'source' => 'Google Review'
                ],
                (object)[
                    'customer_name' => 'Dr. Kamrul Hasan',
                    'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
                    'destination' => 'Dubai, UAE',
                    'service' => 'Visa & Ticketing',
                    'review' => 'Got my Dubai e-Visa in just 48 hours and roundtrip Emirates tickets at an unbeatable corporate rate. Emisha’s visa consultancy team is professional, prompt, and trustworthy.',
                    'rating' => 5,
                    'source' => 'Google Review'
                ],
            ]);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            @foreach($displayTestimonials as $testimonial)
                <div class="bg-white rounded-[28px] p-7 sm:p-8 border border-slate-200/80 shadow-[0_10px_35px_rgba(11,31,58,0.04)] hover:shadow-[0_22px_50px_rgba(11,31,58,0.09)] hover:-translate-y-1.5 transition-all duration-300 relative flex flex-col justify-between group overflow-hidden">
                    
                    <!-- Decorative Background Watermark Quote -->
                    <div class="absolute right-5 top-5 text-[#D4AF37]/10 pointer-events-none group-hover:text-[#D4AF37]/15 transition-colors">
                        <svg class="w-16 h-16 fill-current" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    <div>
                        <!-- Top Row: Rating & Category Tag -->
                        <div class="flex items-center justify-between gap-3 mb-5">
                            <div class="flex items-center gap-1.5">
                                <div class="flex items-center text-[#D4AF37]">
                                    @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <span class="text-xs font-bold text-[#0B1F3A] bg-amber-50 text-amber-900 border border-amber-200/60 px-1.5 py-0.5 rounded">5.0</span>
                            </div>

                            @if(!empty($testimonial->destination) || !empty($testimonial->service))
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-50 text-[#0B1F3A] border border-slate-200">
                                {{ $testimonial->destination ?? $testimonial->service }}
                            </span>
                            @endif
                        </div>

                        <!-- Review Quote Text -->
                        <p class="text-slate-700 text-sm sm:text-[14px] leading-relaxed mb-6 font-normal relative z-10">
                            "{{ $testimonial->review ?? $testimonial->content ?? 'Great travel booking experience with Emisha Tours & Travels. Highly professional and seamless services.' }}"
                        </p>
                    </div>

                    <!-- Client Identity Card Footer -->
                    <div class="flex items-center justify-between pt-5 border-t border-slate-100 relative z-10">
                        <div class="flex items-center gap-3.5">
                            @if(!empty($testimonial->photo))
                                <img 
                                    src="{{ $testimonial->photo }}" 
                                    alt="{{ $testimonial->customer_name ?? $testimonial->name ?? 'Customer' }}" 
                                    class="w-11 h-11 rounded-full object-cover border-2 border-[#D4AF37]/60 shadow-sm"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-[#0B1F3A] to-[#163761] text-[#D4AF37] border-2 border-[#D4AF37]/50 flex items-center justify-center font-bold text-sm shadow-sm">
                                    {{ substr($testimonial->customer_name ?? $testimonial->name ?? 'T', 0, 1) }}
                                </div>
                            @endif

                            <div>
                                <h4 class="font-bold font-heading text-[#0B1F3A] text-sm leading-tight">
                                    {{ $testimonial->customer_name ?? $testimonial->name ?? 'Verified Client' }}
                                </h4>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <span class="text-[11px] text-slate-500 font-medium">Verified Traveler</span>
                                </div>
                            </div>
                        </div>

                        <!-- Source Badge -->
                        <span class="text-[10.5px] font-semibold text-slate-400 bg-slate-50 px-2 py-1 rounded-md border border-slate-200/60">
                            {{ $testimonial->source ?? 'Google' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Trust Highlights Strip -->
        <div class="mt-14 p-6 rounded-[22px] bg-white border border-slate-200/80 shadow-[0_8px_30px_rgba(11,31,58,0.03)] grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="border-r border-slate-100 last:border-0">
                <div class="text-2xl sm:text-3xl font-black font-heading text-[#0B1F3A]">10,000+</div>
                <div class="text-xs text-slate-500 mt-0.5 font-medium">Happy Travelers</div>
            </div>
            <div class="border-r border-slate-100 last:border-0">
                <div class="text-2xl sm:text-3xl font-black font-heading text-[#0B1F3A]">98.5%</div>
                <div class="text-xs text-slate-500 mt-0.5 font-medium">Visa Approval Rate</div>
            </div>
            <div class="border-r border-slate-100 last:border-0">
                <div class="text-2xl sm:text-3xl font-black font-heading text-[#0B1F3A]">4.9 / 5.0</div>
                <div class="text-xs text-slate-500 mt-0.5 font-medium">Client Satisfaction</div>
            </div>
            <div>
                <div class="text-2xl sm:text-3xl font-black font-heading text-[#0B1F3A]">24/7</div>
                <div class="text-xs text-slate-500 mt-0.5 font-medium">Emergency Assistance</div>
            </div>
        </div>

    </div>
</section>

<!-- Call to Action Banner -->
<div class="bg-[#0B1F3A] py-16 md:py-20 text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h2 class="text-2xl md:text-4xl font-bold font-heading mb-4 text-white">Ready to Start Planning Your Next Adventure?</h2>
        <p class="text-slate-300 text-sm md:text-base max-w-xl mx-auto mb-8 font-normal leading-relaxed">
            Contact our travel desk today for customized holiday packages, group airfares, and expert visa solutions.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('tours.index') }}" class="btn btn-gold px-8 py-3.5 shadow-lg text-xs uppercase tracking-wider font-bold rounded-xl">
                <span>Explore Packages</span>
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-white px-8 py-3.5 text-xs uppercase tracking-wider font-bold rounded-xl">
                <span>Contact Office</span>
            </a>
        </div>
    </div>
</div>
@endsection


