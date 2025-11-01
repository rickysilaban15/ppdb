<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kelulusan Siswa</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        h2, h3 {
            text-align: center;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: center;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .section {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h2>Laporan Kelulusan Siswa</h2>
    <h3>SMK N 2 Siatas Barita</h3>

    {{-- Bagian siswa lulus --}}
    <div class="section">
        <h4>Daftar Siswa Lulus</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Jurusan</th>
                    <th>Skor Akhir</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['lulus'] as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nama_lengkap }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->jurusanPilihan1->nama_jurusan ?? '-' }}</td>
                        <td>{{ $siswa->skor_akhir ?? '-' }}</td>
                        <td><b>Lulus</b></td>
                    </tr>
                @empty
                    <tr><td colspan="6">Tidak ada siswa lulus</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Bagian siswa tidak lulus --}}
    <div class="section">
        <h4>Daftar Siswa Tidak Lulus</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Jurusan</th>
                    <th>Skor Akhir</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['tidak_lulus'] as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nama_lengkap }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->jurusanPilihan1->nama_jurusan ?? '-' }}</td>
                        <td>{{ $siswa->skor_akhir ?? '-' }}</td>
                        <td><b>Tidak Lulus</b></td>
                    </tr>
                @empty
                    <tr><td colspan="6">Tidak ada siswa tidak lulus</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p style="margin-top:40px; text-align:right;">
        <i>Dicetak pada: {{ now()->format('d M Y H:i') }}</i>
    </p>
</body>
</html>
