@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Tambah Data Pegawai</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none text-dark" href="{{ route('pegawai.index') }}">Data Pegawai</a>
            <a class="breadcrumb-item text-decoration-none active" href="#">Tambah Data Pegawai</a>
        </ol>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Data Pegawai</h3></div>
                    <div class="card-body">
                        <form action="{{ route('pegawai.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input name="name" class="form-control" id="inputNama" type="text" placeholder="Nama" required />
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                <label for="inputNama">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="tujuan_id" class="form-select" required>
                                    <option selected disabled>Pilih Tujuan</option>
                                    @foreach($tujuanList as $tujuan)
                                    <option value="{{ $tujuan->id }}">{{ $tujuan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="kehadiran" class="form-select" required>
                                    <option selected disabled>Kehadiran</option>
                                    <option value="1">Hadir</option>
                                    <option value="0">Tidak Hadir</option>
                                </select>
                            </div>
                            <div class="mt-4 mb-0">
                                <button class="d-grid btn btn-primary btn-block" type="submit">Tambah Data</button>
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
