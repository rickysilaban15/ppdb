<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara mendaftar PPDB online?',
                'answer' => 'Anda dapat mendaftar melalui menu "Daftar Online" di website ini. Isi formulir pendaftaran dengan data yang valid dan lengkap, kemudian submit formulir tersebut.',
                'order' => 1
            ],
            [
                'question' => 'Apa saja persyaratan yang dibutuhkan?',
                'answer' => "Persyaratan yang dibutuhkan:\n- Fotocopy akta kelahiran\n- Fotocopy KK\n- Pas foto 3x4 (2 lembar)\n- Rapor semester 1-5\n- Surat keterangan lulus (jika sudah lulus)\n- Kartu peserta ujian nasional",
                'order' => 2
            ],
            [
                'question' => 'Kapan batas waktu pendaftaran?',
                'answer' => 'Batas waktu pendaftaran dapat dilihat pada pengumuman resmi di website atau hubungi pihak sekolah untuk informasi lebih lanjut. Biasanya pendaftaran dibuka selama 2 bulan sebelum tahun ajaran baru.',
                'order' => 3
            ],
            [
                'question' => 'Apakah ada biaya pendaftaran?',
                'answer' => 'Pendaftaran PPDB di SMK Harapan Bangsa tidak dipungut biaya. Proses pendaftaran sepenuhnya gratis. Hati-hati terhadap penipuan yang mengatasnamakan sekolah.',
                'order' => 4
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}