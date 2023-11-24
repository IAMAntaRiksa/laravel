<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
        $tamu = Tamu::find($id);
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

    public function create()
    {
        $jam_masuk_default = Carbon::now('Asia/Jakarta')->format('H:i');
        return view('pages.tamu.create', compact('jam_masuk_default'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'name_instansi' => 'required',
            'pekerjaan_intansi' => 'required',
            'tipe_tamu' => 'required',
            'alamat' => 'required',
            'pertemuan' => 'required',
            'keperluan' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'identitas' => 'required',
            'foto_identitas' => 'nullable|string',
            'foto_tamu' => 'nullable|string',
        ]);

        // dd($request->foto_tamu);
    
        // Store image foto indentitas
        if ($request->has('foto_identitas')) {
            $image_parts = explode(";base64,", $request->input('foto_identitas'));
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $filePath = 'public/foto_identitas/' . $imageName;
            Storage::put($filePath, $image_base64);
            
            // Update the path in the validated data
            $validatedData['foto_identitas'] = $filePath;
        }

        // Store image foto_tamu
        if ($request->has('foto_tamu')) {
            $image_parts = explode(";base64,", $request->input('foto_tamu'));
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $filePath = 'public/foto_tamu/' . $imageName;
            Storage::put($filePath, $image_base64);
            
            // Update the path in the validated data
            $validatedData['foto_tamu'] = $filePath;
        }
    
        // Create a new Tamu model instance and save the data
        $tamu = Tamu::create($validatedData);
    
        // Redirect or return response as per your requirement
        alert()->success('Succsess', 'Data tamu telah berhasil ditambahkan');
        return redirect()->route('tamu.index');
    }

    public function edit($id)
    {
        $tamu = Tamu::find($id);
        return view('pages.tamu.edit', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'name_instansi' => 'required',
            'pekerjaan_intansi' => 'required',
            'tipe_tamu' => 'required',
            'alamat' => 'required',
            'pertemuan' => 'required',
            'keperluan' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'identitas' => 'required',
        ]);

        $tamu = Tamu::findOrFail($id);
        $tamu->update($request->all());

        alert()->success('Succsess', 'Data tamu telah berhasil diupdate');
        return redirect()->route('tamu.index')->with('success', 'Data Tamu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Tamu::findOrFail($id);

        $data->delete();

        alert()->success('Succsess', 'Data tamu telah berhasil dihapus');
        return redirect()->route('tamu.index')->with('success', 'Data Tamu berhasil dihapus.');
    }
}