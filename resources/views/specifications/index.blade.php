@extends('layouts.app')
@section('title', 'Aircraft Specifications')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Aircraft Specifications</span>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header & Filter Toolbar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400 text-xs font-mono mb-2">
                <span>SECTION 01 • FACTORY DATA</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Aircraft Specifications</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Design limits, standard ratings, dimensions, and fluid capacities</p>
        </div>

        {{-- Filter Selectors --}}
        <form method="GET" class="flex items-center gap-2.5 flex-wrap">
            <select name="model" class="px-3.5 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm" onchange="this.form.submit()">
                <option value="">All Models (172/F172)</option>
                @foreach($models as $m)
                <option value="{{ $m }}" {{ request('model') == $m ? 'selected' : '' }}>Model {{ $m }}</option>
                @endforeach
            </select>

            <select name="year" class="px-3.5 py-2 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm" onchange="this.form.submit()">
                <option value="">All Years (1969–1976)</option>
                @foreach($years as $y)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>Year {{ $y }}</option>
                @endforeach
            </select>

            @if(request('model') || request('year'))
            <a href="{{ route('specifications') }}" class="px-3 py-2 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-xs font-semibold">Clear</a>
            @endif
        </form>
    </div>

    {{-- Grouped Specifications Cards --}}
    @if($grouped->count())
    <div class="space-y-8">
        @foreach($grouped as $category => $specs)
        <div id="{{ Str::slug($category) }}" class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-xl scroll-mt-20">
            {{-- Category Header --}}
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/60 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                    <h2 class="text-base font-bold text-slate-900 dark:text-white tracking-tight">{{ $category }}</h2>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400 font-mono text-xs font-bold">
                    {{ $specs->count() }} items
                </span>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/40 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            <th class="px-6 py-3.5">Specification</th>
                            <th class="px-6 py-3.5">Rating / Value</th>
                            <th class="px-6 py-3.5">Unit</th>
                            <th class="px-6 py-3.5">Model</th>
                            <th class="px-6 py-3.5">Year</th>
                            <th class="px-6 py-3.5">Source</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                        @foreach($specs as $spec)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                            <td class="px-6 py-3.5 font-bold text-slate-900 dark:text-slate-100">{{ $spec->name }}</td>
                            <td class="px-6 py-3.5 font-mono font-bold text-cyan-600 dark:text-cyan-400">{{ $spec->value }}</td>
                            <td class="px-6 py-3.5 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $spec->unit ?? '—' }}</td>
                            <td class="px-6 py-3.5 font-mono text-xs">
                                @if($spec->model)
                                <span class="px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300">{{ $spec->model }}</span>
                                @else<span class="text-slate-400">All</span>@endif
                            </td>
                            <td class="px-6 py-3.5 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $spec->year ?? '1969–1976' }}</td>
                            <td class="px-6 py-3.5 font-mono text-xs">
                                @if($spec->source_page)
                                <a href="{{ route('manual.page', $spec->source_page) }}" target="_blank"
                                   class="text-blue-600 dark:text-blue-400 hover:text-cyan-600 dark:hover:text-cyan-300 hover:underline">
                                    p.{{ $spec->source_page }}
                                </a>
                                @else<span class="text-slate-400">—</span>@endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500">
        <p class="font-bold text-slate-700 dark:text-slate-300 text-base">No specifications matching your filter</p>
        <a href="{{ route('specifications') }}" class="mt-3 inline-block text-xs font-semibold text-cyan-600 dark:text-cyan-400 hover:underline">Reset Filters</a>
    </div>
    @endif

</div>
@endsection
