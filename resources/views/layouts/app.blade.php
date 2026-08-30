<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          darkMode: localStorage.getItem('darkMode') === 'true',
          mobileNav: false,
          toggleDark() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          }
      }"
      :class="{ 'dark': darkMode }"
      x-init="if (darkMode) document.documentElement.classList.add('dark')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cessna 172 Series') — Digital Service Manual</title>
    <meta name="description" content="@yield('meta_description', 'Digital Technical Service Manual for Cessna 172-Series (Skyhawk 1969–1976). Search, navigate, and reference factory maintenance procedures.')">
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>✈️</text></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; top: 0px !important; position: static !important; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Smooth page transitions */
        .page-content { animation: fadeIn 0.2s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: translateY(0); } }

        /* Hide Google Translate top banner, toolbar, and iframes completely */
        .goog-te-banner-frame,
        .goog-te-banner-frame.skiptranslate,
        iframe.goog-te-banner-frame,
        iframe.skiptranslate,
        .VIpgJd-ZVi9C-bHOHid,
        .VIpgJd-ZVi9C-OWStAb-OdnEOd,
        .VIpgJd-ZVi9C-hSRGPd,
        .VIpgJd-ZVi9C-x3G2nd,
        #goog-gt-tt,
        .goog-te-balloon-frame,
        .goog-tooltip,
        .goog-tooltip:hover {
            display: none !important;
            visibility: hidden !important;
            height: 0px !important;
            width: 0px !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        .goog-text-highlight { background-color: transparent !important; box-shadow: none !important; }
    </style>

    @stack('head')
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen flex flex-col antialiased transition-colors duration-200 overflow-x-hidden">

<!-- Hidden Google Translate Element Container -->
<div id="google_translate_element" style="display:none;"></div>

<!-- ═══════════════════════════════════════════════════════════════
     RESPONSIVE TOP NAVIGATION HEADER
═══════════════════════════════════════════════════════════════ -->
<header class="sticky top-0 z-50 bg-white/95 dark:bg-slate-950/95 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-2 sm:gap-4">

            <!-- Logo & Brand (Responsive) -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 sm:gap-3 flex-shrink-0 group">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-cyan-600 via-blue-600 to-indigo-600 p-0.5 shadow-lg shadow-cyan-500/20 group-hover:shadow-cyan-500/40 transition-all duration-300">
                    <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-cyan-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                </div>
                <div class="notranslate" translate="no">
                    <div class="text-xs sm:text-sm font-extrabold tracking-tight text-slate-900 dark:text-white flex items-center gap-1.5 leading-none">
                        CESSNA 172
                        <span class="hidden xs:inline text-[9px] sm:text-[10px] font-mono px-1.5 py-0.5 bg-blue-100 dark:bg-cyan-950 text-blue-700 dark:text-cyan-400 border border-blue-200 dark:border-cyan-800/60 rounded font-bold">1969–1976</span>
                    </div>
                    <div class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 font-medium tracking-wide mt-1 leading-none truncate max-w-[120px] sm:max-w-none">Service Manual</div>
                </div>
            </a>

            <!-- Desktop Navigation Menu (Large screens >= 1024px) -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-1.5">

                <!-- 1. Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="px-3 py-2 rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-slate-900 text-blue-600 dark:text-cyan-400 border border-blue-200 dark:border-slate-800' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900/60' }}">
                    <svg class="w-4 h-4 text-blue-500 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <!-- 2. Service Manual Dropdown -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button @click="open = !open"
                            class="px-3 py-2 rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 {{ request()->routeIs('manual.*') ? 'bg-blue-50 dark:bg-slate-900 text-blue-600 dark:text-cyan-400 border border-blue-200 dark:border-slate-800' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900/60' }}">
                        <svg class="w-4 h-4 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span>Service Manual</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-64 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl p-2 z-50 space-y-1"
                         style="display: none;">
                        <a href="{{ route('manual.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">All 21 Sections</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Master Index & Table of Contents</div>
                            </div>
                        </a>
                        <div class="h-px bg-slate-200 dark:bg-slate-800/80 my-1"></div>
                        <a href="{{ route('manual.section', '01') }}" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg text-xs text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors">
                            <span class="font-mono text-cyan-600 dark:text-cyan-400 font-bold text-[11px]">§01</span>
                            <span>General Description</span>
                        </a>
                        <a href="{{ route('manual.section', '02') }}" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg text-xs text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors">
                            <span class="font-mono text-cyan-600 dark:text-cyan-400 font-bold text-[11px]">§02</span>
                            <span>Ground Handling & Servicing</span>
                        </a>
                        <a href="{{ route('manual.section', '11') }}" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg text-xs text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors">
                            <span class="font-mono text-cyan-600 dark:text-cyan-400 font-bold text-[11px]">§11</span>
                            <span>Powerplant & Engine</span>
                        </a>
                        <a href="{{ route('manual.section', '16') }}" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg text-xs text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors">
                            <span class="font-mono text-cyan-600 dark:text-cyan-400 font-bold text-[11px]">§16</span>
                            <span>Electrical Systems</span>
                        </a>
                        <a href="{{ route('manual.section', '20') }}" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg text-xs text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors">
                            <span class="font-mono text-cyan-600 dark:text-cyan-400 font-bold text-[11px]">§20</span>
                            <span>Wiring Diagrams</span>
                        </a>
                    </div>
                </div>

                <!-- 3. Technical Specs Dropdown -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button @click="open = !open"
                            class="px-3 py-2 rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 {{ request()->routeIs('specifications') || request()->routeIs('torque') || request()->routeIs('models.*') ? 'bg-blue-50 dark:bg-slate-900 text-blue-600 dark:text-cyan-400 border border-blue-200 dark:border-slate-800' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900/60' }}">
                        <svg class="w-4 h-4 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Technical Specs</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-64 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl p-2 z-50 space-y-1"
                         style="display: none;">
                        <a href="{{ route('specifications') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-emerald-500 transition-colors">Factory Specifications</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Dimensions, Weights, Limits</div>
                            </div>
                        </a>
                        <a href="{{ route('models.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-sky-500/10 text-sky-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-sky-500 transition-colors">Aircraft Models & Serials</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">172K/L/M & Serial Lookup</div>
                            </div>
                        </a>
                        <a href="{{ route('torque') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-amber-500 transition-colors">Torque Values Reference</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Standard Hardware Torques</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- 4. Maintenance & Operations Dropdown -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button @click="open = !open"
                            class="px-3 py-2 rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 {{ request()->routeIs('inspection') || request()->routeIs('systems.*') || request()->routeIs('figures.*') || request()->routeIs('wiring') ? 'bg-blue-50 dark:bg-slate-900 text-blue-600 dark:text-cyan-400 border border-blue-200 dark:border-slate-800' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900/60' }}">
                        <svg class="w-4 h-4 text-cyan-500 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Operations</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-64 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl p-2 z-50 space-y-1"
                         style="display: none;">
                        <a href="{{ route('inspection') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-rose-500/10 text-rose-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-rose-500 transition-colors">Inspection Checklist</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">50h, 100h, 200h, Annual Cards</div>
                            </div>
                        </a>
                        <a href="{{ route('systems.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-cyan-500/10 text-cyan-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-cyan-500 transition-colors">Aircraft Systems Directory</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Engine, Fuel, Landing Gear...</div>
                            </div>
                        </a>
                        <a href="{{ route('figures.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-amber-500 transition-colors">Technical Figures Gallery</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Diagrams & Illustrations</div>
                            </div>
                        </a>
                        <a href="{{ route('wiring') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors group">
                            <div class="w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-yellow-500 transition-colors">Wiring Schematics</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Section 20 Electrical Wire Data</div>
                            </div>
                        </a>
                    </div>
                </div>

            </nav>

            <!-- Right Action Tools (Fluid on all viewports) -->
            <div class="flex items-center gap-1.5 sm:gap-2">

                <!-- Search button -->
                <a href="{{ route('search') }}"
                   class="p-2 sm:px-2.5 sm:py-1.5 rounded-xl bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold flex items-center gap-1.5 transition-all shadow-sm"
                   title="Search Manual">
                    <svg class="w-4 h-4 sm:w-3.5 sm:h-3.5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span class="hidden xl:inline">Search</span>
                </a>

                <!-- Dark / Light Mode Toggle Button -->
                <button @click="toggleDark()"
                        class="p-2 rounded-xl bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-amber-400 transition-all shadow-sm"
                        title="Toggle Light / Dark Mode">
                    <!-- Sun icon in Dark Mode -->
                    <svg x-show="darkMode" class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon icon in Light Mode -->
                    <svg x-show="!darkMode" class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- Language Switcher (EN / ID) -->
                <div x-data="languageSwitcher()" class="notranslate" translate="no">
                    <button @click="toggleLanguage()"
                            class="px-2 sm:px-2.5 py-1.5 text-xs font-semibold flex items-center gap-1 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-700 dark:text-slate-200 transition-all shadow-sm"
                            :title="currentLang === 'id' ? 'Kembali ke Bahasa Inggris (Original)' : 'Terjemahkan ke Bahasa Indonesia'">
                        <span class="text-sm" x-text="currentLang === 'id' ? '🇮🇩' : '🇺🇸'"></span>
                        <span class="font-mono text-xs font-bold text-cyan-600 dark:text-cyan-400 notranslate" x-text="currentLang === 'id' ? 'ID' : 'EN'"></span>
                    </button>
                </div>

                <div class="h-5 w-px bg-slate-200 dark:bg-slate-800 my-auto hidden sm:block"></div>

                <!-- Desktop Login / Register (Visible on sm screens >= 640px) -->
                <div class="hidden sm:flex items-center gap-1.5">
                    <a href="{{ route('login') }}"
                       class="px-2.5 sm:px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-semibold flex items-center gap-1.5 transition-all shadow-sm">
                        <svg class="w-3.5 h-3.5 text-blue-500 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        <span>Login</span>
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-2.5 sm:px-3 py-1.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-xs font-bold flex items-center gap-1.5 shadow-md shadow-blue-950/20 dark:shadow-cyan-950/60 transition-all hover:scale-105 active:scale-95">
                        <svg class="w-3.5 h-3.5 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        <span>Register</span>
                    </a>
                </div>

                <!-- Mobile Hamburger Toggle (Visible on < lg screens) -->
                <button @click="mobileNav = !mobileNav"
                        class="lg:hidden p-2 rounded-xl bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 transition-colors shadow-sm"
                        aria-label="Toggle Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

            </div>

        </div>
    </div>

    <!-- Mobile Drawer Menu (Slide Down on < lg) -->
    <div x-show="mobileNav"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="mobileNav = false"
         class="lg:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 px-4 py-4 space-y-2 shadow-2xl transition-colors duration-200 max-h-[85vh] overflow-y-auto"
         style="display: none;">

        <!-- Mobile Login & Register Row (On small mobile) -->
        <div class="grid grid-cols-2 gap-2 pb-3 border-b border-slate-200 dark:border-slate-800 sm:hidden">
            <a href="{{ route('login') }}" class="py-2.5 text-center rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-white flex items-center justify-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-blue-500 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}" class="py-2.5 text-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 text-xs font-bold text-white flex items-center justify-center gap-1.5 shadow-md">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                <span>Register</span>
            </a>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">🏠</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('manual.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">📖</span>
                <span>Service Manual (21 Sections)</span>
            </a>
            <a href="{{ route('specifications') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">📋</span>
                <span>Factory Specifications</span>
            </a>
            <a href="{{ route('models.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">✈️</span>
                <span>Aircraft Models & Serials</span>
            </a>
            <a href="{{ route('inspection') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">🔍</span>
                <span>Inspection Checklist</span>
            </a>
            <a href="{{ route('systems.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">⚙️</span>
                <span>Aircraft Systems Directory</span>
            </a>
            <a href="{{ route('figures.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">🖼️</span>
                <span>Technical Figures Gallery</span>
            </a>
            <a href="{{ route('torque') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">🔩</span>
                <span>Installation Torque Limits</span>
            </a>
            <a href="{{ route('wiring') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">
                <span class="text-base">⚡</span>
                <span>Wiring Schematics (Sec 20)</span>
            </a>
        </nav>
    </div>
</header>

<!-- ═══════════════════════════════════════════════════════════════
     BREADCRUMB BAR (Optional per view)
═══════════════════════════════════════════════════════════════ -->
@hasSection('breadcrumb')
<div class="border-b border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-950/60 px-4 sm:px-6 lg:px-8 py-2.5">
    <div class="max-w-7xl mx-auto">
        @yield('breadcrumb')
    </div>
</div>
@endif

<!-- ═══════════════════════════════════════════════════════════════
     MAIN CONTENT (FULL-WIDTH / PROPORTIONAL CONTAINER)
═══════════════════════════════════════════════════════════════ -->
<main class="flex-1 min-w-0">
    <div class="page-content">
        @yield('content')
    </div>
</main>

<!-- ═══════════════════════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════════════════════ -->
<footer class="mt-16 border-t border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-950/90 py-10 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto space-y-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 dark:bg-amber-950/40 border border-amber-300 dark:border-amber-500/30 rounded-xl max-w-2xl text-left">
            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <p class="text-xs text-amber-800 dark:text-amber-300/90 leading-relaxed">
                <strong>AVIATION ADVISORY:</strong> This digital manual is provided for documentation and technical reference purposes. Always verify with current FAA/CAA approved maintenance data and applicable Airworthiness Directives.
            </p>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 text-xs text-slate-500 dark:text-slate-400">
            <a href="{{ route('manual.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Manual Chapters</a>
            <span>•</span>
            <a href="{{ route('specifications') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Specifications</a>
            <span>•</span>
            <a href="{{ route('models.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Aircraft Models</a>
            <span>•</span>
            <a href="{{ route('inspection') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Inspection Checklist</a>
            <span>•</span>
            <a href="{{ route('login') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Login</a>
            <span>•</span>
            <a href="{{ route('register') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Register</a>
        </div>

        <p class="text-xs text-slate-400 dark:text-slate-500 font-mono">
            Cessna 172-Series Service Manual Digital Library • Skyhawk Series 1969–1976 (D1232-13 Rev 1)
        </p>
    </div>
</footer>

@stack('modals')
@stack('scripts')

<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,id',
        autoDisplay: false
    }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
