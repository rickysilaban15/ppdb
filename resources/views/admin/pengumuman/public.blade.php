<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengumuman Kelulusan Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 30px; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        th { background-color: #f2f2f2; }
        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>📢 Pengumuman Kelulusan PPDB</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Jurusan Diterima</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                    <td class="{{ $siswa->status_kelulusan === 'lulus' ? 'lulus' : 'tidak-lulus' }}">
                        {{ ucfirst($siswa->status_kelulusan) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
