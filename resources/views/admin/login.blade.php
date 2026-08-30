<!DOCTYPE html>
<html lang="en"
      x-data="{
          darkMode: localStorage.getItem('darkMode') === 'true',
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
    <title>Sign In — Cessna 172 Flight Operations</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; top: 0px !important; position: static !important; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Hide Google Translate top banner & toolbar */
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
<body class="bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen flex flex-col justify-between p-4 sm:p-6 md:p-8 relative overflow-x-hidden overflow-y-auto antialiased selection:bg-cyan-500 selection:text-slate-950 transition-colors duration-200">

<!-- Hidden Google Translate Element Container -->
<div id="google_translate_element" style="display:none;"></div>

<!-- Ambient Avionics Glow Elements (Fixed to background) -->
<div class="fixed -top-32 -left-32 w-96 h-96 rounded-full bg-cyan-600/10 dark:bg-cyan-600/20 blur-[100px] pointer-events-none"></div>
<div class="fixed -bottom-32 -right-32 w-96 h-96 rounded-full bg-blue-600/10 dark:bg-blue-600/20 blur-[100px] pointer-events-none"></div>

<!-- Top Bar Toolset -->
<header class="w-full max-w-5xl mx-auto flex items-center justify-between gap-3 relative z-20 pb-4">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm group">
        <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>Back to Portal</span>
    </a>

    <div class="flex items-center gap-2">

        <!-- Dark / Light Mode Toggle Button -->
        <button @click="toggleDark()"
                class="p-2 rounded-xl bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-amber-400 transition-all shadow-sm"
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

        <!-- Language Switcher -->
        <div class="notranslate" x-data="languageSwitcher()" translate="no">
            <button @click="toggleLanguage()"
                    class="px-2.5 py-1.5 text-xs font-semibold flex items-center gap-1.5 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-700 dark:text-slate-200 transition-all shadow-sm group"
                    :title="currentLang === 'id' ? 'Switch to English' : 'Terjemahkan ke Bahasa Indonesia'">
                <span class="text-sm" x-text="currentLang === 'id' ? '🇮🇩' : '🇺🇸'"></span>
                <span class="font-mono text-xs font-bold text-cyan-600 dark:text-cyan-400 notranslate" x-text="currentLang === 'id' ? 'ID' : 'EN'"></span>
            </button>
        </div>
    </div>
</header>

<!-- Main Auth Container -->
<main class="w-full max-w-md mx-auto my-auto py-4 relative z-10" x-data="{
    email: '{{ old('email', 'admin@gmail.com') }}',
    password: 'password',
    fillAdminDemo() {
        this.email = 'admin@gmail.com';
        this.password = 'password';
    }
}">

    <!-- Brand Header -->
    <div class="text-center mb-6 space-y-2">
        <div class="inline-flex w-16 h-16 rounded-2xl bg-gradient-to-tr from-cyan-600 via-blue-600 to-indigo-600 p-0.5 shadow-xl shadow-cyan-500/20 mb-2 hover:scale-105 transition-transform">
            <div class="w-full h-full bg-white dark:bg-slate-950 rounded-[14px] flex items-center justify-center">
                <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </div>
        </div>
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-100 dark:bg-cyan-950/80 border border-cyan-200 dark:border-cyan-500/30 text-cyan-700 dark:text-cyan-400 text-xs font-mono font-bold">
            <span>CESSNA 172 • FLIGHT OPERATIONS</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Maintenance Portal</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">Sign in to manage service manuals, schematics & aircraft systems</p>
    </div>

    <!-- Login Card -->
    <div class="rounded-3xl bg-white dark:bg-slate-900/90 backdrop-blur-xl border border-slate-200 dark:border-slate-800/90 p-6 sm:p-8 shadow-xl dark:shadow-2xl space-y-6 transition-colors duration-200">

        <!-- Navigation Tabs: Sign In / Register -->
        <div class="grid grid-cols-2 p-1 bg-slate-100 dark:bg-slate-950 rounded-2xl border border-slate-200 dark:border-slate-800">
            <a href="{{ route('login') }}" class="py-2.5 text-center text-xs font-bold rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md shadow-cyan-950">
                Sign In
            </a>
            <a href="{{ route('register') }}" class="py-2.5 text-center text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                Register
            </a>
        </div>

        @if(session('error'))
        <div class="p-3.5 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-500/40 rounded-2xl text-xs text-rose-700 dark:text-rose-300 flex items-center gap-2.5 shadow-sm">
            <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if(session('success'))
        <div class="p-3.5 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-500/40 rounded-2xl text-xs text-emerald-700 dark:text-emerald-300 flex items-center gap-2.5 shadow-sm">
            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Operator Email</label>
                <div class="relative">
                    <input type="email" name="email" x-model="email" required autofocus
                           placeholder="admin@gmail.com"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 rounded-2xl text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-all font-mono">
                </div>
                @error('email')<p class="text-rose-500 dark:text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Access Password</label>
                <div class="relative">
                    <input type="password" name="password" x-model="password" required
                           placeholder="password"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 rounded-2xl text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-all font-mono">
                </div>
                @error('password')<p class="text-rose-500 dark:text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-500 hover:from-blue-500 hover:to-teal-400 text-white font-bold text-sm tracking-wide shadow-xl shadow-cyan-950/20 dark:shadow-cyan-950/80 transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2">
                <span>Authorize & Enter</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>

        <!-- Quick 1-Click Demo Fill Banner -->
        <div class="pt-4 border-t border-slate-200 dark:border-slate-800/80 text-center space-y-2">
            <div class="text-[11px] text-slate-500 dark:text-slate-400 font-mono flex items-center justify-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                <span>One-Click Demo Access:</span>
            </div>
            <button @click="fillAdminDemo()" type="button"
                    class="w-full py-2.5 px-4 rounded-xl bg-slate-50 dark:bg-slate-950 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 hover:border-cyan-500/40 text-xs font-mono text-cyan-700 dark:text-cyan-400 hover:text-cyan-800 dark:hover:text-cyan-300 transition-all flex items-center justify-center gap-2 group shadow-sm">
                <span>🔑</span>
                <strong>admin@gmail.com</strong> / <span>password</span>
                <span class="text-[10px] text-slate-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-300">(Auto-fill)</span>
            </button>
        </div>

    </div>
</main>

<!-- Footer -->
<footer class="w-full text-center py-4 text-xs text-slate-400 dark:text-slate-500 relative z-10">
    Cessna Aircraft Company • Skyhawk Series 1969–1976
</footer>

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
