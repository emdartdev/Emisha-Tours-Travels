@extends('layouts.app')

@section('title', "Explore {$destination->name} — Tour Packages & Travel Guide")
@section('meta_description', $destination->short_description)
@section('og_image', $destination->hero_image)

@section('content')
<!-- Destination Hero -->
<section class="relative bg-[#0B1F3A] text-white min-h-[420px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ $destination->hero_image ?: $destination->thumbnail }}" alt="{{ $destination->name }}" class="w-full h-full object-cover opacity-35">
        <div class="absolute inset-0 bg-gradient-to-t from-[#071527] via-[#0B1F3A]/85 to-transparent"></div>
    </div>

    <div class="container-custom relative z-10 py-16">
        <div class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:underline">Home</a> / 
            <a href="{{ route('destinations.index') }}" class="hover:underline">Destinations</a> / 
            <span class="text-white/60">{{ $destination->name }}</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4">
            <span class="text-white">{{ $destination->name }}</span>
        </h1>
        <p class="text-base md:text-lg text-slate-200 max-w-2xl leading-relaxed font-normal">
            {{ $destination->short_description }}
        </p>
    </div>
</section>

<!-- Destination Content & Tours -->
<section class="section-padding bg-[#F8FAFC]">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left 2-Columns: About & Packages -->
            <div class="lg:col-span-2 space-y-10">
                <!-- About Description -->
                <div class="card-base p-8 rounded-[24px]">
                    <h2 class="text-2xl font-extrabold text-[#0B1F3A] mb-4">About {{ $destination->name }}</h2>
                    <p class="text-base text-slate-600 leading-relaxed">
                        {{ $destination->description ?: $destination->short_description }}
                    </p>
                </div>

                <!-- Tour Packages in this Destination -->
                <div>
                    <h2 class="text-2xl font-extrabold text-[#0B1F3A] mb-6">
                        Tour Packages in {{ $destination->name }} ({{ $tours->count() }})
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($tours as $tour)
                            <x-tour-card :tour="$tour" />
                        @empty
                            <div class="col-span-2 card-base p-8 text-center text-slate-500 rounded-[24px]">
                                No specific packages found. Contact us to build a custom package for {{ $destination->name }}.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Sidebar: Visa Info & Quick Contact -->
            <div class="lg:col-span-1 space-y-6">
                @if($visaCountry)
                <div class="card-base p-6 rounded-[24px] border-t-4 border-t-[#D4AF37]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">{{ $visaCountry->flag }}</div>
                        <div>
                            <h3 class="font-extrabold text-base text-[#0B1F3A]">Visa Assistance</h3>
                            <div class="text-xs text-slate-400">{{ $visaCountry->country_name }}</div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed mb-4">
                        {{ $visaCountry->short_description }}
                    </p>
                    <a href="{{ route('visa.show', $visaCountry->slug) }}" class="btn btn-primary btn-sm w-full text-center shadow-md">
                        <span>View Visa Requirements</span>
                    </a>
                </div>
                @endif

                <div class="card-base p-8 rounded-[24px] bg-gradient-to-br from-[#071527] to-[#0B1F3A] text-white shadow-xl border border-[#D4AF37]/30">
                    <h3 class="text-xl font-extrabold text-white mb-2">Need a Customized Plan?</h3>
                    <p class="text-xs text-white/75 mb-6 leading-relaxed">
                        Let us build a customized itinerary with flights, private transport, and your choice of 4/5-star hotels.
                    </p>
                    <a href="{{ route('contact') }}#custom-trip" class="btn btn-gold btn-sm w-full text-center shadow-lg">
                        <span>Plan My Custom Trip</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
