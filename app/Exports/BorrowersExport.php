<?php

namespace App\Exports;

use App\Models\Borrower;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BorrowersExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
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

        return $borrowers->map(function ($borrower) {
            return [
                $borrower->id,
                $borrower->name,
                $borrower->email,
                $borrower->phone,
                $borrower->room->name,
                $borrower->purpose,
                $borrower->borrow_date->format('d/m/Y'),
                $borrower->borrow_time,
                $borrower->return_date->format('d/m/Y'),
                $borrower->return_time,
                $borrower->status,
                $borrower->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'Email',
            'Telepon',
            'Ruangan',
            'Keperluan',
            'Tanggal Peminjaman',
            'Jam Peminjaman',
            'Tanggal Pengembalian',
            'Jam Pengembalian',
            'Status',
            'Dibuat Pada',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0066CC']],
            ],
        ];
    }
}