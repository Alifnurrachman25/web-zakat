<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZakatType;

class ZakatTypeSeeder extends Seeder
{
    public function run(): void
    {
        $zakatTypes = [
            ['name' => 'Zakat Fitrah'],
            ['name' => 'Zakat Maal'],
            ['name' => 'Zakat Fidiyah'],
        ];

        foreach ($zakatTypes as $zakat) {
            ZakatType::updateOrCreate(
                ['name' => $zakat['name']]
            );
        }
    }
}
