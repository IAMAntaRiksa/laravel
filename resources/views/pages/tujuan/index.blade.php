@extends('layouts.app', ['title' => 'Data Tujuan'])

{{-- Data tables --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css" />

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Data Tujuan</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item text-decoration-none active">Data Tujuan</li>
    </ol>
</div>
<div class="card ms-4 me-4">
    <div class="card-body">
        <h4 class="card-title">Data Tujuan</h4>
        <hr>
        <div class="table-responsive">
            @if (Auth::check() && (Auth::user()->id != 2 || is_null(Auth::user()->id)))   
            <a href="{{ route('tujuan.create') }}" class="btn btn-primary btn-sm mb-3">
                <i class="bi bi-plus-circle me-1"></i>Tambah
            </a>
            @endif
          
         
            <table id="tableTujuan" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tujuanList as $key => $data)
                    <tr>
                        <td><span class="text-muted">{{ ++$key + ($tujuanList->currentPage() - 1) * $tujuanList->perPage() }}</span></td>
                        <td>{{ $data->name }}</td>
                        @if (Auth::check() && (Auth::user()->id != 2 || is_null(Auth::user()->id)))   
                                    
                        <td>
                            <form method="POST" action="{{ route('tujuan.destroy', $data->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                            <a href="{{ route('tujuan.edit', ['id' => $data->id]) }}" class="btn btn-info btn-sm btn-loader">Edit</a>
                        </td>
                        @endif
         
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tujuanList->links() }}
        </div>
    </div>
</div>
@endsection

{{-- Data tables JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableTujuan').DataTable({
            "pageLength": 50
        });
    });
</script>
