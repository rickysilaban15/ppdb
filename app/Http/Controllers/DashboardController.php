<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        try {
            // Ambil data dari database - GUNAKAN STATUS YANG BENAR
            $totalSiswa = Siswa::count();
            $siswaDiterima = Siswa::where('status_seleksi', 'diterima')->count();
            $siswaPending = Siswa::where('status_seleksi', 'pending')->orWhereNull('status_seleksi')->count();
            $siswaDitolak = Siswa::where('status_seleksi', 'ditolak')->count();
            $totalJurusan = Jurusan::count();
            
            // Data untuk chart pendaftaran (6 bulan terakhir)
            $pendaftaranData = [];
            $diterimaData = [];
            $labels = [];
            
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthName = $date->translatedFormat('F');
                $labels[] = $monthName;
                
                $pendaftaranData[] = Siswa::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                    
                $diterimaData[] = Siswa::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->where('status_seleksi', 'diterima')
                    ->count();
            }
            
            // Data untuk chart jurusan
            $jurusanData = Jurusan::withCount([
                'siswaPilihan1 as peminat_pilihan1',
                'siswaPilihan2 as peminat_pilihan2',
                'siswaDiterima as diterima_count'
            ])->get()->map(function ($jurusan) {
                $totalPeminat = $jurusan->peminat_pilihan1 + $jurusan->peminat_pilihan2;
                
                return [
                    'nama' => $jurusan->nama_jurusan,
                    'total_peminat' => $totalPeminat,
                    'pilihan1' => $jurusan->peminat_pilihan1,
                    'pilihan2' => $jurusan->peminat_pilihan2,
                    'diterima' => $jurusan->diterima_count
                ];
            });
            
            // Aktivitas terbaru
            $recentActivities = Siswa::with([
                'jurusanPilihan1:id,nama_jurusan',
                'jurusanPilihan2:id,nama_jurusan', 
                'jurusanDiterima:id,nama_jurusan'
            ])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($siswa) {
                // Tentukan jurusan yang dipilih untuk ditampilkan
                $jurusanNama = $siswa->jurusanDiterima?->nama_jurusan ?? 
                              ($siswa->jurusanPilihan1?->nama_jurusan ?? 
                              ($siswa->jurusanPilihan2?->nama_jurusan ?? 'Belum memilih'));
                
                return [
                    'nama' => $siswa->nama_lengkap,
                    'no_pendaftaran' => $siswa->no_pendaftaran,
                    'jurusan' => $jurusanNama,
                    'status' => $this->translateStatus($siswa->status_seleksi),
                    'waktu' => $siswa->created_at->diffForHumans(),
                    'status_color' => $this->getStatusColor($siswa->status_seleksi)
                ];
            });

            return view('admin.dashboard', compact(
                'totalSiswa', 
                'siswaDiterima',  // GANTI: siswaLulus -> siswaDiterima
                'siswaPending',
                'siswaDitolak',   // GANTI: siswaTidakLulus -> siswaDitolak
                'totalJurusan',
                'pendaftaranData',
                'diterimaData',   // GANTI: lulusData -> diterimaData
                'labels',
                'jurusanData',
                'recentActivities'
            ));

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Dashboard Error: ' . $e->getMessage());
            
            // Fallback data jika ada error
            return view('admin.dashboard', [
                'totalSiswa' => 0,
                'siswaDiterima' => 0,
                'siswaPending' => 0,
                'siswaDitolak' => 0,
                'totalJurusan' => 0,
                'pendaftaranData' => [0, 0, 0, 0, 0, 0],
                'diterimaData' => [0, 0, 0, 0, 0, 0],
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                'jurusanData' => [],
                'recentActivities' => [],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get status color for UI
     */
    private function getStatusColor($status)
    {
        return match($status) {
            'diterima' => 'success',    // GANTI: lulus -> diterima
            'pending' => 'warning',     // GANTI: menunggu -> pending
            'ditolak' => 'danger',      // GANTI: tidak_lulus -> ditolak
            null => 'secondary',
            default => 'secondary'
        };
    }

    /**
     * Translate status to Indonesian
     */
    private function translateStatus($status)
    {
        return match($status) {
            'diterima' => 'Diterima',   // GANTI: lulus -> Diterima
            'pending' => 'Pending',      // GANTI: menunggu -> Pending
            'ditolak' => 'Ditolak',     // GANTI: tidak_lulus -> Ditolak
            null => 'Belum Diproses',
            default => $status
        };
    }

    /**
     * Get admin data for API requests.
     */
    public function getDashboardData()
    {
        try {
            $totalSiswa = Siswa::count();
            $siswaDiterima = Siswa::where('status_seleksi', 'diterima')->count(); // GANTI
            $siswaPending = Siswa::where('status_seleksi', 'pending')->orWhereNull('status_seleksi')->count(); // GANTI
            
            $recentActivities = Siswa::with([
                'jurusanPilihan1:id,nama_jurusan',
                'jurusanPilihan2:id,nama_jurusan',
                'jurusanDiterima:id,nama_jurusan'
            ])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get()
            ->map(function ($siswa) {
                $jurusanNama = $siswa->jurusanDiterima?->nama_jurusan ?? 
                              ($siswa->jurusanPilihan1?->nama_jurusan ?? 
                              ($siswa->jurusanPilihan2?->nama_jurusan ?? 'Belum memilih'));
                
                return [
                    'nama' => $siswa->nama_lengkap,
                    'jurusan' => $jurusanNama,
                    'status' => $this->translateStatus($siswa->status_seleksi),
                    'waktu' => $siswa->created_at->diffForHumans()
                ];
            });
            
            return response()->json([
                'success' => true,
                'totalSiswa' => $totalSiswa,
                'siswaDiterima' => $siswaDiterima, // GANTI
                'siswaPending' => $siswaPending,
                'recentActivities' => $recentActivities
            ]);

        } catch (\Exception $e) {
            \Log::error('Dashboard API Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'totalSiswa' => 0,
                'siswaDiterima' => 0, // GANTI
                'siswaPending' => 0,
                'recentActivities' => []
            ], 500);
        }
    }
}