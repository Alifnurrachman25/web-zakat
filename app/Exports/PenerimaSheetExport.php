<?php

namespace App\Exports;

use App\Models\PenerimaZakat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenerimaSheetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PenerimaZakat::select(
            'name',
            'perumahan',
            'blok',
            'rt',
            'kategori'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Perumahan',
            'Blok',
            'RT',
            'Kategori'
        ];
    }
}
