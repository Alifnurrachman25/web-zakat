<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rt;

class RTSeeder extends Seeder
{
    public function run(): void
    {
        $rts = ['RT 24', 'RT 25', 'RT 70', 'RT 71', 'RT 72'];
        foreach ($rts as $r) {
            Rt::create(['name' => $r]);
        }
    }
}
