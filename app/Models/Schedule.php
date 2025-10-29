<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'room_id',
        'day',
        'start_time',
        'end_time',
        'block',
        'semester',
        'class_name',
        'teacher_name',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // Hari dalam bahasa Indonesia
    public static function getDays(): array
    {
        return [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        ];
    }
}