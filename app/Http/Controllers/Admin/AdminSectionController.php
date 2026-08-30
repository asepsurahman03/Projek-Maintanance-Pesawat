<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Manual;
use Illuminate\Http\Request;

class AdminSectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('manual')->withCount('subsections')->orderBy('sort_order')->paginate(30);
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        $manuals = Manual::all();
        return view('admin.sections.create', compact('manuals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'manual_id'      => 'required|exists:manuals,id',
            'section_number' => 'required|string|max:10',
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'page_start'     => 'nullable|integer|min:1',
            'page_end'       => 'nullable|integer|min:1',
            'system_slug'    => 'nullable|string|max:100',
            'sort_order'     => 'required|integer|min:0',
        ]);

        Section::create($data);
        return redirect()->route('admin.sections.index')->with('success', 'Section created.');
    }

    public function edit(Section $section)
    {
        $manuals = Manual::all();
        return view('admin.sections.edit', compact('section', 'manuals'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'manual_id'      => 'required|exists:manuals,id',
            'section_number' => 'required|string|max:10',
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'page_start'     => 'nullable|integer|min:1',
            'page_end'       => 'nullable|integer|min:1',
            'system_slug'    => 'nullable|string|max:100',
            'sort_order'     => 'required|integer|min:0',
        ]);

        $section->update($data);
        return redirect()->route('admin.sections.index')->with('success', 'Section updated.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section deleted.');
    }

    public function show(Section $section)
    {
        return redirect()->route('admin.sections.edit', $section);
    }
}
