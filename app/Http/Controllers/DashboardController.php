<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Borrower;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik berdasarkan role
        if ($user->isAdmin()) {
            $totalRooms = Room::count();
            $totalBorrowers = Borrower::count();
            $totalUsers = \App\Models\User::count();
            $pendingBorrowers = Borrower::where('status', 'pending')->count();
        } elseif ($user->isSarpras()) {
            // Sarpras hanya melihat ruangan umum (category_id = 1)
            $totalRooms = Room::where('category_id', 1)->count();
            $totalBorrowers = Borrower::whereHas('room', function ($query) {
                $query->where('category_id', 1);
            })->count();
            $pendingBorrowers = Borrower::whereHas('room', function ($query) {
                $query->where('category_id', 1);
            })->where('status', 'pending')->count();
            $totalUsers = 1; // Hanya diri sendiri
        } else {
            // Toolman hanya melihat ruangan jurusannya
            $totalRooms = Room::where('category_id', $user->category_id)->count();
            $totalBorrowers = Borrower::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->count();
            $pendingBorrowers = Borrower::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->where('status', 'pending')->count();
            $totalUsers = 1;
        }

        return view('dashboard.index', compact(
            'totalRooms',
            'totalBorrowers',
            'totalUsers',
            'pendingBorrowers'
        ));
    }
}