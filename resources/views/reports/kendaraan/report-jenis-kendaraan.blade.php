<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Jenis Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .header p {
            margin: 0;
            padding: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Perumda Air Minum Tirta Perwira Kab. Purbalingga</h2>
        <p>Jl. Letjend S. Parman No. 62 Kedungmenjangan Purbalingga</p>
        <p>Telp. (0281) 891706</p>
        <hr style="border-top: 2px solid black; margin: 10px 0;">
    </div>

    <h3 style="text-align: center;">DAFTAR JENIS KENDARAAN</h3>
    <p>Tanggal Cetak: {{ $date }}</p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Jenis</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->desc }}</td>
                <td>{{ $record->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
