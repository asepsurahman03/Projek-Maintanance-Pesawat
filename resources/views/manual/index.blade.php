@extends('layouts.app')
@section('title', 'Manual — Table of Contents')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Service Manual Table of Contents</span>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-950/80 border border-blue-200 dark:border-blue-500/30 text-blue-700 dark:text-blue-400 text-xs font-mono mb-2">
                <span>MASTER INDEX • 21 SECTIONS</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Cessna 172-Series Service Manual</h1>
            @if($manual)
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                {{ $manual->title }} • <span class="font-mono text-cyan-600 dark:text-cyan-400 font-semibold">{{ $manual->edition }}</span> ({{ $manual->coverage_start }}–{{ $manual->coverage_end }})
            </p>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-3 flex-shrink-0">
            <a href="{{ route('manual.page', 1) }}"
               class="px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-semibold flex items-center gap-2 transition-all shadow-sm">
                <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                <span>Original PDF Viewer</span>
            </a>
            <a href="{{ route('search') }}"
               class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-cyan-950/40 transition-all hover:scale-105 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span>Search Manual</span>
            </a>
        </div>
    </div>

    <!-- Sections List Card -->
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 divide-y divide-slate-100 dark:divide-slate-800/60 overflow-hidden shadow-sm dark:shadow-2xl">
        @forelse($sections as $section)
        <a href="{{ route('manual.section', $section->section_number) }}"
           class="flex items-center justify-between gap-5 px-6 py-4.5 hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
            <div class="flex items-center gap-4 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-gradient-to-br dark:from-blue-600/30 dark:to-cyan-600/20 border border-blue-200 dark:border-cyan-500/30 flex items-center justify-center font-mono font-bold text-blue-600 dark:text-cyan-400 text-xs shadow-sm flex-shrink-0">
                    §{{ Str::padLeft($section->section_number, 2, '0') }}
                </div>
                <div class="min-w-0">
                    <div class="font-bold text-sm text-slate-800 dark:text-slate-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors">
                        Section {{ $section->section_number }} — {{ $section->title }}
                    </div>
                    @if($section->description)
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 truncate max-w-2xl">{{ $section->description }}</div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-4 flex-shrink-0">
                @if($section->page_start)
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 font-mono text-xs text-slate-600 dark:text-slate-400">
                    p.{{ $section->page_start }}@if($section->page_end)–{{ $section->page_end }}@endif
                </span>
                @endif
                <span class="text-xs font-semibold text-slate-400 dark:text-slate-500 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors flex items-center gap-1">
                    <span>Read</span>
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>
        @empty
        <div class="px-6 py-16 text-center text-slate-500">
            <p class="font-bold text-slate-700 dark:text-slate-300">No sections found</p>
            <p class="text-xs text-slate-500 mt-1">Run <code class="font-mono bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-cyan-600 dark:text-cyan-400">php artisan db:seed</code> to populate manual sections.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
