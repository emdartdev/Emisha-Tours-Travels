@extends('layouts.app')

@section('title', 'Travel Stories, Visa Guides & Insider Advice | Emisha Tours & Travels')
@section('meta_description', 'Read insightful travel guides, international visa policies, packing tips, and inspiring destination itineraries written by Bangladesh travel specialists.')

@section('content')
<!-- Hero Section -->
<div class="bg-[#0B1F3A] py-14 lg:py-20 text-white relative overflow-hidden">
    <!-- Ambient Blur Backgrounds -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#D4AF37]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#071527] via-[#0B1F3A] to-[#071527] opacity-95"></div>

    <div class="container-custom relative z-10 text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 border border-white/20 text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-4">
            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <span>Curated Travel Journal & Insider Insights</span>
        </div>
        
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 text-white font-serif tracking-tight leading-tight">
            Stories of Discovery, <br class="hidden sm:inline">
            <span class="text-gradient-gold">Guides & Travel Advice</span>
        </h1>
        
        <p class="text-slate-200 text-xs sm:text-sm md:text-base leading-relaxed font-light mb-8 max-w-2xl mx-auto">
            Stay ahead with verified visa regulations, flight booking hacks, seasonal destination itineraries, and cultural insights crafted by Bangladesh travel specialists.
        </p>

        <!-- 3 Quick Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-left max-w-2xl mx-auto">
            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3.5 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0 text-sm">
                    ✦
                </span>
                <div>
                    <div class="font-bold text-white text-xs">Expert Guides</div>
                    <div class="text-[10.5px] text-slate-300">Researched & Verified</div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3.5 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </span>
                <div>
                    <div class="font-bold text-white text-xs">Visa Rules</div>
                    <div class="text-[10.5px] text-slate-300">Embassy Compliant</div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3.5 flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <div>
                    <div class="font-bold text-white text-xs">Weekly Updates</div>
                    <div class="text-[10.5px] text-slate-300">Latest Travel News</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-padding bg-[#F8FAFC]">
    <div class="container-custom">
        <!-- Category & Search Toolbar -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-[0_2px_16px_rgba(11,31,58,0.03)] mb-10 flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Category Pills -->
            <div class="flex items-center gap-1.5 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 scrollbar-none text-xs">
                <a href="{{ route('blog.index') }}" 
                   class="px-4 py-2 rounded-xl transition-all whitespace-nowrap {{ !request('category') ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                    All Articles
                </a>
                @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug, 'search' => request('search')]) }}" 
                           class="px-4 py-2 rounded-xl transition-all whitespace-nowrap {{ request('category') == $category->slug ? 'bg-[#0B1F3A] text-white font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- Search Form -->
            <form action="{{ route('blog.index') }}" method="GET" class="relative w-full md:w-72">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search articles, tips, visa..." 
                    class="w-full bg-slate-50 border border-slate-200/90 rounded-xl pl-9 pr-8 py-2 text-xs text-[#0B1F3A] focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] transition"
                >
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                @if(request('search'))
                    <a href="{{ route('blog.index', ['category' => request('category')]) }}" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 text-xs font-bold">
                        ✕
                    </a>
                @endif
            </form>
        </div>

        @if($posts->count() > 0)
            @php
                $isFirstPage = $posts->currentPage() === 1 && !request('search') && !request('category');
                $featuredPost = $isFirstPage ? $posts->first() : null;
                $gridPosts = $isFirstPage ? $posts->slice(1) : $posts;
            @endphp

            <!-- 1. Featured Lead Story (Creative Magazine Centerpiece) -->
            @if($featuredPost)
                <div class="mb-12">
                    <article class="bg-white rounded-[28px] overflow-hidden border border-slate-200/80 shadow-[0_4px_28px_rgba(11,31,58,0.04)] hover:shadow-[0_20px_45px_rgba(11,31,58,0.1)] transition-all duration-500 group grid grid-cols-1 lg:grid-cols-12 items-stretch">
                        <!-- Left Media -->
                        <a href="{{ route('blog.show', $featuredPost->slug) }}" class="lg:col-span-7 relative h-72 sm:h-96 lg:h-full min-h-[320px] overflow-hidden bg-slate-100 block">
                            <img 
                                src="{{ $featuredPost->featured_image ?? 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200' }}" 
                                alt="{{ $featuredPost->title }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent lg:hidden"></div>
                            
                            @if($featuredPost->category)
                                <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#0B1F3A]/90 backdrop-blur-md text-[#D4AF37] text-[11px] font-bold uppercase tracking-wider border border-[#D4AF37]/30 shadow-md">
                                    <span>★</span>
                                    <span>{{ $featuredPost->category->name }}</span>
                                </span>
                            @endif
                        </a>

                        <!-- Right Narrative Details -->
                        <div class="lg:col-span-5 p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-3 font-medium">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#D4AF37]/10 text-[#927513] text-[10.5px] font-bold">
                                        Featured Story
                                    </span>
                                    <span>•</span>
                                    <span>{{ $featuredPost->published_at ? $featuredPost->published_at->format('M d, Y') : $featuredPost->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $featuredPost->reading_time ?? '5' }} min read</span>
                                </div>

                                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold font-serif text-[#0B1F3A] group-hover:text-[#D4AF37] transition-colors duration-300 mb-3.5 leading-snug">
                                    <a href="{{ route('blog.show', $featuredPost->slug) }}">
                                        {{ $featuredPost->title }}
                                    </a>
                                </h2>

                                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-6 line-clamp-3 font-normal">
                                    {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}
                                </p>
                            </div>

                            <div class="pt-5 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center font-bold text-xs shadow-xs">
                                        E
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-[#0B1F3A] block">Emisha Tours & Travels</span>
                                        <span class="text-[10px] text-slate-400">Senior Travel Specialist</span>
                                    </div>
                                </div>

                                <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-primary btn-sm rounded-xl px-4 py-2 text-xs font-bold shadow-xs flex items-center gap-1">
                                    <span>Read Story</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @endif

            <!-- 2. Minimal 3-Column Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($gridPosts as $post)
                    <article class="bg-white rounded-[24px] overflow-hidden border border-slate-200/80 hover:border-[#D4AF37]/50 shadow-[0_2px_14px_rgba(11,31,58,0.03)] hover:shadow-[0_16px_36px_rgba(11,31,58,0.09)] transition-all duration-400 hover:-translate-y-1.5 flex flex-col justify-between group">
                        <div>
                            <!-- Article Cover Image -->
                            <a href="{{ route('blog.show', $post->slug) }}" class="relative aspect-[16/10] overflow-hidden bg-slate-100 block">
                                <img 
                                    src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800' }}" 
                                    alt="{{ $post->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    loading="lazy"
                                >
                                @if($post->category)
                                    <span class="absolute top-3.5 left-3.5 bg-[#0B1F3A]/90 backdrop-blur-md text-[#D4AF37] text-[10.5px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-[#D4AF37]/30 shadow-xs">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </a>

                            <!-- Article Text Content -->
                            <div class="p-6">
                                <div class="flex items-center gap-2 text-xs text-slate-400 mb-2.5 font-medium">
                                    <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $post->reading_time ?? '5' }} min read</span>
                                </div>

                                <h3 class="text-base sm:text-lg font-bold font-serif text-[#0B1F3A] group-hover:text-[#D4AF37] transition-colors duration-300 line-clamp-2 mb-2 leading-snug">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 font-normal">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 110) }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-6 pt-0 flex items-center justify-between border-t border-slate-100 mt-2">
                            <div class="flex items-center gap-2 pt-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center text-xs font-bold shadow-2xs">
                                    E
                                </div>
                                <span class="text-xs font-semibold text-slate-700">Emisha Tours & Travels</span>
                            </div>

                            <a href="{{ route('blog.show', $post->slug) }}" class="pt-3 text-xs font-bold text-[#0B1F3A] group-hover:text-[#D4AF37] flex items-center gap-1 transition-colors">
                                <span>Read</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-[26px] p-12 text-center border border-slate-200/80 shadow-[0_4px_24px_rgba(11,31,58,0.04)] max-w-md mx-auto">
                <div class="w-14 h-14 rounded-2xl bg-[#D4AF37]/15 text-[#0B1F3A] flex items-center justify-center mx-auto mb-4 border border-[#D4AF37]/30">
                    <svg class="w-7 h-7 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <h3 class="text-lg font-bold font-serif text-[#0B1F3A] mb-1.5">No Articles Found</h3>
                <p class="text-slate-500 text-xs mb-6 leading-relaxed">We couldn't find any articles matching your search criteria. Try a different keyword or explore all categories.</p>
                <a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm rounded-xl px-5 py-2.5 text-xs font-bold">
                    <span>View All Articles</span>
                </a>
            </div>
        @endif

        <!-- Newsletter & Travel Assistance Banner -->
        <div class="mt-14 rounded-[26px] bg-[#0B1F3A] text-white p-6 sm:p-9 flex flex-col md:flex-row items-center justify-between gap-6 border border-[#D4AF37]/30 shadow-xl relative overflow-hidden">
            <div class="relative z-10 max-w-xl">
                <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-wider block mb-1">Stay Inspired</span>
                <h3 class="text-xl sm:text-2xl font-bold font-serif text-white mb-1.5">
                    Need Customized Itinerary or Visa Planning?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-light">
                    Speak directly with our destination experts for tailored family holiday packages and embassy visa consultation.
                </p>
            </div>
            <div class="flex items-center gap-3 relative z-10 flex-shrink-0">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('contact_whatsapp', '+8801805464291')) }}?text=Hello%20Emisha%20Tours,%20I%20have%20an%20inquiry%20regarding%20travel%20and%20tours." target="_blank" class="btn btn-whatsapp btn-sm rounded-xl px-5 py-3 text-xs font-bold flex items-center gap-2 shadow-md">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>WhatsApp Travel Desk</span>
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-white btn-sm rounded-xl px-5 py-3 text-xs font-bold">
                    <span>Contact Us</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


