@extends('layouts.app')
@section('title', $model->popular_name . ' (' . $model->model . ' - ' . $model->year . ')')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Models', 'url' => route('models.index')],
    ['label' => $model->popular_name . ' (' . $model->model . ')']
]" />
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <span class="badge-blue font-mono text-sm px-3 py-1">{{ $model->model }}</span>
            <span class="text-sm font-semibold text-slate-500">{{ $model->year }}</span>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $model->popular_name }}</h1>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <div class="card p-6 space-y-4">
            <h2 class="text-base font-semibold text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-700 pb-2">Aircraft Identification</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-xs text-slate-500 block">Model Designation</span>
                    <span class="font-mono font-semibold text-slate-800 dark:text-slate-200">{{ $model->model }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-500 block">Model Year</span>
                    <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $model->year }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-500 block">Serial Beginning</span>
                    <span class="font-mono text-slate-800 dark:text-slate-200">{{ $model->serial_beginning ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-500 block">Serial Ending</span>
                    <span class="font-mono text-slate-800 dark:text-slate-200">{{ $model->serial_ending ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h2 class="text-base font-semibold text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-700 pb-2">Engine & System Specifications</h2>
            <div class="text-sm space-y-3">
                <div>
                    <span class="text-xs text-slate-500 block">Standard Engine</span>
                    <span class="font-medium text-slate-800 dark:text-slate-200">{{ $model->engine ?? 'Lycoming O-320-E2D' }}</span>
                </div>
                @if($model->notes)
                <div>
                    <span class="text-xs text-slate-500 block">Technical Notes</span>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">{{ $model->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Applicable Specifications & Sections</h3>
            <p class="text-xs text-slate-500 mt-0.5">Explore technical service sections and specifications for this model.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('specifications', ['model' => $model->model]) }}" class="btn-secondary btn-sm">View Specifications</a>
            <a href="{{ route('manual.index') }}" class="btn-primary btn-sm">Open Manual</a>
        </div>
    </div>

    @if($model->source_page)
    <div class="mt-6">
        <x-source-reference section="01" :page="$model->source_page" />
    </div>
    @endif
</div>
@endsection
