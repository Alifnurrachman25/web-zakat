<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiceType;

class RiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $riceTypes = [
            ['name' => 'Beras Reguler', 'price' => 48000],
            ['name' => 'Beras Premium', 'price' => 54000],
        ];

        foreach ($riceTypes as $rice) {
            RiceType::updateOrCreate(
                ['name' => $rice['name']], // supaya tidak duplicate
                ['price' => $rice['price']]
            );
        }
    }
}
