<?php

namespace App\Http\Controllers;

use App\Models\AircraftModel;
use Illuminate\Http\Request;

class AircraftModelController extends Controller
{
    public function index()
    {
        $models = AircraftModel::orderBy('year')->orderBy('model')->get();
        $years  = $models->pluck('year')->unique()->sort()->values();

        return view('models.index', compact('models', 'years'));
    }

    public function show(AircraftModel $model)
    {
        return view('models.show', compact('model'));
    }

    /**
     * AJAX serial number lookup
     * GET /models/lookup?serial=17265522
     */
    public function lookup(Request $request)
    {
        $serial = trim($request->get('serial', ''));

        if (!$serial) {
            return response()->json(['found' => false, 'error' => 'Serial number required.']);
        }

        // Try exact prefix matching first, then numeric range
        $match = AircraftModel::get()->first(fn($m) => $m->matchesSerial($serial));

        if ($match) {
            return response()->json([
                'found' => true,
                'model' => [
                    'id'               => $match->id,
                    'popular_name'     => $match->popular_name,
                    'model'            => $match->model,
                    'year'             => $match->year,
                    'serial_beginning' => $match->serial_beginning,
                    'serial_ending'    => $match->serial_ending,
                    'engine'           => $match->engine,
                    'notes'            => $match->notes,
                    'source_page'      => $match->source_page,
                    'url'              => route('models.show', $match->id),
                ],
            ]);
        }

        return response()->json(['found' => false]);
    }
}
