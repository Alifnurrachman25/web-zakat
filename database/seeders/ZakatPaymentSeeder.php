<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\ZakatType;
use App\Models\RiceType;
use App\Models\Perumahan;
use App\Models\Rt;

class ZakatPaymentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID yang diperlukan agar relasi valid
        $userIds = User::pluck('id')->toArray();
        $zakatTypeIds = ZakatType::pluck('id')->toArray();
        $riceTypeIds = RiceType::pluck('id')->toArray();
        $perumahanIds = Perumahan::pluck('id')->toArray();
        $rtIds = Rt::pluck('id')->toArray();

        // Cek minimal data master
        if (empty($userIds) || empty($zakatTypeIds)) {
            $this->command->warn('Skip ZakatPaymentSeeder: Pastikan tabel users dan zakat_types sudah ada isinya!');
            return;
        }

        for ($i = 1; $i <= 50; $i++) {
            $metode = $faker->randomElement(['tunai', 'beras']);
            $jumlahJiwa = $faker->numberBetween(1, 5);

            // Logika sederhana: Jika beras (kg), jika tunai (rupiah)
            $bayar = ($metode === 'beras')
                ? $jumlahJiwa * 2.5 // Standar 2.5kg per jiwa
                : $jumlahJiwa * 45000; // Misal standar Rp 45.000 per jiwa

            DB::table('zakat_payments')->insert([
                'user_id' => $faker->randomElement($userIds),
                'muzakki_id' => null, // Sesuai migration, bisa null
                'zakat_type_id' => $faker->randomElement($zakatTypeIds),
                'rice_type_id' => ($metode === 'beras') ? $faker->randomElement($riceTypeIds) : null,
                'nama_muzakki' => $faker->name,
                'perumahan_id' => $faker->randomElement($perumahanIds),
                'rt_id' => $faker->randomElement($rtIds),
                'blok' => $faker->bothify('Block ??-##'),
                'phone' => $faker->phoneNumber,
                'jumlah_jiwa' => $jumlahJiwa,
                'metode_pembayaran' => $metode,
                'bayar' => $bayar,
                'infaq' => $faker->randomElement([5000, 10000, 20000, 50000]),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('50 data pembayaran zakat berhasil dibuat.');
    }
}
