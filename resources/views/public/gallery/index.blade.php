@extends('layouts.app')

@section('title', 'Photo Gallery & Tour Memories | Emisha Tours & Travels')
@section('meta_description', 'Explore mesmerizing travel photographs, tourist memories, scenic destinations, and cultural experiences captured across our global tours.')
@section('canonical_url', route('gallery.index'))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- =========================================================================
     01. LUXURY HERO BANNER
     ========================================================================= -->
<div class="bg-gradient-to-b from-[#071324] via-[#0B1F3A] to-[#071324] text-white py-16 sm:py-20 lg:py-24 relative overflow-hidden">
    <!-- Ambient Lighting Accents -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-custom relative z-10 text-center">
        <!-- Breadcrumbs -->
        <nav class="flex items-center justify-center gap-2 text-xs text-slate-400 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('nav.home') }}</a>
            <span>/</span>
            <span class="text-[#D4AF37] font-semibold">{{ app()->getLocale() === 'bn' ? 'ফটোগ্যালারি' : 'Photo Gallery' }}</span>
        </nav>

        <!-- Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-[#D4AF37]/30 text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-md shadow-xs">
            <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
            <span>{{ app()->getLocale() === 'bn' ? 'ভ্রমণের দৃশ্যপট ও সোনালী স্মৃতি' : 'Visual Journeys & Memories' }}</span>
        </div>

        <!-- Heading & Intro -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-serif tracking-tight text-white mb-4">
            @if(app()->getLocale() === 'bn')
                ট্যুর গ্যালারি ও <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] via-amber-200 to-[#D4AF37]">স্মরণীয় ভ্রমণ মুহূর্ত</span>
            @else
                Travel Gallery & <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] via-amber-200 to-[#D4AF37]">Global Memories</span>
            @endif
        </h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-sm sm:text-base lg:text-lg font-light leading-relaxed mb-10">
            {{ app()->getLocale() === 'bn' 
                ? 'আমাদের আন্তর্জাতিক গ্রুপ ট্যুর, বিলাসবহুল আইল্যান্ড রিসোর্ট এবং ভিআইপি পারিবারিক সফরের মনোরম চিত্র ও মধুর স্মৃতি।' 
                : 'Real snapshots of serenity, joy, and breathtaking adventures from our international group tours, tropical island retreats, and VIP private itineraries.' }}
        </p>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto pt-6 border-t border-white/10">
            <div class="p-3">
                <div class="text-xl sm:text-2xl font-extrabold font-serif text-[#D4AF37]">500+</div>
                <div class="text-[11px] sm:text-xs text-slate-400 uppercase tracking-wider font-medium mt-0.5">{{ app()->getLocale() === 'bn' ? 'ট্যুর স্মৃতি' : 'Tour Memories' }}</div>
            </div>
            <div class="p-3">
                <div class="text-xl sm:text-2xl font-extrabold font-serif text-[#D4AF37]">24+</div>
                <div class="text-[11px] sm:text-xs text-slate-400 uppercase tracking-wider font-medium mt-0.5">{{ app()->getLocale() === 'bn' ? 'গন্তব্য' : 'Destinations' }}</div>
            </div>
            <div class="p-3">
                <div class="text-xl sm:text-2xl font-extrabold font-serif text-[#D4AF37]">100%</div>
                <div class="text-[11px] sm:text-xs text-slate-400 uppercase tracking-wider font-medium mt-0.5">{{ app()->getLocale() === 'bn' ? 'আরামদায়ক হোটেল' : 'Authentic Stays' }}</div>
            </div>
            <div class="p-3">
                <div class="text-xl sm:text-2xl font-extrabold font-serif text-[#D4AF37]">4.9★</div>
                <div class="text-[11px] sm:text-xs text-slate-400 uppercase tracking-wider font-medium mt-0.5">{{ app()->getLocale() === 'bn' ? 'গ্রাহক সন্তুষ্টি' : 'Traveler Rating' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     02. GALLERY SECTION & INTERACTIVE FILTER
     ========================================================================= -->
<div class="bg-[#F8FAFC] py-14 sm:py-20">
    <div class="container-custom">

        <!-- Controls: Category Filters + Live Search -->
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6 mb-12">
            
            <!-- Category Tabs -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2" id="filter-tabs">
                <button onclick="filterGallery('all', event)" 
                        class="gallery-filter-btn active px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 bg-[#0B1F3A] text-[#D4AF37] border border-[#0B1F3A] shadow-md shadow-[#0B1F3A]/20 cursor-pointer">
                    {{ app()->getLocale() === 'bn' ? 'সব ছবি' : 'All Photos' }} (<span id="total-count">{{ $images->total() > 0 ? $images->total() : ($images->count() > 0 ? $images->count() : 12) }}</span>)
                </button>

                @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                        <button onclick="filterGallery('cat-{{ $category->id }}', event)" 
                                class="gallery-filter-btn px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 bg-white text-slate-600 hover:text-[#0B1F3A] hover:bg-slate-100/80 border border-slate-200/80 shadow-xs cursor-pointer">
                            {{ $category->localized_name ?? $category->name }}
                        </button>
                    @endforeach
                @else
                    <button onclick="filterGallery('cat-island', event)" class="gallery-filter-btn px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-white text-slate-600 border border-slate-200 shadow-xs">
                        {{ app()->getLocale() === 'bn' ? 'আইল্যান্ড ও সৈকত' : 'Island & Beach' }}
                    </button>
                    <button onclick="filterGallery('cat-cultural', event)" class="gallery-filter-btn px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-white text-slate-600 border border-slate-200 shadow-xs">
                        {{ app()->getLocale() === 'bn' ? 'ঐতিহ্য ও নগর' : 'Cultural & City' }}
                    </button>
                    <button onclick="filterGallery('cat-memories', event)" class="gallery-filter-btn px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-white text-slate-600 border border-slate-200 shadow-xs">
                        {{ app()->getLocale() === 'bn' ? 'গ্রাহকদের স্মৃতি' : 'Client Memories' }}
                    </button>
                @endif
            </div>

            <!-- Instant Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" 
                       id="gallery-search" 
                       placeholder="{{ app()->getLocale() === 'bn' ? 'গন্তব্য, শহর বা ট্যুর খুঁজুন...' : 'Search destination, city, tour...' }}" 
                       onkeyup="searchGallery(this.value)"
                       class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200/90 rounded-xl text-xs text-[#0B1F3A] placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/50 focus:border-[#D4AF37] shadow-xs transition-all">
            </div>

        </div>

        <!-- Photo Grid (Balanced Symmetrical 4:5 Aspect Ratio Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
            
            @if($images->count() > 0)
                @foreach($images as $idx => $image)
                    <div class="gallery-item cat-{{ $image->gallery_category_id ?? 'all' }} group relative rounded-[24px] overflow-hidden bg-[#0B1F3A] border border-slate-200/80 hover:border-[#D4AF37]/60 shadow-[0_8px_24px_rgba(11,31,58,0.06)] hover:shadow-[0_20px_40px_rgba(11,31,58,0.16)] transition-all duration-500 hover:-translate-y-1.5 aspect-[4/5] flex flex-col justify-between cursor-pointer"
                         data-title="{{ $image->title }}"
                         data-location="{{ $image->location ?? 'Global Destination' }}"
                         data-caption="{{ $image->caption ?? '' }}"
                         data-src="{{ $image->image_url }}"
                         data-category="{{ $image->category->name ?? 'Emisha Tour' }}"
                         onclick="openLightbox({{ $idx }})">
                        
                        <!-- High Resolution Image -->
                        <img src="{{ $image->image_url }}" 
                             alt="{{ $image->alt_text ?? $image->title }}" 
                             class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-out"
                             loading="lazy">

                        <!-- Ambient Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#071527] via-[#0B1F3A]/40 to-black/20 opacity-60 group-hover:opacity-90 transition-opacity duration-300"></div>

                        <!-- Top Floating Metadata -->
                        <div class="relative z-10 p-4 sm:p-5 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-[10px] font-semibold">
                                <svg class="w-3 h-3 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $image->location ?? 'Global Tour' }}</span>
                            </span>

                            @if($image->category)
                                <span class="px-2.5 py-0.5 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[10px] font-bold shadow-xs">
                                    {{ $image->category->name }}
                                </span>
                            @endif
                        </div>

                        <!-- Quick View Center Action Trigger -->
                        <div class="absolute inset-0 z-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <span class="w-12 h-12 rounded-full bg-[#0B1F3A]/80 backdrop-blur-md border border-[#D4AF37]/60 text-[#D4AF37] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </span>
                        </div>

                        <!-- Bottom Card Caption Details -->
                        <div class="relative z-10 p-5 text-white space-y-1.5 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="font-bold font-serif text-sm sm:text-base text-white leading-snug line-clamp-1 group-hover:text-[#D4AF37] transition-colors">
                                {{ $image->title }}
                            </h3>
                            @if($image->caption)
                                <p class="text-[11px] text-slate-300 line-clamp-2 leading-relaxed font-light">
                                    {{ $image->caption }}
                                </p>
                            @endif
                            <div class="pt-2 flex items-center justify-between text-[11px] font-bold text-[#D4AF37]">
                                <span class="inline-flex items-center gap-1">
                                    <span>View Photo Story</span>
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </div>
                        </div>

                    </div>
                @endforeach
            @else
                <!-- Fallback Curated Photo Matrix -->
                @php
                    $samplePhotos = [
                        ['src' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Maldives Overwater Luxury Lagoon', 'location' => 'South Ari Atoll, Maldives', 'cat' => 'Island & Beach', 'cat_class' => 'cat-island', 'caption' => 'Turquoise crystal ocean with private overwater sundeck and coral reef snorkeling.'],
                        ['src' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Phi Phi Islands Speedboat Cruise', 'location' => 'Phuket, Thailand', 'cat' => 'Island & Beach', 'cat_class' => 'cat-island', 'caption' => 'Cruising Maya Bay and Pileh Lagoon with emerald turquoise lagoons and limestone cliffs.'],
                        ['src' => 'https://images.unsplash.com/photo-1451337516015-6b6e9a44a8a3?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Lahbab Red Desert Safari', 'location' => 'Lahbab Desert, Dubai', 'cat' => 'International', 'cat_class' => 'cat-cultural', 'caption' => 'Thrilling 4x4 dune bashing, camel riding, and VIP BBQ dinner under the desert stars.'],
                        ['src' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Wat Arun Temple of Dawn', 'location' => 'Bangkok, Thailand', 'cat' => 'Cultural & City', 'cat_class' => 'cat-cultural', 'caption' => 'Iconic riverside Khmer-style porcelain spire glowing during sunset at Chao Phraya River.'],
                        ['src' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Downtown Dubai & Burj Khalifa', 'location' => 'Dubai, UAE', 'cat' => 'Cultural & City', 'cat_class' => 'cat-cultural', 'caption' => 'World-famous futuristic skyline and choreographed Dubai Fountain spectacle.'],
                        ['src' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Petronas Twin Towers Illumination', 'location' => 'Kuala Lumpur, Malaysia', 'cat' => 'Cultural & City', 'cat_class' => 'cat-cultural', 'caption' => 'Stunning 88-storey architectural masterpiece illuminated in the heart of KLCC.'],
                        ['src' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Bali Ubud Lush Rice Terraces', 'location' => 'Ubud, Bali, Indonesia', 'cat' => 'Island & Beach', 'cat_class' => 'cat-island', 'caption' => 'Serene emerald green Tegallalang rice paddies, traditional culture, and tropical nature.'],
                        ['src' => 'https://images.unsplash.com/photo-1570939274717-7eda259b50ed?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Cappadocia Sunrise Hot Air Balloons', 'location' => 'Göreme, Cappadocia, Turkey', 'cat' => 'International', 'cat_class' => 'cat-cultural', 'caption' => 'Fairy-tale landscape filled with hundreds of colorful hot air balloons rising over fairy chimneys.'],
                        ['src' => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Swiss Alps Panoramic Mountain Vista', 'location' => 'Jungfrau Region, Switzerland', 'cat' => 'International', 'cat_class' => 'cat-cultural', 'caption' => 'Majestic snow-capped alpine peaks, scenic cogwheel trains, and pristine mountain air.'],
                        ['src' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Happy Family Vacation in Coral Island', 'location' => 'Pattaya, Thailand', 'cat' => 'Client Memories', 'cat_class' => 'cat-memories', 'caption' => 'Capturing unforgettable smiling moments during our private customized family tour package.'],
                        ['src' => 'https://images.unsplash.com/photo-1608958435020-e8a7109ba809?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Cox\'s Bazar Marine Drive Golden Sunset', 'location' => 'Cox\'s Bazar, Bangladesh', 'cat' => 'Client Memories', 'cat_class' => 'cat-memories', 'caption' => 'Breathtaking crimson sunset overlooking the world’s longest natural sea beach.'],
                        ['src' => 'https://images.unsplash.com/photo-1565552684305-7e77f250353a?auto=format&fit=crop&w=1200&h=1500&q=85', 'title' => 'Holy Makkah Masjid Al-Haram', 'location' => 'Makkah, Saudi Arabia', 'cat' => 'Umrah Sacred', 'cat_class' => 'cat-cultural', 'caption' => 'Peaceful spiritual atmosphere at the Holy Kaaba during premium VIP Umrah pilgrimage.'],
                    ];
                @endphp
                @foreach($samplePhotos as $sIdx => $s)
                    <div class="gallery-item {{ $s['cat_class'] }} group relative rounded-[24px] overflow-hidden bg-[#0B1F3A] border border-slate-200/80 hover:border-[#D4AF37]/60 shadow-[0_8px_24px_rgba(11,31,58,0.06)] hover:shadow-[0_20px_40px_rgba(11,31,58,0.16)] transition-all duration-500 hover:-translate-y-1.5 aspect-[4/5] flex flex-col justify-between cursor-pointer"
                         data-title="{{ $s['title'] }}"
                         data-location="{{ $s['location'] }}"
                         data-caption="{{ $s['caption'] }}"
                         data-src="{{ $s['src'] }}"
                         data-category="{{ $s['cat'] }}"
                         onclick="openLightbox({{ $sIdx }})">
                        
                        <img src="{{ $s['src'] }}" 
                             alt="{{ $s['title'] }}" 
                             class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-out"
                             loading="lazy">

                        <div class="absolute inset-0 bg-gradient-to-t from-[#071527] via-[#0B1F3A]/40 to-black/20 opacity-60 group-hover:opacity-90 transition-opacity duration-300"></div>

                        <div class="relative z-10 p-4 sm:p-5 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-[10px] font-semibold">
                                <svg class="w-3 h-3 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $s['location'] }}</span>
                            </span>

                            <span class="px-2.5 py-0.5 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-[10px] font-bold shadow-xs">
                                {{ $s['cat'] }}
                            </span>
                        </div>

                        <div class="absolute inset-0 z-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <span class="w-12 h-12 rounded-full bg-[#0B1F3A]/80 backdrop-blur-md border border-[#D4AF37]/60 text-[#D4AF37] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </span>
                        </div>

                        <div class="relative z-10 p-5 text-white space-y-1.5 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="font-bold font-serif text-sm sm:text-base text-white leading-snug line-clamp-1 group-hover:text-[#D4AF37] transition-colors">
                                {{ $s['title'] }}
                            </h3>
                            <p class="text-[11px] text-slate-300 line-clamp-2 leading-relaxed font-light">
                                {{ $s['caption'] }}
                            </p>
                            <div class="pt-2 flex items-center justify-between text-[11px] font-bold text-[#D4AF37]">
                                <span class="inline-flex items-center gap-1">
                                    <span>View Photo Story</span>
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif

        </div>

        <!-- No Results Box -->
        <div id="no-results" class="hidden text-center py-16 bg-white rounded-3xl border border-slate-200/80 shadow-xs max-w-md mx-auto my-8">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-[#D4AF37] flex items-center justify-center mx-auto mb-4 border border-amber-200/60">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h3 class="font-bold font-serif text-lg text-[#0B1F3A] mb-1">No Photos Found</h3>
            <p class="text-xs text-slate-500 mb-4">Try adjusting your filter or search keywords.</p>
            <button onclick="resetGalleryFilters()" class="btn btn-secondary btn-sm rounded-xl font-bold text-xs px-4 py-2">
                Reset All Filters
            </button>
        </div>

        <!-- Pagination (if applicable) -->
        @if($images->hasPages())
            <div class="mt-14 flex justify-center">
                {{ $images->links() }}
            </div>
        @endif

    </div>
</div>

<!-- =========================================================================
     03. TRAVEL WITH US CTA BANNER
     ========================================================================= -->
<div class="bg-[#0B1F3A] text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="container-custom relative z-10">
        <div class="bg-gradient-to-r from-white/5 to-white/[0.02] rounded-3xl p-8 sm:p-12 border border-[#D4AF37]/30 backdrop-blur-md flex flex-col lg:flex-row items-center justify-between gap-8 text-center lg:text-left">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-[#D4AF37]/20 text-[#D4AF37] uppercase tracking-wider mb-3">
                    Personalized Vacations
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-white mb-2">
                    Want to create your own travel memories?
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-light">
                    From customized visa processing to luxury overwater villas and flight booking, our travel specialists will craft your perfect itinerary.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                <a href="{{ route('tours.index') }}" class="btn btn-primary rounded-xl font-bold text-xs sm:text-sm px-6 py-3.5 shadow-md flex items-center justify-center gap-2">
                    <span>Explore Tour Packages</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="https://wa.me/8801805464291?text=Hello%20Emisha%20Tours,%20I%20would%20like%20to%20plan%20a%20tour%20package." target="_blank" rel="noopener" class="px-6 py-3.5 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                    <span>Chat on WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     04. INTERACTIVE FULLSCREEN LIGHTBOX MODAL
     ========================================================================= -->
<div id="gallery-lightbox" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-xl flex flex-col justify-between p-4 sm:p-6 transition-all duration-300">
    
    <!-- Top Modal Header Bar -->
    <div class="flex items-center justify-between z-20">
        <div class="flex items-center gap-3">
            <span id="modal-counter" class="px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-mono text-[#D4AF37]">
                1 / 12
            </span>
            <span id="modal-category" class="hidden sm:inline-block px-3 py-1 rounded-full bg-[#D4AF37] text-[#0B1F3A] text-xs font-extrabold">
                Island Escape
            </span>
        </div>

        <div class="flex items-center gap-3">
            <a id="modal-whatsapp-btn" href="#" target="_blank" rel="noopener" class="hidden sm:inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span>Inquire on WhatsApp</span>
            </a>
            <button onclick="closeLightbox()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-white flex items-center justify-center transition-colors cursor-pointer" aria-label="Close Lightbox">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Center Stage: Image + Navigation Arrows -->
    <div class="relative flex-1 flex items-center justify-center my-2 sm:my-4 overflow-hidden">
        
        <!-- Prev Arrow -->
        <button onclick="prevPhoto()" class="absolute left-1 sm:left-6 z-30 w-9 h-9 sm:w-12 sm:h-12 rounded-full bg-black/60 hover:bg-[#D4AF37] text-white hover:text-[#0B1F3A] border border-white/20 hover:border-[#D4AF37] flex items-center justify-center transition-all duration-200 cursor-pointer shadow-lg" aria-label="Previous Photo">
            <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        <!-- Main Photo -->
        <div class="relative max-h-[75vh] max-w-[90vw] sm:max-w-4xl flex items-center justify-center">
            <img id="modal-img" src="" alt="" class="max-h-[70vh] sm:max-h-[72vh] max-w-full rounded-xl sm:rounded-2xl object-contain shadow-2xl transition-all duration-300 border border-white/10">
        </div>

        <!-- Next Arrow -->
        <button onclick="nextPhoto()" class="absolute right-1 sm:right-6 z-30 w-9 h-9 sm:w-12 sm:h-12 rounded-full bg-black/60 hover:bg-[#D4AF37] text-white hover:text-[#0B1F3A] border border-white/20 hover:border-[#D4AF37] flex items-center justify-center transition-all duration-200 cursor-pointer shadow-lg" aria-label="Next Photo">
            <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    <!-- Bottom Caption Bar -->
    <div class="max-w-3xl mx-auto w-full text-center z-20 pb-2">
        <div class="flex items-center justify-center gap-1.5 text-xs font-semibold text-[#D4AF37] uppercase tracking-wider mb-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span id="modal-location">Phuket, Thailand</span>
        </div>
        <h2 id="modal-title" class="text-lg sm:text-xl font-bold font-serif text-white mb-1.5">
            Phi Phi Island Speedboat Cruise
        </h2>
        <p id="modal-caption" class="text-xs sm:text-sm text-slate-300 font-light max-w-xl mx-auto line-clamp-2">
            Crystal turquoise lagoon, Maya Bay sightseeing, Pileh Lagoon swimming & luxury speedboat transfer.
        </p>
    </div>

</div>

<!-- =========================================================================
     05. JAVASCRIPT LOGIC
     ========================================================================= -->
<script>
let currentPhotoIndex = 0;
let visibleItems = [];

function collectVisibleItems() {
    const allItems = Array.from(document.querySelectorAll('.gallery-item'));
    return allItems.filter(item => item.style.display !== 'none');
}

function filterGallery(categoryClass, event) {
    const items = document.querySelectorAll('.gallery-item');
    const buttons = document.querySelectorAll('.gallery-filter-btn');
    const noResults = document.getElementById('no-results');

    buttons.forEach(btn => {
        btn.classList.remove('bg-[#0B1F3A]', 'text-[#D4AF37]', 'shadow-md', 'shadow-[#0B1F3A]/20', 'border-[#0B1F3A]', 'active');
        btn.classList.add('bg-white', 'text-slate-600', 'border-slate-200/80');
    });

    if (event && event.currentTarget) {
        event.currentTarget.classList.add('bg-[#0B1F3A]', 'text-[#D4AF37]', 'shadow-md', 'shadow-[#0B1F3A]/20', 'border-[#0B1F3A]', 'active');
        event.currentTarget.classList.remove('bg-white', 'text-slate-600', 'border-slate-200/80');
    }

    let matchCount = 0;
    items.forEach(item => {
        if (categoryClass === 'all' || item.classList.contains(categoryClass)) {
            item.style.display = 'flex';
            matchCount++;
        } else {
            item.style.display = 'none';
        }
    });

    if (noResults) {
        noResults.classList.toggle('hidden', matchCount > 0);
    }
}

function searchGallery(query) {
    const items = document.querySelectorAll('.gallery-item');
    const noResults = document.getElementById('no-results');
    const q = query.trim().toLowerCase();

    let matchCount = 0;
    items.forEach(item => {
        const title = (item.getAttribute('data-title') || '').toLowerCase();
        const location = (item.getAttribute('data-location') || '').toLowerCase();
        const caption = (item.getAttribute('data-caption') || '').toLowerCase();
        const category = (item.getAttribute('data-category') || '').toLowerCase();

        if (!q || title.includes(q) || location.includes(q) || caption.includes(q) || category.includes(q)) {
            item.style.display = 'flex';
            matchCount++;
        } else {
            item.style.display = 'none';
        }
    });

    if (noResults) {
        noResults.classList.toggle('hidden', matchCount > 0);
    }
}

function resetGalleryFilters() {
    document.getElementById('gallery-search').value = '';
    const allBtn = document.querySelector('.gallery-filter-btn');
    if (allBtn) allBtn.click();
}

function openLightbox(index) {
    visibleItems = collectVisibleItems();
    if (visibleItems.length === 0) return;

    currentPhotoIndex = index % visibleItems.length;
    updateLightboxContent();

    const lightbox = document.getElementById('gallery-lightbox');
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('gallery-lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
}

function updateLightboxContent() {
    visibleItems = collectVisibleItems();
    if (!visibleItems[currentPhotoIndex]) return;

    const item = visibleItems[currentPhotoIndex];
    const src = item.getAttribute('data-src') || '';
    const title = item.getAttribute('data-title') || '';
    const location = item.getAttribute('data-location') || '';
    const caption = item.getAttribute('data-caption') || '';
    const category = item.getAttribute('data-category') || 'Tour';

    document.getElementById('modal-img').src = src;
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-location').textContent = location;
    document.getElementById('modal-caption').textContent = caption;
    document.getElementById('modal-category').textContent = category;
    document.getElementById('modal-counter').textContent = `${currentPhotoIndex + 1} / ${visibleItems.length}`;

    const waMsg = encodeURIComponent(`Hello Emisha Tours, I am interested in this destination: ${title} (${location}). Please share tour details.`);
    document.getElementById('modal-whatsapp-btn').href = `https://wa.me/8801805464291?text=${waMsg}`;
}

function nextPhoto() {
    visibleItems = collectVisibleItems();
    if (visibleItems.length === 0) return;
    currentPhotoIndex = (currentPhotoIndex + 1) % visibleItems.length;
    updateLightboxContent();
}

function prevPhoto() {
    visibleItems = collectVisibleItems();
    if (visibleItems.length === 0) return;
    currentPhotoIndex = (currentPhotoIndex - 1 + visibleItems.length) % visibleItems.length;
    updateLightboxContent();
}

// Keyboard Listeners
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('gallery-lightbox');
    if (!lightbox || lightbox.classList.contains('hidden')) return;

    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight') nextPhoto();
    if (e.key === 'ArrowLeft') prevPhoto();
});
</script>
@endsection
