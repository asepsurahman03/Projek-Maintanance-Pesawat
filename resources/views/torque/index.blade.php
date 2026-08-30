@extends('layouts.app')
@section('title', 'Torque Values')

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Torque Values Reference</span>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="pb-6 border-b border-slate-200 dark:border-slate-800">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-950/80 border border-amber-200 dark:border-amber-500/30 text-amber-700 dark:text-amber-400 text-xs font-mono mb-2">
            <span>FIGURE 1-4 • STANDARD TORQUE LIMITS</span>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Installation Torque Limits</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Recommended torque values for standard aircraft hardware fasteners and nuts</p>

        <div class="mt-4 p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-500/30 text-xs text-amber-800 dark:text-amber-300 flex items-start gap-2.5">
            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <div>
                <strong>IMPORTANT NOTICE:</strong> This torque chart applies to installation procedures only and is not intended as a method for checking tightness of parts already installed in service.
            </div>
        </div>
    </div>

    {{-- Search Filter --}}
    <form method="GET" class="max-w-md">
        <div class="relative">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="q" value="{{ $search }}" placeholder="Filter by thread size or description..."
                   class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500 font-mono shadow-sm"
                   oninput="debounceSearch(this.form)">
        </div>
    </form>

    {{-- Torque Values Table --}}
    @if($torqueValues->count())
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/40 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        <th class="px-6 py-4">Thread Size / Fastener Description</th>
                        <th class="px-6 py-4">Torque Limit</th>
                        <th class="px-6 py-4">Unit</th>
                        <th class="px-6 py-4">Application Notes</th>
                        <th class="px-6 py-4">Source Page</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                    @foreach($torqueValues as $tv)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                        <td class="px-6 py-4 font-mono font-bold text-slate-900 dark:text-white">{{ $tv->name }}</td>
                        <td class="px-6 py-4 font-mono font-extrabold text-amber-600 dark:text-amber-400 text-base">{{ $tv->value }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $tv->unit ?? '—' }}</td>
                        <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400 max-w-sm">{{ $tv->notes ?? '—' }}</td>
                        <td class="px-6 py-4 font-mono text-xs">
                            @if($tv->source_page)
                            <a href="{{ route('manual.page', $tv->source_page) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-cyan-600 dark:hover:text-cyan-300 hover:underline">p.{{ $tv->source_page }}</a>
                            @else<span class="text-slate-400">—</span>@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500">
        <p class="font-bold text-slate-700 dark:text-slate-300">No torque values found matching your search</p>
    </div>
    @endif

</div>
@endsection
