<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Exports\TamuExport;
use Illuminate\Http\Request;
use PHPExcel;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportToExcel()
    {
        // Ambil data dari database
        $data = Tamu::all();

        // Buat array untuk data yang akan diekspor
        $exportData = [];

        // Loop melalui data dan tambahkan ke array exportData
        foreach ($data as $item) {
            $exportData[] = [
                'ID' => $item->id,
                'Name' => $item->name,
                'Name Instansi' => $item->name_instansi,
                'Pekerjaan Instansi' => $item->pekerjaan_instansi,
                'Tipe Tamu' => $item->tipe_tamu,
                'Alamat' => $item->alamat,
                'Pertemuan' => $item->pertemuan,
                'Keperluan' => $item->keperluan,
                'Jam Masuk' => $item->jam_masuk,
                'Jam Keluar' => $item->jam_keluar,
                'Identitas' => $item->identitas,
                'Status Keluar' => $item->status_keluar,
                // Tambahkan kolom lainnya sesuai dengan struktur model Anda
            ];
        }

        // Ekspor data ke dalam file Excel
        return Excel::download(new TamuExport($exportData), 'data.xlsx');
    }
}



