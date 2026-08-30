@extends('layouts.app')
@section('title', 'Wiring Diagrams — Section 20')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Wiring Diagrams</span>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="pb-6 border-b border-slate-200 dark:border-slate-800">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-950/80 border border-yellow-200 dark:border-yellow-500/30 text-yellow-700 dark:text-yellow-400 text-xs font-mono mb-2">
            <span>SECTION 20 • ELECTRICAL SCHEMATICS</span>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Electrical Wiring Diagrams</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Section 20 — Electrical schematics, wire routing, and power distribution diagrams for Cessna 172-Series</p>
    </div>

    @if($diagrams->count())
    <div class="grid sm:grid-cols-2 gap-6">
        @foreach($diagrams as $diagram)
        <a href="{{ route('figures.show', $diagram->id) }}"
           class="group rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 hover:border-yellow-500/40 p-6 shadow-sm dark:shadow-xl transition-all duration-300 hover:-translate-y-1 space-y-4">
            <div class="flex items-start justify-between gap-4">
                <div class="w-12 h-12 rounded-2xl bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="text-right">
                    <span class="px-2.5 py-1 rounded-lg bg-yellow-50 dark:bg-yellow-950/60 border border-yellow-200 dark:border-yellow-500/30 font-mono font-bold text-yellow-700 dark:text-yellow-400 text-xs">
                        Fig. {{ $diagram->figure_number }}
                    </span>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-base text-slate-900 dark:text-slate-100 group-hover:text-yellow-600 dark:group-hover:text-yellow-300 transition-colors tracking-tight">
                    {{ $diagram->title }}
                </h3>
                @if($diagram->caption)
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed">{{ $diagram->caption }}</p>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-mono text-slate-500">
                <span class="text-blue-600 dark:text-blue-400">Section 20</span>
                @if($diagram->page)
                <span>Page {{ $diagram->page }}</span>
                @endif
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500">
        <p class="font-bold text-slate-700 dark:text-slate-300">No wiring diagrams found</p>
    </div>
    @endif

</div>
@endsection
