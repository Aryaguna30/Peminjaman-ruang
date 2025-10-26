<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'class_name',
        'purpose',
        'borrow_date',
        'borrow_time',
        'return_date',
        'return_time',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
