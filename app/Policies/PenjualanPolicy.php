<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{

    public function view(User $user, Penjualan $penjualan): bool
    {
        // Admin boleh lihat semua transaksi
        if ($user->role->name === 'admin') {
            return true;
        }

        return $user->role->name === 'kasir'
            && $penjualan->user_id === $user->id;
    }

    
    public function update(User $user, Penjualan $penjualan): bool
    {
        return $user->role->name === 'admin'
        && $penjualan->status === 'OPEN';
    }

 
    public function delete(User $user, Penjualan $penjualan): bool
    {
        return $user->role->name === 'admin'
        && $penjualan->status === 'OPEN';
    }
}