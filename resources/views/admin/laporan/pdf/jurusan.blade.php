<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jurusan PPDB</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #666;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Laporan Peminat & Diterima per Jurusan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Peminat Pilihan 1</th>
                <th>Peminat Pilihan 2</th>
                <th>Total Peminat</th>
                <th>Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $jurusan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jurusan->nama_jurusan }}</td>
                    <td>{{ $jurusan->peminat_1 }}</td>
                    <td>{{ $jurusan->peminat_2 }}</td>
                    <td>{{ $jurusan->peminat_1 + $jurusan->peminat_2 }}</td>
                    <td>{{ $jurusan->diterima }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y, H:i') }}
    </div>
</body>
</html>
