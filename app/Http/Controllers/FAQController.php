<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function publicIndex()
    {
        $faqs = Faq::active()
                    ->ordered()
                    ->get();

        // Fallback data jika belum ada FAQ di database
        if ($faqs->isEmpty()) {
            $faqs = collect([
                [
                    'question' => 'Kapan pendaftaran PPDB dibuka?',
                    'answer' => 'Pendaftaran PPDB SMK N 2 Siatas Barita biasanya dibuka pada bulan April setiap tahunnya. Informasi lengkap mengenai jadwal pendaftaran akan diumumkan melalui website resmi sekolah dan media sosial resmi kami.',
                    'category' => 'pendaftaran'
                ],
                [
                    'question' => 'Apa saja persyaratan untuk mendaftar?',
                    'answer' => "Persyaratan untuk mendaftar di SMK N 2 Siatas Barita meliputi:\n1. Fotokopi ijazah SMP/MTs atau SKL\n2. Fotokopi rapor semester 1-5 SMP/MTs\n3. Fotokopi akta kelahiran\n4. Fotokopi Kartu Keluarga (KK)\n5. Pas foto terbaru ukuran 3x4 (2 lembar)\n6. Fotokopi sertifikat prestasi (jika ada)\n7. Surat keterangan sehat dari dokter",
                    'category' => 'pendaftaran'
                ],
                [
                    'question' => 'Bagaimana proses seleksi calon siswa?',
                    'answer' => "Proses seleksi calon siswa di SMK Harapan Bangsa meliputi:\n1. Seleksi administrasi\n2. Tes akademik\n3. Tes psikologi\n4. Wawancara\n5. Tes kesehatan\nHasil seleksi akan diumumkan melalui website dan papan pengumuman sekolah.",
                    'category' => 'seleksi'
                ],
                [
                    'question' => 'Berapa biaya pendaftaran?',
                    'answer' => 'Biaya pendaftaran PPDB SMK Harapan Bangsa adalah Rp 200.000,-. Biaya ini digunakan untuk pengolahan administrasi dan pelaksanaan tes seleksi.',
                    'category' => 'biaya'
                ],
                [
                    'question' => 'Jurusan apa saja yang tersedia?',
                    'answer' => "SMK  menyediakan beberapa jurusan unggulan:\n1. Teknik Komputer dan Jaringan (TKJ)\n2. Multimedia (MM)\n3. Akuntansi dan Keuangan Lembaga (AKL)\n4. Otomasi dan Tata Kelola Perkantoran (OTKP)\n5. Teknik Kendaraan Ringan (TKR)",
                    'category' => 'akademik'
                ]
            ]);
        }

        return view('faq', compact('faqs'));
    }
}