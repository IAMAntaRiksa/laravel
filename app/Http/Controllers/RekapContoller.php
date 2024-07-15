<?php
namespace App\Http\Controllers;

use App\Models\Tamu;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class RekapContoller extends Controller
{
    public function index()
    {
        return view('pages.rekap.index');
    }

    public function getData(Request $request)
    {
        $search = $request->input('search.value');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $tipeTamu = $request->input('tipe_tamu');

        $dataQuery = Tamu::query();

        if (!empty($search)) {
            $dataQuery->where('name', 'like', '%' . $search . '%');
        }

        if ($startDate && $endDate) {
            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
            $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (!empty($tipeTamu)) {
            $dataQuery->where('tipe_tamu', $tipeTamu);
        }

        $orderColumn = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        if ($orderColumn !== null) {
            $orderColumn = $request->input("columns.{$orderColumn}.data");
            $dataQuery->orderBy($orderColumn, $orderDirection);
        }

        $totalData = $dataQuery->count();

        $start = $request->input('start');
        $length = $request->input('length');
        $draw = $request->input('draw');

        $data = $dataQuery->skip($start)->take($length)->get();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ]);
    }

    public function exportPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $tipeTamu = $request->input('tipe_tamu');

        $dataQuery = Tamu::query();

        if ($startDate && $endDate) {
            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
            $dataQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (!empty($tipeTamu)) {
            $dataQuery->where('tipe_tamu', $tipeTamu);
        }

        $data = $dataQuery->get();

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
