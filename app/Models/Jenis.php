<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jenis';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_jenis',
    ];

    /**
     * Relasi: Satu jenis bisa memiliki banyak produk (1 to Many)
     */
    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'jenis_id');
    }
}