@extends('layouts.admin')
@section('title', 'Operations Dashboard')

@section('content')

<!-- ═══════════════════════════════════════════════════════════════
     HERO AVIONICS BANNER
═══════════════════════════════════════════════════════════════ -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950/90 border border-slate-800/90 p-6 sm:p-8 shadow-2xl text-white">
    <!-- Ambient decorative glow -->
    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute right-40 -bottom-20 w-60 h-60 rounded-full bg-blue-600/10 blur-2xl pointer-events-none"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-950/70 border border-cyan-500/30 text-cyan-400 text-xs font-mono">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                <span>AVIONICS CMS • SKYHAWK 1969–1976</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Cessna 172 Digital Service Manual
            </h1>
            <p class="text-slate-300 text-sm max-w-2xl leading-relaxed">
                Centralized content control for technical specifications, factory maintenance checklists, wiring diagrams, and high-resolution figures.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3 flex-shrink-0">
            <a href="{{ route('manual.index') }}" target="_blank"
               class="px-4 py-2.5 rounded-xl bg-slate-900/90 hover:bg-slate-800 text-slate-200 hover:text-white text-xs font-semibold flex items-center gap-2 border border-slate-700 transition-all shadow-sm">
                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Live Reader</span>
            </a>
            <a href="{{ route('admin.sections.create') }}"
               class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-cyan-950 transition-all hover:scale-105 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Section</span>
            </a>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     METRIC STATS GRID
