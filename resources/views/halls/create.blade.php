<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        return view('halls.index', compact('halls'));
    }

    public function create()
    {
        return view('halls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        Hall::create($validated);

        return redirect()->route('halls.index')->with('success', 'Aula berhasil ditambahkan');
    }

    public function edit(Hall $hall)
    {
        return view('halls.edit', compact('hall'));
    }

    public function update(Request $request, Hall $hall)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $hall->update($validated);

        return redirect()->route('halls.index')->with('success', 'Aula berhasil diperbarui');
    }

    public function destroy(Hall $hall)
    {
        $hall->delete();
        return redirect()->route('halls.index')->with('success', 'Aula berhasil dihapus');
    }
}
