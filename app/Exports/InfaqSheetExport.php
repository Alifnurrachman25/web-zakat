<?php

namespace App\Exports;

use App\Models\Infaq;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InfaqSheetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Infaq::select(
            'tanggal',
            'pemasukan_manual',
            'pemasukan_dari_zakat',
            'total_pemasukan',
            'imam',
            'kultum',
            'bilal'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Manual',
            'Dari Zakat',
            'Total',
            'Imam',
            'Kultum',
            'Bilal'
        ];
    }
}
