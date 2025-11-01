<?php
namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Siswa::with(['jurusanPilihan1', 'jurusanPilihan2', 'jurusanDiterima'])->get();
    }
    
    public function headings(): array
    {
        return [
            'No Pendaftaran', 'Nama Lengkap', 'NISN', 'NIK', 'Tempat Lahir', 'Tanggal Lahir',
            'Jenis Kelamin', 'Agama', 'Alamat', 'Kelurahan', 'Kecamatan', 'Kabupaten/Kota',
            'Provinsi', 'Kode Pos', 'No Telepon', 'Nama Ayah', 'Nama Ibu', 'Pekerjaan Ayah',
            'Pekerjaan Ibu', 'No Telepon Ayah', 'No Telepon Ibu', 'Asal Sekolah', 'Alamat Sekolah',
            'Tahun Lulus', 'Jurusan Pilihan 1', 'Jurusan Pilihan 2', 'Jalur Pendaftaran',
            'Rerata Nilai Rapor', 'Nilai Akreditasi Sekolah', 'Indeks Sekolah Asal',
            'Skor Akhir', 'Status Kelulusan', 'Jurusan Diterima'
        ];
    }
    
    public function map($siswa): array
    {
        return [
            $siswa->no_pendaftaran ?? '-',
            $siswa->nama_lengkap,
            $siswa->nisn,
            $siswa->nik,
            $siswa->tempat_lahir,
            $siswa->tanggal_lahir,
            $siswa->jenis_kelamin,
            $siswa->agama,
            $siswa->alamat_jalan,
            $siswa->kelurahan,
            $siswa->kecamatan,
            $siswa->kabupaten_kota,
            $siswa->provinsi,
            $siswa->kode_pos,
            $siswa->no_telepon,
            $siswa->nama_ayah,
            $siswa->nama_ibu,
            $siswa->pekerjaan_ayah,
            $siswa->pekerjaan_ibu,
            $siswa->no_telepon_ayah,
            $siswa->no_telepon_ibu,
            $siswa->asal_sekolah,
            $siswa->alamat_sekolah_asal,
            $siswa->tahun_lulus,
            $siswa->jurusanPilihan1->nama_jurusan ?? '-',
            $siswa->jurusanPilihan2->nama_jurusan ?? '-',
            $siswa->jalur_pendaftaran,
            $siswa->rerata_nilai_rapor,
            $siswa->nilai_akreditasi_sekolah,
            $siswa->indeks_sekolah_asal,
            $siswa->skor_akhir,
            $siswa->status_kelulusan,
            $siswa->jurusanDiterima->nama_jurusan ?? '-'
        ];
    }
}