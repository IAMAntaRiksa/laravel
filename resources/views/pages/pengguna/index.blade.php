@extends('layouts.app', ['title' => 'Pengguna'])

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Pengguna</h3>
        <ol class="breadcrumb mb-4">
            <a class="breadcrumb-item text-decoration-none active" href="Pengguna.html">Pengguna</a>
        </ol>
    </div>
    <div class="card ms-4 me-4">
        <div class="card-body">
            <h4 class="card-title">Data Admin</h4>
            <hr>
            <div class="table-responsive">
                <a href="{{ route('pengguna.create') }}"class="btn btn-primary btn-sm float-end"><i class="bi-plus"></i>Tambah</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $data)
                            <tr>
                                <td><span class="text-muted">
                                        {{ ++$key + ($datas->currentPage() - 1) * $datas->perPage() }}</span></td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->username }}</td>
                                <td>
                                 
                                 
                                    <form method="POST" action="{{ route('pengguna.delete', $data->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                    </form>
                                    <a href="{{ route('pengguna.edit', $data->id) }}"
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
