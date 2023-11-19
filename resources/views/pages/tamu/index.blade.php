@extends('layouts.app', ['title' => 'Data Tamu'])

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Tamu</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none active" href="">Data Tamu</a>
        </ol>
    </div>
    <div class="card ms-4 me-4">
        <div class="card-body">
            <h4 class="card-title">Data Tamu</h4>
            <hr>
            <div class="table-responsive">
                <a href="{{ route('tamu.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i>Tambah</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pekerjaan/Instansi</th>
                            <th>Tipe Tamu</th>
                            <th>Alamat</th>
                            <th>Yang Ditemui</th>
                            <th>Keperluan</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Identitas Diri</th>
                            <th>Foto Identitas</th>
                            <th>Foto Tamu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tamulist as $key => $data)
                            <tr>
                                <td><span class="text-muted">
                                        {{ ++$key + ($tamulist->currentPage() - 1) * $tamulist->perPage() }}</span></td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->pekerjaan_intansi }}</td>
                                <td>
                                    {{ $data->tipe_tamu }}
                                </td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->pertemuan }}</td>
                                <td>{{ $data->keperluan }}</td>
                                <td>{{ $data->jam_masuk }}</td>
                                <td id="jamKeluarField">{{ $data->jam_keluar }}</td>
                                <td>{{ $data->identitas }}</td>
                                <td>{{ $data->foto_identitas }}</td>
                                <td>{{ $data->foto_tamu }}</td>
                                <td>
                                    <div class="form-switch">
                                        <input type="checkbox" id="statusSwitch" 
                                        @if($data->status_keluar == 'aktif') checked @endif>
                                        <label for="statusSwitch"></label>
                                    </div>
                                </td>
                                
                                <td>
                                    <form method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                    </form>
                                    <a href=""
                                        class="btn btn-info btn-sm btn-loader">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    $(document).on('change', '#statusSwitch', function(){
        if($(this).is(":checked")) {
            updateStatus('aktif');
        } else {
            updateStatus('keluar'); 
        }
    });

    function updateStatus(action) {
        $.ajax({
            url: '{{ route("updateStatus", ['id' => $data->id]) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                action: action
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
</script>