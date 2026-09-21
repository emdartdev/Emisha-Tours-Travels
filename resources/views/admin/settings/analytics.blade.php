@extends('layouts.admin')

@section('title', 'Analytics & Marketing Tracking Command Center')

@section('content')
<div class="space-y-8" x-data="{
    activeTab: 'overview',
    searchQuery: '',
    filterCategory: 'all',
    verifying: {},
    verifyResult: {},
    hasUnsavedChanges: false,
    
    verifyProvider(key, fieldId) {
        const val = document.getElementById(fieldId)?.value || '';
        this.verifying[key] = true;
        this.verifyResult[key] = null;
        
        fetch('{{ route('admin.settings.analytics.verify') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ provider: key, value: val })
        })
        .then(res => res.json())
        .then(data => {
            this.verifying[key] = false;
            this.verifyResult[key] = data;
        })
        .catch(err => {
            this.verifying[key] = false;
            this.verifyResult[key] = { status: 'error', message: 'Network error or server failed to respond.' };
        });
    },

    testEventName: 'whatsapp_click',
    testEventValue: '15000',
    testingSimulator: false,
    simulatorMessage: null,
    fireTestEvent() {
        this.testingSimulator = true;
        this.simulatorMessage = null;
        fetch('{{ route('admin.settings.analytics.test-event') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                event_name: this.testEventName,
                event_value: this.testEventValue,
                metadata: { channel: 'WhatsApp Concierge', test_source: 'Admin Command Simulator' }
            })
        })
        .then(res => res.json())
        .then(data => {
            this.testingSimulator = false;
            this.simulatorMessage = data;
        })
        .catch(err => {
            this.testingSimulator = false;
            this.simulatorMessage = { status: 'error', message: 'Test event dispatch failed.' };
        });
    },

    copyToClipboard(text, id) {
        navigator.clipboard.writeText(text);
        const el = document.getElementById(id);
        if (el) {
            const original = el.innerText;
            el.innerText = 'Copied!';
            setTimeout(() => el.innerText = original, 2000);
        }
    }
}" @keydown.window.prevent.ctrl.s="document.getElementById('analytics-form').submit()" @keydown.window.prevent.cmd.s="document.getElementById('analytics-form').submit()">

    <!-- Page Header & Master Action Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b admin-table-divider">
        <div>
            <div class="flex items-center gap-2.5 text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-[#D4AF37] animate-pulse shadow-sm shadow-[#D4AF37]/50"></span>
                <span>Enterprise Marketing Telemetry & Pixel Manager</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--admin-text-heading)] tracking-tight">
                Analytics & Marketing Pixels
            </h1>
            <p class="text-xs sm:text-sm text-[var(--admin-text-muted)] mt-1 max-w-2xl">
                Connect, verify, enable, disable, and monitor GA4, GTM, Meta Pixel, TikTok, LinkedIn, Ads, and search console verification without touching code.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
            <a href="{{ route('home') }}" target="_blank" class="admin-card inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-[var(--admin-text-main)] hover:text-[#D4AF37] border shadow-xs transition active:scale-95">
                <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Live Preview</span>
            </a>
            
            <button type="submit" form="analytics-form" class="btn btn-gold text-xs shadow-lg shadow-[#D4AF37]/20 flex items-center gap-2 px-6 py-2.5 rounded-xl font-extrabold uppercase tracking-wider hover:brightness-105 active:scale-95 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                <span>Save All Settings</span>
            </button>
        </div>
    </div>

    <!-- Feedback Alerts -->
    @if(session('success'))
        <div class="admin-card p-4 rounded-2xl border-l-4 border-l-emerald-500 flex items-start justify-between gap-3 shadow-md animate-fade-in border">
            <div class="flex items-center gap-3 text-emerald-500">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-[var(--admin-text-main)]">Configuration Saved</h4>
                    <p class="text-xs text-[var(--admin-text-muted)]">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" @click="$el.parentElement.remove()" class="text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <!-- Status Overview Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Health Score -->
        <div class="admin-card rounded-3xl p-5 border shadow-sm flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold tracking-wider uppercase text-[var(--admin-text-muted)]">Tracking Health</span>
                <span class="w-7 h-7 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[var(--admin-text-heading)] font-mono">{{ $summary['health_score'] }}%</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $summary['health_score'] >= 80 ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500' }}">
                        {{ $summary['health_score'] >= 80 ? 'OPTIMAL' : 'PARTIAL' }}
                    </span>
                </div>
                <div class="w-full bg-slate-200/70 dark:bg-slate-800 rounded-full h-1.5 mt-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-1.5 rounded-full" style="width: {{ $summary['health_score'] }}%"></div>
                </div>
                <div class="flex justify-between items-center text-[10px] text-[var(--admin-text-muted)] mt-2">
                    <span>{{ $summary['active_count'] }} of {{ $summary['total_providers'] }} active</span>
                    <span>Core 5 Ready</span>
                </div>
            </div>
        </div>

        <!-- Active Tracking Services -->
        <div class="admin-card rounded-3xl p-5 border shadow-sm flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold tracking-wider uppercase text-[var(--admin-text-muted)]">Active Platforms</span>
                <span class="w-7 h-7 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </span>
            </div>
            <div>
                <span class="text-2xl sm:text-3xl font-extrabold text-[var(--admin-text-heading)] font-mono">{{ $summary['active_count'] }}</span>
                <div class="flex items-center gap-1.5 text-[11px] text-[var(--admin-text-muted)] mt-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>{{ $summary['active_count'] }} verified credentials in vault</span>
                </div>
            </div>
        </div>

        <!-- Events Logged Today -->
        <div class="admin-card rounded-3xl p-5 border shadow-sm flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold tracking-wider uppercase text-[var(--admin-text-muted)]">Events Logged Today</span>
                <span class="w-7 h-7 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </span>
            </div>
            <div>
                <span class="text-2xl sm:text-3xl font-extrabold text-[var(--admin-text-heading)] font-mono">{{ $summary['events_today'] }}</span>
                <div class="text-[11px] text-[var(--admin-text-muted)] mt-2">
                    Lifetime events: <span class="font-bold text-[var(--admin-text-main)] font-mono">{{ $summary['events_total'] }}</span>
                </div>
            </div>
        </div>

        <!-- Conversions Today -->
        <div class="admin-card rounded-3xl p-5 border shadow-sm flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold tracking-wider uppercase text-[var(--admin-text-muted)]">Conversions Today</span>
                <span class="w-7 h-7 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div>
                <span class="text-2xl sm:text-3xl font-extrabold text-[var(--admin-text-heading)] font-mono">{{ $summary['conversions_today'] }}</span>
                <div class="text-[11px] text-purple-500 font-semibold mt-2">
                    Tour Inquiries, Visas & Ticket Quotes
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs & Platform Filter Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
        <!-- Navigation Tabs -->
        <div class="flex items-center gap-1.5 p-1.5 rounded-2xl admin-subtle border overflow-x-auto scrollbar-none">
            <button type="button" @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                <span>Overview & Status</span>
            </button>

            <button type="button" @click="activeTab = 'analytics'" :class="activeTab === 'analytics' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <span>Web Analytics (GA4, GTM, Clarity)</span>
            </button>

            <button type="button" @click="activeTab = 'social'" :class="activeTab === 'social' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Social Pixels (Meta, TikTok, LinkedIn)</span>
            </button>

            <button type="button" @click="activeTab = 'ads'" :class="activeTab === 'ads' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                <span>Ad Networks (Google Ads, Bing)</span>
            </button>

            <button type="button" @click="activeTab = 'search'" :class="activeTab === 'search' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Search Console</span>
            </button>

            <button type="button" @click="activeTab = 'custom'" :class="activeTab === 'custom' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                <span>Privacy & Custom Scripts</span>
            </button>

            <button type="button" @click="activeTab = 'simulator'" :class="activeTab === 'simulator' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Event Simulator</span>
            </button>
        </div>
    </div>

    <!-- Main Configuration Form -->
    <form id="analytics-form" action="{{ route('admin.settings.analytics.update') }}" method="POST">
        @csrf

        <!-- TAB 1: OVERVIEW & STATUS DASHBOARD -->
        <div x-show="activeTab === 'overview'" class="space-y-6">
            <!-- Grid of All Trackers Status -->
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Platform Connection Status Grid</h3>
                        <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Live operational status across all 24 integrated tracking providers.</p>
                    </div>
                    <div class="relative w-full sm:w-64">
                        <input 
                            type="text" 
                            x-model="searchQuery" 
                            placeholder="Filter platform..." 
                            class="admin-input w-full pl-9 pr-3.5 py-2 rounded-xl text-xs border focus:outline-none focus:border-[#D4AF37] transition"
                        >
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-[var(--admin-text-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5">
                    @php
                        $providersOverview = [
                            ['key' => 'ga4', 'name' => 'Google Analytics 4', 'id' => $settings->google_analytics_id, 'enabled' => $settings->google_analytics_enabled, 'tab' => 'analytics', 'icon' => 'GA'],
                            ['key' => 'gtm', 'name' => 'Google Tag Manager', 'id' => $settings->google_tag_manager_id, 'enabled' => $settings->google_tag_manager_enabled, 'tab' => 'analytics', 'icon' => 'TM'],
                            ['key' => 'clarity', 'name' => 'Microsoft Clarity', 'id' => $settings->clarity_project_id, 'enabled' => $settings->clarity_enabled, 'tab' => 'analytics', 'icon' => 'MC'],
                            ['key' => 'hotjar', 'name' => 'Hotjar Heatmaps', 'id' => $settings->hotjar_site_id, 'enabled' => $settings->hotjar_enabled, 'tab' => 'analytics', 'icon' => 'HJ'],
                            ['key' => 'plausible', 'name' => 'Plausible Analytics', 'id' => $settings->plausible_domain, 'enabled' => $settings->plausible_enabled, 'tab' => 'analytics', 'icon' => 'PL'],
                            ['key' => 'posthog', 'name' => 'PostHog Analytics', 'id' => $settings->posthog_api_key, 'enabled' => $settings->posthog_enabled, 'tab' => 'analytics', 'icon' => 'PH'],
                            ['key' => 'meta', 'name' => 'Meta Pixel (Facebook & Instagram)', 'id' => $settings->facebook_pixel_id, 'enabled' => $settings->facebook_pixel_enabled, 'tab' => 'social', 'icon' => 'FB'],
                            ['key' => 'tiktok', 'name' => 'TikTok Pixel', 'id' => $settings->tiktok_pixel_id, 'enabled' => $settings->tiktok_pixel_enabled, 'tab' => 'social', 'icon' => 'TT'],
                            ['key' => 'snapchat', 'name' => 'Snapchat Pixel', 'id' => $settings->snapchat_pixel_id, 'enabled' => $settings->snapchat_pixel_enabled, 'tab' => 'social', 'icon' => 'SC'],
                            ['key' => 'linkedin', 'name' => 'LinkedIn Insight Tag', 'id' => $settings->linkedin_partner_id, 'enabled' => $settings->linkedin_enabled, 'tab' => 'social', 'icon' => 'LI'],
                            ['key' => 'pinterest', 'name' => 'Pinterest Tag', 'id' => $settings->pinterest_tag_id, 'enabled' => $settings->pinterest_enabled, 'tab' => 'social', 'icon' => 'PIN'],
                            ['key' => 'twitter', 'name' => 'X (Twitter) Pixel', 'id' => $settings->twitter_pixel_id, 'enabled' => $settings->twitter_pixel_enabled, 'tab' => 'social', 'icon' => 'X'],
                            ['key' => 'reddit', 'name' => 'Reddit Pixel', 'id' => $settings->reddit_pixel_id, 'enabled' => $settings->reddit_pixel_enabled, 'tab' => 'social', 'icon' => 'RD'],
                            ['key' => 'quora', 'name' => 'Quora Pixel', 'id' => $settings->quora_pixel_id, 'enabled' => $settings->quora_pixel_enabled, 'tab' => 'social', 'icon' => 'QR'],
                            ['key' => 'google_ads', 'name' => 'Google Ads Conversion Tracking', 'id' => $settings->google_ads_conversion_id, 'enabled' => $settings->google_ads_enabled, 'tab' => 'ads', 'icon' => 'AD'],
                            ['key' => 'bing_ads', 'name' => 'Microsoft Advertising (Bing UET)', 'id' => $settings->bing_ads_tag_id, 'enabled' => $settings->bing_ads_enabled, 'tab' => 'ads', 'icon' => 'MS'],
                            ['key' => 'taboola', 'name' => 'Taboola Pixel', 'id' => $settings->taboola_pixel_id, 'enabled' => $settings->taboola_pixel_enabled, 'tab' => 'ads', 'icon' => 'TB'],
                            ['key' => 'outbrain', 'name' => 'Outbrain Amplify Pixel', 'id' => $settings->outbrain_pixel_id, 'enabled' => $settings->outbrain_pixel_enabled, 'tab' => 'ads', 'icon' => 'OB'],
                            ['key' => 'gsc', 'name' => 'Google Search Console Verification', 'id' => $settings->google_site_verification, 'enabled' => !empty($settings->google_site_verification), 'tab' => 'search', 'icon' => 'GSC'],
                            ['key' => 'bing_webmaster', 'name' => 'Bing Webmaster Tools Verification', 'id' => $settings->bing_site_verification, 'enabled' => !empty($settings->bing_site_verification), 'tab' => 'search', 'icon' => 'BWT'],
                            ['key' => 'yandex', 'name' => 'Yandex Webmaster Verification', 'id' => $settings->yandex_verification, 'enabled' => !empty($settings->yandex_verification), 'tab' => 'search', 'icon' => 'YX'],
                            ['key' => 'baidu', 'name' => 'Baidu Search Verification', 'id' => $settings->baidu_verification, 'enabled' => !empty($settings->baidu_verification), 'tab' => 'search', 'icon' => 'BD'],
                        ];
                    @endphp

                    @foreach($providersOverview as $p)
                        <div 
                            x-show="!searchQuery || '{{ strtolower($p['name']) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($p['key']) }}'.includes(searchQuery.toLowerCase())"
                            @click="activeTab = '{{ $p['tab'] }}'"
                            class="admin-subtle p-3.5 rounded-2xl border hover:border-[#D4AF37]/50 transition cursor-pointer flex items-center justify-between group"
                        >
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="w-3 h-3 rounded-full {{ $p['enabled'] && !empty($p['id']) ? 'bg-emerald-500 shadow-sm shadow-emerald-500/50' : 'bg-slate-300 dark:bg-slate-700' }} shrink-0"></span>
                                <div class="truncate">
                                    <h4 class="text-xs font-bold text-[var(--admin-text-main)] group-hover:text-[#D4AF37] transition truncate">{{ $p['name'] }}</h4>
                                    <p class="text-[10px] text-[var(--admin-text-muted)] font-mono truncate">
                                        {{ !empty($p['id']) ? Str::limit($p['id'], 22) : 'Not Configured' }}
                                    </p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider {{ $p['enabled'] && !empty($p['id']) ? 'bg-emerald-500/10 text-emerald-500' : 'text-[var(--admin-text-muted)]' }}">
                                {{ $p['enabled'] && !empty($p['id']) ? 'Active' : 'Empty' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Live Telemetry Log & Audit Trail Side by Side -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Live Telemetry Stream -->
                <div class="admin-card rounded-3xl p-6 border shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                                <h3 class="text-sm font-extrabold text-[var(--admin-text-heading)]">Live Telemetry Stream</h3>
                            </div>
                            <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">Last 20 hits</span>
                        </div>

                        <div class="space-y-2.5 max-h-72 overflow-y-auto pr-1">
                            @forelse($recentEvents as $ev)
                                <div class="p-2.5 rounded-xl admin-subtle border text-xs flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-[var(--admin-text-main)] font-mono">{{ $ev->event_name }}</span>
                                            <span class="text-[9px] px-1.5 py-0.5 rounded-md bg-blue-500/10 text-blue-500 font-bold uppercase">{{ $ev->event_category ?? 'General' }}</span>
                                        </div>
                                        <div class="text-[10px] text-[var(--admin-text-muted)] mt-0.5 truncate max-w-xs font-mono">
                                            {{ $ev->page_url }}
                                        </div>
                                    </div>
                                    <div class="text-right text-[10px] text-[var(--admin-text-muted)] shrink-0 font-mono">
                                        <div>{{ $ev->created_at->format('H:i:s') }}</div>
                                        <div>{{ $ev->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-xs text-[var(--admin-text-muted)]">
                                    No analytics events streamed yet today.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Audit Trail -->
                <div class="admin-card rounded-3xl p-6 border shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <h3 class="text-sm font-extrabold text-[var(--admin-text-heading)]">Security & Audit Trail</h3>
                            </div>
                            <span class="text-[10px] text-[var(--admin-text-muted)]">Settings changes</span>
                        </div>

                        <div class="space-y-2.5 max-h-72 overflow-y-auto pr-1">
                            @forelse($auditLogs as $log)
                                <div class="p-2.5 rounded-xl admin-subtle border text-xs flex items-center justify-between">
                                    <div>
                                        <div class="font-bold text-[var(--admin-text-main)]">{{ $log->action }}</div>
                                        <div class="text-[10px] text-[var(--admin-text-muted)] mt-0.5">{{ $log->details }}</div>
                                    </div>
                                    <div class="text-[10px] text-[var(--admin-text-muted)] shrink-0 font-mono">
                                        {{ $log->created_at->format('d M H:i') }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-xs text-[var(--admin-text-muted)]">
                                    No settings change audits recorded yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: WEB ANALYTICS (GA4, GTM, CLARITY, HOTJAR, PLAUSIBLE, POSTHOG) -->
        <div x-show="activeTab === 'analytics'" class="space-y-6">
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm space-y-8">
                <div>
                    <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Web Analytics & Behavioral Telemetry</h3>
                    <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Configure your primary analytics engines, heatmaps, and event streaming SDKs.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Google Analytics 4 -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center font-black text-xs">GA</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Google Analytics 4 (GA4)</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="google_analytics_enabled" value="0">
                                <input type="checkbox" name="google_analytics_enabled" value="1" {{ $settings->google_analytics_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="ga4_input" 
                                    name="google_analytics_id" 
                                    value="{{ old('google_analytics_id', $settings->google_analytics_id) }}" 
                                    placeholder="G-XXXXXXXXXX" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('ga4', 'ga4_input')" :disabled="verifying['ga4']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['ga4']">Verify</span>
                                    <span x-show="verifying['ga4']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Measurement ID starting with G- from Google Analytics Admin > Data Streams.</p>
                            
                            <template x-if="verifyResult['ga4']">
                                <div :class="verifyResult['ga4'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['ga4'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- Google Tag Manager -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center font-black text-xs">TM</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Google Tag Manager (GTM)</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="google_tag_manager_enabled" value="0">
                                <input type="checkbox" name="google_tag_manager_enabled" value="1" {{ $settings->google_tag_manager_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="gtm_input" 
                                    name="google_tag_manager_id" 
                                    value="{{ old('google_tag_manager_id', $settings->google_tag_manager_id) }}" 
                                    placeholder="GTM-XXXXXXX" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('gtm', 'gtm_input')" :disabled="verifying['gtm']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['gtm']">Verify</span>
                                    <span x-show="verifying['gtm']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">GTM container ID. Automatically injects head script and body noscript iframe.</p>
                            
                            <template x-if="verifyResult['gtm']">
                                <div :class="verifyResult['gtm'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['gtm'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- Microsoft Clarity -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-cyan-500/10 text-cyan-500 flex items-center justify-center font-black text-xs">MC</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Microsoft Clarity (Heatmaps & Replays)</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="clarity_enabled" value="0">
                                <input type="checkbox" name="clarity_enabled" value="1" {{ $settings->clarity_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="clarity_input" 
                                    name="clarity_project_id" 
                                    value="{{ old('clarity_project_id', $settings->clarity_project_id) }}" 
                                    placeholder="e.g. j1k2l3m4n5" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('clarity', 'clarity_input')" :disabled="verifying['clarity']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['clarity']">Verify</span>
                                    <span x-show="verifying['clarity']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Clarity Project Tracking ID from clarity.microsoft.com.</p>
                            
                            <template x-if="verifyResult['clarity']">
                                <div :class="verifyResult['clarity'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['clarity'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- Hotjar Heatmaps -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-rose-500/10 text-rose-500 flex items-center justify-center font-black text-xs">HJ</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Hotjar Heatmaps</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="hotjar_enabled" value="0">
                                <input type="checkbox" name="hotjar_enabled" value="1" {{ $settings->hotjar_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="hotjar_input" 
                                    name="hotjar_site_id" 
                                    value="{{ old('hotjar_site_id', $settings->hotjar_site_id) }}" 
                                    placeholder="e.g. 1234567" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('hotjar', 'hotjar_input')" :disabled="verifying['hotjar']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['hotjar']">Verify</span>
                                    <span x-show="verifying['hotjar']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Hotjar Site ID (numerical) from Hotjar dashboard.</p>
                            
                            <template x-if="verifyResult['hotjar']">
                                <div :class="verifyResult['hotjar'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['hotjar'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- Plausible Analytics -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center font-black text-xs">PL</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Plausible Analytics (Cookieless / Privacy-First)</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="plausible_enabled" value="0">
                                <input type="checkbox" name="plausible_enabled" value="1" {{ $settings->plausible_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="plausible_input" 
                                    name="plausible_domain" 
                                    value="{{ old('plausible_domain', $settings->plausible_domain) }}" 
                                    placeholder="emishatours.com" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('plausible', 'plausible_input')" :disabled="verifying['plausible']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['plausible']">Verify</span>
                                    <span x-show="verifying['plausible']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Registered domain configured in your Plausible instance.</p>
                            
                            <template x-if="verifyResult['plausible']">
                                <div :class="verifyResult['plausible'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['plausible'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- PostHog Analytics -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-orange-500/10 text-orange-500 flex items-center justify-center font-black text-xs">PH</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">PostHog Analytics</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="posthog_enabled" value="0">
                                <input type="checkbox" name="posthog_enabled" value="1" {{ $settings->posthog_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div class="space-y-2">
                            <input 
                                type="text" 
                                name="posthog_api_key" 
                                value="{{ old('posthog_api_key', $settings->posthog_api_key) }}" 
                                placeholder="Project API Key (phc_...)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <input 
                                type="text" 
                                name="posthog_host" 
                                value="{{ old('posthog_host', $settings->posthog_host ?? 'https://us.i.posthog.com') }}" 
                                placeholder="Host Instance (e.g. https://us.i.posthog.com or EU)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)]">PostHog client-side initialization key and ingestion domain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: SOCIAL MEDIA PIXELS -->
        <div x-show="activeTab === 'social'" class="space-y-6">
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm space-y-8">
                <div>
                    <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Social Media Conversion Pixels</h3>
                    <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Track social campaigns, retargeting pools, and attribution from Meta, TikTok, LinkedIn, and more.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Meta / Facebook / Instagram / Threads -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center font-black text-xs">FB</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Meta Pixel (Facebook, Instagram & Threads)</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="facebook_pixel_enabled" value="0">
                                <input type="checkbox" name="facebook_pixel_enabled" value="1" {{ $settings->facebook_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="meta_input" 
                                    name="facebook_pixel_id" 
                                    value="{{ old('facebook_pixel_id', $settings->facebook_pixel_id) }}" 
                                    placeholder="15-16 digit Dataset ID" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('meta', 'meta_input')" :disabled="verifying['meta']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['meta']">Verify</span>
                                    <span x-show="verifying['meta']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Meta Events Manager Dataset/Pixel ID (numerical).</p>
                            
                            <template x-if="verifyResult['meta']">
                                <div :class="verifyResult['meta'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['meta'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- TikTok Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-pink-500/10 text-pink-500 flex items-center justify-center font-black text-xs">TT</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">TikTok Pixel</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="tiktok_pixel_enabled" value="0">
                                <input type="checkbox" name="tiktok_pixel_enabled" value="1" {{ $settings->tiktok_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="tiktok_input" 
                                    name="tiktok_pixel_id" 
                                    value="{{ old('tiktok_pixel_id', $settings->tiktok_pixel_id) }}" 
                                    placeholder="e.g. CXXXXXXXXXXXXX" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('tiktok', 'tiktok_input')" :disabled="verifying['tiktok']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['tiktok']">Verify</span>
                                    <span x-show="verifying['tiktok']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">TikTok Ads Manager Pixel ID.</p>
                            
                            <template x-if="verifyResult['tiktok']">
                                <div :class="verifyResult['tiktok'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['tiktok'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- LinkedIn Insight Tag -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-blue-700/10 text-blue-700 flex items-center justify-center font-black text-xs">LI</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">LinkedIn Insight Tag</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="linkedin_enabled" value="0">
                                <input type="checkbox" name="linkedin_enabled" value="1" {{ $settings->linkedin_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="linkedin_input" 
                                    name="linkedin_partner_id" 
                                    value="{{ old('linkedin_partner_id', $settings->linkedin_partner_id) }}" 
                                    placeholder="e.g. 1234567" 
                                    class="admin-input flex-1 px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                                <button type="button" @click="verifyProvider('linkedin', 'linkedin_input')" :disabled="verifying['linkedin']" class="px-3.5 py-2.5 rounded-xl text-xs font-bold admin-card border hover:text-[#D4AF37] transition shrink-0">
                                    <span x-show="!verifying['linkedin']">Verify</span>
                                    <span x-show="verifying['linkedin']" class="animate-spin inline-block">↻</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">LinkedIn Campaign Manager Partner ID.</p>
                            
                            <template x-if="verifyResult['linkedin']">
                                <div :class="verifyResult['linkedin'].status === 'valid' ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="p-2 rounded-xl text-xs mt-2 font-medium" x-text="verifyResult['linkedin'].message"></div>
                            </template>
                        </div>
                    </div>

                    <!-- Snapchat Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-yellow-500/10 text-yellow-500 flex items-center justify-center font-black text-xs">SC</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Snapchat Pixel</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="snapchat_pixel_enabled" value="0">
                                <input type="checkbox" name="snapchat_pixel_enabled" value="1" {{ $settings->snapchat_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="snapchat_pixel_id" 
                                value="{{ old('snapchat_pixel_id', $settings->snapchat_pixel_id) }}" 
                                placeholder="Snap Pixel ID (UUID string)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Snap Ads Manager Pixel ID.</p>
                        </div>
                    </div>

                    <!-- Pinterest Tag -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center font-black text-xs">PIN</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Pinterest Tag</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="pinterest_enabled" value="0">
                                <input type="checkbox" name="pinterest_enabled" value="1" {{ $settings->pinterest_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="pinterest_tag_id" 
                                value="{{ old('pinterest_tag_id', $settings->pinterest_tag_id) }}" 
                                placeholder="Tag ID (numerical)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Pinterest Business Tag ID.</p>
                        </div>
                    </div>

                    <!-- X / Twitter Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-slate-900 text-white flex items-center justify-center font-black text-xs">X</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">X (Twitter) Conversion Tracking</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="twitter_pixel_enabled" value="0">
                                <input type="checkbox" name="twitter_pixel_enabled" value="1" {{ $settings->twitter_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="twitter_pixel_id" 
                                value="{{ old('twitter_pixel_id', $settings->twitter_pixel_id) }}" 
                                placeholder="Pixel ID (e.g. o1234)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Twitter Ads universal website tag ID.</p>
                        </div>
                    </div>

                    <!-- Reddit Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-orange-600/10 text-orange-600 flex items-center justify-center font-black text-xs">RD</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Reddit Pixel</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="reddit_pixel_enabled" value="0">
                                <input type="checkbox" name="reddit_pixel_enabled" value="1" {{ $settings->reddit_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="reddit_pixel_id" 
                                value="{{ old('reddit_pixel_id', $settings->reddit_pixel_id) }}" 
                                placeholder="e.g. a2_XXXXXXX" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Reddit Ads Conversion Pixel ID.</p>
                        </div>
                    </div>

                    <!-- Quora Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-red-800/10 text-red-800 flex items-center justify-center font-black text-xs">QR</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Quora Pixel</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="quora_pixel_enabled" value="0">
                                <input type="checkbox" name="quora_pixel_enabled" value="1" {{ $settings->quora_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="quora_pixel_id" 
                                value="{{ old('quora_pixel_id', $settings->quora_pixel_id) }}" 
                                placeholder="32-char hex pixel code" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Quora Ads pixel identifier.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 4: AD NETWORKS -->
        <div x-show="activeTab === 'ads'" class="space-y-6">
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm space-y-8">
                <div>
                    <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Advertising & Paid Media Networks</h3>
                    <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Configure paid conversion tracking, enhanced conversions, and native ad networks.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Google Ads Conversion Tracking -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center font-black text-xs">AD</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Google Ads Conversion Tracking</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="google_ads_enabled" value="0">
                                <input type="checkbox" name="google_ads_enabled" value="1" {{ $settings->google_ads_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div class="space-y-2.5">
                            <div>
                                <label class="block text-[11px] font-bold text-[var(--admin-text-muted)] mb-1">Conversion ID (AW-XXXXXXXXX)</label>
                                <input 
                                    type="text" 
                                    name="google_ads_conversion_id" 
                                    value="{{ old('google_ads_conversion_id', $settings->google_ads_conversion_id) }}" 
                                    placeholder="AW-XXXXXXXXX" 
                                    class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-[var(--admin-text-muted)] mb-1">Default Conversion Label (Optional)</label>
                                <input 
                                    type="text" 
                                    name="google_ads_conversion_label" 
                                    value="{{ old('google_ads_conversion_label', $settings->google_ads_conversion_label) }}" 
                                    placeholder="e.g. AbCdEfGhIjKlMnOp" 
                                    class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                                >
                            </div>
                            <div class="flex items-center gap-2 pt-1">
                                <input type="hidden" name="google_ads_enhanced_conversions" value="0">
                                <input type="checkbox" name="google_ads_enhanced_conversions" value="1" id="ec_toggle" {{ $settings->google_ads_enhanced_conversions ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-700 text-[#D4AF37] focus:ring-[#D4AF37]">
                                <label for="ec_toggle" class="text-xs text-[var(--admin-text-main)] font-semibold cursor-pointer">Enable Enhanced Conversions (Hashed Lead Telemetry)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Microsoft Ads (Bing UET) -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-teal-500/10 text-teal-500 flex items-center justify-center font-black text-xs">MS</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Microsoft Advertising (Bing UET)</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="bing_ads_enabled" value="0">
                                <input type="checkbox" name="bing_ads_enabled" value="1" {{ $settings->bing_ads_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="bing_ads_tag_id" 
                                value="{{ old('bing_ads_tag_id', $settings->bing_ads_tag_id) }}" 
                                placeholder="Bing UET Tag ID (numerical)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Microsoft Advertising Universal Event Tracking (UET) tag ID.</p>
                        </div>
                    </div>

                    <!-- Taboola Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-indigo-600/10 text-indigo-600 flex items-center justify-center font-black text-xs">TB</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Taboola Pixel</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="taboola_pixel_enabled" value="0">
                                <input type="checkbox" name="taboola_pixel_enabled" value="1" {{ $settings->taboola_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="taboola_pixel_id" 
                                value="{{ old('taboola_pixel_id', $settings->taboola_pixel_id) }}" 
                                placeholder="Taboola Account ID (numerical)" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Taboola Ads pixel and publisher account number.</p>
                        </div>
                    </div>

                    <!-- Outbrain Amplify Pixel -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl bg-amber-600/10 text-amber-600 flex items-center justify-center font-black text-xs">OB</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Outbrain Amplify Pixel</h4>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="outbrain_pixel_enabled" value="0">
                                <input type="checkbox" name="outbrain_pixel_enabled" value="1" {{ $settings->outbrain_pixel_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div>
                            <input 
                                type="text" 
                                name="outbrain_pixel_id" 
                                value="{{ old('outbrain_pixel_id', $settings->outbrain_pixel_id) }}" 
                                placeholder="e.g. NANOS_XXXXXXX" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                            <p class="text-[11px] text-[var(--admin-text-muted)] mt-1.5">Outbrain marketer pixel identifier.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 5: SEARCH ENGINE CONSOLES -->
        <div x-show="activeTab === 'search'" class="space-y-6">
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm space-y-8">
                <div>
                    <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Search Engine Domain Verification & Webmaster Tools</h3>
                    <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Injected automatically as standard verification meta tags into the HTML &lt;head&gt; across the entire site.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Google Search Console -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center font-black text-xs">GSC</span>
                            <div>
                                <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Google Search Console</h4>
                                <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">&lt;meta name="google-site-verification" ...&gt;</span>
                            </div>
                        </div>
                        <input 
                            type="text" 
                            name="google_site_verification" 
                            value="{{ old('google_site_verification', $settings->google_site_verification) }}" 
                            placeholder="e.g. google-site-verification=XXXXXXXXXXXXXXXXXXXXX or raw token" 
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                        >
                        <p class="text-[11px] text-[var(--admin-text-muted)]">Paste the entire meta tag content or the verification token string.</p>
                    </div>

                    <!-- Bing Webmaster Tools -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-teal-500/10 text-teal-500 flex items-center justify-center font-black text-xs">BWT</span>
                            <div>
                                <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Bing Webmaster Tools</h4>
                                <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">&lt;meta name="msvalidate.01" ...&gt;</span>
                            </div>
                        </div>
                        <input 
                            type="text" 
                            name="bing_site_verification" 
                            value="{{ old('bing_site_verification', $settings->bing_site_verification) }}" 
                            placeholder="Bing 32-character hexadecimal verification code" 
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                        >
                        <p class="text-[11px] text-[var(--admin-text-muted)]">Bing / Yahoo / DuckDuckGo webmaster verification token.</p>
                    </div>

                    <!-- Yandex Webmaster -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center font-black text-xs">YX</span>
                            <div>
                                <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Yandex Webmaster</h4>
                                <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">&lt;meta name="yandex-verification" ...&gt;</span>
                            </div>
                        </div>
                        <input 
                            type="text" 
                            name="yandex_verification" 
                            value="{{ old('yandex_verification', $settings->yandex_verification) }}" 
                            placeholder="Yandex 16-character code" 
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                        >
                        <p class="text-[11px] text-[var(--admin-text-muted)]">Verification code for Yandex Search.</p>
                    </div>

                    <!-- Baidu Search -->
                    <div class="admin-subtle p-5 rounded-3xl border space-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-blue-700/10 text-blue-700 flex items-center justify-center font-black text-xs">BD</span>
                            <div>
                                <h4 class="text-xs font-bold text-[var(--admin-text-heading)]">Baidu Search Verification</h4>
                                <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">&lt;meta name="baidu-site-verification" ...&gt;</span>
                            </div>
                        </div>
                        <input 
                            type="text" 
                            name="baidu_verification" 
                            value="{{ old('baidu_verification', $settings->baidu_verification) }}" 
                            placeholder="Baidu verification code" 
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                        >
                        <p class="text-[11px] text-[var(--admin-text-muted)]">Verification token for Baidu Webmaster tools.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 6: PRIVACY & CUSTOM SCRIPTS -->
        <div x-show="activeTab === 'custom'" class="space-y-6">
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm space-y-8">
                <div>
                    <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Privacy, Consent & Custom Raw Scripts</h3>
                    <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Manage GDPR/CCPA consent mode and safely inject custom tracking or chatbot scripts into the head or footer.</p>
                </div>

                <!-- Global Consent Mode & Privacy Settings -->
                <div class="admin-subtle p-5 rounded-3xl border space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-muted)]">Global Telemetry Consent & Privacy Controls</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center justify-between p-3.5 rounded-2xl admin-card border">
                            <div>
                                <h5 class="text-xs font-bold text-[var(--admin-text-main)]">Google Consent Mode v2</h5>
                                <p class="text-[11px] text-[var(--admin-text-muted)]">Sets default 'ad_storage' and 'analytics_storage' states for EEA compliance.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer shrink-0 ml-3">
                                <input type="hidden" name="consent_mode_enabled" value="0">
                                <input type="checkbox" name="consent_mode_enabled" value="1" {{ $settings->consent_mode_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-3.5 rounded-2xl admin-card border">
                            <div>
                                <h5 class="text-xs font-bold text-[var(--admin-text-main)]">IP Anonymization</h5>
                                <p class="text-[11px] text-[var(--admin-text-muted)]">Masks the last octet of user IP addresses in GA4 and internal analytics.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer shrink-0 ml-3">
                                <input type="hidden" name="anonymize_ip_enabled" value="0">
                                <input type="checkbox" name="anonymize_ip_enabled" value="1" {{ $settings->anonymize_ip_enabled ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D4AF37]"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Custom Raw Code Injections -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-[var(--admin-text-main)]">Custom &lt;head&gt; Raw Script Code</label>
                            <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">Injected before &lt;/head&gt;</span>
                        </div>
                        <textarea 
                            name="custom_head_script" 
                            rows="9" 
                            placeholder="<!-- Paste custom tracking script, fonts, or meta tags here -->"
                            class="admin-input w-full p-4 rounded-2xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                        >{{ old('custom_head_script', $settings->custom_head_script) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-[var(--admin-text-main)]">Custom &lt;body&gt; Footer Raw Script Code</label>
                            <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">Injected before &lt;/body&gt;</span>
                        </div>
                        <textarea 
                            name="custom_body_script" 
                            rows="9" 
                            placeholder="<!-- Paste custom live chats, feedback widgets, or noscript fallbacks here -->"
                            class="admin-input w-full p-4 rounded-2xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                        >{{ old('custom_body_script', $settings->custom_body_script) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 7: EVENT SIMULATOR & TELEMETRY DEBUGGER -->
        <div x-show="activeTab === 'simulator'" class="space-y-6">
            <div class="admin-card rounded-3xl p-6 sm:p-8 border shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-extrabold text-[var(--admin-text-heading)]">Live Telemetry & Event Dispatch Simulator</h3>
                    <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Test your live pipeline by firing synthetic conversion, inquiry, or booking events and inspecting backend storage.</p>
                </div>

                <div class="admin-subtle p-6 rounded-3xl border space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-[var(--admin-text-muted)] uppercase tracking-wider mb-1.5">Simulation Event Name</label>
                            <select x-model="testEventName" class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-bold focus:outline-none focus:border-[#D4AF37] transition">
                                <option value="tour_inquiry_submitted">tour_inquiry_submitted (Conversion)</option>
                                <option value="visa_application_submitted">visa_application_submitted (Conversion)</option>
                                <option value="ticket_quote_requested">ticket_quote_requested (Conversion)</option>
                                <option value="whatsapp_click">whatsapp_click (Engagement)</option>
                                <option value="phone_call_click">phone_call_click (Engagement)</option>
                                <option value="search_performed">search_performed (Search Telemetry)</option>
                                <option value="newsletter_subscribed">newsletter_subscribed (Lead)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[var(--admin-text-muted)] uppercase tracking-wider mb-1.5">Simulated Event Value (BDT)</label>
                            <input 
                                type="number" 
                                x-model="testEventValue" 
                                placeholder="e.g. 50000" 
                                class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono focus:outline-none focus:border-[#D4AF37] transition"
                            >
                        </div>

                        <div class="flex items-end">
                            <button 
                                type="button" 
                                @click="fireTestEvent()" 
                                :disabled="testingSimulator" 
                                class="w-full py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center justify-center gap-2 active:scale-95"
                            >
                                <span x-show="!testingSimulator">🚀 Fire Test Event</span>
                                <span x-show="testingSimulator" class="animate-spin">↻</span>
                            </button>
                        </div>
                    </div>

                    <template x-if="simulatorMessage">
                        <div :class="simulatorMessage.status === 'success' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'" class="p-4 rounded-2xl text-xs font-medium animate-fade-in flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span x-text="simulatorMessage.status === 'success' ? '✓' : '✗'" class="font-bold"></span>
                                <span x-text="simulatorMessage.message"></span>
                            </div>
                            <span class="text-[10px] font-mono text-[var(--admin-text-muted)]">Event ID: #simulated</span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
