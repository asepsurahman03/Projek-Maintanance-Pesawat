@extends('layouts.app')
@section('title', 'Search — ' . ($query ? '"' . $query . '"' : 'Manual Search'))

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Search Manual</span>
</div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Search Input Box --}}
    <div class="rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white border border-slate-800 p-6 sm:p-8 shadow-2xl space-y-4">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Search Cessna 172 Manual</h1>
        <p class="text-xs text-slate-300">Search across manual chapters, procedure paragraphs, specifications, schematics, and models</p>

        <form method="GET" action="{{ route('search') }}" id="search-form" class="space-y-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="q" id="search-input" value="{{ $query }}"
                           placeholder="Search engine, torque, alternator, magneto, fuel tank..."
                           class="w-full pl-12 pr-10 py-3.5 bg-slate-900 border border-slate-800 rounded-2xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500"
                           autofocus
                           oninput="debounceSearch(document.getElementById('search-form'), 400)">
                    @if($query)
                    <a href="{{ route('search') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white text-xs">
                        ✕
                    </a>
                    @endif
                </div>
                <button type="submit"
                        class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-bold text-sm shadow-lg shadow-cyan-950 transition-all flex items-center justify-center gap-2">
                    <span>Search</span>
                </button>
            </div>

            {{-- Filter Chips --}}
            @if($query)
            <div class="flex flex-wrap gap-2 pt-2 border-t border-slate-800/80">
                @php
                $filters = ['all' => 'All', 'sections' => 'Sections', 'paragraphs' => 'Paragraphs',
                            'specifications' => 'Specs', 'figures' => 'Figures', 'models' => 'Models', 'inspection' => 'Inspection'];
                @endphp
                @foreach($filters as $key => $label)
                <a href="{{ route('search', ['q' => $query, 'filter' => $key]) }}"
                   class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all border
                          {{ $filter === $key
                             ? 'bg-cyan-600 text-white border-cyan-500 shadow-md shadow-cyan-950'
                             : 'bg-slate-900 text-slate-400 border-slate-800 hover:text-white' }}">
                    {{ $label }}
                    @if(isset($counts[$key]) && $counts[$key] > 0)
                    <span class="ml-1 text-[11px] font-mono opacity-80">({{ $counts[$key] }})</span>
                    @endif
                </a>
                @endforeach
            </div>
            @endif
        </form>
    </div>

    {{-- Results Container --}}
    @if($query)
    <div class="space-y-4">
        <div class="flex items-center justify-between text-xs font-mono text-slate-500 dark:text-slate-400">
            <div>
                Found <strong class="text-cyan-600 dark:text-cyan-400 font-bold">{{ $results->count() }}</strong> results matching <span class="text-slate-900 dark:text-white font-bold">"{{ $query }}"</span>
            </div>
        </div>

        @if($results->count())
        <div class="space-y-3">
            @foreach($results as $result)
            <a href="{{ $result['url'] }}"
               class="block p-5 rounded-3xl bg-white dark:bg-slate-950/80 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-cyan-500/40 transition-all group shadow-sm dark:shadow-md space-y-2">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-lg bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-500/30 text-blue-700 dark:text-cyan-400 font-mono text-[11px] font-bold">
                            {{ $result['badge'] }}
                        </span>
                        @if($result['label'])
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">{{ $result['label'] }}</span>
                        @endif
                    </div>
                    @if($result['page'])
                    <span class="text-xs font-mono text-slate-400 dark:text-slate-500">Page {{ $result['page'] }}</span>
                    @endif
                </div>

                <div class="font-bold text-sm text-slate-900 dark:text-slate-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors">
                    {{ $result['title'] }}
                </div>

                @if($result['excerpt'])
                <div class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-2">
                    {!! $result['excerpt'] !!}
                </div>
                @endif
            </a>
            @endforeach
        </div>
        @else
        <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500 space-y-2">
            <p class="font-bold text-slate-700 dark:text-slate-300 text-base">No results found for "{{ $query }}"</p>
            <p class="text-xs text-slate-400 dark:text-slate-500">Try searching for keywords like "fuel", "engine", "torque", "inspection", or a part name.</p>
        </div>
        @endif
    </div>
    @endif

</div>
@endsection
