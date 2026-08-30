<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;

class TorqueController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');

        $query = Specification::where('category', 'Torque')
            ->orderBy('sort_order');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('value', 'LIKE', "%{$search}%")
                  ->orWhere('notes', 'LIKE', "%{$search}%");
            });
        }

        $torqueValues = $query->get();
        $sourcePage   = $torqueValues->first()?->source_page;

        return view('torque.index', compact('torqueValues', 'search', 'sourcePage'));
    }
}
