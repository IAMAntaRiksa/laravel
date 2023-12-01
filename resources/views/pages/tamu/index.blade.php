@extends('layouts.app', ['title' => 'Data Tamu'])

{{-- Data tables --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css" />
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
                <a href="{{ route('tamu.create') }}" class="btn btn-primary btn-sm"><i
                        class="bi bi-plus-circle me-1"></i>Tambah</a>
                <table id="tableTamu" class="table table-hover">
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
                    {{-- <tbody>
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
                                @if ($data->foto_identitas)
                                    <td><img src="{{ Storage::url($data->foto_identitas) }}" alt="Foto Tamu" width="150"></td>
                                @else
                                    <td class="text-danger fw-bold">Tidak ada foto</td>
                                @endif
                                @if ($data->foto_tamu)
                                    <td><img src="{{ Storage::url($data->foto_tamu) }}" alt="Foto Tamu" width="150"></td>
                                @else
                                    <td class="text-danger fw-bold">Tidak ada foto</td>
                                @endif
                                <td data-tamu-id="{{ $data->id }}">
                                    <div class="form-switch">
                                        <input type="checkbox" class="statusSwitch"
                                            @if ($data->status_keluar == 'keluar') checked @endif>
                                        <label for="statusSwitch"></label>
                                    </div>
                                </td>

                                <td>
                                    <form method="POST" action="{{ route('tamu.destroy', $data->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                    </form>
                                    <a href="{{ route('tamu.edit', ['id' => $data->id]) }}"
                                        class="btn btn-info btn-sm btn-loader">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Data tabels js --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableTamu').DataTable({
            "pageLength": 50,
            searching: true,
            processing: true,
            serverSide: true,
            paging: true,
            "order": [],
            bAutoWidth: false,
            ajax: {
                url: '{{ route('getData') }}',
                type: 'GET',
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'name_instansi',
                    name: 'name_instansi'
                },
                {
                    data: 'tipe_tamu',
                    name: 'tipe_tamu'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'pertemuan',
                    name: 'pertemuan'
                },
                {
                    data: 'keperluan',
                    name: 'keperluan'
                },
                {
                    data: 'jam_masuk',
                    name: 'jam_masuk'
                },
                {
                    data: 'jam_keluar',
                    name: 'jam_keluar'
                },
                {
                    data: 'identitas',
                    name: 'identitas'
                },
                {
                    data: 'foto_identitas',
                    name: 'foto_identitas',
                    render: function(data, type, row, meta) {
                        if (data) {
                            var url = window.location.origin + '/storage/' + data.replace(
                                'public/', '');
                            return '<img src="' + url + '" alt="Foto Identitas" width="150" />';
                        } else {
                            return '<span class="text-danger">foto tidak tersedia</span>';
                        }
                    }
                },
                {
                    data: 'foto_tamu',
                    name: 'foto_tamu',
                    render: function(data, type, row, meta) {
                        if (data) {
                            var url = window.location.origin + '/storage/' + data.replace(
                                'public/', '');
                            return '<img src="' + url + '" alt="Foto Tamu" width="150" />';
                        } else {
                            return '<span class="text-danger">foto tidak tersedia</span>';
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return '<div class="form-switch">' +
                            '<input type="checkbox" class="statusSwitch" ' +
                            (row.status_keluar == 'keluar' ? 'checked' : '') +
                            ' data-tamu-id="' + row.id + '">' +
                            '<label for="statusSwitch"></label>' +
                            '</div>';
                    }
                },
                {
                    // button edit dan delete
                    data: null,
                    render: function(data, type, row, meta) {
                        return '<a href="{{ url('tamu') }}/' + row.id +
                            '/edit" class="btn btn-info btn-sm">Edit</a>' +
                            '<button class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-tamu-id="' +
                            row.id + '">Hapus</button>';
                    }
                },
            ],
        });
    });

    // $(document).on('change', '.statusSwitch', function(event) {
    //     event.preventDefault();

    //     var action = $(this).is(":checked") ? 'keluar' : 'aktif';
    //     var tamuId = $(this).closest('td').data('tamu-id');

    //     updateStatus(action, tamuId);

    //     location.reload();
    // });

    // function updateStatus(action, id) {
    //     $.ajax({
    //         url: '{{ url('updateStatus') }}/' + id,
    //         method: 'POST',
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             action: action
    //         },
    //         success: function(response) {
    //             console.log(response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.log(error);
    //         }
    //     });
    // }

    // fungsi untuk mengubah status tamu
    $(document).on('change', '.statusSwitch', function() {
        var id = $(this).data('tamu-id');
        var action = $(this).prop('checked') == true ? 'keluar' : 'aktif';
        updateStatus(action, id);
    });

    // fungsi untuk update status tamu
    function updateStatus(action, id) {
        $.ajax({
            url: '{{ url('updateStatus') }}/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                action: action,
                id: id
            },
            success: function(response) {
                $('#tableTamu').DataTable().ajax.reload();
            },
            error: function(xhr) {
                alert('gagal mengubah status tamu');
            }
        });
    }
</script>
