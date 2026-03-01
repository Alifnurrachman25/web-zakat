<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaZakatSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // =====================RT 25 =====================
            ['name' => 'Nawerih', 'perumahan' => 'Perumahan TBS2', 'blok' => 'D No.5', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Nafiah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'D No.5', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Ust. Rustamaji', 'perumahan' => 'Perumahan TBS2', 'blok' => 'D No.7', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Aisyah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'G No.3', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Kai Dafa', 'perumahan' => 'Perumahan TBS2', 'blok' => 'A No.11', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Djumanah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'G No.4', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Wewen', 'perumahan' => 'Perumahan TBS2', 'blok' => 'G No.5', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Lily', 'perumahan' => 'Perumahan TBS2', 'blok' => 'Q1 No.1', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu (istri Alm. Suyoto)', 'perumahan' => 'Perumahan TBS2', 'blok' => 'P2 No.2', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Wiwik', 'perumahan' => 'Perumahan TBS2', 'blok' => 'P2 No.1', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Achmad Muladi', 'perumahan' => 'Perumahan TBS2', 'blok' => 'P2 No.1', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Mama Ridho', 'perumahan' => 'Perumahan TBS2', 'blok' => 'P1 No.4', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Yutiono', 'perumahan' => 'Perumahan TBS2', 'blok' => 'G2 No.4', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Putri', 'perumahan' => 'Perumahan TBS2', 'blok' => 'G2 No.14', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Fajar Sidik', 'perumahan' => 'Perumahan TBS2', 'blok' => 'J No.11A', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Cici Sedarwini', 'perumahan' => 'Perumahan TBS2', 'blok' => 'J No.11A', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Mama Revan', 'perumahan' => 'Perumahan TBS2', 'blok' => 'J No.14', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bude Lela', 'perumahan' => 'Perumahan TBS2', 'blok' => 'J No.17', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Kai Zizi', 'perumahan' => 'Perumahan TBS2', 'blok' => 'J No.10C', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Kai Musafir', 'perumahan' => 'Perumahan TBS2', 'blok' => 'B No.25', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Eka Susan', 'perumahan' => 'Perumahan TBS2', 'blok' => 'F2 No.03', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Salmiah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'F2 No.03', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Syafa', 'perumahan' => 'Perumahan TBS2', 'blok' => 'F2 No.04', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Ervina/Vita', 'perumahan' => 'Perumahan TBS2', 'blok' => 'E1 No.04', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Jubaedah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'E1 No.06', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Jumri', 'perumahan' => 'Perumahan TBS2', 'blok' => 'E1 No.07', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Junaedi', 'perumahan' => 'Perumahan TBS2', 'blok' => 'E1 No.09', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Agus Hariadi', 'perumahan' => 'Perumahan TBS2', 'blok' => 'E1 No.11', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Reni Handayani', 'perumahan' => 'Perumahan TBS2', 'blok' => 'F1 No.07', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Mukhtar', 'perumahan' => 'Perumahan TBS2', 'blok' => 'F1 No.01', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Wulan Mauludu', 'perumahan' => 'Perumahan Batuah', 'blok' => 'N3 No.26', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Sulistiyowati', 'perumahan' => 'Perumahan Batuah', 'blok' => 'N3 No.26', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Elyana', 'perumahan' => 'Perumahan Batuah', 'blok' => 'N3 No.15', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Erni Maryam', 'perumahan' => 'Perumahan Batuah', 'blok' => 'N3 No.19', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Nurjanah', 'perumahan' => 'Perumahan Batuah', 'blok' => 'N3 No.27', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Umi', 'perumahan' => 'Perumahan Batuah', 'blok' => 'R3 No.07', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Pak Sumini', 'perumahan' => 'Perumahan Batuah', 'blok' => 'R3 No.35', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Suliani', 'perumahan' => 'Perumahan Batuah', 'blok' => 'P3 No.07', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Zainab', 'perumahan' => 'Perumahan Batuah', 'blok' => 'P3 No.05', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Pak Rahman', 'perumahan' => 'Perumahan Batuah', 'blok' => 'R3 No.05', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'Bu Yani', 'perumahan' => 'Perumahan Batuah', 'blok' => 'Q3 No.26', 'rt' => 'RT 25', 'kategori' => 'Fakir'],
            ['name' => 'M. Rusdy', 'perumahan' => 'Perumahan Batuah', 'blok' => 'R3 No.09', 'rt' => 'RT 25', 'kategori' => 'Fakir'],

            // =====================RT 24 =====================
            ['name' => 'Supriani', 'perumahan' => 'Perumahan TBS2', 'blok' => 'C2 No.8', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Dina Triana', 'perumahan' => 'Perumahan TBS2', 'blok' => 'D1 No.5', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Hermanto', 'perumahan' => 'Perumahan TBS2', 'blok' => 'A2 No.5', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Jamilah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'A2 No.1', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Joko Hadi', 'perumahan' => 'Perumahan TBS2', 'blok' => 'B1 No.7', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Dahliana Syafariningsih', 'perumahan' => 'Perumahan TBS2', 'blok' => 'B2 No.1', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Latifah Kusnanti', 'perumahan' => 'Perumahan TBS2', 'blok' => 'N1 No.2', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Sumarni', 'perumahan' => 'Perumahan TBS2', 'blok' => 'B2 No.3', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Prhatin Syafiyadra', 'perumahan' => 'Perumahan TBS2', 'blok' => 'C1 No.6', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Darmaji', 'perumahan' => 'Perumahan TBS2', 'blok' => 'C1 No.2', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Denny', 'perumahan' => 'Perumahan TBS2', 'blok' => 'D2 No.6', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Abd Rasyd', 'perumahan' => 'Perumahan TBS2', 'blok' => 'A2 No.3', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Junah', 'perumahan' => 'Perumahan TBS2', 'blok' => 'M2 No.6', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Ahmad Hamim Thohari', 'perumahan' => 'Perumahan TBS2', 'blok' => 'D2 No.3', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Azra Nahsifa Ramadhani', 'perumahan' => 'Perumahan TBS2', 'blok' => 'A1 No.3', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Fauzan', 'perumahan' => 'Perumahan TBS2', 'blok' => 'A2 No.4', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Mujiati', 'perumahan' => 'Perumahan TBS2', 'blok' => 'H1 No.1', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Laswana', 'perumahan' => 'Perumahan TBS2', 'blok' => 'B1 No.6', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Puspitasari', 'perumahan' => 'Perumahan TBS2', 'blok' => 'K2 No.2', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
            ['name' => 'Uni Safitri', 'perumahan' => 'Perumahan TBS2', 'blok' => 'B1 No.2', 'rt' => 'RT 24', 'kategori' => 'Fakir'],
        ];

        DB::table('penerima_zakat')->insert($data);
    }
}
