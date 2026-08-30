<!DOCTYPE html>
<html lang="en" x-data="{
    darkMode: localStorage.getItem('darkMode') === 'true',
    sidebarOpen: false,
    toggleDark() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" :class="{ 'dark': darkMode }" x-init="if (darkMode) document.documentElement.classList.add('dark')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Cessna 172 Flight Operations CMS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; top: 0px !important; position: static !important; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

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
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen antialiased transition-colors duration-200">

<!-- Hidden Google Translate Element Container -->
<div id="google_translate_element" style="display:none;"></div>

<div class="min-h-screen flex">

    <!-- ═══════════════════════════════════════════════════════════════
         DESKTOP LEFT SIDEBAR
    ═══════════════════════════════════════════════════════════════ -->
    <aside class="hidden lg:flex lg:flex-col w-64 flex-shrink-0 min-h-screen sticky top-0 bg-white dark:bg-slate-950/95 border-r border-slate-200 dark:border-slate-800/90 p-5 justify-between z-40 transition-colors duration-200 shadow-sm dark:shadow-2xl">

        <!-- Top Sidebar: Brand & Nav Links -->
        <div class="space-y-6">

            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 via-blue-600 to-indigo-600 p-0.5 shadow-lg shadow-cyan-500/20 group-hover:shadow-cyan-500/40 transition-all duration-300">
                    <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center">
                        <svg class="w-5 h-5 text-cyan-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                </div>
                <div class="notranslate" translate="no">
                    <div class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white flex items-center gap-1.5 leading-none">
                        CESSNA 172
                        <span class="text-[9px] font-mono px-1.5 py-0.5 bg-blue-100 dark:bg-cyan-950 text-blue-700 dark:text-cyan-400 border border-blue-200 dark:border-cyan-800/60 rounded font-bold">ADMIN</span>
                    </div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium tracking-wide mt-1 leading-none">Control Panel</div>
                </div>
            </a>

            <!-- Navigation Menu -->
            <nav class="space-y-1.5">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 px-3 pb-1">Operations</div>

                <!-- 1. Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950/40' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-500 dark:text-cyan-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <!-- 2. Manual Sections -->
                <a href="{{ route('admin.sections.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.sections.*') ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950/40' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.sections.*') ? 'text-white' : 'text-indigo-500 dark:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Manual Sections</span>
                </a>

                <!-- 3. Technical Figures -->
                <a href="{{ route('admin.figures.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.figures.*') ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950/40' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.figures.*') ? 'text-white' : 'text-amber-500 dark:text-amber-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Figures & Schematics</span>
                </a>

                <!-- 4. Specifications -->
                <a href="{{ route('admin.specifications.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.specifications.*') ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950/40' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.specifications.*') ? 'text-white' : 'text-emerald-500 dark:text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Specifications</span>
                </a>

                <!-- 5. Aircraft Models -->
                <a href="{{ route('admin.models.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.models.*') ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950/40' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.models.*') ? 'text-white' : 'text-sky-500 dark:text-sky-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Aircraft Models</span>
                </a>

                <!-- 6. Inspection Checklist -->
                <a href="{{ route('admin.inspection.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.inspection.*') ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950/40' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-900' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.inspection.*') ? 'text-white' : 'text-rose-500 dark:text-rose-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Inspection Checklist</span>
                </a>
            </nav>
        </div>

        <!-- Bottom Sidebar: Utilities & Account -->
        <div class="pt-6 border-t border-slate-200 dark:border-slate-800/80 space-y-3">

            <!-- Public Portal Link -->
            <a href="{{ route('dashboard') }}" target="_blank"
               class="flex items-center justify-between px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-850 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold transition-all">
                <span class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Public Portal</span>
                </span>
                <span class="text-[10px] font-mono text-slate-400">↗</span>
            </a>

            <!-- Mode & Language Switcher Bar -->
            <div class="flex items-center gap-2">

                <!-- Dark / Light Mode Toggle Button -->
                <button @click="toggleDark()"
                        class="flex-1 py-2 px-3 rounded-xl bg-slate-50 dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-850 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-amber-400 text-xs font-semibold flex items-center justify-center gap-1.5 transition-all"
                        title="Toggle Theme">
                    <svg x-show="darkMode" class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg x-show="!darkMode" class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <span x-text="darkMode ? 'Dark' : 'Light'"></span>
                </button>

                <!-- Language Switcher -->
                <div x-data="languageSwitcher()" class="notranslate" translate="no">
                    <button @click="toggleLanguage()"
                            class="py-2 px-3 rounded-xl bg-slate-50 dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-850 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold flex items-center gap-1.5 transition-all">
                        <span class="text-sm" x-text="currentLang === 'id' ? '🇮🇩' : '🇺🇸'"></span>
                        <span class="font-mono text-xs font-bold text-cyan-600 dark:text-cyan-400 notranslate" x-text="currentLang === 'id' ? 'ID' : 'EN'"></span>
                    </button>
                </div>
            </div>

            <!-- Profile & Sign Out Bar -->
            <div class="flex items-center justify-between p-2 rounded-2xl bg-slate-50 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800/80 notranslate" translate="no">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-cyan-600 to-blue-600 flex items-center justify-center text-white shadow-sm flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ session('admin_email', 'admin@gmail.com') }}</div>
                        <div class="text-[10px] text-slate-500">Administrator</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="p-2 rounded-xl text-rose-500 hover:bg-rose-100 dark:hover:bg-rose-950/60 transition-colors"
                            title="Sign Out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>

        </div>

    </aside>

    <!-- ═══════════════════════════════════════════════════════════════
         MOBILE TOP BAR
    ═══════════════════════════════════════════════════════════════ -->
    <div class="flex-1 flex flex-col min-w-0">

        <header class="lg:hidden sticky top-0 z-30 bg-white/95 dark:bg-slate-950/95 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-4 py-3 flex items-center justify-between shadow-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-bold text-sm text-slate-900 dark:text-white">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-cyan-600 to-blue-600 flex items-center justify-center text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </div>
                <span>Cessna 172 Admin</span>
            </a>

            <div class="flex items-center gap-2">
                <button @click="toggleDark()" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-amber-400">
                    <svg x-show="darkMode" class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg x-show="!darkMode" class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>

                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </header>

        <!-- Mobile Sidebar Drawer -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-full"
             class="lg:hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex"
             style="display: none;">
            <div class="w-64 bg-white dark:bg-slate-950 p-6 flex flex-col justify-between h-full border-r border-slate-200 dark:border-slate-800"
                 @click.away="sidebarOpen = false">
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-sm text-slate-900 dark:text-white">Admin Menu</span>
                        <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white">✕</button>
                    </div>
                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">Dashboard</a>
                        <a href="{{ route('admin.sections.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">Manual Sections</a>
                        <a href="{{ route('admin.figures.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">Figures & Schematics</a>
                        <a href="{{ route('admin.specifications.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">Specifications</a>
                        <a href="{{ route('admin.models.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">Aircraft Models</a>
                        <a href="{{ route('admin.inspection.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-bold text-slate-800 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-900">Inspection Checklist</a>
                    </nav>
                </div>
                <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-rose-600 text-white font-bold text-xs">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════
             MAIN CONTENT AREA (FULL-WIDTH & FULL SPACING)
        ═══════════════════════════════════════════════════════════════ -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto space-y-8">
            @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-500/40 text-emerald-800 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2.5 shadow-sm">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-500/40 text-rose-800 dark:text-rose-300 text-xs font-semibold flex items-center gap-2.5 shadow-sm">
                <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @yield('content')
        </main>

    </div>

</div>

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
