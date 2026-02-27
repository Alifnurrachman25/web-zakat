<?php

namespace App\Exports;

use App\Models\ZakatPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ZakatSheetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ZakatPayment::select(
            'nama_muzakki',
            'phone',
            'blok',
            'jumlah_jiwa',
            'metode_pembayaran',
            'bayar',
            'infaq',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Muzakki',
            'No HP',
            'Blok',
            'Jumlah Jiwa',
            'Metode Pembayaran',
            'Bayar',
            'Infaq',
            'Tanggal'
        ];
    }
}
