@extends('layouts.app')


@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Tamu</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none text-dark" href="{{route('tamu.index')}}">Data Tamu</a>
            <a class="breadcrumb-item text-decoration-none active" href="TambahDataTamu.html">Tambah Data Tamu</a>
        </ol>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Data Tamu</h3></div>
                    <div class="card-body">
                        <form action="{{ route('tamu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input name="name" class="form-control" id="inputNama" type="text" placeholder="nama" />
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                <label for="inputNama">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="name_instansi" class="form-control" id="inputNameInstansi" type="text" placeholder="name_instansi" />
                                <small class="form-text text-danger">{{ $errors->first('name_instansi') }}</small>
                                <label for="inputNameInstansi">Name Instansi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="pekerjaan_intansi" class="form-control" id="inputPekerjaan" type="text" placeholder="pekerjaan" />
                                <small class="form-text text-danger">{{ $errors->first('pekerjaan_intansi') }}</small>
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
                                        <input name="jam_masuk" class="form-control" id="inputJamMasuk" type="time" placeholder="jam masuk" value="{{ $jam_masuk_default }}" />
                                        <small class="form-text text-danger">{{ $errors->first('jam_masuk') }}</small>
                                        <label for="inputJamMasuk">Jam Masuk</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="jam_keluar" class="form-control" id="inputJamKeluar" type="time" placeholder="jam keluar" />
                                        <small class="form-text text-danger">{{ $errors->first('jam_keluar') }}</small>
                                        <label for="inputJamKeluar">Jam Keluar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input  class="form-control" id="inputIdentitas" name="identitas" type="text" placeholder="identitasdiri" />
                                <small class="form-text text-danger">{{ $errors->first('identitasdiri') }}</small>
                                <label for="inputIdentitas">Identitas Diri</label>
                            </div>
                            <input name="foto_identitas" class="form-control" id="inputFotoIdentitas" type="hidden" placeholder="foto_identitas" />
                            <input name="foto_tamu" class="form-control" id="inputFotoTamu" type="hidden" placeholder="foto_tamu" />
                            <div class="text-center">
                                <a href="#" class="btn btn-success" id="foto-identitas"><i class="bi bi-camera me-2"></i>Foto Identitas</a>
                                <a href="#" class="btn btn-success" id="foto-tamu"><i class="bi bi-camera me-2"></i>Foto Tamu</a>
                            </div>
                            {{-- <button id="ulangi-btn" class="btn btn-secondary">Ulangi</button> --}}
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
            
            {{-- Webcam Foto Identitas --}}
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Preview Foto Identitas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <div id="video"></div>
                                <h5 class="mt-3 text-success">Hasil Capture</h5>
                                <div id="hasil-capture"></div>
                                <button id="capture-btn" class="btn btn-primary mt-3" type="button">Capture</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Webcam Foto Tamu --}}
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Preview Foto Tamu</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <div id="video2"></div>
                                <h5 class="mt-3 text-success">Hasil Capture</h5>
                                <div id="hasil-capture2"></div>
                                <button id="capture-btn2" class="btn btn-primary mt-3" type="button">Capture</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script>
    // Untuk foto indentitas
    document.addEventListener('DOMContentLoaded', function() {
    var fotoIdentitasBtn = document.getElementById('foto-identitas');

        // Mengaktifkan WebcamJS saat tombol foto identitas ditekan
        fotoIdentitasBtn.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                // Set ukuran untuk mobile
                Webcam.set({
                    width: 300,
                    height: 225,
                    dest_width: 300,
                    dest_height: 225,
                    image_format: 'png',
                    jpeg_quality: 90
                });
            } else {
                // Set ukuran untuk laptop
                Webcam.set({
                    width: 400,
                    height: 300,
                    dest_width: 400,
                    dest_height: 300,
                    image_format: 'png',
                    jpeg_quality: 90
                });
            }
            Webcam.attach('#video');
        });

        // Mengambil foto saat tombol capture ditekan
        var captureBtn = document.getElementById('capture-btn');
        var hasilCapture = document.getElementById('hasil-capture'); // Elemen untuk menampilkan hasil capture
        var inputFotoIdentitas = document.getElementById('inputFotoIdentitas');

        captureBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form submit bawaan

            Webcam.snap(function(dataURL) {
                // Menampilkan hasil capture pada elemen HTML
                var img = document.createElement('img');
                img.src = dataURL;
                img.width = 400;
                img.height = 300;
                hasilCapture.innerHTML = '';
                hasilCapture.appendChild(img);

                // Simpan dataURL ke dalam inputFotoIdentitas
                inputFotoIdentitas.value = dataURL;
            });
        });
    });

    // Untuk Foto Tamu
    document.addEventListener('DOMContentLoaded', function() {
        // Mengakses tombol foto tamu
        var fotoTamuBtn = document.getElementById('foto-tamu');

        // Mengaktifkan WebcamJS saat tombol foto tamu ditekan
        fotoTamuBtn.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                // Set ukuran untuk mobile
                Webcam.set({
                    width: 300,
                    height: 225,
                    dest_width: 300,
                    dest_height: 225,
                    image_format: 'png',
                    jpeg_quality: 90
                });
            } else {
                // Set ukuran untuk laptop
                Webcam.set({
                    width: 400,
                    height: 300,
                    dest_width: 400,
                    dest_height: 300,
                    image_format: 'png',
                    jpeg_quality: 90
                });
            }
            Webcam.attach('#video2');
        });

       // Mengambil foto saat tombol capture ditekan
        var captureBtn = document.getElementById('capture-btn2');
        var hasilCapture = document.getElementById('hasil-capture2'); // Elemen untuk menampilkan hasil capture
        var inputFotoTamu = document.getElementById('inputFotoTamu');

        captureBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form submit bawaan

            Webcam.snap(function(dataURL) {
                // Menampilkan hasil capture pada elemen HTML
                var img = document.createElement('img');
                img.src = dataURL;
                img.width = 400;
                img.height = 300;
                hasilCapture.innerHTML = '';
                hasilCapture.appendChild(img);

                // Simpan dataURL ke dalam inputFotoTamu
                inputFotoTamu.value = dataURL;
            });
        });
    });


</script>