<?php

namespace App\Policies;

use App\Models\Jenis;
use App\Models\User;

class JenisPolicy
{
    /**
     * Izinkan admin melakukan segalanya melalui before filter
     */
    public function before(User $user, string $ability): ?bool
    {
        // Cek jika user memiliki role_id = 1 atau nama role = 'admin'
        if ($user->role_id === 1 || optional($user->role)->name === 'admin') {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role_id === 1 || optional($user->role)->name === 'admin';
    }

    public function update(User $user, Jenis $jenis): bool
    {
        return $user->role_id === 1 || optional($user->role)->name === 'admin';
    }

    public function delete(User $user, Jenis $jenis): bool
    {
        return $user->role_id === 1 || optional($user->role)->name === 'admin';
    }
}