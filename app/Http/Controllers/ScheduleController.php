<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user || (!$user->isAdmin() && !$user->isToolman())) {
                return redirect('/dashboard')->with('error', 'Akses ditolak!');
            }
            return $next($request);
        });
    }

    // Tampilkan daftar jadwal
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $schedules = Schedule::with('room')->paginate(10);
        } else {
            $schedules = Schedule::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->with('room')->paginate(10);
        }

        return view('schedules.index', compact('schedules'));
    }

    // Tampilkan form create jadwal
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $rooms = Room::all();
        } else {
            $rooms = Room::where('category_id', $user->category_id)->get();
        }

        $days = Schedule::getDays();

        return view('schedules.create', compact('rooms', 'days'));
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'block' => 'required|in:1,2',
            'semester' => 'required|integer|min:1|max:2',
            'class_name' => 'nullable|string|max:100',
            'teacher_name' => 'nullable|string|max:100',
        ]);

        Schedule::create($validated);

        return redirect('/schedules')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Tampilkan form edit jadwal
    public function edit(Schedule $schedule)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $schedule->room->category_id !== $user->category_id) {
            return redirect('/schedules')->with('error', 'Akses ditolak!');
        }

        $rooms = Room::all();
        $days = Schedule::getDays();

        return view('schedules.edit', compact('schedule', 'rooms', 'days'));
    }

    // Update jadwal
    public function update(Request $request, Schedule $schedule)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $schedule->room->category_id !== $user->category_id) {
            return redirect('/schedules')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'block' => 'required|in:1,2',
            'semester' => 'required|integer|min:1|max:2',
            'class_name' => 'nullable|string|max:100',
            'teacher_name' => 'nullable|string|max:100',
        ]);

        $schedule->update($validated);

        return redirect('/schedules')->with('success', 'Jadwal berhasil diperbarui!');
    }

    // Hapus jadwal
    public function destroy(Schedule $schedule)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $schedule->room->category_id !== $user->category_id) {
            return redirect('/schedules')->with('error', 'Akses ditolak!');
        }

        $schedule->delete();

        return redirect('/schedules')->with('success', 'Jadwal berhasil dihapus!');
    }
}