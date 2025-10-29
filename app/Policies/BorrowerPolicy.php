<?php

namespace App\Policies;

use App\Models\Borrower;
use App\Models\User;

class BorrowerPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'sarpras', 'toolman']);
    }

    public function view(User $user, Borrower $borrower): bool
    {
        // Admin can view all
        if ($user->role === 'admin') {
            return true;
        }

        if (!$borrower->room) {
            return false;
        }

        // Sarpras can view borrowers from category_id = 1
        if ($user->role === 'sarpras') {
            return $borrower->room->category_id === 1;
        }

        // Toolman can view borrowers from their category
        if ($user->role === 'toolman') {
            return $borrower->room->category_id === $user->category_id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'sarpras', 'toolman']);
    }

    public function update(User $user, Borrower $borrower): bool
    {
        // Admin can update all
        if ($user->role === 'admin') {
            return true;
        }

        if (!$borrower->room) {
            return false;
        }

        // Sarpras can update borrowers from category_id = 1
        if ($user->role === 'sarpras') {
            return $borrower->room->category_id === 1;
        }

        // Toolman can update borrowers from their category
        if ($user->role === 'toolman') {
            return $borrower->room->category_id === $user->category_id;
        }

        return false;
    }

    public function delete(User $user, Borrower $borrower): bool
    {
        return $this->update($user, $borrower);
    }

    public function approve(User $user, Borrower $borrower): bool
    {
        return $this->update($user, $borrower);
    }

    public function reject(User $user, Borrower $borrower): bool
    {
        return $this->update($user, $borrower);
    }
}
