@extends('layouts.app')

@section('title', "{$tour->localized_title} — Emisha Tours & Travels")
@section('meta_description', $tour->localized_short_description ?: Str::limit(strip_tags($tour->localized_description), 155))
@section('canonical_url', route('tours.show', $tour->slug))
@section('og_type', 'product')
@section('og_image', $tour->cover_image ? url($tour->cover_image) : asset('images/logo.png'))

@section('schema')
    {!! $schema !!}
@endsection

@section('content')
<!-- Tour Detail Header -->
<div class="bg-[#0B1F3A] text-white py-10 sm:py-12 md:py-14 lg:py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#071527] to-[#0B1F3A] opacity-90"></div>
    <div class="container-custom relative z-10">
        <div class="text-[11px] sm:text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-3 flex flex-wrap items-center gap-1.5">
            <a href="{{ route('home') }}" class="hover:underline">{{ __('nav.home') }}</a>
            <span class="text-white/40">/</span>
            <a href="{{ route('tours.index') }}" class="hover:underline">{{ __('nav.tours') }}</a>
            <span class="text-white/40">/</span>
            <a href="{{ route('destinations.show', $tour->destination->slug) }}" class="hover:underline">{{ $tour->destination->localized_name }}</a>
            <span class="text-white/40">/</span>
            <span class="text-white/60 truncate max-w-[200px]">{{ $tour->localized_title }}</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 sm:gap-6">
            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white mb-3 font-serif tracking-tight leading-tight">
                    <span class="text-white">{{ $tour->localized_title }}</span>
                </h1>
                <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm text-white/80">
                    <span class="inline-flex items-center gap-1.5 font-bold text-[#D4AF37]">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        <span>{{ $tour->destination->localized_name }}</span>
                    </span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1.5 font-medium">
                        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $tour->duration_days }} {{ __('common.days') }} / {{ $tour->duration_nights }} {{ __('common.nights') }}</span>
                    </span>
                    <span>•</span>
                    <span class="badge badge-gold font-bold text-xs">{{ $tour->category->localized_name ?? __('tours.standard_package') }}</span>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-4 sm:p-5 rounded-[22px] sm:rounded-[24px] flex flex-row items-center justify-between sm:justify-start gap-4 sm:gap-6 shadow-xl w-full sm:w-auto">
                <div>
                    <div class="text-[10px] sm:text-xs text-white/70 uppercase font-bold tracking-wider">{{ __('common.starting_from') }}</div>
                    <div class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#D4AF37] font-serif">{{ $tour->formatted_price }}</div>
                    <div class="text-[10px] sm:text-[11px] text-white/60">{{ __('tours.per_person') }}</div>
                </div>
                <a href="#inquiry-box" class="btn btn-gold btn-sm py-2.5 sm:py-3 px-4 sm:px-5 shadow-md text-xs font-bold whitespace-nowrap">
                    <span>{{ __('tours.book_inquire') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Tour Details Content -->
<section class="section-padding bg-[#F8FAFC]">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">
            <!-- Left 2-Columns: Overview, Itinerary, Inclusions/Exclusions -->
            <div class="lg:col-span-2 space-y-8 sm:space-y-10">
                <!-- Cover Image -->
                <div class="aspect-16/10 rounded-[20px] sm:rounded-[24px] overflow-hidden shadow-xl border border-slate-100">
                    <img src="{{ $tour->cover_image }}" alt="{{ $tour->localized_title }}" class="w-full h-full object-cover">
                </div>

                <!-- Overview -->
                <div class="card-base p-5 sm:p-7 md:p-8 rounded-[22px] sm:rounded-[24px]">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#0B1F3A] mb-3 sm:mb-4 font-serif">{{ __('tours.overview') }}</h2>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-6 whitespace-pre-line">
                        {{ $tour->localized_description ?: $tour->localized_short_description }}
                    </p>
                </div>

                <!-- Daily Itinerary Timeline -->
                @if($tour->itineraries && $tour->itineraries->count() > 0)
                <div class="card-base p-5 sm:p-7 md:p-8 rounded-[22px] sm:rounded-[24px]">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#0B1F3A] mb-6 font-serif">{{ __('tours.itinerary') }}</h2>
                    
                    <div class="relative border-l-2 border-[#D4AF37]/40 ml-3 sm:ml-4 space-y-6 sm:space-y-8 pl-5 sm:pl-6">
                        @foreach($tour->itineraries as $it)
                        <div class="relative group">
                            <!-- Timeline Bullet -->
                            <div class="absolute -left-[31px] sm:-left-[33px] top-0 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-[#0B1F3A] border-2 border-[#D4AF37] text-white font-bold text-xs flex items-center justify-center shadow-md">
                                {{ $it->day_number }}
                            </div>

                            <div class="bg-[#F8FAFC] p-4 sm:p-6 rounded-[18px] sm:rounded-[20px] border border-slate-100 shadow-2xs">
                                <h3 class="text-base sm:text-lg font-bold text-[#0B1F3A] mb-2 font-serif">
                                    {{ __('tours.day', ['day' => $it->day_number]) }}: {{ $it->localized_title }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3">
                                    {{ $it->localized_description }}
                                </p>

                                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs font-semibold text-slate-500 pt-3 border-t border-slate-200">
                                    @if($it->meals)
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        {{ __('tours.meals') }}: {{ $it->meals_bn && app()->getLocale() === 'bn' ? $it->meals_bn : $it->meals }}
                                    </span>
                                    @endif
                                    @if($it->stay)
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        {{ __('tours.stay') }}: {{ $it->stay_bn && app()->getLocale() === 'bn' ? $it->stay_bn : $it->stay }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Inclusions & Exclusions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Inclusions -->
                    <div class="card-base p-6 rounded-[24px] border-t-4 border-t-emerald-500">
                        <h3 class="text-lg font-bold text-[#0B1F3A] mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>{{ __('tours.inclusions') }}</span>
                        </h3>
                        <ul class="space-y-2.5 text-xs text-slate-600 leading-relaxed">
                            @forelse($tour->inclusions as $inc)
                            <li class="flex items-start gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $inc->localized_title }}</span>
                            </li>
                            @empty
                            <li class="text-slate-400 italic">{{ __('tours.contact_for_inclusions') }}</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Exclusions -->
                    <div class="card-base p-6 rounded-[24px] border-t-4 border-t-rose-500">
                        <h3 class="text-lg font-bold text-[#0B1F3A] mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </span>
                            <span>{{ __('tours.exclusions') }}</span>
                        </h3>
                        <ul class="space-y-2.5 text-xs text-slate-600 leading-relaxed">
                            @forelse($tour->exclusions as $exc)
                            <li class="flex items-start gap-2">
                                <svg class="w-3.5 h-3.5 text-rose-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span>{{ $exc->localized_title }}</span>
                            </li>
                            @empty
                            <li class="text-slate-400 italic">{{ __('tours.personal_expenses_excluded') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right 1-Column: Sticky Booking / Inquiry Card -->
            <div class="lg:col-span-1">
                <div id="inquiry-box" class="card-base p-8 sticky top-24 border border-[#D4AF37]/40 shadow-xl bg-white rounded-[24px]">
                    <div class="text-center pb-6 mb-6 border-b border-slate-100">
                        <div class="text-xs uppercase font-bold text-slate-400 mb-1">{{ __('common.starting_from') }}</div>
                        <div class="text-3xl font-extrabold text-[#0B1F3A]">{{ $tour->formatted_price }}</div>
                        <div class="text-xs text-[#D4AF37] font-bold mt-1">{{ $tour->duration_days }} {{ __('common.days') }} / {{ $tour->duration_nights }} {{ __('common.nights') }}</div>
                    </div>

                    <h3 class="text-lg font-bold text-[#0B1F3A] mb-2">{{ __('tours.book_inquire') }}</h3>
                    <p class="text-xs text-slate-500 mb-6">{{ __('tours.inquiry_subtitle') }}</p>

                    <form action="{{ route('tours.inquire', $tour->slug) }}" method="POST" class="space-y-4" x-data="{ isSubmitting: false }" @submit="if(isSubmitting) return false; isSubmitting = true;">
                        @csrf
                        <div>
                            <label class="form-label text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">{{ __('common.name') }} *</label>
                            <input type="text" name="full_name" required value="{{ old('full_name') }}" placeholder="{{ __('contact.name_placeholder') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A]">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="form-label text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">{{ __('common.email') }} *</label>
                                <input type="email" name="email" required value="{{ old('email') }}" placeholder="name@email.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A]">
                            </div>
                            <div>
                                <label class="form-label text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">{{ __('common.phone') }} *</label>
                                <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="+880 17..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A]">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="form-label text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">{{ __('tours.travel_date') }}</label>
                                <input type="date" name="travel_date" value="{{ old('travel_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A]">
                            </div>
                            <div>
                                <label class="form-label text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">{{ __('tours.travelers_count') }}</label>
                                <input type="number" name="adults" value="{{ old('adults', 2) }}" min="1" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A]">
                            </div>
                        </div>

                        <div>
                            <label class="form-label text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">{{ __('tours.special_requests') }}</label>
                            <textarea name="message" rows="3" placeholder="{{ __('tours.special_requests_placeholder') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A]">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" :disabled="isSubmitting" class="btn btn-gold w-full font-extrabold shadow-lg py-3 text-xs uppercase tracking-wider flex items-center justify-center gap-2">
                            <span x-show="!isSubmitting">{{ __('tours.submit_inquiry') }}</span>
                            <span x-show="isSubmitting" class="flex items-center gap-2" style="display: none;">
                                <svg class="w-4 h-4 animate-spin text-[#0B1F3A]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                <span>{{ __('common.processing') }}</span>
                            </span>
                        </button>
                    </form>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-center gap-2 text-xs text-slate-500">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>{{ __('tours.no_upfront_payment') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Tours -->
@if($relatedTours->isNotEmpty())
<section class="section-padding bg-white border-t border-slate-100">
    <div class="container-custom">
        <h2 class="section-title mb-8">{{ __('tours.related_tours') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedTours as $relTour)
                <x-tour-card :tour="$relTour" />
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

