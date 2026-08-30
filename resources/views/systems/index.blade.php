@extends('layouts.app')
@section('title', 'Aircraft Systems')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Aircraft Systems Hub</span>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="pb-6 border-b border-slate-200 dark:border-slate-800">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-100 dark:bg-cyan-950/80 border border-cyan-200 dark:border-cyan-500/30 text-cyan-700 dark:text-cyan-400 text-xs font-mono mb-2">
            <span>AVIONICS & MECHANICAL HUBS</span>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Aircraft Systems Hub</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Jump directly to specific aircraft functional assemblies, powerplants, and flight surfaces</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($systems as $system)
        <a href="{{ $system['url'] }}"
           class="group rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 hover:border-cyan-500/40 p-6 shadow-sm dark:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    {{ $system['icon'] }}
                </div>
                <div class="flex-1 min-w-0 space-y-1.5">
                    <h2 class="text-base font-bold text-slate-900 dark:text-slate-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors tracking-tight">
                        {{ $system['label'] }}
                    </h2>
                    @if($system['sections']->count())
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        @foreach($system['sections'] as $sec)
                        <span class="font-mono text-xs px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-cyan-700 dark:text-cyan-400 font-bold">
                            §{{ $sec->section_number }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>
                <svg class="w-4 h-4 text-slate-400 dark:text-slate-600 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection
