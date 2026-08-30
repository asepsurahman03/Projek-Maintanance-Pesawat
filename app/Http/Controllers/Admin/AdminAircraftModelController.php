<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AircraftModel;
use Illuminate\Http\Request;

class AdminAircraftModelController extends Controller
{
    public function index()
    {
        $models = AircraftModel::orderBy('year')->paginate(20);
        return view('admin.models.index', compact('models'));
    }

    public function create()
    {
        return view('admin.models.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'popular_name'     => 'required|string|max:100',
            'model'            => 'required|string|max:50',
            'year'             => 'required|string|max:10',
            'serial_beginning' => 'nullable|string|max:50',
            'serial_ending'    => 'nullable|string|max:50',
            'engine'           => 'nullable|string|max:255',
            'notes'            => 'nullable|string',
            'source_page'      => 'nullable|integer',
        ]);

        AircraftModel::create($data);
        return redirect()->route('admin.models.index')->with('success', 'Aircraft model created.');
    }

    public function edit(AircraftModel $model)
    {
        return view('admin.models.edit', compact('model'));
    }

    public function update(Request $request, AircraftModel $model)
    {
        $data = $request->validate([
            'popular_name'     => 'required|string|max:100',
            'model'            => 'required|string|max:50',
            'year'             => 'required|string|max:10',
            'serial_beginning' => 'nullable|string|max:50',
            'serial_ending'    => 'nullable|string|max:50',
            'engine'           => 'nullable|string|max:255',
            'notes'            => 'nullable|string',
            'source_page'      => 'nullable|integer',
        ]);

        $model->update($data);
        return redirect()->route('admin.models.index')->with('success', 'Aircraft model updated.');
    }

    public function destroy(AircraftModel $model)
    {
        $model->delete();
        return redirect()->route('admin.models.index')->with('success', 'Aircraft model deleted.');
    }

    public function show(AircraftModel $model)
    {
        return redirect()->route('admin.models.edit', $model);
    }
}
