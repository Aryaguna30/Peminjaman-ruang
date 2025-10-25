<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrower extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'purpose',
        'borrow_date',
        'return_date',
        'borrow_time',
        'return_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'borrow_time' => 'datetime:H:i',
        'return_time' => 'datetime:H:i',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // Helper method untuk menghitung durasi peminjaman
    public function getDurationInHours(): float
    {
        $borrowDateTime = \Carbon\Carbon::parse($this->borrow_date . ' ' . $this->borrow_time);
        $returnDateTime = \Carbon\Carbon::parse($this->return_date . ' ' . $this->return_time);
        return $borrowDateTime->diffInHours($returnDateTime);
    }

    // Validasi durasi maksimal 4 jam
    public function isValidDuration(): bool
    {
        return $this->getDurationInHours() <= 4;
    }
}