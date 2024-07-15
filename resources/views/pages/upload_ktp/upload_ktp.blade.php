<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload KTP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 10px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 15px;
            font-size: 1.2em;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        .form-group {
            margin-bottom: 0.8rem;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .result .form-group {
            margin: 0.3em 0;
            font-size: 0.9em;
        }
        .result input {
            font-weight: bold;
            border: none;
            background: none;
            width: 100%;
            font-size: 0.9em;
        }
        .result input:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload KTP</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="ktp" accept="image/*" class="form-control-file" id="ktpImage" required>
            </div>
        </form>

        <h2>Hasil Pembacaan KTP</h2>
    
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" id="nik" readonly>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" readonly>
            </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#ktpImage').on('change', function(event) {
                event.preventDefault();

                var formData = new FormData();
                formData.append('ktp', $(this)[0].files[0]);

                $.ajax({
                    url: '/upload-ktp',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.identitas) {
                            $('#nik').val(response.identitas.NIK || '');
                            $('#nama').val(response.identitas.Nama || '');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred while processing your request.');
                    }
                });
            });
        });
    </script>
</body>
</html>
