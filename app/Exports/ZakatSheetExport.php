<?php

namespace App\Exports;

use App\Models\ZakatPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ZakatSheetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ZakatPayment::with('perumahan')
            ->get()
            ->map(function ($zakat) {
                return [
                    'nama_muzakki'      => $zakat->nama_muzakki,
                    'phone'             => $zakat->phone,
                    'perumahan'         => $zakat->perumahan->name ?? '-',
                    'blok'              => $zakat->blok,
                    'jumlah_jiwa'       => $zakat->jumlah_jiwa,
                    'metode_pembayaran' => $zakat->metode_pembayaran,
                    'bayar'             => $zakat->bayar,
                    'infaq'             => $zakat->infaq,
                    'created_at'        => $zakat->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Muzakki',
            'No HP',
            'Perumahan',
            'Blok',
            'Jumlah Jiwa',
            'Metode Pembayaran',
            'Bayar',
            'Infaq',
            'Tanggal'
        ];
    }
}
