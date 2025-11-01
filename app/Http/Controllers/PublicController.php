<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function beranda()
    {
        return view('public.beranda');
    }

    public function tentang()
    {
        return view('public.tentang');
    }

    public function jurusan(Request $request)
    {
        // Query untuk mendapatkan data jurusan
        $query = Jurusan::query();
        
        // Filter berdasarkan pencarian jika ada
        if ($request->has('search')) {
            $query->where('nama_jurusan', 'like', "%{$request->search}%")
                  ->orWhere('kode_jurusan', 'like', "%{$request->search}%")
                  ->orWhere('bidang_keahlian', 'like', "%{$request->search}%");
        }
        
        $jurusans = $query->get();
        
        // Data statistik untuk ditampilkan di view
        $stats = [
            'total_jurusan' => Jurusan::count(),
            'total_pendaftar' => Siswa::count(),
            'total_diterima' => Siswa::whereNotNull('jurusan_diterima')->count(),
            'total_peminat_1' => Siswa::whereNotNull('pilihan_jurusan_1')->count(),
            'total_peminat_2' => Siswa::whereNotNull('pilihan_jurusan_2')->count(),
        ];

        return view('public.jurusan', compact('jurusans', 'stats'));
    }

    public function persyaratan()
    {
        return view('public.persyaratan');
    }

    public function jadwal()
    {
        return view('public.jadwal');
    }

    public function pengumuman()
    {
        return view('public.pengumuman');
    }

    public function kontak()
    {
        return view('public.kontak');
    }
}