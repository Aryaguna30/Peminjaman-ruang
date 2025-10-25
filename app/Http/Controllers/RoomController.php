<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    // Middleware untuk cek role
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user || (!$user->isAdmin() && !$user->isSarpras() && !$user->isToolman())) {
                return redirect('/dashboard')->with('error', 'Akses ditolak!');
            }
            return $next($request);
        });
    }

    // Tampilkan daftar ruangan
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $rooms = Room::with('category')->paginate(10);
        } elseif ($user->isSarpras()) {
            $rooms = Room::where('category_id', 1)->paginate(10);
        } else {
            $rooms = Room::where('category_id', $user->category_id)->paginate(10);
        }

        return view('rooms.index', compact('rooms'));
    }

    // Tampilkan form create ruangan
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $categories = Category::all();
        } elseif ($user->isSarpras()) {
            $categories = Category::where('id', 1)->get();
        } else {
            $categories = Category::where('id', $user->category_id)->get();
        }

        return view('rooms.create', compact('categories'));
    }

    // Simpan ruangan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect('/rooms')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    // Tampilkan form edit ruangan
    public function edit(Room $room)
    {
        $user = Auth::user();

        // Cek otorisasi
        if (!$user->isAdmin() && $room->category_id !== $user->category_id) {
            return redirect('/rooms')->with('error', 'Akses ditolak!');
        }

        $categories = Category::all();
        return view('rooms.edit', compact('room', 'categories'));
    }

    // Update ruangan
    public function update(Request $request, Room $room)
    {
        $user = Auth::user();

        // Cek otorisasi
        if (!$user->isAdmin() && $room->category_id !== $user->category_id) {
            return redirect('/rooms')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect('/rooms')->with('success', 'Ruangan berhasil diperbarui!');
    }

    // Hapus ruangan
    public function destroy(Room $room)
    {
        $user = Auth::user();

        // Cek otorisasi
        if (!$user->isAdmin() && $room->category_id !== $user->category_id) {
            return redirect('/rooms')->with('error', 'Akses ditolak!');
        }

        $room->delete();

        return redirect('/rooms')->with('success', 'Ruangan berhasil dihapus!');
    }
}