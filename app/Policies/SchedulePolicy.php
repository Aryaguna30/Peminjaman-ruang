<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchedulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Schedule $schedule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Schedule $schedule): bool
    {
        // 1. Admin bisa mengedit apa saja
        if ($user->role === 'admin') {
            return true;
        }

        // 2. Sarpras bisa mengedit jadwal di ruangan kategori 1
        if ($user->role === 'sarpras') {
            // Pastikan relasi 'room' sudah di-load
            return $schedule->room->category_id == 1;
        }

        // 3. Pengguna biasa hanya bisa mengedit jadwal
        //    di ruangan yang sesuai dengan kategori mereka
        return $schedule->room->category_id == $user->category_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Schedule $schedule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Schedule $schedule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Schedule $schedule): bool
    {
        return false;
    }
}
