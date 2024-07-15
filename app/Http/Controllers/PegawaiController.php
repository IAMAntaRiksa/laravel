<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Tujuan;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawaiList = Pegawai::with('tujuan')->paginate(10);
        return view('pages.pegawai.index', compact('pegawaiList'));
    }

    public function create()
    {
        $tujuanList = Tujuan::all();
        return view('pages.pegawai.create', compact('tujuanList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tujuan_id' => 'required|exists:tujuans,id',
            'kehadiran' => 'required|boolean',
        ]);

        Pegawai::create($validatedData);

        Alert::success('Success', 'Pegawai berhasil ditambahkan');
        return redirect()->route('pegawai.index');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $tujuanList = Tujuan::all();
        return view('pages.pegawai.edit', compact('pegawai', 'tujuanList'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tujuan_id' => 'required|exists:tujuans,id',
            'kehadiran' => 'required|boolean',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($validatedData);

        Alert::success('Success', 'Pegawai berhasil diperbarui');
        return redirect()->route('pegawai.index');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        Alert::success('Success', 'Pegawai berhasil dihapus');
        return redirect()->route('pegawai.index');
    }
}
