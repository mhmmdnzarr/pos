<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function itemPenjualan()
    {
        return $this->hasMany(itemPenjualan::class, 'produk_id');
    }
}
