<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TamuController extends Controller
{
    public function index()
    {
        $tamulist = Tamu::paginate(10);
       
        return view('pages.tamu.index', compact('tamulist'));
    }

    public function updateStatus(Request $request, $id)
    {
        $tamu = Tamu::findOrFail($id);
        $action = $request->action;

        if ($action == 'aktif') {
            $tamu->status_keluar = 'aktif';
        } elseif ($action == 'keluar') {
            $tamu->jam_keluar = Carbon::now();
            $tamu->status_keluar = 'keluar';
        }
        $tamu->save();
        return response()->json('Status and Jam Keluar tamu berhasil diperbarui');
    }
    public function create(){
        return view('pages.tamu.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => "Nama Harus diisi",
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', "Data Tidak boleh kosong");
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $tamu = new Tamu();
        $tamu->name = $request->name;
        $tamu->name_instansi = $request->name_instansi;
        $tamu->pekerjaan_instansi = $request->pekerjaan_instansi;
        $tamu->tipe_tamu = $request->tipe_tamu;
        $tamu->alamat = $request->alamat;
        $tamu->pertemuan = $request->pertemuan;
        $tamu->keperluan = $request->keperluan;
        $tamu->jam_masuk = $request->jam_masuk;
        $tamu->identitas = $request->identitas;
        $tamu->foto_identitas = $request->foto_identitas;
        $tamu->foto_tamu = $request->foto_tamu;
        try { 
            $tamu->save();  
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => "Gagal Menambhkan Data"]);
        }

        return redirect()->route('tamu.index')->with('success', 'Tamu added successfully.');
    }
}
