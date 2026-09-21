@extends('layouts.app')

@section('title', ($post->meta_title ?? $post->localized_title) . ' | Emisha Tours & Travels')
@section('meta_description', $post->meta_description ?? $post->localized_excerpt ?? Str::limit(strip_tags($post->localized_content), 150))
@section('canonical_url', route('blog.show', $post->slug))
@section('og_type', 'article')
@section('og_image', $post->featured_image ? url($post->featured_image) : asset('images/logo.png'))

@section('schema')
@if(!empty($schema))
    {!! $schema !!}
@endif
@endsection

@section('content')
<!-- Breadcrumbs -->
<div class="bg-slate-50 border-b border-slate-100 py-3.5 text-xs text-slate-500 font-medium">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-gold transition">{{ __('nav.home') }}</a>
        <span class="text-slate-300">/</span>
        <a href="{{ route('blog.index') }}" class="hover:text-gold transition">{{ __('nav.blog') }}</a>
        <span class="text-slate-300">/</span>
        @if($post->category)
            <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="hover:text-gold transition">{{ $post->category->localized_name }}</a>
            <span class="text-slate-300">/</span>
        @endif
        <span class="text-[#0B1F3A] font-semibold truncate max-w-xs sm:max-w-md">{{ $post->localized_title }}</span>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Main Post Content -->
        <article class="lg:col-span-8">
            <div class="bg-white rounded-[24px] border border-slate-100 p-6 md:p-10 shadow-[0_10px_30px_rgba(11,31,58,0.04)]">
                <!-- Header Info -->
                <div class="mb-8">
                    @if($post->category)
                        <span class="inline-block bg-gold/15 text-gold text-xs font-bold px-3.5 py-1 rounded-full uppercase tracking-wider mb-4 border border-gold/20">
                            {{ $post->category->localized_name }}
                        </span>
                    @endif
                    <h1 class="text-2xl md:text-4xl font-bold font-heading text-[#0B1F3A] leading-tight mb-5">
                        {{ $post->localized_title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400 pb-6 border-b border-slate-100 font-medium">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 rounded-full bg-[#0B1F3A] text-gold flex items-center justify-center font-bold text-xs shadow-inner">
                                E
                            </div>
                            <span class="font-semibold text-slate-700">Emisha Tours & Travels</span>
                        </div>
                        <span>•</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('blog.min_read', ['min' => $post->reading_time ?? '5']) }}
                        </span>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($post->featured_image)
                    <div class="rounded-[20px] overflow-hidden mb-8 shadow-sm">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->localized_title }}" class="w-full h-auto max-h-[500px] object-cover">
                    </div>
                @endif

                <!-- Article Body -->
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-5 text-base font-normal">
                    {!! $post->localized_content !!}
                </div>

                <!-- Author Bio Box -->
                <div class="mt-12 p-6 bg-slate-50/80 rounded-[20px] border border-slate-100 flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-full bg-[#0B1F3A] text-gold flex-shrink-0 flex items-center justify-center font-bold text-lg font-heading shadow-md">
                        E
                    </div>
                    <div>
                        <h4 class="font-bold font-heading text-[#0B1F3A] text-sm">Emisha Tours & Travels</h4>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            {{ __('blog.author_bio') }}
                        </p>
                    </div>
                </div>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="lg:col-span-4 space-y-8">
            <!-- Custom Trip CTA -->
            <div class="bg-[#0B1F3A] rounded-[24px] p-7 text-white text-center shadow-xl relative overflow-hidden border border-gold/20">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-gold/10 rounded-full blur-2xl pointer-events-none"></div>
                <span class="text-gold font-bold uppercase tracking-widest text-[11px] inline-block mb-1">{{ __('blog.tailormade_tours') }}</span>
                <h3 class="text-xl font-bold font-heading mb-2 text-white">{{ __('blog.inspired_title') }}</h3>
                <p class="text-slate-300 text-xs mb-6 font-normal leading-relaxed">
                    {{ __('blog.inspired_desc') }}
                </p>
                <a href="{{ route('tours.index') }}" class="block w-full py-3.5 bg-gold hover:bg-gold-light text-[#0B1F3A] font-bold rounded-xl text-sm shadow-md transition-all duration-300 mb-3">
                    {{ __('blog.explore_packages') }}
                </a>
                <a href="{{ route('contact.index') }}" class="block w-full py-3 bg-white/10 text-white font-semibold rounded-xl text-xs hover:bg-white/20 transition-all duration-300 border border-white/15">
                    {{ __('blog.inquire_custom') }}
                </a>
            </div>

            <!-- Recent Articles -->
            @if(isset($recentPosts) && $recentPosts->count() > 0)
                <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-[0_10px_30px_rgba(11,31,58,0.04)]">
                    <h3 class="font-bold font-heading text-[#0B1F3A] text-base mb-4 pb-3 border-b border-slate-100 flex items-center justify-between">
                        <span>{{ __('blog.latest_articles') }}</span>
                        <a href="{{ route('blog.index') }}" class="text-xs font-semibold text-gold hover:underline">{{ __('blog.view_all') }}</a>
                    </h3>
                    <div class="space-y-4">
                        @foreach($recentPosts as $recent)
                            <a href="{{ route('blog.show', $recent->slug) }}" class="flex items-center space-x-3 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    <img src="{{ $recent->featured_image ?? 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=300' }}" 
                                         alt="{{ $recent->localized_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs font-bold text-[#0B1F3A] group-hover:text-gold transition-colors duration-300 line-clamp-2 leading-snug">
                                        {{ $recent->localized_title }}
                                    </h4>
                                    <span class="text-[11px] text-slate-400 mt-1 block">
                                        {{ $recent->published_at ? $recent->published_at->format('M d, Y') : $recent->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Visa Consultation -->
            <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-[0_10px_30px_rgba(11,31,58,0.04)]">
                <div class="w-10 h-10 rounded-xl bg-gold/15 text-gold flex items-center justify-center font-bold text-lg mb-3 border border-gold/20">
                    <svg class="w-5 h-5 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h4 class="font-bold font-heading text-[#0B1F3A] text-sm mb-2">{{ __('visa.visa_assistance') }}</h4>
                <p class="text-xs text-slate-500 mb-4 leading-relaxed font-normal">{{ __('blog.visa_assistance_sub') }}</p>
                <a href="{{ route('visa.index') }}" class="inline-flex items-center text-xs font-bold text-[#0B1F3A] hover:text-gold transition-colors duration-300 gap-1.5 uppercase tracking-wider">
                    <span>{{ __('blog.browse_visa') }}</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </aside>
    </div>
</div>
@endsection


