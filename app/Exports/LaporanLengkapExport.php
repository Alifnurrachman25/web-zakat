<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanLengkapExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ZakatSheetExport(),
            new InfaqSheetExport(),
            new PenerimaSheetExport(),
        ];
    }
}
