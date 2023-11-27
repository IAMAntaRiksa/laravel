@extends('layouts.app', ['title' => 'Data Tamu'])

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Rekap Tamu</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Rekap Tamu</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="input-group mb-3 ms-4">
                <input class="form-control" type="date" id="filterDate" placeholder="Cari" aria-label="Cari"
                aria-describedby="button-addon2">
        
            </div>
        </div>
        <div class="col-9">
            <div class="float-end me-4 mt-2">
                {{-- <a  href="{{ route('export') }}" class="btn btn-success btn-sm me-2 "><i class="bi bi-file-earmark-excel me-1"></i>Ekspor
                    Excel</a> --}}
                <a href="{{ route('exportPDF') }}" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf me-1"></i>Ekspor PDF</a>
            </div>
        </div>
    </div>
    <div class="card ms-4 me-4">
        <div class="card-body">
            <h4 class="card-title">Rekap Tamu</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable">
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
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
 $(document).ready(function() {
    var table = $('#dataTable').DataTable({
        "dom": 'Brtip', 
        "buttons": ['print', 'excel'],
        searching: true,
        processing: true,
        serverSide: true,
        paging: true,
      // bLengthChange: false,
      bAutoWidth: false,
        ajax: {
            url: '{{ route('getData') }}',
            type: 'GET',
            data: function(data) {
                data.page = (data.start / data.length) + 1;
                // Menambahkan filter berdasarkan tanggal, bulan, dan tahun
                var filterDate = $('#filterDate').val();
                if (filterDate) {
                    var dateParts = filterDate.split('-');
                    data.day = dateParts[2];
                    data.month = dateParts[1];
                    data.year = dateParts[0];
                }
            },
            dataSrc: function(response) {
                return response.data;
            },
        },
        columns: [
            { 
          data: null,
            "sortable": false,
            render: function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            },
          },
            { data: 'name', name: 'name' },
            { data: 'name_instansi', name: 'name_instansi' },
            { data: 'tipe_tamu', name: 'tipe_tamu' },
            { data: 'alamat', name: 'alamat' },
            { data: 'pertemuan', name: 'pertemuan' },
            { data: 'keperluan', name: 'keperluan' },
            { data: 'jam_masuk', name: 'jam_masuk' },
            { data: 'jam_keluar', name: 'jam_keluar' },
            { data: 'identitas', name: 'identitas' },
            {
                data: 'foto_identitas',
                name: 'foto_identitas',
                render: function(data, type, row, meta) {
                    if (data) {
                        var url = window.location.origin + '/storage/' + data.replace('public/', '');
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
                        var url = window.location.origin + '/storage/' + data.replace('public/', '');
                        return '<img src="' + url + '" alt="Foto Tamu" width="150" />';
                    } else {
                        return '<span class="text-danger">foto tidak tersedia</span>';
                    }
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, full, meta) {
                    // Konversi format tanggal dari ISO ke format D/M/Y
                    var date = new Date(data);
                    var day = date.getDate();
                    var month = date.getMonth() + 1; // Dalam JavaScript, bulan dimulai dari 0
                    var year = date.getFullYear();

                    // Pad nol di depan jika diperlukan
                    day = day < 10 ? '0' + day : day;
                    month = month < 10 ? '0' + month : month;

                    // Gabungkan menjadi format D/M/Y
                    var formattedDate = day + '/' + month + '/' + year;

                    return formattedDate;
                }
            }
            
        ], 
        "language": {
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        }
    });

    // Menambahkan event handler untuk filter tanggal
    $('#filterDate').on('change', function() {
        table.draw();
    });
});

</script>
