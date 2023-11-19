@extends('layouts.app', ['title' => 'Dasboard'])

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Dashboard</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    <center><img class="mb-3 mt-2" src="{{ asset('dist/images/logo.png') }}" alt="Logo SMBR" width=200></center>
    <div class="card-group shadow-lg border-0 rounded-lg mt-5 ms-4 me-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mt-3">{{$countTamu}}</h2>
                <p class="card-text mb-3"><b>Total Tamu</b></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mt-3">{{$countTamuIntoday}}</h2>
                <p class="card-text mb-3"><b>Tamu Hari Ini</b></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mt-3">{{$countPegawai}}</h2>
                <p class="card-text mb-3"><b>Pegawai</b></p>
            </div>
        </div>
    </div>
@endsection
