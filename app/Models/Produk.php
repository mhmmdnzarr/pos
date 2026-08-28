<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{   
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'jenis_id',
        'user_id',
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public function jenis(): BelongsTo
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemPenjualan(): HasMany
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}