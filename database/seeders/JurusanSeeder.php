<?php
namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusans = [
            // Teknik dan Kejuruan Otomotif
            ['TKRO', 'TKRO', 'Teknik Kendaraan Ringan Otomotif', 'Teknik dan Kejuruan Otomotif', 36, 12, 'Program keahlian yang mempelajari pemeliharaan dan perbaikan kendaraan ringan'],
            ['TBSM', 'TBSM', 'Teknik dan Bisnis Sepeda Motor', 'Teknik dan Kejuruan Otomotif', 36, 12, 'Program keahlian yang mempelajari teknisi dan bisnis sepeda motor'],
            ['TSM', 'TSM', 'Teknik Sepeda Motor', 'Teknik dan Kejuruan Otomotif', 36, 12, 'Program keahlian yang fokus pada perbaikan dan perawatan sepeda motor'],
            
            // Teknik Komputer dan Informasi
            ['TKJ', 'TKJ', 'Teknik Komputer dan Jaringan', 'Teknik Komputer dan Informasi', 36, 12, 'Program keahlian yang mempelajari instalasi, konfigurasi, dan pengelolaan jaringan komputer'],
            ['RPL', 'RPL', 'Rekayasa Perangkat Lunak', 'Teknik Komputer dan Informasi', 36, 12, 'Program keahlian yang mempelajari pemrograman dan pengembangan aplikasi'],
            
            // Teknik Ketenagalistrikan
            ['TITL', 'TITL', 'Teknik Instalasi Tenaga Listrik', 'Teknik Ketenagalistrikan', 36, 12, 'Program keahlian yang mempelajari instalasi dan distribusi tenaga listrik'],
            
            // Bisnis dan Manajemen
            ['AKL', 'AKL', 'Akuntansi dan Keuangan Lembaga', 'Bisnis dan Manajemen', 36, 12, 'Program keahlian yang mempelajari akuntansi dan pengelolaan keuangan'],
            ['OTKP', 'OTKP', 'Otomatisasi dan Tata Kelola Perkantoran', 'Bisnis dan Manajemen', 36, 12, 'Program keahlian yang mempelajari administrasi perkantoran modern'],
            ['PEMASARAN', 'Pemasaran', 'Pemasaran', 'Bisnis dan Manajemen', 36, 12, 'Program keahlian yang mempelajari strategi pemasaran dan penjualan'],
            
            // Pertanian dan Perkebunan
            ['ATPH', 'ATPH', 'Agribisnis Tanaman Pangan dan Hortikultura', 'Pertanian dan Perkebunan', 36, 12, 'Program keahlian yang mempelajari budidaya tanaman pangan dan hortikultura'],
            
            // Desain
            ['DKV', 'DKV', 'Desain Komunikasi Visual', 'Desain', 36, 12, 'Program keahlian yang mempelajari desain grafis dan multimedia'],
            ['DPIB', 'DPIB', 'Desain Pemodelan dan Informasi Bangunan', 'Desain', 36, 12, 'Program keahlian yang mempelajari desain arsitektur dan bangunan'],
            
            // Teknik Mesin
            ['TM', 'Teknik Mesin', 'Teknik Mesin', 'Teknik Mesin', 36, 12, 'Program keahlian yang mempelajari teknologi mesin industri'],
            ['TP', 'Teknik Pemesinan', 'Teknik Pemesinan', 'Teknik Mesin', 36, 12, 'Program keahlian yang mempelajari proses pemesinan dan manufaktur'],
            
            // Teknologi Informasi dan Komunikasi
            ['MM', 'Multimedia', 'Multimedia', 'Teknologi Informasi dan Komunikasi', 36, 12, 'Program keahlian yang mempelajari produksi konten multimedia'],
            
            // Kesehatan dan Pekerjaan Sosial
            ['FARMASI', 'Farmasi', 'Farmasi', 'Kesehatan dan Pekerjaan Sosial', 36, 12, 'Program keahlian yang mempelajari kefarmasian dan kesehatan'],
            
            // Pariwisata
            ['TATA_BOGA', 'Tata Boga', 'Tata Boga', 'Pariwisata', 36, 12, 'Program keahlian yang mempelajari seni kuliner dan tata boga'],
            
            // Kriya
            ['TATA_BUSANA', 'Tata Busana', 'Tata Busana', 'Kriya', 36, 12, 'Program keahlian yang mempelajari desain dan pembuatan busana'],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create([
                'kode_jurusan' => $jurusan[0],
                'nama_jurusan' => $jurusan[1],
                'nama_lengkap' => $jurusan[2],
                'bidang_keahlian' => $jurusan[3],
                'kuota_reguler' => $jurusan[4],
                'kuota_unggulan' => $jurusan[5],
                'deskripsi' => $jurusan[6] ?? null,
            ]);
        }

        $this->command->info('18 Jurusan berhasil ditambahkan!');
    }
}