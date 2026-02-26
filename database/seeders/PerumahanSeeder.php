<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perumahan;

class PerumahanSeeder extends Seeder
{
    public function run(): void
    {
        $perumahans = ['Perumahan TBS1', 'Perumahan TBS2', 'Perumahan Batuah'];
        foreach ($perumahans as $p) {
            Perumahan::create(['name' => $p]);
        }
    }
}
