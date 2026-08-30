@extends('layouts.app')
@section('title', 'Aircraft Models — Serial Lookup')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Aircraft Models & Serials</span>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-10">

    {{-- Header --}}
    <div class="pb-6 border-b border-slate-200 dark:border-slate-800">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 dark:bg-sky-950/80 border border-sky-200 dark:border-sky-500/30 text-sky-700 dark:text-sky-400 text-xs font-mono mb-2">
            <span>MODEL DIRECTORY • 1969–1976</span>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Aircraft Models & Serial Range Lookup</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Cross-reference factory serial numbers to find exact Skyhawk production years and powerplant variants</p>
    </div>

    {{-- Serial Number Lookup Card --}}
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 p-6 sm:p-8 shadow-sm dark:shadow-xl space-y-4" x-data="serialLookup()">
        <h2 class="text-base font-bold text-slate-900 dark:text-white tracking-tight flex items-center gap-2">
            <svg class="w-5 h-5 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Aircraft Serial Number Lookup Tool
        </h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" x-model="serial"
                   placeholder="Enter aircraft serial number (e.g. 17265522, F17200805)"
                   class="flex-1 px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 font-mono"
                   @keydown.enter="lookup()">
            <button @click="lookup()"
                    class="px-6 py-3 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-bold text-sm flex items-center justify-center gap-2 shadow-lg shadow-sky-950/30 transition-all hover:scale-105 active:scale-95 flex-shrink-0"
                    :disabled="loading">
                <span x-show="loading" class="animate-spin w-4 h-4 border-2 border-white/30 border-t-white rounded-full" style="display:none"></span>
                <span x-show="!loading">Identify Model</span>
                <span x-show="loading" style="display:none">Matching...</span>
            </button>
        </div>
        <p class="text-xs text-slate-400 dark:text-slate-500 font-mono">Example: Try <code>17265522</code> (1975 Skyhawk) or <code>F17200805</code> (1972 Reims Skyhawk)</p>

        {{-- Result --}}
        <div x-show="result" class="mt-4 p-5 bg-gradient-to-r from-emerald-50 to-white dark:from-emerald-950/60 dark:to-slate-950 border border-emerald-300 dark:border-emerald-500/40 rounded-2xl space-y-3 shadow-md" style="display:none">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                <span class="font-bold text-emerald-800 dark:text-emerald-300 text-sm">Aircraft Model Identified</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-mono">
                <div class="bg-white dark:bg-slate-900/60 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xs">
                    <div class="text-slate-500 dark:text-slate-400 text-[10px] uppercase">Popular Name</div>
                    <div class="font-bold text-slate-900 dark:text-white text-sm mt-0.5" x-text="result?.popular_name"></div>
                </div>
                <div class="bg-white dark:bg-slate-900/60 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xs">
                    <div class="text-slate-500 dark:text-slate-400 text-[10px] uppercase">Model</div>
                    <div class="font-bold text-sky-600 dark:text-sky-400 text-sm mt-0.5" x-text="result?.model"></div>
                </div>
                <div class="bg-white dark:bg-slate-900/60 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xs">
                    <div class="text-slate-500 dark:text-slate-400 text-[10px] uppercase">Production Year</div>
                    <div class="font-bold text-emerald-600 dark:text-emerald-400 text-sm mt-0.5" x-text="result?.year"></div>
                </div>
                <div class="bg-white dark:bg-slate-900/60 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xs">
                    <div class="text-slate-500 dark:text-slate-400 text-[10px] uppercase">Powerplant</div>
                    <div class="font-bold text-slate-700 dark:text-slate-200 text-xs mt-0.5 truncate" x-text="result?.engine || 'Lycoming O-320'"></div>
                </div>
            </div>
        </div>

        <div x-show="error" class="mt-4 p-4 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-500/40 rounded-2xl text-xs text-rose-700 dark:text-rose-300" style="display:none" x-text="error"></div>
    </div>

    {{-- Full Models Table --}}
    <div class="space-y-4">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight">Complete Model Cross-Reference Catalog</h2>
        @if($models->count())
        <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/40 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            <th class="px-6 py-3.5">Popular Name</th>
                            <th class="px-6 py-3.5">Model</th>
                            <th class="px-6 py-3.5">Year</th>
                            <th class="px-6 py-3.5">Serial Range</th>
                            <th class="px-6 py-3.5">Engine Configuration</th>
                            <th class="px-6 py-3.5">Source</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                        @foreach($models->groupBy('year') as $year => $yearModels)
                        @foreach($yearModels as $model)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                            <td class="px-6 py-3.5 font-bold text-slate-900 dark:text-slate-100">{{ $model->popular_name }}</td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-xl bg-sky-50 dark:bg-sky-950/40 border border-sky-200 dark:border-sky-500/30 text-sky-700 dark:text-sky-400 font-mono text-xs font-bold">{{ $model->model }}</span>
                            </td>
                            <td class="px-6 py-3.5 font-mono text-xs font-bold text-slate-900 dark:text-white">{{ $model->year }}</td>
                            <td class="px-6 py-3.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                @if($model->serial_beginning)
                                {{ $model->serial_beginning }} {{ $model->serial_ending ? 'thru ' . $model->serial_ending : '& on' }}
                                @else — @endif
                            </td>
                            <td class="px-6 py-3.5 text-xs text-slate-500 dark:text-slate-400 font-mono">{{ $model->engine ?? 'Lycoming O-320' }}</td>
                            <td class="px-6 py-3.5 font-mono text-xs">
                                @if($model->source_page)
                                <a href="{{ route('manual.page', $model->source_page) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-cyan-600 dark:hover:text-cyan-300 hover:underline">p.{{ $model->source_page }}</a>
                                @else<span class="text-slate-400">—</span>@endif
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500">
            <p class="font-bold text-slate-700 dark:text-slate-300">No aircraft models found</p>
        </div>
        @endif
    </div>

</div>
@endsection
