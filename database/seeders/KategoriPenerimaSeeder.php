<?php

namespace Database\Seeders;

use App\Models\KategoriPenerima;
use Illuminate\Database\Seeder;

class KategoriPenerimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori_penerimas = ['Fakir', 'Miskin', 'Amil', 'Muallaf', 'Riqab', 'Gharimin', 'Fisabilillah', 'Ibnu Sabil'];
        foreach ($kategori_penerimas as $k) {
            KategoriPenerima::create(['name' => $k]);
        }
    }
}
