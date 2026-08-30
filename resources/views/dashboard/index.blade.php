@extends('layouts.app')
@section('title', 'Dashboard')
@section('meta_description', 'Cessna 172-Series Digital Service & Maintenance Manual — Skyhawk 1969–1976')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-10">

    {{-- ── Hero Section ── --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white p-8 sm:p-10 lg:p-12 border border-slate-800 shadow-2xl">
        <!-- Ambient decorative glow -->
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute right-40 -bottom-20 w-60 h-60 rounded-full bg-blue-600/10 blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-400 text-xs font-mono">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                    <span>CESSNA 172 SERIES • SKYHAWK 1969–1976</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
                    Digital Service &<br>Maintenance Manual
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Factory-recommended technical procedures for ground handling, servicing, inspection schedules, and comprehensive maintenance of Cessna 172-Series aircraft.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row lg:flex-col gap-3.5 flex-shrink-0">
                <a href="{{ route('manual.index') }}"
                   class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-sm font-bold flex items-center justify-center gap-2.5 shadow-xl shadow-cyan-950/60 transition-all hover:scale-105 active:scale-95">
                    <svg class="w-5 h-5 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Browse Manual</span>
                </a>
                <a href="{{ route('search') }}"
                   class="px-6 py-3.5 rounded-2xl bg-slate-900/90 hover:bg-slate-800 text-slate-200 hover:text-white border border-slate-700/80 text-sm font-semibold flex items-center justify-center gap-2.5 transition-all shadow-md">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Search Index</span>
                </a>
            </div>
        </div>

        {{-- Stats row --}}
        <div class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-slate-800/80">
            <div class="text-center p-3 rounded-2xl bg-slate-900/40 border border-slate-800/60">
                <div class="text-2xl sm:text-3xl font-extrabold font-mono text-cyan-400">{{ $totalSections }}</div>
                <div class="text-xs text-slate-400 mt-1 font-medium">Manual Sections</div>
            </div>
            <div class="text-center p-3 rounded-2xl bg-slate-900/40 border border-slate-800/60">
                <div class="text-2xl sm:text-3xl font-extrabold font-mono text-blue-400">1969–1976</div>
                <div class="text-xs text-slate-400 mt-1 font-medium">Coverage Years</div>
            </div>
            <div class="text-center p-3 rounded-2xl bg-slate-900/40 border border-slate-800/60">
                <div class="text-2xl sm:text-3xl font-extrabold font-mono text-indigo-400">172 / F172</div>
                <div class="text-xs text-slate-400 mt-1 font-medium">Aircraft Models</div>
            </div>
            <div class="text-center p-3 rounded-2xl bg-slate-900/40 border border-slate-800/60">
                <div class="text-2xl sm:text-3xl font-extrabold font-mono text-emerald-400">414</div>
                <div class="text-xs text-slate-400 mt-1 font-medium">Manual Pages</div>
            </div>
        </div>
    </div>

    {{-- ── Content Grid ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left Column (2 Cols) --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Quick Access Systems Grid --}}
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-cyan-500"></span>
                        Quick Systems Access
                    </h2>
                    <a href="{{ route('systems.index') }}" class="text-xs font-semibold text-cyan-600 dark:text-cyan-400 hover:underline">View All Systems →</a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($quickAccess as $qa)
                    @php
                    $url = isset($qa['url']) ? $qa['url'] : route('systems.show', $qa['slug']);
                    @endphp
                    <a href="{{ $url }}"
                       class="flex flex-col items-center justify-center gap-2 p-4 rounded-2xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-cyan-500/40 transition-all duration-200 text-center group shadow-sm hover:shadow-md hover:-translate-y-0.5">
                        <span class="text-2xl group-hover:scale-110 transition-transform">{{ $qa['icon'] }}</span>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">{{ $qa['label'] }}</span>
                    </a>
                    @endforeach
                </div>
            </section>

            {{-- Master Table of Contents --}}
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        Manual Table of Contents
                    </h2>
                    <a href="{{ route('manual.index') }}" class="text-xs font-semibold text-cyan-600 dark:text-cyan-400 hover:underline">Browse All Chapters →</a>
                </div>

                <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 divide-y divide-slate-100 dark:divide-slate-800/60 overflow-hidden shadow-sm dark:shadow-xl">
                    @forelse($sections as $s)
                    <a href="{{ route('manual.section', $s->section_number) }}"
                       class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-gradient-to-br dark:from-blue-600/30 dark:to-cyan-600/20 border border-blue-200 dark:border-cyan-500/30 flex items-center justify-center font-mono font-bold text-blue-600 dark:text-cyan-400 text-xs shadow-sm flex-shrink-0">
                                §{{ Str::padLeft($s->section_number, 2, '0') }}
                            </div>
                            <div class="min-w-0">
                                <div class="font-bold text-sm text-slate-800 dark:text-slate-200 group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors truncate">
                                    {{ $s->title }}
                                </div>
                                @if($s->page_start)
                                <div class="text-xs font-mono text-slate-500 mt-0.5">
                                    Pages {{ $s->page_start }}{{ $s->page_end ? '–' . $s->page_end : '' }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            <span class="text-xs font-semibold text-slate-400 dark:text-slate-500 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">Read →</span>
                        </div>
                    </a>
                    @empty
                    <div class="px-6 py-12 text-center text-slate-500">
                        No sections available. Run <code class="font-mono bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-cyan-600 dark:text-cyan-400">php artisan db:seed</code>
                    </div>
                    @endforelse
                </div>
            </section>

        </div>

        {{-- Right Column (1 Col) --}}
        <div class="space-y-6">

            {{-- Continue Reading Card --}}
            @if($lastVisited)
            <section class="space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Jump Back In</h3>
                <a href="{{ $lastVisited['route'] }}"
                   class="block p-5 rounded-3xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-cyan-500/40 shadow-sm dark:shadow-xl transition-all group">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 dark:bg-cyan-500/10 border border-cyan-200 dark:border-cyan-500/30 flex items-center justify-center font-mono font-bold text-cyan-600 dark:text-cyan-400 text-xs flex-shrink-0">
                            §{{ $lastVisited['section'] }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-[10px] uppercase font-bold text-cyan-600 dark:text-cyan-400">Last Visited Section</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white truncate group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors mt-0.5">
                                {{ $lastVisited['title'] }}
                            </div>
                        </div>
                    </div>
                </a>
            </section>
            @endif

            {{-- Key Aviation Reference Hub --}}
            <section class="space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Quick Reference Hub</h3>
                <div class="space-y-2.5">
                    <a href="{{ route('specifications') }}"
                       class="flex items-center gap-3.5 p-4 rounded-2xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-emerald-500/40 transition-all group shadow-sm">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">Factory Specifications</div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-400">Aircraft, engine, & fluid ratings</div>
                        </div>
                    </a>

                    <a href="{{ route('models.index') }}"
                       class="flex items-center gap-3.5 p-4 rounded-2xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-sky-500/40 transition-all group shadow-sm">
                        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">Aircraft Models & Serials</div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-400">Serial number lookup tool</div>
                        </div>
                    </a>

                    <a href="{{ route('inspection') }}"
                       class="flex items-center gap-3.5 p-4 rounded-2xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-rose-500/40 transition-all group shadow-sm">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">Inspection Checklist</div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-400">50h, 100h, 200h & annual cards</div>
                        </div>
                    </a>

                    <a href="{{ route('torque') }}"
                       class="flex items-center gap-3.5 p-4 rounded-2xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-amber-500/40 transition-all group shadow-sm">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">Torque Values</div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-400">Standard bolt tightening table</div>
                        </div>
                    </a>

                    <a href="{{ route('wiring') }}"
                       class="flex items-center gap-3.5 p-4 rounded-2xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-yellow-500/40 transition-all group shadow-sm">
                        <div class="w-9 h-9 rounded-xl bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors">Wiring Diagrams</div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-400">Section 20 schematics</div>
                        </div>
                    </a>
                </div>
            </section>

            {{-- Manual Document Card --}}
            @if($manual)
            <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-6 shadow-sm dark:shadow-xl space-y-3">
                <div class="text-xs font-bold uppercase tracking-wider text-cyan-600 dark:text-cyan-400">Active Documentation</div>
                <div class="text-sm font-bold text-slate-900 dark:text-white leading-snug">{{ $manual->title }}</div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800/80 grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <span class="text-slate-400 text-[10px] block">Edition</span>
                        <span class="font-mono text-slate-700 dark:text-slate-200">{{ $manual->edition }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 text-[10px] block">Coverage</span>
                        <span class="font-mono text-slate-700 dark:text-slate-200">{{ $manual->coverage_start }}–{{ $manual->coverage_end }}</span>
                    </div>
                </div>
            </div>
            @endif

        </div>

    </div>

</div>
@endsection
