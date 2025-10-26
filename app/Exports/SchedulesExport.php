<?php

namespace App\Exports;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SchedulesExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $schedules = Schedule::with('room')->get();
        } else {
            $schedules = Schedule::whereHas('room', function ($query) use ($user) {
                $query->where('category_id', $user->category_id);
            })->with('room')->get();
        }

        return $schedules->map(function ($schedule) {
            return [
                $schedule->id,
                $schedule->room->name,
                $schedule->room->category->name,
                $schedule->day,
                $schedule->start_time,
                $schedule->end_time,
                'Blok ' . $schedule->block,
                'Semester ' . $schedule->semester,
                $schedule->class_name,
                $schedule->teacher_name,
                $schedule->created_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ruangan',
            'Kategori',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Blok',
            'Semester',
            'Kelas',
            'Guru',
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