═══════════════════════════════════════════════════════════════ -->
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">

    <!-- Card 1: Sections -->
    <a href="{{ route('admin.sections.index') }}"
       class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 hover:border-blue-500/50 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-sm">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-300">Sections</span>
            <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $stats['sections'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                <span>Total Chapters</span>
                <span class="text-blue-500 dark:text-blue-400">→</span>
            </div>
        </div>
    </a>

    <!-- Card 2: Subsections -->
    <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Subsections</span>
            <div class="w-8 h-8 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white">{{ $stats['paragraphs'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1">Indexed Paragraphs</div>
        </div>
    </div>

    <!-- Card 3: Figures -->
    <a href="{{ route('admin.figures.index') }}"
       class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 hover:border-amber-500/50 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-sm">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-300">Figures</span>
            <div class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:scale-110 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">{{ $stats['figures'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                <span>Schematics & Drawings</span>
                <span class="text-amber-500 dark:text-amber-400">→</span>
            </div>
        </div>
    </a>

    <!-- Card 4: Specs -->
    <a href="{{ route('admin.specifications.index') }}"
       class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 hover:border-emerald-500/50 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-sm">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-300">Specifications</span>
            <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $stats['specifications'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                <span>Engineering Data</span>
                <span class="text-emerald-500 dark:text-emerald-400">→</span>
            </div>
        </div>
    </a>

    <!-- Card 5: Models -->
    <a href="{{ route('admin.models.index') }}"
       class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 hover:border-sky-500/50 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-sm">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-300">Models</span>
            <div class="w-8 h-8 rounded-xl bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center group-hover:scale-110 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">{{ $stats['models'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                <span>Aircraft Variants</span>
                <span class="text-sky-500 dark:text-sky-400">→</span>
            </div>
        </div>
    </a>

    <!-- Card 6: Inspection -->
    <a href="{{ route('admin.inspection.index') }}"
       class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 hover:border-rose-500/50 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg shadow-sm">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-300">Inspections</span>
            <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:scale-110 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">{{ $stats['inspection'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                <span>Checklist Items</span>
                <span class="text-rose-500 dark:text-rose-400">→</span>
            </div>
        </div>
    </a>

</div>

<!-- ═══════════════════════════════════════════════════════════════
     TWO-COLUMN CONTENT SPLIT
═══════════════════════════════════════════════════════════════ -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column (2 Cols): Recent Manual Sections -->
    <div class="lg:col-span-2 rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-xl">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50 dark:bg-slate-950/40">
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white tracking-tight">Recent Sections in Service Manual</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Chapters and procedural reference documents</p>
            </div>
            <a href="{{ route('admin.sections.index') }}"
               class="text-xs font-semibold text-cyan-600 dark:text-cyan-400 hover:underline flex items-center gap-1 group">
                <span>View All Sections</span>
                <span class="group-hover:translate-x-0.5 transition-transform">→</span>
            </a>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-slate-800/60">
            @forelse($recentSections as $s)
            <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                <div class="flex items-center gap-3.5 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-gradient-to-br dark:from-blue-600/30 dark:to-cyan-600/20 border border-blue-200 dark:border-cyan-500/30 flex items-center justify-center font-mono font-bold text-blue-600 dark:text-cyan-400 text-xs flex-shrink-0 shadow-sm">
                        §{{ $s->section_number }}
                    </div>
                    <div class="min-w-0">
                        <div class="font-semibold text-sm text-slate-800 dark:text-slate-200 group-hover:text-cyan-600 dark:group-hover:text-white truncate transition-colors">
                            {{ $s->title }}
                        </div>
                        <div class="text-xs text-slate-500 flex items-center gap-2 mt-0.5 font-mono">
                            @if($s->page_start)
                            <span>Pages {{ $s->page_start }}{{ $s->page_end ? '–' . $s->page_end : '' }}</span>
                            <span>•</span>
                            @endif
                            <span class="text-slate-400">{{ $s->subsections()->count() }} subsections</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('manual.section', $s->section_number) }}" target="_blank"
                       class="p-2 rounded-lg bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors"
                       title="View Live Reader">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    <a href="{{ route('admin.sections.edit', $s) }}"
                       class="px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-600/20 hover:bg-blue-100 dark:hover:bg-blue-600/30 border border-blue-200 dark:border-blue-500/30 text-blue-700 dark:text-blue-300 hover:text-blue-900 dark:hover:text-white text-xs font-semibold transition-all">
                        Edit
                    </a>
                </div>
            </div>
            @empty
            <div class="px-6 py-12 text-center text-slate-500">
                No sections found. Run <code class="bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-cyan-600 dark:text-cyan-400">php artisan db:seed</code> to populate.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Right Column (1 Col): Operations & Quick Launch -->
    <div class="space-y-6">

        <!-- Quick Create Control -->
        <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 p-6 shadow-sm dark:shadow-xl space-y-4">
            <h3 class="text-xs font-bold text-slate-900 dark:text-white tracking-wide uppercase">Quick Operations</h3>

            <div class="grid grid-cols-1 gap-2.5">
                <a href="{{ route('admin.sections.create') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/90 hover:bg-slate-100 dark:hover:bg-slate-800/90 border border-slate-200 dark:border-slate-800 hover:border-blue-500/40 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-semibold transition-all group">
                    <span class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        Add Manual Section
                    </span>
                    <span class="text-slate-400 group-hover:text-blue-500 transition-colors font-bold">+</span>
                </a>

                <a href="{{ route('admin.figures.create') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/90 hover:bg-slate-100 dark:hover:bg-slate-800/90 border border-slate-200 dark:border-slate-800 hover:border-amber-500/40 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-semibold transition-all group">
                    <span class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        Upload Technical Figure
                    </span>
                    <span class="text-slate-400 group-hover:text-amber-500 transition-colors font-bold">+</span>
                </a>

                <a href="{{ route('admin.specifications.create') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/90 hover:bg-slate-100 dark:hover:bg-slate-800/90 border border-slate-200 dark:border-slate-800 hover:border-emerald-500/40 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-semibold transition-all group">
                    <span class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Add Factory Specification
                    </span>
                    <span class="text-slate-400 group-hover:text-emerald-500 transition-colors font-bold">+</span>
                </a>

                <a href="{{ route('admin.models.create') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/90 hover:bg-slate-100 dark:hover:bg-slate-800/90 border border-slate-200 dark:border-slate-800 hover:border-sky-500/40 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-semibold transition-all group">
                    <span class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                        Register Aircraft Model
                    </span>
                    <span class="text-slate-400 group-hover:text-sky-500 transition-colors font-bold">+</span>
                </a>

                <a href="{{ route('admin.inspection.create') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/90 hover:bg-slate-100 dark:hover:bg-slate-800/90 border border-slate-200 dark:border-slate-800 hover:border-rose-500/40 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-semibold transition-all group">
                    <span class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                        Add Inspection Task
                    </span>
                    <span class="text-slate-400 group-hover:text-rose-500 transition-colors font-bold">+</span>
                </a>
            </div>
        </div>

        <!-- Master Document Overview Card -->
        @if($manual)
        <div class="rounded-3xl bg-white dark:bg-gradient-to-br dark:from-slate-950 dark:to-blue-950/60 border border-slate-200 dark:border-slate-800 p-6 shadow-sm dark:shadow-xl space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-lg">
                    ✈
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">{{ $manual->title }}</h4>
                    <div class="text-[11px] font-mono text-cyan-600 dark:text-cyan-400 mt-0.5">{{ $manual->edition }}</div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800/80 grid grid-cols-2 gap-3 text-xs">
                <div class="bg-slate-50 dark:bg-slate-900/80 p-3 rounded-xl border border-slate-200 dark:border-slate-800">
                    <div class="text-slate-500 dark:text-slate-400 text-[10px] uppercase font-semibold">Total Pages</div>
                    <div class="font-mono font-bold text-slate-900 dark:text-white text-base mt-0.5">{{ $manual->total_pages }}</div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-900/80 p-3 rounded-xl border border-slate-200 dark:border-slate-800">
                    <div class="text-slate-500 dark:text-slate-400 text-[10px] uppercase font-semibold">Status</div>
                    <div class="font-mono font-bold text-emerald-600 dark:text-emerald-400 text-base mt-0.5">Active</div>
                </div>
            </div>
        </div>
        @endif

    </div>

</div>

@endsection
