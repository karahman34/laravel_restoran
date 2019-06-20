<?php

namespace App\Imports;

use App\Masakan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasakanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Masakan([
            'image' => $row['image'],
            'nama_masakan' => $row['nama_masakan'],
            'deskripsi' => $row['deskripsi'],
            'kategori' => $row['kategori'],
            'harga' => $row['harga'],
            'status_masakan' => $row['status_masakan'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at']
        ]);
    }
}
