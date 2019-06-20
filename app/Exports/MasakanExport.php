<?php

namespace App\Exports;

use App\Masakan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MasakanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Masakan::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Image',
            'Nama Masakan',
            'Deskripsi',
            'Kategori',
            'Harga',
            'Status Masakan',
            'Created At',
            'Updated At'
        ];
    }
}
