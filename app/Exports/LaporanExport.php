<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $type;

    public function __construct($type = 'siswa')
    {
        $this->type = $type;
    }

    public function collection()
    {
        if ($this->type === 'siswa') {
            // Ambil semua siswa
            return Siswa::select(
                'no_pendaftaran',
                'nama_lengkap',
                'nisn',
                'jalur_pendaftaran',
                'pilihan_jurusan_1',
                'pilihan_jurusan_2',
                'status_seleksi'
            )->get();
        }

        return collect(); // kosong untuk type lain
    }

    public function headings(): array
    {
        if ($this->type === 'siswa') {
            return [
                'No Pendaftaran',
                'Nama Lengkap',
                'NISN',
                'Jalur Pendaftaran',
                'Pilihan Jurusan 1',
                'Pilihan Jurusan 2',
                'Status Seleksi'
            ];
        }

        return [];
    }
}
