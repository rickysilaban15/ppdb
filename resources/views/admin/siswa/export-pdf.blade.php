<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header h2 {
            font-size: 14px;
            margin: 5px 0;
            font-weight: normal;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA SISWA PPDB</h1>
        <h2>SMK N 2 SIATAS BARITA</h2>
        <p>Tahun Ajaran {{ date('Y') }}</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>No Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Asal Sekolah</th>
                <th>Jurusan Pilihan</th>
                <th>Jalur Pendaftaran</th>
                <th>Skor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $index => $siswa)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $siswa->no_pendaftaran ?? '-' }}</td>
                <td>{{ $siswa->nama_lengkap }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nik }}</td>
                <td>{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td>
                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ $siswa->agama }}</td>
                <td>{{ $siswa->alamat_jalan }}, {{ $siswa->kelurahan }}, {{ $siswa->kecamatan }}, {{ $siswa->kabupaten_kota }}, {{ $siswa->provinsi }}</td>
                <td>{{ $siswa->no_telepon }}</td>
                <td>{{ $siswa->asal_sekolah }}</td>
                <td>
                    {{ $siswa->jurusanPilihan1->nama_jurusan ?? '-' }}
                    @if($siswa->jurusanPilihan2)
                    <br>{{ $siswa->jurusanPilihan2->nama_jurusan }}
                    @endif
                </td>
                <td>{{ $siswa->jalur_pendaftaran }}</td>
                <td>{{ $siswa->skor_akhir }}</td>
                <td>{{ $siswa->status_kelulusan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ $siswas->count() }} siswa</p>
    </div>
</body>
</html>