@extends('layouts.app')

@section('title', '404 — Page Not Found | Emisha Tours & Travels')
@section('meta_description', 'The travel page or holiday package you are looking for is not found. Explore our latest international tour packages, visa services, and cheap flight bookings.')
@section('robots', 'noindex, follow')

@section('content')
<section class="relative min-h-[70vh] flex items-center justify-center py-20 px-4 overflow-hidden bg-gradient-to-b from-[#071A35] via-[#0B1F3A] to-[#0F294D] text-white">
    <!-- Ambient Background Glows -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none -ml-20 -mb-20"></div>

    <div class="max-w-3xl w-full mx-auto text-center relative z-10">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#D4AF37]/15 border border-[#D4AF37]/30 text-[#E5C158] text-xs sm:text-sm font-semibold mb-6 uppercase tracking-wider">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Error 404 — Destination Not Found
        </div>

        <!-- 404 Big Display -->
        <h1 class="text-7xl sm:text-9xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-[#D4AF37] mb-4">
            404
        </h1>

        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            Looks like you've wandered off the itinerary!
        </h2>

        <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto mb-8 leading-relaxed">
            The page, tour package, or resource you are looking for may have been moved, renamed, or is temporarily unavailable. Let's get you back on track.
        </p>

        <!-- Search Bar -->
        <form action="{{ route('tours.index') }}" method="GET" class="max-w-md mx-auto mb-10">
            <div class="relative flex items-center">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search tours, destinations (e.g. Thailand, Dubai)..." 
                    class="w-full pl-11 pr-28 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:bg-white/15 transition text-sm shadow-inner"
                >
                <div class="absolute left-4 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button 
                    type="submit" 
                    class="absolute right-1.5 px-4 py-2 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#0B1F3A] font-semibold text-xs rounded-lg hover:brightness-110 transition shadow-sm"
                >
                    Search
                </button>
            </div>
        </form>

        <!-- Quick Navigation Links -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-2xl mx-auto">
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#D4AF37]/50 transition group">
                <div class="w-10 h-10 rounded-lg bg-[#D4AF37]/15 flex items-center justify-center text-[#E5C158] mb-2 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-white group-hover:text-[#E5C158]">Homepage</span>
            </a>

            <a href="{{ route('tours.index') }}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#D4AF37]/50 transition group">
                <div class="w-10 h-10 rounded-lg bg-[#D4AF37]/15 flex items-center justify-center text-[#E5C158] mb-2 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-white group-hover:text-[#E5C158]">Holiday Packages</span>
            </a>

            <a href="{{ route('visa.index') }}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#D4AF37]/50 transition group">
                <div class="w-10 h-10 rounded-lg bg-[#D4AF37]/15 flex items-center justify-center text-[#E5C158] mb-2 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-white group-hover:text-[#E5C158]">Visa Processing</span>
            </a>

            <a href="{{ route('contact.index') }}" class="flex flex-col items-center justify-center p-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#D4AF37]/50 transition group">
                <div class="w-10 h-10 rounded-lg bg-[#D4AF37]/15 flex items-center justify-center text-[#E5C158] mb-2 group-hover:scale-110 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-white group-hover:text-[#E5C158]">Contact Support</span>
            </a>
        </div>
    </div>
</section>
@endsection
