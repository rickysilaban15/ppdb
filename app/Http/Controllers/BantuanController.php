<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index()
    {
        return view('admin.bantuan.index');
    }
    
    public function dokumentasi()
    {
        return view('admin.bantuan.dokumentasi');
    }
    
    public function faq()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara memverifikasi data siswa?',
                'answer' => 'Untuk memverifikasi data siswa, buka menu Data Siswa → Pilih siswa → Klik tombol Verifikasi.'
            ],
            [
                'question' => 'Bagaimana mengelola jurusan?',
                'answer' => 'Menu Kelola Jurusan tersedia di sidebar untuk menambah, mengedit, atau menghapus jurusan.'
            ],
            [
                'question' => 'Cara membuat pengumuman?',
                'answer' => 'Buka menu Pengumuman → Klik Tambah Pengumuman → Isi form dan publikasi.'
            ]
        ];
        
        return view('admin.bantuan.faq', compact('faqs'));
    }
    

    public function kontak()
    {
        return view('admin.bantuan.kontak');
    }
}