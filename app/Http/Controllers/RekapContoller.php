<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
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
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');
    
        $dataQuery = Tamu::query();
    

      
        // Filter data berdasarkan nilai pencarian
        if (!empty($search)) {
            $dataQuery->where('name', 'like', '%' . $search . '%');
        }
    
        // Filter data berdasarkan tanggal
        if ($day && $month && $year) {
            $dataQuery->whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
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
}
