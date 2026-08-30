@extends('layouts.app')
@section('title', $info['label'])

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Systems', 'url' => route('systems.index')],
    ['label' => $info['label']]
]" />
@endsection

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
    <div class="flex items-center gap-4 mb-8">
        <span class="text-4xl">{{ $info['icon'] }}</span>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $info['label'] }}</h1>
            <div class="flex flex-wrap gap-1.5 mt-2">
                @foreach($sections as $s)
                <span class="badge-blue font-mono text-xs">Section {{ $s->section_number }}</span>
                @endforeach
            </div>
        </div>
    </div>

    @if($sections->count())
    @foreach($sections as $section)
    <div class="mb-10">
        {{-- Section header --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                <span class="section-pill">{{ $section->section_number }}</span>
                {{ $section->title }}
            </h2>
            <a href="{{ route('manual.section', $section->section_number) }}" class="btn-secondary btn-sm">
                Full Section →
            </a>
        </div>

        @if($section->description)
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">{{ $section->description }}</p>
        @endif

        {{-- Subsections preview (first 5) --}}
        @if($section->subsections->count())
        <div class="card divide-y divide-slate-100 dark:divide-slate-700/50 mb-4">
            @foreach($section->subsections->take(8) as $sub)
            <a href="{{ route('manual.section', $section->section_number) }}#para-{{ Str::slug($sub->paragraph_number) }}"
               class="flex items-start gap-3 px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors group">
                @if($sub->paragraph_number)
                <span class="font-mono text-xs text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5 w-14">{{ $sub->paragraph_number }}</span>
                @endif
                <span class="text-sm text-slate-700 dark:text-slate-300 group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">{{ $sub->title ?: Str::limit($sub->content, 80) }}</span>
            </a>
            @endforeach
            @if($section->subsections->count() > 8)
            <div class="px-5 py-3 text-xs text-slate-400">+{{ $section->subsections->count() - 8 }} more paragraphs</div>
            @endif
        </div>
        @endif

        {{-- Figures for this section --}}
        @if($section->figures->count())
        <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Figures</h3>
        <div class="grid sm:grid-cols-2 gap-4">
            @foreach($section->figures->take(4) as $figure)
            <a href="{{ route('figures.show', $figure->id) }}" class="card-hover p-4 flex items-center gap-3">
                <span class="badge-amber font-mono text-xs flex-shrink-0">Fig. {{ $figure->figure_number }}</span>
                <span class="text-sm text-slate-700 dark:text-slate-300 truncate">{{ $figure->title }}</span>
            </a>
            @endforeach
        </div>
        @endif
    </div>
    @endforeach
    @else
    <x-empty-state title="No data found for this system"
                   message="Run php artisan db:seed or manual:import to populate system data."
                   icon="document">
        <a href="{{ route('systems.index') }}" class="btn-secondary">Back to Systems</a>
    </x-empty-state>
    @endif
</div>
@endsection
