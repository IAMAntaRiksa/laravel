@extends('layouts.app')


@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Pengguna</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none text-dark" href="Pengguna.html">Pengguna</a>
            <a class="breadcrumb-item text-decoration-none active" href="TambahPengguna.html">Edit Pengguna</a>
        </ol>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Admin</h3></div>
                    <div class="card-body">
                        <form method="post">
                            @method('PATCH')
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" value="{{ $data->name }}"  name="name" id="inputNama" type="text" placeholder="masukkan nama" />
                                <label for="inputNama">Nama</label>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                            <div class="form-floating mb-3">
                                <input class="form-control" value="{{ $data->username }}" name="username" id="inputEmail" type="email" placeholder="name@example.com" />
                                <label for="inputEmail">Alamat Email</label>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('username') }}</small>
                            <div class="form-floating mb-3">
                                <input class="form-control"  name="password" id="inputPassword" type="password" placeholder="buat password" />
                                <label for="inputPassword">Sandi</label>
                            </div>
                            <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                            <div class="mt-4 mb-0">
                                <div class="d-grid"><button class="btn btn-primary btn-block"  type="submit">Edit Data</button></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">PT. Semen Baturaja Tbk</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection