@extends('layouts.app')
@section('title', 'Figures — Technical Illustrations')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Technical Figures Gallery</span>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header & Filters Toolbar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-950/80 border border-amber-200 dark:border-amber-500/30 text-amber-700 dark:text-amber-400 text-xs font-mono mb-2">
                <span>ILLUSTRATIONS & SCHEMATICS</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Technical Figures Gallery</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Exploded diagrams, wiring schematics, and mechanical installation drawings</p>
        </div>

        <form method="GET" class="flex items-center gap-2.5 flex-wrap">
            <select name="category" class="px-3.5 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 shadow-sm" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ Str::title($cat) }}</option>
                @endforeach
            </select>

            <select name="section" class="px-3.5 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 shadow-sm" onchange="this.form.submit()">
                <option value="">All Sections</option>
                @foreach($sections as $sec)
                <option value="{{ $sec->id }}" {{ request('section') == $sec->id ? 'selected' : '' }}>§{{ $sec->section_number }} — {{ Str::limit($sec->title, 25) }}</option>
                @endforeach
            </select>

            @if(request('category') || request('section'))
            <a href="{{ route('figures.index') }}" class="px-3 py-2 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-xs font-semibold">Clear</a>
            @endif
        </form>
    </div>

    @if($figures->count())
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($figures as $figure)
        <a href="{{ route('figures.show', $figure->id) }}"
           class="group rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 hover:border-amber-500/40 overflow-hidden shadow-sm dark:shadow-xl transition-all duration-300 hover:-translate-y-1">
            {{-- Preview Image Container --}}
            <div class="h-48 bg-slate-100 dark:bg-slate-900/90 flex items-center justify-center p-4 border-b border-slate-100 dark:border-slate-800 overflow-hidden relative">
                @if($figure->hasImage())
                <img src="{{ $figure->image_url }}" alt="{{ $figure->title }}"
                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="text-center text-slate-400 dark:text-slate-500 space-y-1">
                    <svg class="w-10 h-10 mx-auto text-slate-400 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs font-mono">Schematic Reference</span>
                </div>
                @endif
            </div>

            <div class="p-5 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <span class="px-2.5 py-0.5 rounded-lg bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-500/30 font-mono font-bold text-amber-700 dark:text-amber-400 text-xs">
                        Fig. {{ $figure->figure_number }}
                    </span>
                    @if($figure->category)
                    <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400">{{ $figure->category }}</span>
                    @endif
                </div>

                <h3 class="font-bold text-sm text-slate-900 dark:text-slate-100 group-hover:text-amber-600 dark:group-hover:text-amber-300 transition-colors line-clamp-2 leading-snug">
                    {{ $figure->title }}
                </h3>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between text-xs font-mono text-slate-400 dark:text-slate-500">
                    @if($figure->section)
                    <span class="text-blue-600 dark:text-blue-400">§{{ $figure->section->section_number }} {{ $figure->section->title }}</span>
                    @endif
                    @if($figure->page)
                    <span>p.{{ $figure->page }}</span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @if($figures->hasPages())
    <div class="pt-4">
        {{ $figures->links() }}
    </div>
    @endif
    @else
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500">
        <p class="font-bold text-slate-700 dark:text-slate-300 text-base">No figures found for this filter</p>
    </div>
    @endif

</div>
@endsection
