@props(['destination'])

<a href="{{ route('destinations.show', $destination->slug) }}" class="destination-card block group relative aspect-[16/11] rounded-[24px] overflow-hidden shadow-[0_4px_20px_rgba(11,31,58,0.06)] hover:shadow-[0_20px_40px_rgba(11,31,58,0.15)] transition-all duration-300">
    <img 
        src="{{ $destination->thumbnail ?: $destination->hero_image ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80' }}" 
        alt="{{ $destination->localized_name }}" 
        class="destination-card-img w-full h-full object-cover group-hover:scale-106 transition-transform duration-700 ease-out"
        loading="lazy"
    >
    <div class="destination-card-overlay absolute inset-0 bg-gradient-to-t from-[#0B1F3A]/90 via-[#0B1F3A]/30 to-transparent flex flex-col justify-end p-4 sm:p-5 md:p-6 text-white">
        <h3 class="destination-card-name text-lg sm:text-xl md:text-2xl font-bold font-serif group-hover:text-[#D4AF37] transition-colors mb-1 truncate">
            {{ $destination->localized_name }}
        </h3>
        <div class="destination-card-count flex items-center justify-between text-[11.5px] sm:text-xs text-white/80">
            <span>{{ $destination->tours_count ?? $destination->tours()->count() }} {{ __('destinations.tour_packages') }}</span>
            <span class="inline-flex items-center gap-1 font-semibold text-[#D4AF37] group-hover:translate-x-1 transition-transform flex-shrink-0">
                <span>{{ __('common.explore') }}</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        </div>
    </div>
</a>

