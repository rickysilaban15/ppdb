<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\NilaiSiswa;
use App\Models\Prestasi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siswa::with(['jurusanPilihan1', 'jurusanPilihan2']);
            
        if ($request->has('search')) {
            $query->where('nama_lengkap', 'like', "%{$request->search}%")
                  ->orWhere('nisn', 'like', "%{$request->search}%");
        }

        $siswas = $query->paginate(20);
        
        return view('admin.nilai.index', compact('siswas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa->load(['nilaiSiswa', 'prestasi', 'jurusanPilihan1', 'jurusanPilihan2']);
        return view('admin.nilai.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editNilai(Siswa $siswa)
    {
        $siswa->load(['nilaiSiswa', 'prestasi', 'jurusanPilihan1', 'jurusanPilihan2']);
        return view('admin.nilai.edit-nilai', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateNilai(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nilai.*.mata_pelajaran' => 'required|string',
            'nilai.*.nilai' => 'required|numeric|min:0|max:100',
            'nilai.*.semester' => 'required|integer|min:1|max:6',
        ]);

        // Hapus nilai lama
        $siswa->nilaiSiswa()->delete();

        // Simpan nilai baru
        foreach ($request->nilai as $nilaiData) {
            $siswa->nilaiSiswa()->create($nilaiData);
        }

        // Hitung rata-rata nilai rapor
        $rerata = $siswa->nilaiSiswa()->avg('nilai');
        $siswa->update(['rerata_nilai_rapor' => round($rerata, 2)]);

        return redirect()->route('admin.nilai.show', $siswa)
            ->with('success', 'Nilai siswa berhasil diperbarui.');
    }

    /**
     * Add a new prestasi to siswa.
     */
    public function addPrestasi(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'jenis_prestasi' => 'required|in:akademik,non-akademik',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|in:sekolah,kecamatan,kabupaten,provinsi,nasional,internasional',
            'tahun' => 'required|integer',
            'poin_prestasi' => 'required|integer|min:0',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_sertifikat')) {
            $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('prestasi', 'public');
        }

        $siswa->prestasi()->create($validated);

        return back()->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Delete a prestasi.
     */
    public function deletePrestasi(Prestasi $prestasi)
    {
        if ($prestasi->file_sertifikat) {
            Storage::disk('public')->delete($prestasi->file_sertifikat);
        }
        
        $prestasi->delete();

        return back()->with('success', 'Prestasi berhasil dihapus.');
    }

    /**
     * Show seleksi form
     */
    public function showSeleksiForm()
    {
        $jurusan = Jurusan::all();
        return view('admin.nilai.seleksi', compact('jurusan'));
    }

    /**
     * Proses seleksi siswa
     */
    public function prosesSeleksi(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'kuota' => 'required|integer|min:1',
            'metode' => 'required|in:rata_rata,tertimbang',
        ]);

        try {
            $jurusanId = $request->jurusan_id;
            $kuota = $request->kuota;
            $metode = $request->metode;

            Log::info("Memulai proses seleksi - Jurusan: {$jurusanId}, Kuota: {$kuota}, Metode: {$metode}");

            // Ambil siswa dengan status pending untuk jurusan yang dipilih
            $siswaPending = Siswa::where('jurusan_pilihan', $jurusanId)
                ->where('status', 'Pending')
                ->with(['prestasi', 'nilaiSiswa'])
                ->get();

            Log::info("Ditemukan {$siswaPending->count()} siswa pending untuk jurusan {$jurusanId}");

            if ($siswaPending->isEmpty()) {
                return redirect()->route('admin.nilai.seleksi')
                    ->with('error', 'Tidak ada siswa pending untuk jurusan ini.');
            }

            // Hitung skor untuk setiap siswa
            $results = [];
            foreach ($siswaPending as $siswa) {
                if ($metode === 'rata_rata') {
                    $skor = $this->hitungSkorRataRata($siswa);
                } else {
                    $skor = $this->hitungSkorTertimbang($siswa);
                }

                $results[] = [
                    'siswa' => $siswa,
                    'skor' => $skor,
                    'lulus' => false // akan diupdate berdasarkan kuota
                ];

                Log::info("Siswa {$siswa->nama_lengkap} - Skor: {$skor}");
            }

            // Urutkan berdasarkan skor tertinggi
            usort($results, function($a, $b) {
                return $b['skor'] <=> $a['skor'];
            });

            // Tentukan yang lulus berdasarkan kuota
            $countLulus = 0;
            foreach ($results as &$result) {
                if ($countLulus < $kuota) {
                    $result['lulus'] = true;
                    $countLulus++;
                }
            }

            // Simpan hasil seleksi sementara di session
            session(['hasil_seleksi' => $results]);
            session(['jurusan_seleksi' => $jurusanId]);

            Log::info("Proses seleksi selesai - {$countLulus} siswa lulus dari {$kuota} kuota");

            return redirect()->route('admin.nilai.seleksi.hasil')
                ->with('success', 'Proses seleksi berhasil!');

        } catch (\Exception $e) {
            Log::error("Error proses seleksi: " . $e->getMessage());
            return redirect()->route('admin.nilai.seleksi')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan hasil seleksi
     */
    public function hasilSeleksi()
    {
        $results = session('hasil_seleksi', []);
        $jurusanId = session('jurusan_seleksi');
        
        if (empty($results)) {
            return redirect()->route('admin.nilai.seleksi')
                ->with('error', 'Tidak ada hasil seleksi yang ditemukan.');
        }

        $jurusan = Jurusan::find($jurusanId);

        return view('admin.nilai.hasil-seleksi', compact('results', 'jurusan'));
    }

    /**
     * Menampilkan ranking
     */
    public function showRanking()
    {
        // Ambil 3 siswa terbaik yang sudah diterima
        $top3 = Siswa::where('status', 'Diterima')
            ->with(['jurusanPilihan1', 'nilaiSiswa'])
            ->orderBy('skor_akhir', 'desc')
            ->limit(3)
            ->get();

        // Tambahkan ranking
        $ranking = 1;
        foreach ($top3 as $siswa) {
            $siswa->ranking = $ranking++;
        }

        return view('admin.nilai.ranking', compact('top3'));
    }

    /**
     * Memproses ranking dan menyimpan hasil seleksi
     */
    public function prosesRanking(Request $request)
    {
        try {
            $results = session('hasil_seleksi', []);
            
            if (empty($results)) {
                return redirect()->route('admin.nilai.seleksi')
                    ->with('error', 'Tidak ada hasil seleksi untuk diproses.');
            }

            Log::info("Memulai proses ranking untuk " . count($results) . " siswa");

            // Simpan hasil seleksi ke database
            foreach ($results as $result) {
                $siswa = $result['siswa'];
                
                if ($result['lulus']) {
                    // Update status siswa menjadi Diterima
                    $siswa->update([
                        'status' => 'Diterima',
                        'skor_akhir' => $result['skor'],
                        'updated_at' => now()
                    ]);
                    Log::info("Siswa {$siswa->nama_lengkap} - DITERIMA - Skor: {$result['skor']}");
                } else {
                    // Update status siswa menjadi Ditolak
                    $siswa->update([
                        'status' => 'Ditolak',
                        'skor_akhir' => $result['skor'],
                        'updated_at' => now()
                    ]);
                    Log::info("Siswa {$siswa->nama_lengkap} - DITOLAK - Skor: {$result['skor']}");
                }
            }

            // Clear session
            session()->forget(['hasil_seleksi', 'jurusan_seleksi']);

            Log::info("Proses ranking selesai");

            return redirect()->route('admin.nilai.ranking')
                ->with('success', 'Ranking berhasil diproses dan data telah disimpan!');

        } catch (\Exception $e) {
            Log::error("Error proses ranking: " . $e->getMessage());
            return redirect()->route('admin.nilai.seleksi.hasil')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Proses seleksi legacy (GET method untuk kompatibilitas)
     */
    public function prosesSeleksiLegacy()
    {
        Log::warning('Menggunakan metode prosesSeleksiLegacy (GET)');
        
        // Redirect ke form seleksi
        return redirect()->route('admin.nilai.seleksi')
            ->with('info', 'Silakan gunakan form seleksi untuk memproses seleksi siswa.');
    }

    /**
     * Proses ranking legacy (GET method untuk kompatibilitas)
     */
    public function prosesRankingLegacy()
    {
        Log::warning('Menggunakan metode prosesRankingLegacy (GET)');
        
        try {
            // Reset ranking sebelumnya
            Siswa::where('status', 'Diterima')->update(['ranking' => null]);

            // Urutkan berdasarkan skor akhir
            $siswasLulus = Siswa::where('status', 'Diterima')
                               ->orderBy('skor_akhir', 'desc')
                               ->get();

            $ranking = 1;
            foreach ($siswasLulus as $siswa) {
                $siswa->update(['ranking' => $ranking]);
                $ranking++;
            }

            $top3 = Siswa::where('status', 'Diterima')
                        ->where('ranking', '<=', 3)
                        ->orderBy('ranking')
                        ->get();

            return view('admin.nilai.ranking', compact('top3'))
                ->with('info', 'Ranking berhasil diproses menggunakan metode legacy.');

        } catch (\Exception $e) {
            Log::error("Error proses ranking legacy: " . $e->getMessage());
            return redirect()->route('admin.nilai.ranking')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hitung skor rata-rata
     */
    private function hitungSkorRataRata($siswa)
    {
        // Gunakan rerata_nilai_rapor jika sudah ada, jika tidak hitung dari nilaiSiswa
        if ($siswa->rerata_nilai_rapor) {
            $nilaiRapor = $siswa->rerata_nilai_rapor;
        } else {
            $nilaiRapor = $siswa->nilaiSiswa->avg('nilai') ?? 0;
        }

        $jumlahPrestasi = $siswa->prestasi->count();
        
        // Skor = 70% nilai rapor + 30% prestasi
        $skor = ($nilaiRapor * 0.7) + ($jumlahPrestasi * 10 * 0.3);
        
        return min($skor, 100); // Maksimal 100
    }

    /**
     * Hitung skor tertimbang
     */
    private function hitungSkorTertimbang($siswa)
    {
        // Gunakan rerata_nilai_rapor jika sudah ada, jika tidak hitung dari nilaiSiswa
        if ($siswa->rerata_nilai_rapor) {
            $nilaiRapor = $siswa->rerata_nilai_rapor;
        } else {
            $nilaiRapor = $siswa->nilaiSiswa->avg('nilai') ?? 0;
        }

        $jumlahPrestasi = $siswa->prestasi->count();
        
        // Bobot lebih besar untuk prestasi
        $skor = ($nilaiRapor * 0.6) + ($jumlahPrestasi * 15 * 0.4);
        
        return min($skor, 100); // Maksimal 100
    }
}