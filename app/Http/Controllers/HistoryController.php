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
        
        $query = Borrower::whereIn('status', ['approved', 'rejected'])
            ->with(['room', 'user'])
            ->orderBy('return_date', 'desc');

        if ($user->role === 'toolman') {
            $query->where('user_id', $user->id);
        }

        $history = $query->paginate(10);

        return view('history.index', compact('history'));
    }

    public function show(Borrower $borrower)
    {
        $user = Auth::user();
        
        if ($user->role === 'toolman' && $borrower->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        if ($user->role === 'sarpras' && $borrower->room->category_id !== 1) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        if ($user->role === 'toolman' && $borrower->room->category_id !== $user->category_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('history.show', compact('borrower'));
    }
}
