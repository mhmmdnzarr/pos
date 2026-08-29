<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        $jenisList = ['Pakaian', 'Aksesoris', 'Makanan', 'Minuman'];

        foreach ($jenisList as $nama) {
            Jenis::firstOrCreate(['nama_jenis' => $nama]);
        }
    }
}