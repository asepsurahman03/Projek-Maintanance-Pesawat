<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use App\Models\Section;
use Illuminate\Http\Request;

class AdminSpecificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Specification::with('section')->orderBy('category')->orderBy('sort_order');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $specifications = $query->paginate(30)->withQueryString();
        $categories = Specification::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('admin.specifications.index', compact('specifications', 'categories'));
    }

    public function create()
    {
        $sections   = Section::orderBy('sort_order')->get();
        $categories = ['Aircraft','Engine','Fuel','Oil','Propeller','Landing Gear','Flight Controls','Tires','Torque','Other'];
        return view('admin.specifications.create', compact('sections', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id'  => 'nullable|exists:sections,id',
            'category'    => 'required|string|max:100',
            'name'        => 'required|string|max:255',
            'value'       => 'required|string|max:255',
            'unit'        => 'nullable|string|max:50',
            'model'       => 'nullable|string|max:50',
            'year'        => 'nullable|string|max:10',
            'notes'       => 'nullable|string',
            'source_page' => 'nullable|integer',
            'sort_order'  => 'required|integer|min:0',
        ]);

        Specification::create($data);
        return redirect()->route('admin.specifications.index')->with('success', 'Specification created.');
    }

    public function edit(Specification $specification)
    {
        $sections   = Section::orderBy('sort_order')->get();
        $categories = ['Aircraft','Engine','Fuel','Oil','Propeller','Landing Gear','Flight Controls','Tires','Torque','Other'];
        return view('admin.specifications.edit', compact('specification', 'sections', 'categories'));
    }

    public function update(Request $request, Specification $specification)
    {
        $data = $request->validate([
            'section_id'  => 'nullable|exists:sections,id',
            'category'    => 'required|string|max:100',
            'name'        => 'required|string|max:255',
            'value'       => 'required|string|max:255',
            'unit'        => 'nullable|string|max:50',
            'model'       => 'nullable|string|max:50',
            'year'        => 'nullable|string|max:10',
            'notes'       => 'nullable|string',
            'source_page' => 'nullable|integer',
            'sort_order'  => 'required|integer|min:0',
        ]);

        $specification->update($data);
        return redirect()->route('admin.specifications.index')->with('success', 'Specification updated.');
    }

    public function destroy(Specification $specification)
    {
        $specification->delete();
        return redirect()->route('admin.specifications.index')->with('success', 'Specification deleted.');
    }

    public function show(Specification $specification)
    {
        return redirect()->route('admin.specifications.edit', $specification);
    }
}
