<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;

class TujuanController extends Controller
{
    public function index()
    {
        $tujuanList = Tujuan::paginate(10);
        return view('pages.tujuan.index', compact('tujuanList'));
    }

    public function create()
    {
        return view('pages.tujuan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tujuan::create($validatedData);

        alert()->success('Success', 'Data tujuan telah berhasil ditambahkan');
        return redirect()->route('tujuan.index');
    }

    public function edit($id)
    {
        $tujuan = Tujuan::find($id);
        return view('pages.tujuan.edit', compact('tujuan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tujuan = Tujuan::findOrFail($id);
        $tujuan->update($validatedData);

        alert()->success('Success', 'Data tujuan telah berhasil diupdate');
        return redirect()->route('tujuan.index')->with('success', 'Data tujuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tujuan = Tujuan::findOrFail($id);
        $tujuan->delete();

        alert()->success('Success', 'Data tujuan telah berhasil dihapus');
        return redirect()->route('tujuan.index')->with('success', 'Data tujuan berhasil dihapus.');
    }
}
