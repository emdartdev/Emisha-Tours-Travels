@extends('layouts.app')

@section('title', __('destinations.page_title', ['app' => 'Emisha Tours & Travels']))
@section('meta_description', __('destinations.meta_description'))
@section('canonical_url', route('destinations.index'))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<div class="bg-[#0B1F3A] text-white py-12 lg:py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#071527] to-[#0B1F3A] opacity-90"></div>
    <div class="container-custom relative z-10">
        <div class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-2">
            <a href="{{ route('home') }}" class="hover:underline">{{ __('nav.home') }}</a> / <span>{{ __('nav.destinations') }}</span>
        </div>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-3">
            <span class="text-white">{{ __('destinations.heading') }}</span>
        </h1>
        <p class="text-sm md:text-base text-slate-200 max-w-2xl font-normal">
            {{ __('destinations.subheading') }}
        </p>
    </div>
</div>

<section class="section-padding bg-[#F8FAFC]">
    <div class="container-custom">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($destinations as $dest)
                <x-destination-card :destination="$dest" />
            @endforeach
        </div>

        <div class="mt-12">
            {{ $destinations->links() }}
        </div>
    </div>
</section>
@endsection

