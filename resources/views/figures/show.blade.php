@extends('layouts.app')
@section('title', 'Figure ' . $figure->figure_number . ' — ' . $figure->title)

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Figures', 'url' => route('figures.index')],
    ['label' => 'Figure ' . $figure->figure_number]
]" />
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <span class="badge-blue font-mono">Figure {{ $figure->figure_number }}</span>
            @if($figure->section)
            <a href="{{ route('manual.section', $figure->section->section_number) }}" class="badge-slate hover:bg-blue-50 dark:hover:bg-blue-950 transition-colors text-xs">
                Section {{ $figure->section->section_number }}
            </a>
            @endif
            @if($figure->category)
            <span class="badge-amber text-xs">{{ Str::title($figure->category) }}</span>
            @endif
        </div>
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $figure->title }}</h1>
    </div>

    {{-- Figure viewer --}}
    <div class="mb-8">
        <x-figure-viewer :figure="$figure" />
    </div>

    {{-- Details --}}
    <div class="grid sm:grid-cols-2 gap-6">
        <div class="card p-5">
            <h2 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Figure Details</h2>
            <dl class="space-y-2">
                <div class="flex justify-between text-sm">
                    <dt class="text-slate-500">Figure Number</dt>
                    <dd class="font-mono font-medium">{{ $figure->figure_number }}</dd>
                </div>
                @if($figure->page)
                <div class="flex justify-between text-sm">
                    <dt class="text-slate-500">Source Page</dt>
                    <dd><a href="{{ route('manual.page', $figure->page) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-mono">{{ $figure->page }}</a></dd>
                </div>
                @endif
                @if($section)
                <div class="flex justify-between text-sm">
                    <dt class="text-slate-500">Section</dt>
                    <dd><a href="{{ route('manual.section', $section->section_number) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $section->section_number }} — {{ Str::limit($section->title, 30) }}</a></dd>
                </div>
                @endif
                @if($figure->category)
                <div class="flex justify-between text-sm">
                    <dt class="text-slate-500">Category</dt>
                    <dd>{{ Str::title($figure->category) }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    {{-- Prev/Next --}}
    <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-700 flex justify-between gap-4">
        @if($prev)
        <a href="{{ route('figures.show', $prev->id) }}" class="btn-secondary flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Figure {{ $prev->figure_number }}
        </a>
        @else<div></div>@endif

        @if($next)
        <a href="{{ route('figures.show', $next->id) }}" class="btn-secondary flex items-center gap-2">
            Figure {{ $next->figure_number }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endif
    </div>
</div>
@endsection
