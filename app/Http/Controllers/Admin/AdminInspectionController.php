<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InspectionItem;
use App\Models\Section;
use Illuminate\Http\Request;

class AdminInspectionController extends Controller
{
    public function index(Request $request)
    {
        $query = InspectionItem::with('section')->orderBy('interval')->orderBy('sort_order');

        if ($request->filled('interval')) {
            $query->where('interval', $request->interval);
        }

        $items = $query->paginate(30)->withQueryString();
        return view('admin.inspection.index', compact('items'));
    }

    public function create()
    {
        $sections  = Section::orderBy('sort_order')->get();
        $intervals = InspectionItem::intervals();
        return view('admin.inspection.create', compact('sections', 'intervals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id'  => 'nullable|exists:sections,id',
            'item'        => 'required|string|max:255',
            'interval'    => 'required|string|in:' . implode(',', InspectionItem::intervals()),
            'description' => 'nullable|string',
            'notes'       => 'nullable|string',
            'source_page' => 'nullable|integer',
            'sort_order'  => 'required|integer|min:0',
        ]);

        InspectionItem::create($data);
        return redirect()->route('admin.inspection.index')->with('success', 'Inspection item created.');
    }

    public function edit(InspectionItem $inspection)
    {
        $sections  = Section::orderBy('sort_order')->get();
        $intervals = InspectionItem::intervals();
        return view('admin.inspection.edit', compact('inspection', 'sections', 'intervals'));
    }

    public function update(Request $request, InspectionItem $inspection)
    {
        $data = $request->validate([
            'section_id'  => 'nullable|exists:sections,id',
            'item'        => 'required|string|max:255',
            'interval'    => 'required|string|in:' . implode(',', InspectionItem::intervals()),
            'description' => 'nullable|string',
            'notes'       => 'nullable|string',
            'source_page' => 'nullable|integer',
            'sort_order'  => 'required|integer|min:0',
        ]);

        $inspection->update($data);
        return redirect()->route('admin.inspection.index')->with('success', 'Inspection item updated.');
    }

    public function destroy(InspectionItem $inspection)
    {
        $inspection->delete();
        return redirect()->route('admin.inspection.index')->with('success', 'Inspection item deleted.');
    }

    public function show(InspectionItem $inspection)
    {
        return redirect()->route('admin.inspection.edit', $inspection);
    }
}
