@extends('layouts.app')


@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Tamu</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none text-dark" href="DataTamu.html">Data Tamu</a>
            <a class="breadcrumb-item text-decoration-none active" href="TambahDataTamu.html">Tambah Data Tamu</a>
        </ol>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Data Tamu</h3></div>
                    <div class="card-body">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="form-floating mb-3">
                                <input name="name" class="form-control" id="inputNama" type="text" placeholder="nama" />
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                <label for="inputNama">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input  name="name_instansi" class="form-control" id="inputNama" type="text" placeholder="nama" />
                                <small class="form-text text-danger">{{ $errors->first('name_instansi') }}</small>
                                <label for="inputNama">Name Instansi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="pekerjaan_instansi" class="form-control" id="inputPekerjaan" type="text" placeholder="pekerjaan" />
                                <small class="form-text text-danger">{{ $errors->first('pekerjaan_instansi') }}</small>
                                <label for="inputPekerjaan">Pekerjaan/Instansi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="tipe_tamu" required class="form-select" aria-label="Default select example">
                                    <option selected disabled>Tipe Tamu</option>
                                    <option value="penting">Penting</option>
                                    <option value="biasa">Biasa</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="alamat" class="form-control" id="inputAlamat" type="text" placeholder="alamat" />
                                <small class="form-text text-danger">{{ $errors->first('alamat') }}</small>
                                <label for="inputAlamat">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="pertemuan" class="form-control" id="inputDitemui" type="text" placeholder="yang ditemui" />
                                <small class="form-text text-danger">{{ $errors->first('pertemuan') }}</small>
                                <label for="inputDitemui">Yang Ditemui</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="keperluan" class="form-control" id="inputKeperluan" type="text" placeholder="keperluan" />
                                <small class="form-text text-danger">{{ $errors->first('keperluan') }}</small>
                                <label for="inputKeperluan">Keperluan</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="jam_masuk" class="form-control" id="inputJamMasuk" type="text" placeholder="jam masuk" />
                                        <small class="form-text text-danger">{{ $errors->first('jam_masuk') }}</small>
                                        <label for="inputJamMasuk">Jam Masuk</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="jam_keluar" class="form-control" id="inputJamKeluar" type="text" placeholder="jam keluar" />
                                        <small class="form-text text-danger">{{ $errors->first('jam_keluar') }}</small>
                                        <label for="inputJamKeluar">Jam Keluar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input  class="form-control" id="inputIdentitas" type="text" placeholder="identitasdiri" />
                                <small class="form-text text-danger">{{ $errors->first('identitasdiri') }}</small>
                                <label for="inputIdentitas">Identitas Diri</label>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-success"><i class="bi bi-camera me-2"></i>Foto Identitas</a>
                                <a href="#" class="btn btn-success"><i class="bi bi-camera me-2"></i>Foto Tamu</a>
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