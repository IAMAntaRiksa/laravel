<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class PenggunaController extends Controller
{
    public function index()
    {
        $datas = User::paginate(5);

        return view('pages.pengguna.index', compact('datas'));
    }
    public function delete($id)
    {
        try {
            User::where('id', $id)->delete();
        } catch (\Exception $errors) {
            return redirect()->route('pengguna.index')->withErrors(['message' => "Gagal Menghapus Data"]);
        }

        Session::flash('message', "Data Berhasil Dihapus");
        return redirect()->route('pengguna.index');
    }

    public function create(){
        return view("pages.pengguna.create");
    }


    public function store(Request $request)
    {
        $messages = [
            'email.required' => "Email Harus diisi",
            'email.unique' => "Email Sudah digunakan",
            'name.required' => "Nama Harus diisi",
            'password.required' => "Password Harus diisi",
       
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', "Pengguna Tidak boleh kosong");
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = new User;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->password = Hash::make($request->password);
    

        $api_token = Hash::make(Str::random(40));
        $data->api_token = $api_token;

        try { 
            $data->save();
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => "Gagal Menambhkan Data"]);
        }

        Session::flash('message', "Data berhasil dihapus");
        return redirect()->route('pengguna.index');
    }
    public function edit($id){

        try {
            $data = User::where('id', $id)->first();
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => "get id user"]);
        }

        return view("pages.pengguna.edit")->with('data', $data);
    }


    public function update(Request $request, $id)
    {
        $messages = [
            'email.required' => "Email Harus diisi",
            'email.unique' => "Email Sudah digunakan",
            'name.required' => "Nama Harus diisi",
            'password.required' => "Password Harus diisi",
       
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', "Pengguna Tidak boleh kosong");
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = User::find($id);
        $data->email = $request->email;
        $data->name = $request->name;
        $data->password = Hash::make($request->password);
    

        $api_token = Hash::make(Str::random(40));
        $data->api_token = $api_token;

        try { 
            $data->save();
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => "Gagal Menambhkan Data"]);
        }

        Session::flash('message', "Data berhasil dihapus");
        return redirect()->route('pengguna.index');
    }
}
