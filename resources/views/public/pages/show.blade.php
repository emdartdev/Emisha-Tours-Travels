@extends('layouts.app')

@section('title', ($page->meta_title ?? $page->localized_title) . ' | Emisha Tours & Travels')
@section('meta_description', $page->meta_description ?? Str::limit(strip_tags($page->localized_content), 160))
@section('canonical_url', route('pages.show', $page->slug))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- Hero / Header -->
<div class="bg-[#0B1F3A] py-16 md:py-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#D4AF37]/15 text-[#D4AF37] uppercase tracking-widest mb-3 border border-[#D4AF37]/30">
            {{ app()->getLocale() === 'bn' ? 'আইনি ও তথ্য সংক্রান্ত' : 'Legal & Information' }}
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
            <span class="text-white">{{ $page->localized_title }}</span>
        </h1>
        <p class="text-slate-200 text-xs mt-3 font-medium">
            {{ app()->getLocale() === 'bn' ? 'সর্বশেষ হালনাগাদ:' : 'Last Updated:' }} {{ $page->updated_at ? $page->updated_at->format('F d, Y') : date('F d, Y') }}
        </p>
    </div>
</div>

<!-- Page Content Container -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <div class="bg-white rounded-[24px] p-8 md:p-12 border border-slate-100 shadow-[0_10px_30px_rgba(11,31,58,0.04)]">
        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-6 text-sm md:text-base font-normal {{ app()->getLocale() === 'bn' ? 'font-[\'Hind_Siliguri\',sans-serif]' : '' }}">
            {!! $page->localized_content !!}
        </div>
    </div>
</div>
@endsection

