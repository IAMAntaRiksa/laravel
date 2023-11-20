<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    
    public function export()
    {
        $data = Tamu::all(); // Ganti dengan model dan query sesuai kebutuhan

        // return Excel::download(new DataExport($data), 'data.xlsx');
    }
}
