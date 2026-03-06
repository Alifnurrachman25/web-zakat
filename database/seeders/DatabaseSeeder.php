<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Panggil UserSeeder
        $this->call([
            UserSeeder::class,
            RiceTypeSeeder::class,
            ZakatTypeSeeder::class,
            PerumahanSeeder::class,
            RTSeeder::class,
            KategoriPenerimaSeeder::class,
            // InfaqSeeder::class,
            // ZakatPaymentSeeder::class,
            // PenerimaZakatSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
