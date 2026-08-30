@extends('layouts.admin')
@section('title', 'Edit Aircraft Model')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.models.index') }}" class="p-2 rounded-xl bg-slate-950 border border-slate-800 text-slate-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-extrabold text-white tracking-tight">Edit Model {{ $model->model }}</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ $model->popular_name }} ({{ $model->year }})</p>
        </div>
    </div>

    <div class="rounded-3xl bg-slate-950/80 border border-slate-800/90 p-6 sm:p-8 shadow-2xl">
        <form id="edit-form" method="POST" action="{{ route('admin.models.update', $model) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Popular Name</label>
                    <input type="text" name="popular_name" value="{{ old('popular_name', $model->popular_name) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Model Designation</label>
                    <input type="text" name="model" value="{{ old('model', $model->model) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Model Year</label>
                    <input type="text" name="year" value="{{ old('year', $model->year) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Serial Beginning</label>
                    <input type="text" name="serial_beginning" value="{{ old('serial_beginning', $model->serial_beginning) }}"
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Serial Ending</label>
                    <input type="text" name="serial_ending" value="{{ old('serial_ending', $model->serial_ending) }}"
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Standard Powerplant / Engine</label>
                <input type="text" name="engine" value="{{ old('engine', $model->engine) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Source Page</label>
                <input type="number" name="source_page" value="{{ old('source_page', $model->source_page) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Technical Notes</label>
                <textarea name="notes" rows="3"
                          class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">{{ old('notes', $model->notes) }}</textarea>
            </div>
        </form>

        <div class="pt-6 mt-6 border-t border-slate-800/80 flex items-center justify-between">
            <form method="POST" action="{{ route('admin.models.destroy', $model) }}"
                  onsubmit="return confirm('Delete model {{ $model->model }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/40 text-rose-400 text-xs font-bold transition-colors">
                    Delete Model
                </button>
            </form>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.models.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit" form="edit-form" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white text-xs font-bold shadow-lg shadow-sky-950 transition-all hover:scale-105 active:scale-95">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
