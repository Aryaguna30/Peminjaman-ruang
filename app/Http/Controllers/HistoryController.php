<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data peminjaman yang sudah selesai (status: approved atau rejected)
        $query = Borrower::whereIn('status', ['approved', 'rejected'])
            ->with(['room', 'user'])
            ->orderBy('return_date', 'desc');

        // Filter berdasarkan role
        if ($user->role === 'toolman') {
            $query->where('user_id', $user->id);
        }

        $history = $query->paginate(10);

        return view('history.index', compact('history'));
    }

    public function show(Borrower $borrower)
    {
        return view('history.show', compact('borrower'));
    }
}
