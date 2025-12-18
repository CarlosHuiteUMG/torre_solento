<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('name')->get();
        return view('admin.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'max_capacity' => ['nullable', 'integer', 'min:1'],
        ]);

        Area::create($validated);

        return redirect()->route('admin.areas.index')->with('status', 'Área creada');
    }

    public function edit(Area $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'max_capacity' => ['nullable', 'integer', 'min:1'],
        ]);

        $area->update($validated);

        return redirect()->route('admin.areas.index')->with('status', 'Área actualizada');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('status', 'Área eliminada');
    }
}
