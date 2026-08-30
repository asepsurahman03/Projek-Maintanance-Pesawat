@extends('layouts.admin')
@section('title', 'Edit Section ' . $section->section_number)

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.sections.index') }}" class="p-2 rounded-xl bg-slate-950 border border-slate-800 text-slate-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-extrabold text-white tracking-tight">Edit Section §{{ $section->section_number }}</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ $section->title }}</p>
        </div>
    </div>

    <div class="rounded-3xl bg-slate-950/80 border border-slate-800/90 p-6 sm:p-8 shadow-2xl">
        <form id="edit-form" method="POST" action="{{ route('admin.sections.update', $section) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Target Manual</label>
                    <select name="manual_id" required
                            class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        @foreach($manuals as $m)
                        <option value="{{ $m->id }}" {{ $section->manual_id == $m->id ? 'selected' : '' }}>{{ $m->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Section Number</label>
                    <input type="text" name="section_number" value="{{ old('section_number', $section->section_number) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Section Title</label>
                <input type="text" name="title" value="{{ old('title', $section->title) }}" required
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Description & Scope</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">{{ old('description', $section->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Start Page</label>
                    <input type="number" name="page_start" value="{{ old('page_start', $section->page_start) }}"
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">End Page</label>
                    <input type="number" name="page_end" value="{{ old('page_end', $section->page_end) }}"
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">System Slug (Optional)</label>
                <input type="text" name="system_slug" value="{{ old('system_slug', $section->system_slug) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>
        </form>

        <div class="pt-6 mt-6 border-t border-slate-800/80 flex items-center justify-between">
            <form method="POST" action="{{ route('admin.sections.destroy', $section) }}"
                  onsubmit="return confirm('Delete section {{ $section->section_number }} and all its subsections?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/40 text-rose-400 text-xs font-bold transition-colors">
                    Delete Section
                </button>
            </form>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.sections.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit" form="edit-form" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-xs font-bold shadow-lg shadow-cyan-950 transition-all hover:scale-105 active:scale-95">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
