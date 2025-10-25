<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowerController extends Controller
{
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

    // Tampilkan daftar peminjam
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $borrowers = Borrower::with('room')->paginate(10);
        } elseif ($user->isSarpras()) {
            $borrowers = Borrower::whereHas('room', function ($query) {
                $query->where('category_id', 1);
            })->with('room')->paginate(10);
        } else {
            $borrowers = Borrower::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->with('room')->paginate(10);
        }

        return view('borrowers.index', compact('borrowers'));
    }

    // Tampilkan form create peminjam
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $rooms = Room::all();
        } elseif ($user->isSarpras()) {
            $rooms = Room::where('category_id', 1)->get();
        } else {
            $rooms = Room::where('category_id', $user->category_id)->get();
        }

        return view('borrowers.create', compact('rooms'));
    }

    // Simpan peminjam baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'purpose' => 'required|string',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'borrow_time' => 'required|date_format:H:i',
            'return_time' => 'required|date_format:H:i',
        ]);

        // Validasi durasi maksimal 4 jam
        $borrowDateTime = Carbon::parse($validated['borrow_date'] . ' ' . $validated['borrow_time']);
        $returnDateTime = Carbon::parse($validated['return_date'] . ' ' . $validated['return_time']);
        $durationHours = $borrowDateTime->diffInHours($returnDateTime);

        if ($durationHours > 4) {
            return back()->withErrors(['return_time' => 'Durasi peminjaman maksimal 4 jam!']);
        }

        $validated['status'] = 'pending';
        Borrower::create($validated);

        return redirect('/borrowers')->with('success', 'Data peminjam berhasil ditambahkan!');
    }

    // Tampilkan form edit peminjam
    public function edit(Borrower $borrower)
    {
        $user = Auth::user();

        // Cek otorisasi
        if (!$user->isAdmin() && $borrower->room->category_id !== $user->category_id) {
            return redirect('/borrowers')->with('error', 'Akses ditolak!');
        }

        $rooms = Room::all();
        return view('borrowers.edit', compact('borrower', 'rooms'));
    }

    // Update peminjam
    public function update(Request $request, Borrower $borrower)
    {
        $user = Auth::user();

        // Cek otorisasi
        if (!$user->isAdmin() && $borrower->room->category_id !== $user->category_id) {
            return redirect('/borrowers')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'purpose' => 'required|string',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'borrow_time' => 'required|date_format:H:i',
            'return_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,approved,rejected,completed',
        ]);

        // Validasi durasi maksimal 4 jam
        $borrowDateTime = Carbon::parse($validated['borrow_date'] . ' ' . $validated['borrow_time']);
        $returnDateTime = Carbon::parse($validated['return_date'] . ' ' . $validated['return_time']);
        $durationHours = $borrowDateTime->diffInHours($returnDateTime);

        if ($durationHours > 4) {
            return back()->withErrors(['return_time' => 'Durasi peminjaman maksimal 4 jam!']);
        }

        $borrower->update($validated);

        return redirect('/borrowers')->with('success', 'Data peminjam berhasil diperbarui!');
    }

    // Hapus peminjam
    public function destroy(Borrower $borrower)
    {
        $user = Auth::user();

        // Cek otorisasi
        if (!$user->isAdmin() && $borrower->room->category_id !== $user->category_id) {
            return redirect('/borrowers')->with('error', 'Akses ditolak!');
        }

        $borrower->delete();

        return redirect('/borrowers')->with('success', 'Data peminjam berhasil dihapus!');
    }

    // Approve peminjaman
    public function approve(Borrower $borrower)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $borrower->room->category_id !== $user->category_id) {
            return redirect('/borrowers')->with('error', 'Akses ditolak!');
        }

        $borrower->update(['status' => 'approved']);

        return redirect('/borrowers')->with('success', 'Peminjaman disetujui!');
    }

    // Reject peminjaman
    public function reject(Borrower $borrower)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $borrower->room->category_id !== $user->category_id) {
            return redirect('/borrowers')->with('error', 'Akses ditolak!');
        }

        $borrower->update(['status' => 'rejected']);

        return redirect('/borrowers')->with('success', 'Peminjaman ditolak!');
    }
}