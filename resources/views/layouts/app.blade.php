<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Emisha Tours & Travels — Premium Holiday Packages & Visa Consultancy')</title>
    <meta name="description" content="@yield('meta_description', 'Emisha Tours & Travels is a premier travel agency in Dhaka, Bangladesh offering international tour packages, certified visa processing, and air ticketing.')">
    @php
        $pageCanonical = trim($__env->yieldContent('canonical_url', url()->current()));
        $pageCanonical = $pageCanonical ?: url()->current();
        $langSep = str_contains($pageCanonical, '?') ? '&' : '?';
        $hreflangEn = $pageCanonical . $langSep . 'lang=en';
        $hreflangBn = $pageCanonical . $langSep . 'lang=bn';
    @endphp
    <link rel="canonical" href="{{ $pageCanonical }}">
    <link rel="alternate" hreflang="en" href="{{ $hreflangEn }}">
    <link rel="alternate" hreflang="bn" href="{{ $hreflangBn }}">
    <link rel="alternate" hreflang="x-default" href="{{ $pageCanonical }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <meta name="theme-color" content="#071A35">

    <!-- Favicon & Brand Icons -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- OpenGraph / Facebook / WhatsApp -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('title', 'Emisha Tours & Travels — Premium Travel Agency')">
    <meta property="og:description" content="@yield('meta_description', 'Discover premium international tour packages, certified visa consultancy, and global air ticketing.')">
    <meta property="og:url" content="{{ $pageCanonical }}">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="Emisha Tours & Travels">
    <meta property="og:locale" content="{{ app()->getLocale() === 'bn' ? 'bn_BD' : 'en_US' }}">

    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Emisha Tours & Travels')">
    <meta name="twitter:description" content="@yield('meta_description', 'Discover premium international tour packages, certified visa consultancy, and global air ticketing.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

    <!-- Google Fonts: Poppins (Primary Font) + Hind Siliguri (Bengali) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Alpine.js for lightweight UI transitions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <!-- Vite Assets (CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dynamic JSON-LD Schema -->
    @yield('schema')
    @stack('schema')

    <!-- Marketing & Analytics Telemetry (Head) -->
    @include('components.tracking-scripts', ['position' => 'head'])

    @stack('styles')
</head>
<body class="bg-white text-[#1E293B] min-h-full flex flex-col antialiased selection:bg-[#D4AF37] selection:text-[#0B1F3A] {{ app()->getLocale() === 'bn' ? 'font-bengali' : 'font-sans' }}">
    <!-- Marketing & Analytics GTM NoScript (Body Start) -->
    @include('components.tracking-scripts', ['position' => 'body_start'])

    <div id="app" class="flex flex-col min-h-screen">
        <!-- Site Header Component -->
        @include('components.header')

        <!-- Flash Notifications -->
        @include('components.flash-messages')

        <!-- Main Page Content Slot -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Site Footer Component -->
        @include('components.footer')
    </div>

    <!-- GDPR / CCPA Cookie Consent Floating Banner -->
    @include('components.cookie-consent')

    <!-- Marketing & Analytics Footer Telemetry (Body End) -->
    @include('components.tracking-scripts', ['position' => 'body_end'])

    @stack('scripts')
</body>
</html>
