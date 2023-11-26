<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class PDFController extends Controller
{
    public function exportPDF()
    {
        $data = Tamu::all(); // Ganti dengan model yang sesuai dan atur impor model di atas

        // Render PDF
        $pdf = new Dompdf();
        $pdf->loadHtml(view('pages.rekap.pdf', compact('data')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
    
        // Generate file name
        $fileName = 'data.pdf';
    
        // Set response headers
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ];
    
        // Output the generated PDF to the browser
        return response($pdf->output(), 200, $headers);
    }
}
