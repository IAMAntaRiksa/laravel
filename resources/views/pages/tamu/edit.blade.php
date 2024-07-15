@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Tamu</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none text-dark" href="{{ route('tamu.index') }}">Data Tamu</a>
            <a class="breadcrumb-item text-decoration-none active" href="">Edit Data Tamu</a>
        </ol>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Data Tamu</h3></div>
                    <div class="card-body">
                        <form action="{{ route('tamu.update', $tamu->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <input name="name" class="form-control" id="inputNama" type="text" placeholder="Nama" value="{{ $tamu->name }}" />
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                <label for="inputNama">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="name_instansi" class="form-control" id="inputNameInstansi" type="text" placeholder="Nama Instansi" value="{{ $tamu->name_instansi }}" />
                                <small class="form-text text-danger">{{ $errors->first('name_instansi') }}</small>
                                <label for="inputNameInstansi">Nama Instansi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="pekerjaan_intansi" class="form-control" id="inputPekerjaan" type="text" placeholder="Pekerjaan/Instansi" value="{{ $tamu->pekerjaan_intansi }}" />
                                <small class="form-text text-danger">{{ $errors->first('pekerjaan_intansi') }}</small>
                                <label for="inputPekerjaan">Pekerjaan/Instansi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="tipe_tamu" id="tipeTamu" required class="form-select" aria-label="Default select example">
                                    <option disabled>Tipe Tamu</option>
                                    <option value="perkelompok" {{ $tamu->tipe_tamu == 'perkelompok' ? 'selected' : '' }}>Perkelompok</option>
                                    <option value="perorangan" {{ $tamu->tipe_tamu == 'perorangan' ? 'selected' : '' }}>Perorangan</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3 {{ $tamu->tipe_tamu == 'perkelompok' ? '' : 'd-none' }}" id="pdfUpload">
                                <input name="file_pdf" class="form-control" id="inputFilePDF" type="file" accept="application/pdf" />
                                <small class="form-text text-danger">{{ $errors->first('file_pdf') }}</small>
                                <label for="inputFilePDF">Upload File PDF</label>
                                @if($tamu->file_pdf)
                                    <small>Current PDF: <a href="{{ Storage::url($tamu->file_pdf) }}" target="_blank">View PDF</a></small>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input name="alamat" class="form-control" id="inputAlamat" type="text" placeholder="Alamat" value="{{ $tamu->alamat }}" />
                                <small class="form-text text-danger">{{ $errors->first('alamat') }}</small>
                                <label for="inputAlamat">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="pertemuan" class="form-control" id="inputDitemui" type="text" placeholder="Yang Ditemui" value="{{ $tamu->pertemuan }}" />
                                <small class="form-text text-danger">{{ $errors->first('pertemuan') }}</small>
                                <label for="inputDitemui">Yang Ditemui</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="keperluan" class="form-control" id="inputKeperluan" type="text" placeholder="Keperluan" value="{{ $tamu->keperluan }}" />
                                <small class="form-text text-danger">{{ $errors->first('keperluan') }}</small>
                                <label for="inputKeperluan">Keperluan</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="jam_masuk" class="form-control" id="inputJamMasuk" type="time" placeholder="Jam Masuk" value="{{ $tamu->jam_masuk }}" />
                                        <small class="form-text text-danger">{{ $errors->first('jam_masuk') }}</small>
                                        <label for="inputJamMasuk">Jam Masuk</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="jam_keluar" class="form-control" id="inputJamKeluar" type="time" placeholder="Jam Keluar" value="{{ $tamu->jam_keluar }}" />
                                        <small class="form-text text-danger">{{ $errors->first('jam_keluar') }}</small>
                                        <label for="inputJamKeluar">Jam Keluar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputIdentitas" name="identitas" type="text" placeholder="Identitas Diri" value="{{ $tamu->identitas }}" />
                                <small class="form-text text-danger">{{ $errors->first('identitas') }}</small>
                                <label for="inputIdentitas">Identitas Diri</label>
                            </div>
                            {{-- <input name="foto_identitas" class="form-control" id="inputFotoIdentitas" type="hidden" placeholder="Foto Identitas" />
                            <input name="foto_tamu" class="form-control" id="inputFotoTamu" type="hidden" placeholder="Foto Tamu" />
                            <div class="text-center">
                                <a href="#" class="btn btn-success" id="foto-identitas"><i class="bi bi-camera me-2"></i>Foto Identitas</a>
                                <a href="#" class="btn btn-success" id="foto-tamu"><i class="bi bi-camera me-2"></i>Foto Tamu</a>
                            </div> --}}
                            <div class="mt-4 mb-0">
                                <button class="d-grid btn btn-primary btn-block" type="submit">Update Data</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script>
    // Untuk foto identitas
    // document.addEventListener('DOMContentLoaded', function() {
    //     var fotoIdentitasBtn = document.getElementById('foto-identitas');

    //     // Mengaktifkan WebcamJS saat tombol foto identitas ditekan
    //     fotoIdentitasBtn.addEventListener('click', function() {
    //         if (window.innerWidth <= 768) {
    //             // Set ukuran untuk mobile
    //             Webcam.set({
    //                 width: 300,
    //                 height: 225,
    //                 dest_width: 300,
    //                 dest_height: 225,
    //                 image_format: 'png',
    //                 jpeg_quality: 90
    //             });
    //         } else {
    //             // Set ukuran untuk laptop
    //             Webcam.set({
    //                 width: 400,
    //                 height: 300,
    //                 dest_width: 400,
    //                 dest_height: 300,
    //                 image_format: 'png',
    //                 jpeg_quality: 90
    //             });
    //         }
    //         Webcam.attach('#video');
    //     });

    //     // Mengambil foto saat tombol capture ditekan
    //     var captureBtn = document.getElementById('capture-btn');
    //     var hasilCapture = document.getElementById('hasil-capture'); // Elemen untuk menampilkan hasil capture
    //     var inputFotoIdentitas = document.getElementById('inputFotoIdentitas');

    //     captureBtn.addEventListener('click', function(event) {
    //         event.preventDefault(); // Mencegah form submit bawaan

    //         Webcam.snap(function(dataURL) {
    //             // Menampilkan hasil capture pada elemen HTML
    //             var img = document.createElement('img');
    //             img.src = dataURL;
    //             img.width = 400;
    //             img.height = 300;
    //             hasilCapture.innerHTML = '';
    //             hasilCapture.appendChild(img);

    //             // Simpan dataURL ke dalam inputFotoIdentitas
    //             inputFotoIdentitas.value = dataURL;
    //         });
    //     });
    // });

    // // Untuk foto tamu
    // document.addEventListener('DOMContentLoaded', function() {
    //     var fotoTamuBtn = document.getElementById('foto-tamu');

    //     // Mengaktifkan WebcamJS saat tombol foto tamu ditekan
    //     fotoTamuBtn.addEventListener('click', function() {
    //         if (window.innerWidth <= 768) {
    //             // Set ukuran untuk mobile
    //             Webcam.set({
    //                 width: 300,
    //                 height: 225,
    //                 dest_width: 300,
    //                 dest_height: 225,
    //                 image_format: 'png',
    //                 jpeg_quality: 90
    //             });
    //         } else {
    //             // Set ukuran untuk laptop
    //             Webcam.set({
    //                 width: 400,
    //                 height: 300,
    //                 dest_width: 400,
    //                 dest_height: 300,
    //                 image_format: 'png',
    //                 jpeg_quality: 90
    //             });
    //         }
    //         Webcam.attach('#video2');
    //     });

    //     // Mengambil foto saat tombol capture ditekan
    //     var captureBtn2 = document.getElementById('capture-btn2');
    //     var hasilCapture2 = document.getElementById('hasil-capture2'); // Elemen untuk menampilkan hasil capture
    //     var inputFotoTamu = document.getElementById('inputFotoTamu');

    //     captureBtn2.addEventListener('click', function(event) {
    //         event.preventDefault(); // Mencegah form submit bawaan

    //         Webcam.snap(function(dataURL) {
    //             // Menampilkan hasil capture pada elemen HTML
    //             var img = document.createElement('img');
    //             img.src = dataURL;
    //             img.width = 400;
    //             img.height = 300;
    //             hasilCapture2.innerHTML = '';
    //             hasilCapture2.appendChild(img);

    //             // Simpan dataURL ke dalam inputFotoTamu
    //             inputFotoTamu.value = dataURL;
    //         });
    //     });
    // });

    // Menampilkan atau menyembunyikan input file PDF berdasarkan tipe tamu
    $(document).ready(function() {
        $('#tipeTamu').change(function() {
            var tipeTamu = $(this).val();
            if (tipeTamu === 'perkelompok') {
                $('#pdfUpload').removeClass('d-none');
                $('#inputFilePDF').attr('required', true);
            } else {
                $('#pdfUpload').addClass('d-none');
                $('#inputFilePDF').removeAttr('required');
            }
        });
    });
</script>
