<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;

class InfaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan lokalisasi Indonesia

        // Pastikan ada user di database agar foreignId tidak error
        // Jika belum ada user, kita ambil ID 1 (pastikan Anda sudah menjalankan seeder User)
        $userIds = User::pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->info('Skip InfaqSeeder: Belum ada data di tabel users.');
            return;
        }

        for ($i = 1; $i <= 50; $i++) {
            $manual = $faker->numberBetween(50000, 500000);
            $zakat = $faker->numberBetween(100000, 1000000);

            DB::table('infaqs')->insert([
                'tanggal' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'pemasukan_manual' => $manual,
                'pemasukan_dari_zakat' => $zakat,
                'total_pemasukan' => $manual + $zakat,
                'imam' => $faker->name('male'),
                'kultum' => 'Tema ' . $faker->sentence(3),
                'bilal' => $faker->name('male'),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
