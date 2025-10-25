<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BorrowersExport;
use App\Exports\SchedulesExport;

class ReportController extends Controller
{
    // Export peminjam ke PDF
    public function borrowersPdf()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $borrowers = Borrower::with('room')->get();
        } elseif ($user->isSarpras()) {
            $borrowers = Borrower::whereHas('room', function ($query) {
                $query->where('category_id', 1);
            })->with('room')->get();
        } else {
            $borrowers = Borrower::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->with('room')->get();
        }

        $pdf = Pdf::loadView('reports.borrowers', compact('borrowers'));
        return $pdf->download('laporan-peminjam-' . date('Y-m-d') . '.pdf');
    }

    // Export peminjam ke Excel
    public function borrowersExcel()
    {
        return Excel::download(new BorrowersExport, 'laporan-peminjam-' . date('Y-m-d') . '.xlsx');
    }

    // Export jadwal ke PDF
    public function schedulesPdf()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $schedules = Schedule::with('room')->get();
        } else {
            $schedules = Schedule::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->with('room')->get();
        }

        $pdf = Pdf::loadView('reports.schedules', compact('schedules'));
        return $pdf->download('laporan-jadwal-' . date('Y-m-d') . '.pdf');
    }

    // Export jadwal ke Excel
    public function schedulesExcel()
    {
        return Excel::download(new SchedulesExport, 'laporan-jadwal-' . date('Y-m-d') . '.xlsx');
    }
}