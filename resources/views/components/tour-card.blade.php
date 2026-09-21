@props(['tour'])

<div class="tour-card group bg-white border border-slate-200/80 rounded-[26px] shadow-[0_8px_25px_rgba(11,31,58,0.03)] hover:shadow-[0_22px_45px_rgba(11,31,58,0.11)] hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
    <div>
        <!-- Card Image & Floating Badges -->
        <a href="{{ route('tours.show', $tour->slug) }}" class="block relative aspect-[16/10] overflow-hidden bg-slate-900">
            <img 
                src="{{ $tour->cover_image ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=600&q=80' }}" 
                alt="{{ $tour->localized_title }}" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out opacity-95"
                loading="lazy"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B1F3A]/70 via-[#0B1F3A]/10 to-transparent"></div>
            
            <!-- Top Left Status Badge -->
            @if($tour->featured)
                <span class="absolute top-3.5 left-3.5 z-10 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gradient-to-r from-[#D4AF37] to-[#E8D28A] text-[#0B1F3A] text-[10.5px] font-extrabold tracking-wide shadow-md border border-white/20">
                    <svg class="w-3 h-3 text-[#0B1F3A] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span>{{ __('tours.featured') }}</span>
                </span>
            @elseif($tour->popular)
                <span class="absolute top-3.5 left-3.5 z-10 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#0B1F3A]/90 backdrop-blur-md text-[#D4AF37] border border-[#D4AF37]/40 text-[10.5px] font-extrabold tracking-wide shadow-md">
                    <svg class="w-3 h-3 text-[#D4AF37] fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.527.82-1.144 2.05-1.527 3.32-.4 1.32-.614 2.807-.614 4.132 0 3.314 2.686 6 6 6s6-2.686 6-6c0-1.657-.672-3.157-1.757-4.243a1 1 0 00-1.414 1.414C17.447 11.286 18 12.571 18 14c0 2.209-1.791 4-4 4s-4-1.791-4-4c0-1.026.168-2.202.493-3.277.34-1.127.88-2.188 1.348-2.916.14-.217.27-.398.375-.526a1 1 0 00-.821-1.728z" clip-rule="evenodd"/></svg>
                    <span>{{ __('tours.popular') }}</span>
                </span>
            @endif

            <!-- Top Right Duration Badge -->
            <span class="absolute top-3.5 right-3.5 z-10 bg-black/50 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full border border-white/20 shadow-xs inline-flex items-center gap-1.5">
                <svg class="w-3 h-3 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $tour->duration_days }} {{ __('common.days') }} / {{ $tour->duration_nights }} {{ __('common.nights') }}</span>
            </span>

            <!-- Bottom Left Category Pill -->
            @if($tour->category)
            <div class="absolute bottom-3 left-3.5">
                <span class="inline-block px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-white/20 backdrop-blur-md text-white border border-white/20">
                    {{ $tour->category->localized_name }}
                </span>
            </div>
            @endif
        </a>

        <!-- Card Content -->
        <div class="p-4 sm:p-5 md:p-6">
            <!-- Destination Subheader -->
            <div class="flex items-center gap-1.5 text-[10.5px] font-bold uppercase tracking-wider text-[#D4AF37] mb-1.5">
                <svg class="w-3.5 h-3.5 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="truncate">{{ $tour->destination ? $tour->destination->localized_name : __('tours.international_tour') }}</span>
            </div>
            
            <!-- Tour Title -->
            <h3 class="text-sm sm:text-base md:text-[17px] font-bold font-serif text-[#0B1F3A] leading-snug mb-2 group-hover:text-[#D4AF37] transition-colors line-clamp-2">
                <a href="{{ route('tours.show', $tour->slug) }}">
                    {{ $tour->localized_title }}
                </a>
            </h3>

            <!-- Short Description -->
            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed font-normal mb-3.5">
                {{ $tour->localized_short_description }}
            </p>

            <!-- Quick Inclusions Highlights -->
            <div class="flex items-center flex-wrap gap-1.5 sm:gap-2 pt-2 border-t border-slate-100 text-[10.5px] sm:text-[11px] font-medium text-slate-600">
                <span class="inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>{{ app()->getLocale() === 'bn' ? '৪/৫★ হোটেল' : '4/5★ Stays' }}</span>
                </span>
                <span class="text-slate-300">•</span>
                <span class="inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'ট্রান্সফার' : 'Transfers' }}</span>
                </span>
                <span class="text-slate-300">•</span>
                <span class="inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    <span>{{ app()->getLocale() === 'bn' ? 'সাইটসিয়িং' : 'Sightseeing' }}</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Card Footer & Pricing -->
    <div class="px-4 sm:px-5 md:px-6 py-3.5 sm:py-4 bg-slate-50/70 border-t border-slate-100 flex items-center justify-between gap-2.5">
        <div class="min-w-0">
            <span class="text-[9.5px] sm:text-[10px] uppercase font-bold text-slate-400 tracking-wider block leading-none mb-1">{{ __('tours.starting_from') }}</span>
            <div class="text-sm sm:text-base md:text-lg font-extrabold text-[#0B1F3A] font-serif truncate">
                {{ $tour->formatted_price }}
            </div>
        </div>

        <a href="{{ route('tours.show', $tour->slug) }}" class="btn btn-gold px-3 sm:px-3.5 py-2 min-h-[38px] rounded-xl text-xs uppercase tracking-wider font-bold shadow-sm flex items-center gap-1.5 group-hover:shadow-md transition-all flex-shrink-0">
            <span>{{ __('tours.explore') }}</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</div>


