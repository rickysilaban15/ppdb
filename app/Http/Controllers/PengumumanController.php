<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;

class PengumumanController extends Controller
{
    /**
     * Display public announcement page
     */
    public function public()
    {
        // Get announcement settings
        $pengumumanAktif = Pengaturan::where('key_name', 'pengumuman_aktif')->first();
        $pengumumanJudul = Pengaturan::where('key_name', 'pengumuman_judul')->first();
        $pengumumanKonten = Pengaturan::where('key_name', 'pengumuman_konten')->first();
        $pengumumanTanggal = Pengaturan::where('key_name', 'pengumuman_tanggal')->first();
        $pengumumanWaktu = Pengaturan::where('key_name', 'pengumuman_waktu')->first();

        // Check if announcement is active
        if (!$pengumumanAktif || $pengumumanAktif->value != '1') {
            // Use the existing pengumuman view but show closed message
            return view('public.pengumuman', [
                'pengumumanAktif' => false,
                'pengumumanJudul' => $pengumumanJudul?->value ?? 'Pengumuman Belum Tersedia',
                'pengumumanKonten' => $pengumumanKonten?->value ?? 'Pengumuman hasil seleksi PPDB akan diumumkan sesuai jadwal yang telah ditentukan.',
                'pengumumanTanggal' => $pengumumanTanggal?->value ?? '-',
                'pengumumanWaktu' => $pengumumanWaktu?->value ?? '-'
            ]);
        }

        // Show active announcement
        return view('public.pengumuman', [
            'pengumumanAktif' => true,
            'pengumumanJudul' => $pengumumanJudul?->value ?? 'Pengumuman Hasil Seleksi PPDB',
            'pengumumanKonten' => $pengumumanKonten?->value ?? 'Pengumuman akan segera tersedia.',
            'pengumumanTanggal' => $pengumumanTanggal?->value ?? date('d-m-Y'),
            'pengumumanWaktu' => $pengumumanWaktu?->value ?? '00:00 WIB'
        ]);
    }

    /**
     * Display admin announcement management
     */
    public function index()
    {
        $pengumumanAktif = Pengaturan::where('key_name', 'pengumuman_aktif')->first();
        $pengumumanJudul = Pengaturan::where('key_name', 'pengumuman_judul')->first();
        $pengumumanKonten = Pengaturan::where('key_name', 'pengumuman_konten')->first();
        $pengumumanTanggal = Pengaturan::where('key_name', 'pengumuman_tanggal')->first();
        $pengumumanWaktu = Pengaturan::where('key_name', 'pengumuman_waktu')->first();

        return view('admin.pengumuman.index', compact(
            'pengumumanAktif',
            'pengumumanJudul',
            'pengumumanKonten',
            'pengumumanTanggal',
            'pengumumanWaktu'
        ));
    }

    /**
     * Update announcement settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'pengumuman_judul' => 'required|string|max:255',
            'pengumuman_konten' => 'required|string',
            'pengumuman_tanggal' => 'required|date',
            'pengumuman_waktu' => 'required|string',
        ]);

        // Update or create settings
        Pengaturan::updateOrCreate(
            ['key_name' => 'pengumuman_judul'],
            ['value' => $request->pengumuman_judul]
        );

        Pengaturan::updateOrCreate(
            ['key_name' => 'pengumuman_konten'],
            ['value' => $request->pengumuman_konten]
        );

        Pengaturan::updateOrCreate(
            ['key_name' => 'pengumuman_tanggal'],
            ['value' => $request->pengumuman_tanggal]
        );

        Pengaturan::updateOrCreate(
            ['key_name' => 'pengumuman_waktu'],
            ['value' => $request->pengumuman_waktu]
        );

        return redirect()->route('pengumuman.index')->with('success', 'Pengaturan pengumuman berhasil diperbarui.');
    }

    /**
     * Toggle announcement status
     */
    public function toggleStatus(Request $request)
    {
        $status = $request->status ? '1' : '0';

        Pengaturan::updateOrCreate(
            ['key_name' => 'pengumuman_aktif'],
            ['value' => $status]
        );

        return response()->json(['success' => true, 'status' => $status]);
    }
}