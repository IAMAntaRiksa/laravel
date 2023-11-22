<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TamuExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Name Instansi',
            'Pekerjaan Instansi',
            'Tipe Tamu',
            'Alamat',
            'Pertemuan',
            'Keperluan',
            'Jam Masuk',
            'Jam Keluar',
            'Identitas',
            'Status Keluar',
        ];
    }
}
