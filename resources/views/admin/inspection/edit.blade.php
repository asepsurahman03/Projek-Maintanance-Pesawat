@extends('layouts.admin')
@section('title', 'Edit Inspection Item')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.inspection.index') }}" class="p-2 rounded-xl bg-slate-950 border border-slate-800 text-slate-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-extrabold text-white tracking-tight">Edit Inspection Task</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ Str::limit($inspection->item, 50) }}</p>
        </div>
    </div>

    <div class="rounded-3xl bg-slate-950/80 border border-slate-800/90 p-6 sm:p-8 shadow-2xl">
        <form id="edit-form" method="POST" action="{{ route('admin.inspection.update', $inspection) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Inspection Interval</label>
                    <select name="interval" required
                            class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">
                        @foreach($intervals as $interval)
                        <option value="{{ $interval }}" {{ $inspection->interval == $interval ? 'selected' : '' }}>{{ $interval }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Section Reference</label>
                    <select name="section_id"
                            class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">
                        <option value="">None / General</option>
                        @foreach($sections as $s)
                        <option value="{{ $s->id }}" {{ $inspection->section_id == $s->id ? 'selected' : '' }}>§{{ $s->section_number }} — {{ Str::limit($s->title, 22) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Task Title</label>
                <input type="text" name="item" value="{{ old('item', $inspection->item) }}" required
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Detailed Procedure</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">{{ old('description', $inspection->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Source Page</label>
                    <input type="number" name="source_page" value="{{ old('source_page', $inspection->source_page) }}"
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $inspection->sort_order) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Warnings & Precautionary Notes</label>
                <textarea name="notes" rows="2"
                          class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">{{ old('notes', $inspection->notes) }}</textarea>
            </div>
        </form>

        <div class="pt-6 mt-6 border-t border-slate-800/80 flex items-center justify-between">
            <form method="POST" action="{{ route('admin.inspection.destroy', $inspection) }}"
                  onsubmit="return confirm('Delete this inspection item?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/40 text-rose-400 text-xs font-bold transition-colors">
                    Delete Task
                </button>
            </form>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.inspection.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit" form="edit-form" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-500 hover:to-pink-500 text-white text-xs font-bold shadow-lg shadow-rose-950 transition-all hover:scale-105 active:scale-95">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
