@extends('layouts.app')

@section('title', __('tours.page_title', ['app' => 'Emisha Tours & Travels']))
@section('meta_description', __('tours.meta_description'))
@section('canonical_url', route('tours.index'))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- Hero Section (Creative Minimal Luxury Design) -->
<div class="bg-[#0B1F3A] text-white py-14 sm:py-20 relative overflow-hidden">
    <!-- Ambient Subtle Radial Glows & Grid Pattern -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-custom relative z-10">
        <!-- Breadcrumbs -->
        <div class="inline-flex items-center gap-2 text-xs font-medium text-white/60 mb-4 bg-white/[0.05] px-3.5 py-1.5 rounded-full border border-white/10 backdrop-blur-md">
            <a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('nav.home') }}</a>
            <span class="text-white/30">/</span>
            <span class="text-[#D4AF37] font-semibold">{{ __('nav.tours') }}</span>
        </div>

        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-[#D4AF37]/15 text-[#D4AF37] border border-[#D4AF37]/30 uppercase tracking-widest mb-3.5 backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span>{{ __('tours.badge_curated') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold font-serif text-white tracking-tight leading-tight mb-4">
                {{ __('tours.heading') }}
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-normal max-w-2xl">
                {{ __('tours.subheading') }}
            </p>
        </div>

        <!-- Quick Category Filter Chips Bar -->
        <div class="mt-8 pt-6 border-t border-white/10 flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-none">
            <a 
                href="{{ route('tours.index', array_merge(request()->except(['category', 'page']))) }}" 
                class="px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap transition-all duration-200 flex items-center gap-1.5 {{ !request('category') ? 'bg-[#D4AF37] text-[#0B1F3A] shadow-md font-bold' : 'bg-white/10 text-white/80 hover:bg-white/15 hover:text-white border border-white/10' }}"
            >
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ __('tours.all_packages') }}</span>
            </a>
            @foreach($categories as $category)
                <a 
                    href="{{ route('tours.index', array_merge(request()->except(['page']), ['category' => $category->slug])) }}" 
                    class="px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap transition-all duration-200 {{ request('category') == $category->slug ? 'bg-[#D4AF37] text-[#0B1F3A] shadow-md font-bold' : 'bg-white/10 text-white/80 hover:bg-white/15 hover:text-white border border-white/10' }}"
                >
                    {{ $category->localized_name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Main Catalog & Filter Section -->
<section class="py-8 sm:py-12 md:py-16 bg-slate-50/70 border-b border-slate-200/80 min-h-screen" x-data="{ mobileFilterOpen: false }">
    <div class="container-custom">
        <!-- Mobile Filter Action Bar (< 1024px) -->
        <div class="lg:hidden mb-6 flex items-center justify-between gap-3 bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200 shadow-sm">
            <button 
                type="button" 
                @click="mobileFilterOpen = !mobileFilterOpen"
                class="flex-1 py-2.5 px-4 rounded-xl bg-[#0B1F3A] text-white text-xs font-bold flex items-center justify-center gap-2 shadow-xs transition active:scale-98"
            >
                <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                <span x-text="mobileFilterOpen ? '{{ __('tours.hide_filters') }}' : '{{ __('tours.filter_btn') }}'">{{ __('tours.filter_btn') }}</span>
            </button>
            @if(request()->hasAny(['search', 'destination', 'category', 'duration', 'sort']))
                <a href="{{ route('tours.index') }}" class="text-xs text-[#D4AF37] font-bold px-3 py-2.5 rounded-xl bg-amber-50 border border-amber-200/60 whitespace-nowrap">
                    {{ __('tours.reset') }}
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-start">
            
            <!-- Left Filter Sidebar (lg:col-span-4 xl:col-span-3) -->
            <aside 
                :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" 
                class="lg:col-span-4 xl:col-span-3 lg:sticky lg:top-24 z-20"
            >
                <div class="bg-white rounded-[24px] sm:rounded-[28px] p-5 sm:p-7 border border-slate-200/80 shadow-[0_10px_35px_rgba(11,31,58,0.04)]">
                    
                    <!-- Filter Top Header -->
                    <div class="flex items-center justify-between pb-4 sm:pb-5 mb-5 sm:mb-6 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-[#D4AF37]/15 text-[#0B1F3A] flex items-center justify-center font-bold text-sm border border-[#D4AF37]/30">
                                🔍
                            </span>
                            <div>
                                <h3 class="font-bold font-serif text-base sm:text-lg text-[#0B1F3A]">{{ __('tours.filter_title') }}</h3>
                                <p class="text-[10.5px] sm:text-[11px] text-slate-400">{{ __('tours.filter_subtitle') }}</p>
                            </div>
                        </div>
                        @if(request()->hasAny(['search', 'destination', 'category', 'duration', 'sort']))
                            <a href="{{ route('tours.index') }}" class="text-xs text-[#D4AF37] hover:text-[#0B1F3A] font-bold px-2.5 py-1 rounded-lg bg-amber-50 hover:bg-amber-100 transition-colors border border-amber-200/60">
                                {{ __('tours.reset_all') }}
                            </a>
                        @endif
                    </div>

                    <form action="{{ route('tours.index') }}" method="GET" class="space-y-4 sm:space-y-5">
                        <!-- Search Keyword Box -->
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-slate-700 mb-1.5">
                                {{ __('tours.search_label') }}
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}" 
                                    placeholder="{{ __('tours.search_placeholder') }}" 
                                    class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-xs text-[#0B1F3A] bg-slate-50/50 focus:bg-white transition-all"
                                >
                                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        <!-- Destination Select -->
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-slate-700 mb-1.5">
                                {{ __('tours.destination_label') }}
                            </label>
                            <select name="destination" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-xs text-[#0B1F3A] bg-slate-50/50 focus:bg-white transition-all">
                                <option value="">{{ __('tours.all_destinations') }}</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest->slug }}" {{ request('destination') == $dest->slug ? 'selected' : '' }}>
                                        {{ $dest->localized_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Category Select -->
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-slate-700 mb-1.5">
                                {{ __('tours.category_label') }}
                            </label>
                            <select name="category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-xs text-[#0B1F3A] bg-slate-50/50 focus:bg-white transition-all">
                                <option value="">{{ __('tours.all_categories') }}</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->localized_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Duration Select -->
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-slate-700 mb-1.5">
                                {{ __('tours.duration_label') }}
                            </label>
                            <select name="duration" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-xs text-[#0B1F3A] bg-slate-50/50 focus:bg-white transition-all">
                                <option value="">{{ __('tours.any_duration') }}</option>
                                <option value="1-3" {{ request('duration') == '1-3' ? 'selected' : '' }}>{{ __('tours.duration_short') }}</option>
                                <option value="4-6" {{ request('duration') == '4-6' ? 'selected' : '' }}>{{ __('tours.duration_std') }}</option>
                                <option value="7+" {{ request('duration') == '7+' ? 'selected' : '' }}>{{ __('tours.duration_long') }}</option>
                            </select>
                        </div>

                        <!-- Sort By Select -->
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-slate-700 mb-1.5">
                                {{ __('tours.sort_label') }}
                            </label>
                            <select name="sort" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-xs text-[#0B1F3A] bg-slate-50/50 focus:bg-white transition-all">
                                <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>{{ __('tours.sort_newest') }}</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('tours.sort_price_low') }}</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('tours.sort_price_high') }}</option>
                                <option value="duration" {{ request('sort') == 'duration' ? 'selected' : '' }}>{{ __('tours.sort_duration') }}</option>
                            </select>
                        </div>

                        <!-- Apply Button -->
                        <button type="submit" class="btn btn-gold w-full text-xs uppercase tracking-wider font-bold py-3 rounded-xl shadow-md flex items-center justify-center gap-2">
                            <span>{{ __('tours.apply_filters') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>

                    <!-- Fast Custom Inquiry Callout Box -->
                    <div class="mt-6 pt-5 border-t border-slate-100 text-center bg-slate-50/70 p-4 rounded-2xl border border-slate-200/60">
                        <span class="text-[10.5px] uppercase tracking-wider font-extrabold text-[#D4AF37] block mb-1">{{ __('tours.custom_inquiry_title') }}</span>
                        <p class="text-xs text-slate-600 mb-3 leading-relaxed">{{ __('tours.custom_inquiry_desc') }}</p>
                        <a href="{{ route('contact.index') }}" class="text-xs font-bold text-[#0B1F3A] hover:text-[#D4AF37] inline-flex items-center gap-1 transition-colors">
                            <span>{{ __('tours.talk_specialist') }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Right Catalog Area (lg:col-span-8 xl:col-span-9) -->
            <main class="lg:col-span-8 xl:col-span-9">
                
                <!-- Results Bar & Active Filter Badges -->
                <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-[0_4px_20px_rgba(11,31,58,0.03)] mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-medium text-slate-500">{{ __('tours.showing') }}</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-[#0B1F3A] text-white font-bold text-xs">{{ $tours->total() }}</span>
                        <span class="text-xs font-medium text-slate-500">{{ __('tours.available_packages') }}</span>
                    </div>

                    @if(request()->hasAny(['search', 'destination', 'category', 'duration']))
                    <div class="flex flex-wrap items-center gap-1.5 text-xs">
                        @if(request('search'))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 font-medium">
                                {{ __('tours.keyword') }}: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('destination'))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 font-medium">
                                {{ __('tours.dest') }}: {{ ucfirst(request('destination')) }}
                            </span>
                        @endif
                        @if(request('category'))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 font-medium">
                                {{ __('tours.cat') }}: {{ ucfirst(str_replace('-', ' ', request('category'))) }}
                            </span>
                        @endif
                        @if(request('duration'))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 font-medium">
                                {{ __('tours.dur') }}: {{ request('duration') }} {{ __('common.days') }}
                            </span>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Tour Cards Grid (3 Columns on large screens) -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-7">
                    @forelse($tours as $tour)
                        <x-tour-card :tour="$tour" />
                    @empty
                        <div class="col-span-full text-center py-16 bg-white p-8 sm:p-12 rounded-[28px] border border-slate-200/80 shadow-[0_10px_35px_rgba(11,31,58,0.03)]">
                            <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-4 border border-amber-200/60 font-bold">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold font-serif text-[#0B1F3A] mb-2">{{ __('tours.no_tours_found') }}</h3>
                            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto mb-6 leading-relaxed">
                                {{ __('tours.no_tours_desc') }}
                            </p>
                            <a href="{{ route('tours.index') }}" class="btn btn-gold px-6 py-3 text-xs uppercase tracking-wider font-bold rounded-xl shadow-md">
                                {{ __('tours.reset_all') }}
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Container -->
                @if($tours->hasPages())
                    <div class="mt-12 bg-white rounded-2xl p-4 border border-slate-200/80 shadow-[0_4px_20px_rgba(11,31,58,0.03)] flex justify-center">
                        {{ $tours->links() }}
                    </div>
                @endif

            </main>

        </div>
    </div>
</section>
@endsection


