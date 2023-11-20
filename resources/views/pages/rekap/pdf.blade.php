<!DOCTYPE html>
<html>
<head>
    <title>Data PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            th, td {
                padding: 5px;
            }
        }
    </style>
</head>
<body>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Name Instansi</th>
                    <th>Pekerjaan Instansi</th>
                    <th>Tipe Tamu</th>
                    <th>Alamat</th>
                    <th>Pertemuan</th>
                    <th>Keperluan</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Identitas</th>
                    <th>Status Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as  $key=>$item)
                   
                    <tr>
                        @php
                        $no = $key+1;
                        if(Request::has('page'))
                        {
                        $no += (Request::get('page') - 1) * 10;
                        }
                        @endphp
                        <td>{{ $no }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->name_instansi }}</td>
                        <td>{{ $item->pekerjaan_intansi }}</td>
                        <td>{{ $item->tipe_tamu }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->pertemuan }}</td>
                        <td>{{ $item->keperluan }}</td>
                        <td>{{ $item->jam_masuk }}</td>
                        <td>{{ $item->jam_keluar }}</td>
                        <td>{{ $item->identitas }}</td>
                        <td>{{ $item->status_keluar }}</td>
                
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>