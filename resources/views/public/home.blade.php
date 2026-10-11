@extends('layouts.app')

@section('title', app()->getLocale() === 'bn' ? 'এমিসা ট্যুরস অ্যান্ড ট্রাভেলস — প্রিমিয়াম ট্রাভেল এজেন্সি, ভিসা ও এয়ার টিকেটিং' : 'Emisha Tours & Travels — Premium Travel Agency, Visa Assistance & Air Ticketing')
@section('meta_description', app()->getLocale() === 'bn' ? 'আন্তর্জাতিক ট্যুর প্যাকেজ, থাইল্যান্ড, মালয়েশিয়া, দুবাই, সিঙ্গাপুরের সার্টিফাইড ভিসা কনসালটেন্সি এবং এয়ার টিকিট বুকিং।' : 'Discover curated international tour packages, certified visa consultancy for Thailand, Malaysia, Dubai, Singapore, and worldwide flight booking.')

@section('schema')
    {!! $schema !!}
@endsection

@section('content')
<!-- =========================================================================
     01. HERO PANORAMIC SECTION (Modern Minimal Luxury + Greeting & Search)
     ========================================================================= -->
<section class="relative bg-[#0B1F3A] text-white py-10 sm:py-14 md:py-16 lg:py-20 min-h-[auto] md:min-h-[580px] lg:min-h-[660px] flex items-center overflow-hidden">
    <!-- Background Cinematic Image with Luxury Aviation Navy Gradient Overlay -->
    <div class="absolute inset-0 z-0">
        <img 
            src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=85" 
            alt="Cinematic tropical beach paradise" 
            class="w-full h-full object-cover object-center opacity-35 transform scale-105 transition-transform duration-1000 ease-out"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-[#071527]/95 via-[#0B1F3A]/85 to-[#071527]/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A] via-transparent to-transparent"></div>
    </div>

    <div class="container-custom relative z-10 w-full">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Greeting & Eyebrow Pill (Mobile-Optimized + Dynamic Client Time) -->
            <div 
                x-data="{ 
                    greetingEn: 'Welcome',
                    greetingBn: 'স্বাগতম',
                    isBn: {{ app()->getLocale() === 'bn' ? 'true' : 'false' }},
                    init() {
                        const hour = new Date().getHours();
                        if (hour >= 5 && hour < 12) {
                            this.greetingEn = 'Good Morning';
                            this.greetingBn = 'শুভ সকাল';
                        } else if (hour >= 12 && hour < 17) {
                            this.greetingEn = 'Good Afternoon';
                            this.greetingBn = 'শুভ দুপুর';
                        } else if (hour >= 17 && hour < 21) {
                            this.greetingEn = 'Good Evening';
                            this.greetingBn = 'শুভ সন্ধ্যা';
                        } else {
                            this.greetingEn = 'Welcome';
                            this.greetingBn = 'স্বাগতম';
                        }
                    }
                }"
                class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-[#D4AF37]/40 text-[#D4AF37] text-[11px] sm:text-xs font-semibold uppercase tracking-wider mb-4 sm:mb-5 shadow-sm max-w-full"
            >
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse flex-shrink-0"></span>
                <span class="whitespace-nowrap flex items-center gap-1">
                    <span x-text="isBn ? greetingBn : greetingEn">Good Morning</span>! 
                    <span class="hidden xs:inline">{{ app()->getLocale() === 'bn' ? 'এমিসা ট্যুরস অ্যান্ড ট্রাভেলস-এ' : 'Welcome to' }}</span>
                    <span class="font-bold">{{ app()->getLocale() === 'bn' ? 'স্বাগতম' : 'Emisha Tours & Travels' }}</span>
                </span>
            </div>

            <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.2] sm:leading-[1.15] mb-3 sm:mb-5 font-heading">
                <span class="text-white block">{{ app()->getLocale() === 'bn' ? 'বিশ্বকে ঘুরে দেখুন।' : 'Explore the World.' }}</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] via-[#F3E5AB] to-[#D4AF37]">
                    {{ app()->getLocale() === 'bn' ? 'ভ্রমণ করুন নির্ভরতার সাথে।' : 'Travel With Confidence.' }}
                </span>
            </h1>

            <p class="text-xs sm:text-sm md:text-base text-white/90 max-w-2xl mx-auto leading-relaxed mb-6 sm:mb-8 font-normal">
                {{ app()->getLocale() === 'bn' ? 'আন্তর্জাতিক ছুটির প্যাকেজ, সার্টিফাইড ভিসা কনসালটেন্সি এবং সেরা এয়ার টিকেটিং সেবা।' : 'Curated international tour packages, certified visa consultancy, and global air ticketing solutions tailored for Bangladeshi travelers.' }}
            </p>

            <!-- Interactive Search Box -->
            <div class="w-full max-w-4xl mx-auto text-left">
                <div class="w-full bg-white/95 backdrop-blur-2xl rounded-2xl sm:rounded-[24px] md:rounded-[26px] p-3.5 sm:p-5 md:p-6 shadow-[0_20px_50px_-10px_rgba(7,21,39,0.25)] sm:shadow-[0_25px_60px_-15px_rgba(7,21,39,0.35)] border border-white/80 ring-1 ring-black/5">
                    <form action="{{ route('tours.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-2.5 sm:gap-3.5 items-end">
                        <div class="md:col-span-6 relative">
                            <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ app()->getLocale() === 'bn' ? 'কোথায় যেতে চান?' : 'Where to?' }}</span>
                            </label>
                            <div class="bg-slate-50/90 border border-slate-200/80 rounded-xl">
                                <input 
                                    type="text" 
                                    name="search" 
                                    placeholder="{{ app()->getLocale() === 'bn' ? 'গন্তব্যের নাম লিখুন (যেমন: থাইল্যান্ড, মালদ্বীপ, দুবাই)' : 'Where do you want to go? (e.g. Thailand, Maldives, Dubai)' }}" 
                                    class="w-full pl-3.5 pr-4 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] placeholder-slate-400"
                                >
                            </div>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <span>{{ app()->getLocale() === 'bn' ? 'ট্যুর ক্যাটাগরি' : 'Tour Style' }}</span>
                            </label>
                            <div class="bg-slate-50/90 border border-slate-200/80 rounded-xl">
                                <select name="category" class="w-full pl-3.5 pr-4 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] cursor-pointer">
                                    <option value="">{{ app()->getLocale() === 'bn' ? 'সকল ক্যাটাগরি' : 'All Categories' }}</option>
                                    <option value="international-packages">{{ app()->getLocale() === 'bn' ? 'আন্তর্জাতিক ট্যুর' : 'International Tours' }}</option>
                                    <option value="domestic-holidays">{{ app()->getLocale() === 'bn' ? 'অভ্যন্তরীণ ভ্রমণ' : 'Domestic Holidays' }}</option>
                                    <option value="honeymoon-specials">{{ app()->getLocale() === 'bn' ? 'হানিমুন স্পেশাল' : 'Honeymoon Specials' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:col-span-3">
                            <button type="submit" class="w-full btn btn-gold btn-md h-[42px] sm:h-[44px] rounded-xl font-bold shadow-md flex items-center justify-center gap-2 text-xs sm:text-sm">
                                <span>{{ app()->getLocale() === 'bn' ? 'প্যাকেজ খুঁজুন' : 'Search Packages' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                    <div class="mt-3.5 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-1.5 sm:gap-2 text-[10.5px] sm:text-[11px] text-slate-500">
                        <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                            <span class="font-bold text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'জনপ্রিয়:' : 'Popular:' }}</span>
                            <a href="{{ route('tours.index', ['destination' => 'thailand']) }}" class="text-slate-600 hover:text-[#D4AF37] font-medium">{{ app()->getLocale() === 'bn' ? 'থাইল্যান্ড' : 'Thailand' }}</a>
                            <span class="text-slate-300">•</span>
                            <a href="{{ route('tours.index', ['destination' => 'maldives']) }}" class="text-slate-600 hover:text-[#D4AF37] font-medium">{{ app()->getLocale() === 'bn' ? 'মালদ্বীপ' : 'Maldives' }}</a>
                            <span class="text-slate-300">•</span>
                            <a href="{{ route('tours.index', ['destination' => 'dubai']) }}" class="text-slate-600 hover:text-[#D4AF37] font-medium">{{ app()->getLocale() === 'bn' ? 'দুবাই' : 'Dubai' }}</a>
                            <span class="text-slate-300">•</span>
                            <a href="{{ route('tours.index', ['destination' => 'malaysia']) }}" class="text-slate-600 hover:text-[#D4AF37] font-medium">{{ app()->getLocale() === 'bn' ? 'মালয়েশিয়া' : 'Malaysia' }}</a>
                            <span class="text-slate-300">•</span>
                            <a href="{{ route('tours.index', ['destination' => 'coxs-bazar']) }}" class="text-slate-600 hover:text-[#D4AF37] font-medium">{{ app()->getLocale() === 'bn' ? 'কক্সবাজার' : "Cox's Bazar" }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Highlights Under Search Bar -->
            <div class="mt-6 sm:mt-8 flex flex-wrap items-center justify-center gap-3 sm:gap-6 md:gap-8 text-[11px] sm:text-xs text-white/90 font-medium">
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'যাচাইকৃত হোটেল রেট' : 'Verified Hotel Rates' }}</span>
                </div>
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'সার্টিফাইড ভিসা ডেস্ক' : 'Certified Visa Desk' }}</span>
                </div>
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? '২৪/৭ সাপোর্ট হেল্পলাইন' : '24/7 Helpline Support' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     02. PROMOTIONAL HIGHLIGHT BANNERS (3 Luxury Deal Cards)
     ========================================================================= -->
<section class="py-8 bg-white border-b border-slate-100">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Promo 1: Tour Deal -->
            <div class="relative overflow-hidden rounded-[20px] bg-gradient-to-br from-[#0B1F3A] to-[#163660] text-white p-6 shadow-[0_8px_24px_rgba(11,31,58,0.08)] flex flex-col justify-between group">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-[#D4AF37]/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[10px] font-extrabold uppercase tracking-wider mb-3">
                        <span>{{ app()->getLocale() === 'bn' ? 'সীমিত অফার' : 'Limited Offer' }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">
                        {{ app()->getLocale() === 'bn' ? 'হলিডে স্পেশাল ডিল' : 'Holiday Special Deals' }}
                    </h3>
                    <p class="text-xs text-slate-200 leading-relaxed mb-4">
                        {{ app()->getLocale() === 'bn' ? 'ব্যাংকক, ফুকেট ও মালদ্বীপে ১৫% পর্যন্ত বিশেষ ছাড় উপভোগ করুন।' : 'Save up to 15% on curated Bangkok, Phuket & Maldives holiday packages.' }}
                    </p>
                </div>
                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-[#D4AF37]">{{ app()->getLocale() === 'bn' ? 'শুরু ৳ ৩২,৫০০ থেকে' : 'From ৳ 32,500' }}</span>
                    <a href="{{ route('tours.index') }}" class="btn btn-outline-white btn-xs rounded-full">
                        <span>{{ app()->getLocale() === 'bn' ? 'অফার দেখুন' : 'View Deals' }}</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Promo 2: Visa Support -->
            <div class="relative overflow-hidden rounded-[20px] bg-gradient-to-br from-[#073B3A] to-[#0B5250] text-white p-6 shadow-[0_8px_24px_rgba(7,59,58,0.08)] flex flex-col justify-between group">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-400/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-400 text-[#073B3A] text-[10px] font-extrabold uppercase tracking-wider mb-3">
                        <span>{{ app()->getLocale() === 'bn' ? 'উচ্চ সফলতা' : 'High Approval' }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">
                        {{ app()->getLocale() === 'bn' ? 'ফাস্ট-ট্র্যাক ভিসা সহায়তা' : 'Fast-Track Visa Assistance' }}
                    </h3>
                    <p class="text-xs text-slate-200 leading-relaxed mb-4">
                        {{ app()->getLocale() === 'bn' ? 'থাইল্যান্ড, ইউএই ও শেঞ্জেনের জন্য নির্ভুল ফাইল ও ব্যাংক সলভেন্সি যাচাই।' : 'Expert documentation & bank solvency review for Thailand, UAE, & Schengen.' }}
                    </p>
                </div>
                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-emerald-300">{{ app()->getLocale() === 'bn' ? '৫-৭ কার্যদিবস' : '5-7 Days Turnaround' }}</span>
                    <a href="{{ route('visa.index') }}" class="btn btn-outline-white btn-xs rounded-full">
                        <span>{{ app()->getLocale() === 'bn' ? 'ভিসা আবেদন' : 'Apply Visa' }}</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Promo 3: Air Ticketing -->
            <div class="relative overflow-hidden rounded-[20px] bg-gradient-to-br from-[#1E293B] to-[#0F172A] text-white p-6 shadow-[0_8px_24px_rgba(30,41,59,0.08)] flex flex-col justify-between group">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-[#D4AF37]/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[10px] font-extrabold uppercase tracking-wider mb-3">
                        <span>{{ app()->getLocale() === 'bn' ? 'জিডিএস এয়ারফেয়ার' : 'GDS Airfares' }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">
                        {{ app()->getLocale() === 'bn' ? 'সেরা ফ্লাইট কোটেশন' : 'Best Air Ticket Quotations' }}
                    </h3>
                    <p class="text-xs text-slate-200 leading-relaxed mb-4">
                        {{ app()->getLocale() === 'bn' ? 'সরাসরি এয়ারলাইন বুকিং, ২৪/৭ তারিখ পরিবর্তন ও রি-ইস্যু সাপোর্ট।' : 'Direct airline booking with 24/7 date changes & flexible reissue assistance.' }}
                    </p>
                </div>
                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-[#D4AF37]">{{ app()->getLocale() === 'bn' ? 'তাৎক্ষণিক কোটেশন' : 'Instant Quotes' }}</span>
                    <a href="{{ route('ticketing.index') }}" class="btn btn-outline-white btn-xs rounded-full">
                        <span>{{ app()->getLocale() === 'bn' ? 'কোটেশন চান' : 'Request Quote' }}</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     03. BEST TOUR DEALS (Modern Clean Grid with Category Pills)
     ========================================================================= -->
<section class="section-padding bg-[#F8FAFC]">
    <div class="container-custom">
        <!-- Section Header with Subtitle & View All Button -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
            <div>
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                    <span>{{ app()->getLocale() === 'bn' ? 'সেরা ট্যুর অফার' : 'Best Tour Deals' }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-[#0B1F3A] mb-1">
                    {{ app()->getLocale() === 'bn' ? 'জনপ্রিয় ছুটির প্যাকেজ' : 'Featured Holiday Packages' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500">
                    {{ app()->getLocale() === 'bn' ? 'হোটেল ও গাইডেড ট্রান্সফার সহ বাছাইকৃত আন্তর্জাতিক ও অভ্যন্তরীণ ভ্রমণ প্যাকেজ।' : 'Handpicked international and domestic itineraries with certified hotels & guided transfers.' }}
                </p>
            </div>
            <a href="{{ route('tours.index') }}" class="mt-4 md:mt-0 btn btn-outline btn-sm rounded-full">
                <span>{{ app()->getLocale() === 'bn' ? 'সকল প্যাকেজ দেখুন' : 'View All Packages' }}</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Tour Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse($featuredTours as $tour)
                <x-tour-card :tour="$tour" />
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500 card-base p-10 bg-white">
                    {{ app()->getLocale() === 'bn' ? 'এই মুহূর্তে কোনো প্যাকেজ পাওয়া যায়নি।' : 'No tour packages available at this moment.' }}
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- =========================================================================
     04. TOP DESTINATIONS (Bento / Modern Masonry Grid)
     ========================================================================= -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-2">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                <span>{{ app()->getLocale() === 'bn' ? 'আপনার ভ্রমণ' : 'Your Trips' }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-[#0B1F3A] mb-2">
                {{ app()->getLocale() === 'bn' ? 'জনপ্রিয় পর্যটন গন্তব্যসমূহ' : 'Popular Tourist Destinations' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                {{ app()->getLocale() === 'bn' ? 'বিশ্বের দর্শনীয় স্থান, ট্রপিক্যাল সমুদ্র সৈকত ও মনকাড়া পর্যটন কেন্দ্র।' : 'Discover iconic world landmarks, tropical escapes, and cultural hubs loved by Bangladeshi travelers.' }}
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularDestinations as $dest)
                <x-destination-card :destination="$dest" />
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('destinations.index') }}" class="btn btn-outline btn-sm rounded-full py-2.5 px-6 text-xs font-bold">
                <span>{{ app()->getLocale() === 'bn' ? 'সকল গন্তব্য দেখুন' : 'Explore All Destinations' }}</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- =========================================================================
     05. VISA PROCESSING & CONSULTANCY (Light Tinted Luxury Container Grid)
     ========================================================================= -->
<section class="section-padding bg-gradient-to-b from-[#F8FAFC] via-[#F1F5F9]/60 to-[#F8FAFC] border-y border-slate-200/60 relative overflow-hidden">
    <div class="container-custom relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 sm:mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0B1F3A]/5 border border-[#0B1F3A]/10 text-xs font-bold uppercase tracking-wider text-[#0B1F3A] mb-2.5">
                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'ভিসা প্রসেসিং ও কনসালটেন্সি' : 'Visa Processing & Consultancy' }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-serif text-[#0B1F3A] mb-1.5">
                    {{ app()->getLocale() === 'bn' ? 'ঝামেলামুক্ত ভিসা প্রসেসিং' : 'Hassle-Free Visa Assistance' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 max-w-xl">
                    {{ app()->getLocale() === 'bn' ? 'অফিসিয়াল দূতাবাস চেকলিস্ট যাচাই, নির্ভুল ফাইল প্রস্তুত এবং সর্বোচ্চ সাফল্যের অনলাইন ই-ভিসা সাপোর্ট।' : 'Official embassy checklist inspection, document review, and online e-visa application support with verified high success rates.' }}
                </p>
            </div>
            <a href="{{ route('visa.index') }}" class="mt-4 md:mt-0 btn btn-outline btn-sm rounded-full self-start md:self-auto shadow-2xs">
                <span>{{ app()->getLocale() === 'bn' ? 'সকল দেশ দেখুন' : 'View All Countries' }}</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @foreach($featuredVisaCountries as $country)
                <x-visa-card :country="$country" />
            @endforeach
        </div>
    </div>
</section>

<!-- =========================================================================
     06. TRAVEL SPECIALIST CONSULTATION & INSTANT ASSISTANCE
     ========================================================================= -->
<section class="py-16 sm:py-24 bg-gradient-to-b from-white via-slate-50/50 to-white relative overflow-hidden">
    <div class="absolute top-1/4 -left-20 w-80 h-80 bg-[#D4AF37]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-[#0B1F3A]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-custom relative z-10">
        <div class="rounded-[32px] bg-[#0B1F3A] text-white shadow-[0_25px_60px_rgba(11,31,58,0.25)] border border-white/10 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-radial from-[#D4AF37]/15 to-transparent blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center p-7 sm:p-10 lg:p-14 relative z-10">
                <!-- Left Column -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="relative rounded-[24px] overflow-hidden border border-white/15 shadow-xl group bg-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80" 
                            alt="Travel Specialist Consultation" 
                            class="w-full h-72 sm:h-80 object-cover group-hover:scale-105 transition-transform duration-700 opacity-90"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A] via-[#0B1F3A]/30 to-transparent"></div>
                        
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-[#D4AF37] text-[11px] font-bold uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-ping"></span>
                                <span>{{ app()->getLocale() === 'bn' ? 'বিশেষজ্ঞ ট্রাভেল কনসালটেন্সি' : 'Travel Specialist Consultation' }}</span>
                            </span>
                        </div>

                        <div class="absolute bottom-4 left-4 right-4 bg-white/10 backdrop-blur-xl border border-white/20 p-4 rounded-2xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#D4AF37]/20 border border-[#D4AF37]/40 text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-white tracking-tight">{{ app()->getLocale() === 'bn' ? 'নিবেদিত ট্রিপ প্ল্যানার' : 'Dedicated Trip Planner' }}</h4>
                                    <p class="text-[11px] text-white/80 mt-0.5 leading-snug">{{ app()->getLocale() === 'bn' ? 'আপনার পরিবারের জন্য নির্ভরযোগ্য গ্রাউন্ড সাপোর্ট ও কাস্টমাইজড সেবা।' : 'Expert ground assistance & personalized support for your family.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10 backdrop-blur-md flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="text-[10px] text-white/50 uppercase font-bold tracking-wider block">{{ app()->getLocale() === 'bn' ? 'সরাসরি ডেস্ক' : 'Direct Desk' }}</span>
                                <span class="text-xs font-bold text-white">{{ App\Models\Setting::get('contact_phone', '+880 1805-464291') }}</span>
                            </div>
                        </div>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা ট্যুরস, আমার ট্যুর ও ভিসা পরামর্শ প্রয়োজন।' : 'Hello Emisha Tours, I need assistance with tour and visa.') }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-[#D4AF37] hover:text-[#0B1F3A] text-white text-[11px] font-bold transition-all border border-white/15">
                            {{ app()->getLocale() === 'bn' ? 'হোয়াটসঅ্যাপ ২৪/৭' : 'WhatsApp 24/7' }}
                        </a>
                    </div>
                </div>

                <!-- Right Column: Interactive Consultation Form -->
                <div class="lg:col-span-7">
                    <div class="max-w-xl lg:pl-2">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#D4AF37]/15 border border-[#D4AF37]/30 text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3.5 backdrop-blur-md">
                            <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                            <span>{{ app()->getLocale() === 'bn' ? 'তাৎক্ষণিক সহায়তা' : 'Instant Assistance' }}</span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-serif text-white tracking-tight leading-tight mb-2.5">
                            {{ app()->getLocale() === 'bn' ? 'ট্যুর বা ভিসা সংক্রান্ত যেকোনো তথ্যের প্রয়োজন?' : 'Need any support for tour and visa?' }}
                        </h3>
                        
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-7">
                            {{ app()->getLocale() === 'bn' ? 'আপনার ভ্রমণের বিবরণ জমা দিন। আমাদের কনসালটেন্ট দ্রুত আপনার সাথে যোগাযোগ করবেন।' : 'Send us your travel request. Our specialists will call you back within 30 minutes with customized itineraries and visa guidelines.' }}
                        </p>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="subject" value="Quick Travel & Visa Consultation Request">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label class="block text-[10.5px] uppercase tracking-wider font-bold text-white/60 mb-1.5">{{ app()->getLocale() === 'bn' ? 'আপনার পূর্ণ নাম *' : 'Your Full Name *' }}</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        required 
                                        placeholder="{{ app()->getLocale() === 'bn' ? 'যেমন: তানভীর আহমেদ' : 'e.g. Tanvir Ahmed' }}" 
                                        class="w-full bg-white/[0.07] hover:bg-white/[0.10] text-white placeholder-white/40 border border-white/15 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-[#D4AF37] focus:bg-white/[0.12] focus:ring-1 focus:ring-[#D4AF37] transition-all"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10.5px] uppercase tracking-wider font-bold text-white/60 mb-1.5">{{ app()->getLocale() === 'bn' ? 'মোবাইল / হোয়াটসঅ্যাপ নম্বর *' : 'Mobile / WhatsApp Number *' }}</label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        required 
                                        placeholder="+880 1700-000000" 
                                        class="w-full bg-white/[0.07] hover:bg-white/[0.10] text-white placeholder-white/40 border border-white/15 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-[#D4AF37] focus:bg-white/[0.12] focus:ring-1 focus:ring-[#D4AF37] transition-all"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10.5px] uppercase tracking-wider font-bold text-white/60 mb-1.5">{{ app()->getLocale() === 'bn' ? 'ইমেইল অ্যাড্রেস (ঐচ্ছিক)' : 'Email Address (Optional)' }}</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="tanvir@example.com" 
                                        class="w-full bg-white/[0.07] hover:bg-white/[0.10] text-white placeholder-white/40 border border-white/15 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-[#D4AF37] focus:bg-white/[0.12] focus:ring-1 focus:ring-[#D4AF37] transition-all"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10.5px] uppercase tracking-wider font-bold text-white/60 mb-1.5">{{ app()->getLocale() === 'bn' ? 'গন্তব্য ও সম্ভাব্য তারিখ *' : 'Destination & Preferred Date *' }}</label>
                                    <input 
                                        type="text" 
                                        name="message" 
                                        required 
                                        placeholder="{{ app()->getLocale() === 'bn' ? 'যেমন: অক্টোবরে থাইল্যান্ড ৩ জন' : 'e.g. Thailand in October (3 Persons)' }}" 
                                        class="w-full bg-white/[0.07] hover:bg-white/[0.10] text-white placeholder-white/40 border border-white/15 rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-[#D4AF37] focus:bg-white/[0.12] focus:ring-1 focus:ring-[#D4AF37] transition-all"
                                    >
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-3">
                                <button type="submit" class="btn btn-gold px-7 py-3.5 text-xs uppercase tracking-wider font-bold rounded-xl shadow-lg flex items-center justify-center gap-2 group">
                                    <span>{{ app()->getLocale() === 'bn' ? 'অনুরোধ জমা দিন' : 'Send Inquiry Request' }}</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                                
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা ট্যুরস, আমার ট্যুর ও ভিসা পরামর্শ প্রয়োজন।' : 'Hello Emisha Tours, I need assistance with tour and visa.') }}" target="_blank" class="px-6 py-3.5 rounded-xl bg-emerald-600/90 hover:bg-emerald-600 text-white text-xs uppercase tracking-wider font-bold transition-all shadow-md flex items-center justify-center gap-2 border border-emerald-500/30">
                                    <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                    <span>{{ app()->getLocale() === 'bn' ? 'হোয়াটসঅ্যাপে চ্যাট' : 'Chat on WhatsApp' }}</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 Minimal Luxury Trust Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-[24px] p-6 sm:p-7 border border-slate-200/80 shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-[0_15px_35px_rgba(11,31,58,0.08)] hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold font-serif text-base text-[#0B1F3A] mb-1 group-hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? '২৪/৭ সাপোর্ট হেল্পলাইন' : '24/7 Helpline Support' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">{{ app()->getLocale() === 'bn' ? 'পুরো ভ্রমণ জুড়ে আপনার সাথে সার্বক্ষণিক ট্রিপ ম্যানেজার।' : 'Dedicated trip manager on WhatsApp & direct phone throughout your journey.' }}</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#D4AF37] to-amber-300 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>

            <div class="bg-white rounded-[24px] p-6 sm:p-7 border border-slate-200/80 shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-[0_15px_35px_rgba(11,31,58,0.08)] hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold font-serif text-base text-[#0B1F3A] mb-1 group-hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? 'সার্টিফাইড ভিসা ডেস্ক' : 'Certified Visa Desk' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">{{ app()->getLocale() === 'bn' ? 'শতভাগ দূতাবাস স্ট্যান্ডার্ড পেপারওয়ার্ক ও সলভেন্সি অডিট।' : '100% Embassy compliant paperwork, trade license & bank solvency inspection.' }}</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#D4AF37] to-amber-300 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>

            <div class="bg-white rounded-[24px] p-6 sm:p-7 border border-slate-200/80 shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-[0_15px_35px_rgba(11,31,58,0.08)] hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold font-serif text-base text-[#0B1F3A] mb-1 group-hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? 'সেরা মূল্যের নিশ্চয়তা' : 'Best Price Guarantee' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-normal">{{ app()->getLocale() === 'bn' ? 'সরাসরি এয়ারলাইন ও হোটেল পার্টনার চুক্তি, কোনো গোপন খরচ নেই।' : 'Direct hotel & airline partner contracts with no hidden markups or surcharges.' }}</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#D4AF37] to-amber-300 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     07. WHY CHOOSE US
     ========================================================================= -->
<section class="py-20 lg:py-28 bg-gradient-to-b from-white via-slate-50/70 to-slate-100/50 relative overflow-hidden">
    <div class="container-custom relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-14 lg:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-[#D4AF37]/30 shadow-xs text-xs font-bold uppercase tracking-widest text-[#B89628] mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span>{{ app()->getLocale() === 'bn' ? 'কেন এমিসা ট্যুরস' : 'Why Emisha Tours' }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-serif text-[#0B1F3A] tracking-tight mb-3">
                {{ app()->getLocale() === 'bn' ? 'আস্থা, স্বচ্ছতা এবং আভিজাত্যের নিশ্চয়তা' : 'Built on Trust, Transparency & Excellence' }}
            </h2>
            <p class="text-sm sm:text-base text-slate-500 leading-relaxed max-w-xl mx-auto font-normal">
                {{ app()->getLocale() === 'bn' ? 'ভিসা, ফ্লাইট ও ট্যুর প্ল্যানিংয়ের প্রতিটি ধাপে নিখুঁত ব্যবস্থাপনার মাধ্যমে আপনার ভ্রমণকে করি নির্বিঘ্ন।' : 'We take away the friction of travel planning, ensuring your visa, flights, and tours are handled with meticulous detail.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- 01 -->
            <div class="group relative bg-white/90 backdrop-blur-xs rounded-2xl p-7 border border-slate-200/80 hover:border-[#D4AF37]/50 shadow-[0_4px_20px_-4px_rgba(11,31,58,0.04)] hover:shadow-[0_20px_35px_-10px_rgba(212,175,55,0.15)] transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100/70 border border-amber-200/60 text-[#D4AF37] flex items-center justify-center shadow-xs group-hover:scale-110 group-hover:bg-[#0B1F3A] group-hover:text-[#D4AF37] group-hover:border-[#0B1F3A] transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold font-serif text-slate-200 group-hover:text-[#D4AF37]/50 transition-colors">01</span>
                    </div>

                    <h3 class="font-bold text-base sm:text-lg text-[#0B1F3A] mb-2 group-hover:text-[#0B1F3A] transition-colors">
                        {{ app()->getLocale() === 'bn' ? 'সর্বোচ্চ ভিসা সফলতা' : 'High Visa Success' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6">
                        {{ app()->getLocale() === 'bn' ? 'দূতাবাসে জমা দেওয়ার আগে ব্যাংক স্টেটমেন্ট ও এনওসি-র নির্ভুল অডিট।' : 'Rigorous pre-submission inspection of bank statements, employment NOCs, and invites.' }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100/80 flex items-center gap-1.5 text-[11px] font-semibold text-amber-700 bg-amber-50/50 -mx-3 -mb-3 px-3 py-2 rounded-xl">
                    <svg class="w-3.5 h-3.5 text-amber-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'যাচাইকৃত প্রি-অডিট চেক' : 'Meticulous Pre-Audit Check' }}</span>
                </div>
            </div>

            <!-- 02 -->
            <div class="group relative bg-white/90 backdrop-blur-xs rounded-2xl p-7 border border-slate-200/80 hover:border-blue-500/40 shadow-[0_4px_20px_-4px_rgba(11,31,58,0.04)] hover:shadow-[0_20px_35px_-10px_rgba(59,130,246,0.15)] transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100/70 border border-blue-200/60 text-blue-600 flex items-center justify-center shadow-xs group-hover:scale-110 group-hover:bg-[#0B1F3A] group-hover:text-blue-400 group-hover:border-[#0B1F3A] transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold font-serif text-slate-200 group-hover:text-blue-400/50 transition-colors">02</span>
                    </div>

                    <h3 class="font-bold text-base sm:text-lg text-[#0B1F3A] mb-2 group-hover:text-[#0B1F3A] transition-colors">
                        {{ app()->getLocale() === 'bn' ? '৪/৫-স্টার হোটেল নিশ্চয়তা' : 'Verified 4/5-Star Hotels' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6">
                        {{ app()->getLocale() === 'bn' ? 'সেন্ট্রাল লোকেশন, নিরাপত্তা ও হালাল খাবার নিশ্চিতকরণ।' : 'Direct partner hotel contracts ensuring central locations, safety, and halal meal options.' }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100/80 flex items-center gap-1.5 text-[11px] font-semibold text-blue-700 bg-blue-50/50 -mx-3 -mb-3 px-3 py-2 rounded-xl">
                    <svg class="w-3.5 h-3.5 text-blue-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'নিরাপদ ও হালাল আবাসন' : 'Central & Halal Assured Stays' }}</span>
                </div>
            </div>

            <!-- 03 -->
            <div class="group relative bg-white/90 backdrop-blur-xs rounded-2xl p-7 border border-slate-200/80 hover:border-emerald-500/40 shadow-[0_4px_20px_-4px_rgba(11,31,58,0.04)] hover:shadow-[0_20px_35px_-10px_rgba(16,185,129,0.15)] transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100/70 border border-emerald-200/60 text-emerald-600 flex items-center justify-center shadow-xs group-hover:scale-110 group-hover:bg-[#0B1F3A] group-hover:text-emerald-400 group-hover:border-[#0B1F3A] transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold font-serif text-slate-200 group-hover:text-emerald-400/50 transition-colors">03</span>
                    </div>

                    <h3 class="font-bold text-base sm:text-lg text-[#0B1F3A] mb-2 group-hover:text-[#0B1F3A] transition-colors">
                        {{ app()->getLocale() === 'bn' ? 'স্বচ্ছ প্যাকেজ বিবরণ' : 'Transparent Inclusions' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6">
                        {{ app()->getLocale() === 'bn' ? 'সকল ট্রান্সফার, ট্যাক্স ও এন্ট্রি টিকিট পূর্বে সুস্পষ্টভাবে উল্লেখ থাকে।' : 'All airport transfers, taxes, entry tickets, and guides are clearly stated with zero hidden fees.' }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100/80 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700 bg-emerald-50/50 -mx-3 -mb-3 px-3 py-2 rounded-xl">
                    <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'গোপন খরচহীন নিশ্চয়তা' : 'Zero Hidden Fees Guarantee' }}</span>
                </div>
            </div>

            <!-- 04 -->
            <div class="group relative bg-white/90 backdrop-blur-xs rounded-2xl p-7 border border-slate-200/80 hover:border-purple-500/40 shadow-[0_4px_20px_-4px_rgba(11,31,58,0.04)] hover:shadow-[0_20px_35px_-10px_rgba(168,85,247,0.15)] transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100/70 border border-purple-200/60 text-purple-600 flex items-center justify-center shadow-xs group-hover:scale-110 group-hover:bg-[#0B1F3A] group-hover:text-purple-400 group-hover:border-[#0B1F3A] transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold font-serif text-slate-200 group-hover:text-purple-400/50 transition-colors">04</span>
                    </div>

                    <h3 class="font-bold text-base sm:text-lg text-[#0B1F3A] mb-2 group-hover:text-[#0B1F3A] transition-colors">
                        {{ app()->getLocale() === 'bn' ? 'কাস্টম ট্রিপ প্ল্যানিং' : 'Custom Trip Planning' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6">
                        {{ app()->getLocale() === 'bn' ? 'হানিমুন কাপল, পরিবার ও কর্পোরেট গ্রুপের জন্য বিশেষায়িত পরিকল্পনা।' : 'Tailored private vacations for honeymoon couples, families, and corporate executive retreats.' }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100/80 flex items-center gap-1.5 text-[11px] font-semibold text-purple-700 bg-purple-50/50 -mx-3 -mb-3 px-3 py-2 rounded-xl">
                    <svg class="w-3.5 h-3.5 text-purple-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ app()->getLocale() === 'bn' ? '১-অন-১ নিবেদিত ট্রাভেল বিশেষজ্ঞ' : '1-on-1 Dedicated Specialist' }}</span>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-slate-200/70 flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-xs font-semibold text-slate-400">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                <span class="text-slate-600">{{ app()->getLocale() === 'bn' ? 'সরকারি অনুমোদিত ট্যুর অপারেটর' : 'Government Approved Tour Operator' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                <span class="text-slate-600">{{ app()->getLocale() === 'bn' ? 'আইএটিএ স্ট্যান্ডার্ড ফ্লাইট বুকিং' : 'IATA Standard Global Flight Access' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span class="text-slate-600">{{ app()->getLocale() === 'bn' ? '২৪/৭ সার্বক্ষণিক সহায়তা ডেস্ক' : '24/7 Dedicated Concierge Support' }}</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     08. CLIENT TESTIMONIALS
     ========================================================================= -->
<section class="section-padding bg-[#0B1F3A] text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-custom relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-[#D4AF37]/30 text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3.5 backdrop-blur-md shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                    <span>{{ app()->getLocale() === 'bn' ? 'গ্রাহকদের গল্প ও অভিজ্ঞতা' : 'Client Trust & Stories' }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-serif text-white tracking-tight mb-3">
                    {{ app()->getLocale() === 'bn' ? '১০,০০০+ সম্মানিত ভ্রমণপিপাসুর আস্থা' : 'Loved By Over 10,000+ Explorers' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed font-light">
                    {{ app()->getLocale() === 'bn' ? 'পরিবার, দম্পতি ও কর্পোরেট ক্লায়েন্টদের বাস্তব প্রতিক্রিয়া যারা এমিসা ট্যুরস অ্যান্ড ট্রাভেলসের মাধ্যমে সুন্দর ভ্রমণ সম্পন্ন করেছেন।' : 'Authentic feedback from families, couples, and corporate travelers who trusted Emisha Tours & Travels for their international journeys, visa processing, and air ticketing.' }}
                </p>
            </div>

            <!-- Google Verified Reviews -->
            <div class="inline-flex items-center gap-3.5 bg-white/10 backdrop-blur-md border border-white/20 px-5 py-3 rounded-2xl shadow-md shrink-0">
                <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center font-extrabold text-sm text-[#0B1F3A] shadow-xs">
                    G
                </div>
                <div class="text-left">
                    <div class="flex items-center gap-1 text-[#D4AF37]">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-3.5 h-3.5 fill-current text-[#D4AF37]" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                        <span class="font-bold text-xs text-white ml-1 font-mono">4.9 / 5.0</span>
                    </div>
                    <span class="text-[11px] text-slate-300 font-medium block mt-0.5">{{ app()->getLocale() === 'bn' ? 'গুগল ভেরিফাইড রিভিউ' : 'Google Verified Client Reviews' }}</span>
                </div>
            </div>
        </div>

        <!-- Testimonial Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-14">
            <!-- 1 -->
            <div class="bg-white rounded-[28px] p-7 sm:p-8 text-[#0B1F3A] shadow-xl flex flex-col justify-between h-full relative group border border-slate-100 hover:border-[#D4AF37]/50 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-1 text-[#D4AF37]">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current text-[#D4AF37]" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="text-xs font-bold text-[#0B1F3A] ml-1 font-mono">5.0</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-amber-50 border border-amber-200/80 text-[#B89628] text-[11px] font-bold">
                            {{ app()->getLocale() === 'bn' ? 'থাইল্যান্ড ভ্রমণ' : 'Thailand Escape' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6 font-normal">
                        {{ app()->getLocale() === 'bn' ? '"ব্যাংকক এবং পাতায়ায় আমাদের ৫ দিনের ট্যুরটি অত্যন্ত নিখুঁতভাবে পরিচালনা করেছে এমিসা। হোটেল ট্রান্সফার থেকে ডিনার ক্রুজ টিকেট—সবকিছুই ছিল সময়মত ও পরিপাটি।"' : '"Our 5-day Bangkok and Pattaya tour was flawlessly organized by Emisha Tours. From hotel transfers to dinner cruise tickets, everything was on time and stress-free. Highly recommended!"' }}
                    </p>
                </div>
                <div class="flex items-center gap-3.5 pt-5 border-t border-slate-100">
                    <img 
                        src="{{ asset('images/clients/tanvir-ahmed.jpg') }}" 
                        alt="Tanvir Ahmed - Emisha Tours Verified Traveler" 
                        class="w-13 h-13 rounded-2xl object-cover border-2 border-[#D4AF37]/50 shadow-sm"
                        loading="lazy"
                    >
                    <div>
                        <div class="font-bold text-sm sm:text-base text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'তানভীর আহমেদ' : 'Tanvir Ahmed' }}</div>
                        <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-0.5">
                            <span class="text-emerald-700 font-semibold flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                                <span>{{ app()->getLocale() === 'bn' ? 'যাচাইকৃত ভ্রমণকারী' : 'Verified Traveler' }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="bg-white rounded-[28px] p-7 sm:p-8 text-[#0B1F3A] shadow-xl flex flex-col justify-between h-full relative group border border-slate-100 hover:border-[#D4AF37]/50 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-1 text-[#D4AF37]">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current text-[#D4AF37]" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="text-xs font-bold text-[#0B1F3A] ml-1 font-mono">5.0</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-[11px] font-bold">
                            {{ app()->getLocale() === 'bn' ? 'মালদ্বীপ হানিমুন' : 'Maldives Honeymoon' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6 font-normal">
                        {{ app()->getLocale() === 'bn' ? '"মালদ্বীপে ওয়াটার ভিলা এবং স্পিডবোট ট্রান্সফারের অপূর্ব ব্যবস্থাপনা ছিল। ক্যান্ডেললাইট ডিনার ও সব খরচ আগে থেকেই স্পষ্ট ছিল।"' : '"The overwater villa experience in the Maldives arranged by Emisha was pure magic! They took care of our speedboat transfers, candlelight dinner, and green taxes without any hidden costs."' }}
                    </p>
                </div>
                <div class="flex items-center gap-3.5 pt-5 border-t border-slate-100">
                    <img 
                        src="{{ asset('images/clients/nusrat-farhan.jpg') }}" 
                        alt="Nusrat Jahan & Farhan - Emisha Tours Verified Travelers" 
                        class="w-13 h-13 rounded-2xl object-cover border-2 border-[#D4AF37]/50 shadow-sm"
                        loading="lazy"
                    >
                    <div>
                        <div class="font-bold text-sm sm:text-base text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'নুসরাত জাহান ও ফারহান' : 'Nusrat Jahan & Farhan' }}</div>
                        <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-0.5">
                            <span class="text-emerald-700 font-semibold flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                                <span>{{ app()->getLocale() === 'bn' ? 'যাচাইকৃত ভ্রমণকারী' : 'Verified Traveler' }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3 -->
            <div class="bg-white rounded-[28px] p-7 sm:p-8 text-[#0B1F3A] shadow-xl flex flex-col justify-between h-full relative group border border-slate-100 hover:border-[#D4AF37]/50 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-1 text-[#D4AF37]">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current text-[#D4AF37]" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="text-xs font-bold text-[#0B1F3A] ml-1 font-mono">5.0</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-[11px] font-bold">
                            {{ app()->getLocale() === 'bn' ? 'দুবাই, ইউএই' : 'Dubai, UAE' }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6 font-normal">
                        {{ app()->getLocale() === 'bn' ? '"মাত্র ৪৮ ঘণ্টায় দুবাই ই-ভিসা এবং এমিরেটসের রাউন্ডট্রিপ টিকেট সেরা রেটে পেয়েছি। তাদের ভিসা কনসালটেন্সি অত্যন্ত দক্ষ ও নির্ভরযোগ্য।"' : '"Got my Dubai e-Visa in just 48 hours and roundtrip Emirates tickets at an unbeatable corporate rate. Emisha’s visa consultancy team is professional, prompt, and trustworthy."' }}
                    </p>
                </div>
                <div class="flex items-center gap-3.5 pt-5 border-t border-slate-100">
                    <img 
                        src="{{ asset('images/clients/dr-kamrul-hasan.jpg') }}" 
                        alt="Dr. Kamrul Hasan - Emisha Tours Verified Traveler" 
                        class="w-13 h-13 rounded-2xl object-cover border-2 border-[#D4AF37]/50 shadow-sm"
                        loading="lazy"
                    >
                    <div>
                        <div class="font-bold text-sm sm:text-base text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'ডা. কামরুল হাসান' : 'Dr. Kamrul Hasan' }}</div>
                        <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-0.5">
                            <span class="text-emerald-700 font-semibold flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                                <span>{{ app()->getLocale() === 'bn' ? 'যাচাইকৃত ভ্রমণকারী' : 'Verified Traveler' }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Stat Counters Strip -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 pt-8 sm:pt-10 border-t border-white/15 text-center">
            <div class="p-3 sm:p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <div class="text-xl sm:text-3xl lg:text-4xl font-extrabold font-serif text-[#D4AF37] mb-1">
                    10,000+
                </div>
                <div class="text-[11px] sm:text-sm text-slate-300 font-medium">
                    {{ app()->getLocale() === 'bn' ? 'সন্তুষ্ট ভ্রমণকারী' : 'Happy Travelers' }}
                </div>
            </div>

            <div class="p-3 sm:p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <div class="text-xl sm:text-3xl lg:text-4xl font-extrabold font-serif text-[#D4AF37] mb-1">
                    98.5%
                </div>
                <div class="text-[11px] sm:text-sm text-slate-300 font-medium">
                    {{ app()->getLocale() === 'bn' ? 'ভিসা সাফল্যের হার' : 'Visa Approval Rate' }}
                </div>
            </div>

            <div class="p-3 sm:p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <div class="text-xl sm:text-3xl lg:text-4xl font-extrabold font-serif text-[#D4AF37] mb-1">
                    4.9 / 5.0
                </div>
                <div class="text-[11px] sm:text-sm text-slate-300 font-medium">
                    {{ app()->getLocale() === 'bn' ? 'গ্রাহক সন্তুষ্টি' : 'Client Satisfaction' }}
                </div>
            </div>

            <div class="p-3 sm:p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                <div class="text-xl sm:text-3xl lg:text-4xl font-extrabold font-serif text-[#D4AF37] mb-1">
                    24/7
                </div>
                <div class="text-[11px] sm:text-sm text-slate-300 font-medium">
                    {{ app()->getLocale() === 'bn' ? 'সাপোর্ট ডেস্ক' : 'Support Desk' }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     09. MAKE MEMORIES WITH US
     ========================================================================= -->
<section class="section-padding bg-gradient-to-b from-white via-slate-50/70 to-white relative overflow-hidden">
    <div class="container-custom relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#D4AF37]/10 border border-[#D4AF37]/30 text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-3 shadow-xs">
                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ app()->getLocale() === 'bn' ? 'ভ্রমণ মুহূর্ত' : 'Visual Journey' }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-serif text-[#0B1F3A] mb-3 tracking-tight">
                {{ app()->getLocale() === 'bn' ? 'আমাদের সাথে তৈরি হোক মধুর স্মৃতি' : 'Make memories with us' }}
            </h2>
            <p class="text-xs sm:text-sm md:text-base text-slate-500 leading-relaxed max-w-xl mx-auto font-normal">
                {{ app()->getLocale() === 'bn' ? 'আমাদের আন্তর্জাতিক গ্রুপ ও ফ্যামিলি ট্যুর চলাকালীন ধারণকৃত আনন্দের কিছু মুহূর্ত।' : 'Moments of joy, serenity, and discovery captured during our international group and family tours.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 max-w-6xl mx-auto items-stretch">
            <!-- 1 -->
            <a href="{{ route('tours.index') }}" class="group relative rounded-[28px] overflow-hidden bg-[#0B1F3A] border border-slate-200/80 hover:border-[#D4AF37]/60 shadow-[0_12px_36px_rgba(11,31,58,0.08)] hover:shadow-[0_24px_50px_rgba(11,31,58,0.18)] transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between aspect-[4/5] w-full block">
                <img 
                    src="https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1200&h=1500&q=85" 
                    alt="Thailand Island Cruise - Phi Phi Islands" 
                    class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-[#071527] via-[#0B1F3A]/65 to-[#071527]/25"></div>
                
                <div class="relative z-10 p-5 sm:p-6 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-[11px] font-semibold">
                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ app()->getLocale() === 'bn' ? 'থাইল্যান্ড হাইলাইটস' : 'Thailand Highlights' }}</span>
                    </span>
                    <span class="px-3 py-1 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[11px] font-extrabold shadow-sm font-mono">
                        {{ app()->getLocale() === 'bn' ? '৫দিন / ৪রাত' : '5D / 4N' }}
                    </span>
                </div>

                <div class="relative z-10 p-5 sm:p-6 text-white space-y-3">
                    <div>
                        <div class="text-[11px] text-[#D4AF37] font-semibold uppercase tracking-wider mb-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ app()->getLocale() === 'bn' ? 'ফুকেট ও ফি ফি দ্বীপপুঞ্জ' : 'Phuket & Phi Phi Islands' }}</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold font-serif leading-snug text-white group-hover:text-[#D4AF37] transition-colors">
                            {{ app()->getLocale() === 'bn' ? 'ফি ফি আইল্যান্ড স্পিডবোট ক্রুজ' : 'Phi Phi Island Speedboat Cruise' }}
                        </h3>
                    </div>

                    <p class="text-xs text-slate-200 line-clamp-2 leading-relaxed font-light">
                        {{ app()->getLocale() === 'bn' ? 'মায়া বে সাইটসিয়িং, পিলেহ লাগুন সাঁতার ও লাক্সারি স্পিডবোট ট্রান্সফার।' : 'Crystal turquoise lagoon, Maya Bay sightseeing, Pileh Lagoon swimming & luxury speedboat transfer.' }}
                    </p>

                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'স্পিডবোট' : 'Speedboat' }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'মায়া বে' : 'Maya Bay' }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'বুফে লাঞ্চ' : 'Buffet Lunch' }}</span>
                    </div>

                    <div class="pt-2 border-t border-white/15 flex items-center justify-between text-xs font-bold text-[#D4AF37]">
                        <span>{{ app()->getLocale() === 'bn' ? 'ট্যুর বিবরণ দেখুন' : 'Explore Tour Itinerary' }}</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </a>

            <!-- 2 -->
            <a href="{{ route('tours.index') }}" class="group relative rounded-[28px] overflow-hidden bg-[#0B1F3A] border border-slate-200/80 hover:border-[#D4AF37]/60 shadow-[0_12px_36px_rgba(11,31,58,0.08)] hover:shadow-[0_24px_50px_rgba(11,31,58,0.18)] transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between aspect-[4/5] w-full block">
                <img 
                    src="https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=1200&h=1500&q=85" 
                    alt="Maldives Luxury Overwater Resort" 
                    class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-[#071527] via-[#0B1F3A]/65 to-[#071527]/25"></div>
                
                <div class="relative z-10 p-5 sm:p-6 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-[11px] font-semibold">
                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ app()->getLocale() === 'bn' ? 'মালদ্বীপ লাক্সারি' : 'Maldives Luxury' }}</span>
                    </span>
                    <span class="px-3 py-1 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[11px] font-extrabold shadow-sm font-mono">
                        {{ app()->getLocale() === 'bn' ? '৪দিন / ৩রাত' : '4D / 3N' }}
                    </span>
                </div>

                <div class="relative z-10 p-5 sm:p-6 text-white space-y-3">
                    <div>
                        <div class="text-[11px] text-[#D4AF37] font-semibold uppercase tracking-wider mb-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ app()->getLocale() === 'bn' ? 'সাউথ আরি অ্যাটল' : 'South Ari Atoll Island' }}</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold font-serif leading-snug text-white group-hover:text-[#D4AF37] transition-colors">
                            {{ app()->getLocale() === 'bn' ? 'ওয়াটার ভিলা প্রাইভেট ভ্যাকেশন' : 'Overwater Villa Private Getaway' }}
                        </h3>
                    </div>

                    <p class="text-xs text-slate-200 line-clamp-2 leading-relaxed font-light">
                        {{ app()->getLocale() === 'bn' ? 'ইনফিনিটি সানডেক, কচ্ছপের সাথে স্নরকেলিং এবং সানসেট ডলফিন ক্রুজ।' : 'Pure serenity with private infinity sundeck, house reef snorkeling with sea turtles & sunset dolphin cruise.' }}
                    </p>

                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'ওয়াটার ভিলা' : 'Water Villa' }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'রিফ স্নরকেলিং' : 'Reef Snorkeling' }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'অল ইনক্লুসিভ' : 'All Inclusive' }}</span>
                    </div>

                    <div class="pt-2 border-t border-white/15 flex items-center justify-between text-xs font-bold text-[#D4AF37]">
                        <span>{{ app()->getLocale() === 'bn' ? 'ট্যুর বিবরণ দেখুন' : 'Explore Tour Itinerary' }}</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </a>

            <!-- 3 -->
            <a href="{{ route('tours.index') }}" class="group relative rounded-[28px] overflow-hidden bg-[#0B1F3A] border border-slate-200/80 hover:border-[#D4AF37]/60 shadow-[0_12px_36px_rgba(11,31,58,0.08)] hover:shadow-[0_24px_50px_rgba(11,31,58,0.18)] transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between aspect-[4/5] w-full block">
                <img 
                    src="https://images.unsplash.com/photo-1451337516015-6b6e9a44a8a3?auto=format&fit=crop&w=1200&h=1500&q=85" 
                    alt="Dubai Red Desert Safari" 
                    class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-[#071527] via-[#0B1F3A]/65 to-[#071527]/25"></div>
                
                <div class="relative z-10 p-5 sm:p-6 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-[11px] font-semibold">
                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ app()->getLocale() === 'bn' ? 'দুবাই ডেজার্ট সাফারি' : 'Dubai Desert Safari' }}</span>
                    </span>
                    <span class="px-3 py-1 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[11px] font-extrabold shadow-sm font-mono">
                        {{ app()->getLocale() === 'bn' ? '৫দিন / ৪রাত' : '5D / 4N' }}
                    </span>
                </div>

                <div class="relative z-10 p-5 sm:p-6 text-white space-y-3">
                    <div>
                        <div class="text-[11px] text-[#D4AF37] font-semibold uppercase tracking-wider mb-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ app()->getLocale() === 'bn' ? 'লাহবাব রেড ডেজার্ট' : 'Lahbab Red Desert' }}</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold font-serif leading-snug text-white group-hover:text-[#D4AF37] transition-colors">
                            {{ app()->getLocale() === 'bn' ? 'রেড ডিউনস ও ভিআইপি ক্যাম্প বারবিকিউ' : 'Red Dunes & VIP Camp BBQ' }}
                        </h3>
                    </div>

                    <p class="text-xs text-slate-200 line-clamp-2 leading-relaxed font-light">
                        {{ app()->getLocale() === 'bn' ? '৪x৪ ডিউন ব্যাশিং, স্যান্ডবোর্ডিং, ফ্যালকন ছবি ও ফাইভ স্টার অ্যারাবিয়ান বারবিকিউ।' : '4x4 Dune bashing, sandboarding, falcon photography, camel riding & 5-star Arabian BBQ dinner under the stars.' }}
                    </p>

                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? '৪x৪ ডিউন ব্যাশিং' : '4x4 Dune Bashing' }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'ফ্যালকন ফটো' : 'Falcon Photo' }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-white/10 backdrop-blur-md border border-white/15 text-[10px] text-white/90">{{ app()->getLocale() === 'bn' ? 'ভিআইপি বারবিকিউ' : 'VIP Camp BBQ' }}</span>
                    </div>

                    <div class="pt-2 border-t border-white/15 flex items-center justify-between text-xs font-bold text-[#D4AF37]">
                        <span>{{ app()->getLocale() === 'bn' ? 'ট্যুর বিবরণ দেখুন' : 'Explore Tour Itinerary' }}</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </a>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-6 mt-10 sm:mt-12 text-center">
            <a href="{{ route('gallery.index') }}" class="btn btn-primary btn-md rounded-xl font-bold shadow-md flex items-center justify-center gap-2 text-xs sm:text-sm px-6 py-3">
                <span>{{ app()->getLocale() === 'bn' ? 'সম্পূর্ণ ফটো গ্যালারি দেখুন' : 'View Full Photo Gallery' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <div class="text-xs text-slate-500 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>{{ app()->getLocale() === 'bn' ? '৫০০+ স্মরণীয় গ্রুপ ও ফ্যামিলি মেমোরিজ' : '500+ Group & Family Memories Captured' }}</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     10. NEWS, TIPS & GUIDES (Blog Section)
     ========================================================================= -->
<section class="section-padding bg-[#F8FAFC] border-t border-slate-200/60">
    <div class="container-custom">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
            <div>
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                    <span>{{ app()->getLocale() === 'bn' ? 'ভ্রমণ গাইড' : 'Travel Guides' }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-[#0B1F3A] mb-1">
                    {{ app()->getLocale() === 'bn' ? 'সাম্প্রতিক টিপস ও ভিসা গাইড' : 'Latest Insights & Visa Guides' }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500">
                    {{ app()->getLocale() === 'bn' ? 'বিশেষজ্ঞদের লেখা প্রয়োজনীয় ভ্রমণ নির্দেশনা, বাজেট পরিকল্পনা ও পরামর্শ।' : 'Comprehensive travel requirements, tips, and budget itineraries written by specialists.' }}
                </p>
            </div>
            <a href="{{ route('blog.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-1.5 text-xs font-bold text-[#0B1F3A] hover:text-[#D4AF37] bg-white border border-slate-200 px-4 py-2 rounded-full shadow-xs hover:border-[#D4AF37] transition">
                <span>{{ app()->getLocale() === 'bn' ? 'সকল আর্টিকেল দেখুন' : 'View All Articles' }}</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($recentBlogs as $blog)
            <article class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col h-full group">
                <a href="{{ route('blog.show', $blog->slug) }}" class="aspect-[16/10] overflow-hidden block">
                    <img 
                        src="{{ $blog->featured_image ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600' }}" 
                        alt="{{ $blog->localized_title }}" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                        loading="lazy"
                    >
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 text-[11px] text-slate-400 mb-2.5">
                        <span class="text-[#D4AF37] font-bold uppercase tracking-wider">{{ $blog->category ? $blog->category->localized_name : (app()->getLocale() === 'bn' ? 'গাইড' : 'Guide') }}</span>
                        <span>•</span>
                        <span>{{ $blog->reading_time }} {{ app()->getLocale() === 'bn' ? 'মিনিট পাঠ' : 'min read' }}</span>
                    </div>
                    <h3 class="text-base font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] transition-colors leading-snug mb-2 font-serif line-clamp-2">
                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->localized_title }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                        {{ $blog->localized_excerpt }}
                    </p>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="mt-auto text-xs font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] inline-flex items-center gap-1 transition-colors">
                        <span>{{ app()->getLocale() === 'bn' ? 'সম্পূর্ণ পড়ুন' : 'Read Full Guide' }}</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- =========================================================================
     11. FREQUENTLY ASKED QUESTIONS
     ========================================================================= -->
<section class="section-padding bg-white">
    <div class="container-custom max-w-3xl">
        <div class="text-center max-w-xl mx-auto mb-10">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-2">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                <span>FAQ</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-[#0B1F3A] mb-2">
                {{ app()->getLocale() === 'bn' ? 'সাধারণ প্রশ্নোত্তর' : 'Frequently Asked Questions' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                {{ app()->getLocale() === 'bn' ? 'ট্যুর প্যাকেজ কাস্টমাইজেশন, ভিসা প্রসেসিং সময় ও পেমেন্ট সংক্রান্ত জরুরি উত্তর।' : 'Quick answers regarding tour customization, visa processing timelines, and payment options.' }}
            </p>
        </div>

        <div class="space-y-3.5" x-data="{ activeAccordion: null }">
            @foreach($faqs as $idx => $faq)
            <div class="border border-slate-200 rounded-2xl overflow-hidden bg-[#F8FAFC] transition">
                <button 
                    type="button" 
                    @click="activeAccordion = (activeAccordion === {{ $idx }} ? null : {{ $idx }})" 
                    class="w-full text-left p-5 font-bold text-sm text-[#0B1F3A] flex justify-between items-center hover:bg-white transition-colors"
                >
                    <span>{{ $faq->localized_question }}</span>
                    <svg :class="activeAccordion === {{ $idx }} ? 'rotate-180 text-[#D4AF37]' : 'text-slate-400'" class="w-4 h-4 transform transition-transform flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="activeAccordion === {{ $idx }}" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200/60 pt-3 bg-white">
                    {{ $faq->localized_answer }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =========================================================================
     12. QUICK CONTACT & LOCATION BAR
     ========================================================================= -->
<section class="py-12 bg-slate-50 border-t border-slate-200/80">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-center">
            <!-- Item 1: Phone -->
            <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block">{{ app()->getLocale() === 'bn' ? 'হটলাইন সাপোর্ট' : 'Hotline Support' }}</span>
                    <a href="tel:{{ App\Models\Setting::get('contact_phone', '+8801805464291') }}" class="font-bold text-xs text-[#0B1F3A] hover:text-[#D4AF37] truncate block">
                        {{ App\Models\Setting::get('contact_phone', '+880 1805-464291') }}
                    </a>
                </div>
            </div>

            <!-- Item 2: Email -->
            <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block">{{ app()->getLocale() === 'bn' ? 'অফিসিয়াল ইমেইল' : 'Direct Email' }}</span>
                    <a href="mailto:{{ App\Models\Setting::get('contact_email', 'info@emishatours.com') }}" class="font-bold text-xs text-[#0B1F3A] hover:text-[#D4AF37] truncate block">
                        {{ App\Models\Setting::get('contact_email', 'info@emishatours.com') }}
                    </a>
                </div>
            </div>

            <!-- Item 3: Office Hours -->
            <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block">{{ app()->getLocale() === 'bn' ? 'অফিস সময়সূচী' : 'Office Schedule' }}</span>
                    <span class="font-bold text-xs text-[#0B1F3A] block truncate">
                        {{ app()->getLocale() === 'bn' ? App\Models\Setting::get('office_hours_bn', 'শনিবার – বৃহস্পতিবার: সকাল ১০:০০ – সন্ধ্যা ৬:৩০') : App\Models\Setting::get('office_hours', 'Saturday – Thursday: 10:00 AM – 6:30 PM') }}
                    </span>
                </div>
            </div>

            <!-- Item 4: Location & Map -->
            <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-[10px] text-slate-400 uppercase font-bold block">{{ app()->getLocale() === 'bn' ? 'প্রধান কার্যালয়' : 'Head Office' }}</span>
                    <a href="{{ route('contact.index') }}" class="font-bold text-xs text-[#0B1F3A] hover:text-[#D4AF37] truncate block">
                        {{ app()->getLocale() === 'bn' ? App\Models\Setting::get('office_address_bn', 'ইউনিয়ন ব্যাংক ভবন (৬ষ্ঠ তলা), ১২৮১, পূর্ব মনিপুর, বেগম রোকেয়া সরণি, মিরপুর, ঢাকা') : App\Models\Setting::get('office_address', 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     13. FINAL CONVERSION CTA
     ========================================================================= -->
<section class="py-16 bg-gradient-to-r from-[#071527] via-[#0B1F3A] to-[#071527] text-white text-center relative overflow-hidden">
    <div class="container-custom relative z-10 max-w-3xl">
        <h2 class="text-2xl sm:text-4xl font-extrabold font-serif text-white tracking-tight mb-3">
            {{ app()->getLocale() === 'bn' ? 'আপনার পরবর্তী ভ্রমণের জন্য প্রস্তুত?' : 'Ready For Your Next Journey?' }}
        </h2>
        <p class="text-xs sm:text-base text-white/80 leading-relaxed mb-6 max-w-xl mx-auto">
            {{ app()->getLocale() === 'bn' ? 'আমাদের জানান আপনি কোথায় যেতে চান। আমাদের অভিজ্ঞ টিম আপনার প্রতিটি পরিকল্পনা সুন্দরভাবে সাজিয়ে দেবে।' : 'Tell us where you want to go. Our expert team will help you plan every detail with complete peace of mind.' }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3.5">
            <a href="{{ route('contact.index') }}" class="btn btn-gold btn-md shadow-lg rounded-xl">
                <span>{{ app()->getLocale() === 'bn' ? 'পরামর্শ শুরু করুন' : 'Start Your Inquiry' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা ট্যুরস, আমি একটি ভ্রমণ পরিকল্পনা করতে চাই।' : 'Hello Emisha Tours, I would like to plan a trip.') }}" target="_blank" class="btn btn-outline-white btn-md rounded-xl inline-flex items-center gap-2">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                </svg>
                <span>{{ app()->getLocale() === 'bn' ? 'হোয়াটসঅ্যাপ হেল্পলাইন' : 'WhatsApp Helpline' }}</span>
            </a>
        </div>
    </div>
</section>


@endsection
