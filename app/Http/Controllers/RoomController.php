<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $rooms = Room::with('category')->paginate(10);
        } elseif ($user->role === 'sarpras') {
            $rooms = Room::where('category_id', 1)->with('category')->paginate(10);
        } else {
            $rooms = Room::where('category_id', $user->category_id)->with('category')->paginate(10);
        }

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('rooms.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect('/rooms')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $categories = Category::all();
        return view('rooms.edit', compact('room', 'categories'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect('/rooms')->with('success', 'Ruangan berhasil diperbarui!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('/rooms')->with('success', 'Ruangan berhasil dihapus!');
    }
}
