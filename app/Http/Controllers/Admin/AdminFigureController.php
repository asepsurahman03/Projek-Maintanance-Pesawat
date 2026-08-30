<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Figure;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFigureController extends Controller
{
    public function index()
    {
        $figures = Figure::with('section')->orderBy('figure_number')->paginate(20);
        return view('admin.figures.index', compact('figures'));
    }

    public function create()
    {
        $sections = Section::orderBy('sort_order')->get();
        return view('admin.figures.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id'    => 'required|exists:sections,id',
            'figure_number' => 'required|string|max:20',
            'title'         => 'required|string|max:255',
            'page'          => 'nullable|integer|min:1',
            'caption'       => 'nullable|string',
            'category'      => 'nullable|string|max:50',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('figures', 'public');
        }

        unset($data['image']);
        Figure::create($data);
        return redirect()->route('admin.figures.index')->with('success', 'Figure created.');
    }

    public function edit(Figure $figure)
    {
        $sections = Section::orderBy('sort_order')->get();
        return view('admin.figures.edit', compact('figure', 'sections'));
    }

    public function update(Request $request, Figure $figure)
    {
        $data = $request->validate([
            'section_id'    => 'required|exists:sections,id',
            'figure_number' => 'required|string|max:20',
            'title'         => 'required|string|max:255',
            'page'          => 'nullable|integer|min:1',
            'caption'       => 'nullable|string',
            'category'      => 'nullable|string|max:50',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($figure->image_path) {
                Storage::disk('public')->delete($figure->image_path);
            }
            $data['image_path'] = $request->file('image')->store('figures', 'public');
        }

        unset($data['image']);
        $figure->update($data);
        return redirect()->route('admin.figures.index')->with('success', 'Figure updated.');
    }

    public function destroy(Figure $figure)
    {
        if ($figure->image_path) {
            Storage::disk('public')->delete($figure->image_path);
        }
        $figure->delete();
        return redirect()->route('admin.figures.index')->with('success', 'Figure deleted.');
    }

    public function show(Figure $figure)
    {
        return redirect()->route('admin.figures.edit', $figure);
    }
}
