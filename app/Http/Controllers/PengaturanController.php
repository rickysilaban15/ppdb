<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index()
    {
        try {
            // Check if table exists
            if (!\Schema::hasTable('pengaturan')) {
                return view('admin.pengaturan.index', [
                    'pengaturan' => $this->getDefaultSettings(),
                    'error' => 'Table pengaturan belum dibuat. Silakan jalankan migration.'
                ]);
            }

            $pengaturan = $this->getSettings();

            return view('admin.pengaturan.index', compact('pengaturan'));

        } catch (\Exception $e) {
            return view('admin.pengaturan.index', [
                'pengaturan' => $this->getDefaultSettings(),
                'error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    private function getSettings()
    {
        return [
            'nama_sekolah' => Pengaturan::getValue('nama_sekolah', 'SMK N 2 Siatas Barita'),
            'alamat_sekolah' => Pengaturan::getValue('alamat_sekolah', 'Jl. Pendidikan No. 123, Siatas Barita'),
            'telepon_sekolah' => Pengaturan::getValue('telepon_sekolah', '(0621) 12345'),
            'email_sekolah' => Pengaturan::getValue('email_sekolah', 'info@smkn2siatasbarita.sch.id'),
            
            'tahun_ajaran' => Pengaturan::getValue('tahun_ajaran', '2024/2025'),
            'tanggal_mulai' => Pengaturan::getValue('tanggal_mulai', date('Y-m-d')),
            'tanggal_selesai' => Pengaturan::getValue('tanggal_selesai', date('Y-m-d', strtotime('+30 days'))),
            'status_pendaftaran' => Pengaturan::getValue('status_pendaftaran', 'buka'),
            
            'min_nilai' => Pengaturan::getValue('min_nilai', '75'),
            'max_mapel_rendah' => Pengaturan::getValue('max_mapel_rendah', '3'),
            
            'smtp_host' => Pengaturan::getValue('smtp_host', ''),
            'smtp_port' => Pengaturan::getValue('smtp_port', '587'),
            'smtp_username' => Pengaturan::getValue('smtp_username', ''),
            'smtp_password' => Pengaturan::getValue('smtp_password', ''),
        ];
    }

    private function getDefaultSettings()
    {
        return [
            'nama_sekolah' => 'SMK N 2 Siatas Barita',
            'alamat_sekolah' => 'Jl. Pendidikan No. 123, Siatas Barita',
            'telepon_sekolah' => '(0621) 12345',
            'email_sekolah' => 'info@smkn2siatasbarita.sch.id',
            'tahun_ajaran' => '2024/2025',
            'tanggal_mulai' => date('Y-m-d'),
            'tanggal_selesai' => date('Y-m-d', strtotime('+30 days')),
            'status_pendaftaran' => 'buka',
            'min_nilai' => '75',
            'max_mapel_rendah' => '3',
            'smtp_host' => '',
            'smtp_port' => '587',
            'smtp_username' => '',
            'smtp_password' => '',
        ];
    }

    public function update(Request $request)
    {
        try {
            // Check if table exists
            if (!\Schema::hasTable('pengaturan')) {
                return back()->with('error', 'Table pengaturan belum dibuat. Silakan jalankan migration terlebih dahulu.');
            }

            $kategori = $request->kategori;
            
            switch ($kategori) {
                case 'umum':
                    $this->updatePengaturanUmum($request);
                    break;
                    
                case 'ppdb':
                    $this->updatePengaturanPPDB($request);
                    break;
                    
                case 'seleksi':
                    $this->updatePengaturanSeleksi($request);
                    break;
                    
                case 'email':
                    $this->updatePengaturanEmail($request);
                    break;
                    
                default:
                    return back()->with('error', 'Kategori pengaturan tidak valid.');
            }

            return back()->with('success', 'Pengaturan ' . ucfirst($kategori) . ' berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui pengaturan: ' . $e->getMessage());
        }
    }

    private function updatePengaturanUmum($request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string',
            'telepon_sekolah' => 'required|string',
            'email_sekolah' => 'required|email',
        ]);

        Pengaturan::setValue('nama_sekolah', $request->nama_sekolah);
        Pengaturan::setValue('alamat_sekolah', $request->alamat_sekolah);
        Pengaturan::setValue('telepon_sekolah', $request->telepon_sekolah);
        Pengaturan::setValue('email_sekolah', $request->email_sekolah);
    }

    private function updatePengaturanPPDB($request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status_pendaftaran' => 'required|in:buka,tutup',
        ]);

        Pengaturan::setValue('tahun_ajaran', $request->tahun_ajaran);
        Pengaturan::setValue('tanggal_mulai', $request->tanggal_mulai);
        Pengaturan::setValue('tanggal_selesai', $request->tanggal_selesai);
        Pengaturan::setValue('status_pendaftaran', $request->status_pendaftaran);
    }

    private function updatePengaturanSeleksi($request)
    {
        $request->validate([
            'min_nilai' => 'required|numeric|min:0|max:100',
            'max_mapel_rendah' => 'required|integer|min:0',
        ]);

        Pengaturan::setValue('min_nilai', $request->min_nilai);
        Pengaturan::setValue('max_mapel_rendah', $request->max_mapel_rendah);
    }

    private function updatePengaturanEmail($request)
    {
        $request->validate([
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|integer',
            'smtp_username' => 'nullable|string',
            'smtp_password' => 'nullable|string',
        ]);

        Pengaturan::setValue('smtp_host', $request->smtp_host);
        Pengaturan::setValue('smtp_port', $request->smtp_port);
        Pengaturan::setValue('smtp_username', $request->smtp_username);
        Pengaturan::setValue('smtp_password', $request->smtp_password);
    }

    public function backup()
    {
        try {
            // Redirect ke halaman backup yang sudah kita buat
            return redirect()->route('admin.backup');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengakses halaman backup: ' . $e->getMessage());
        }
    }

    public function optimasi(Request $request)
    {
        try {
            // Clear application cache
            Artisan::call('cache:clear');
            
            // Clear config cache
            Artisan::call('config:clear');
            
            // Clear route cache
            Artisan::call('route:clear');
            
            // Clear view cache
            Artisan::call('view:clear');
            
            // Clear all pengaturan cache
            Cache::flush();

            return back()->with('success', 'Sistem berhasil dioptimasi! Semua cache telah dibersihkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengoptimasi sistem: ' . $e->getMessage());
        }
    }

    public function logs()
    {
        $logFile = storage_path('logs/laravel.log');
        
        if (file_exists($logFile)) {
            $logs = file_get_contents($logFile);
            $logs = $logs ?: 'Log file kosong.';
        } else {
            $logs = 'Log file tidak ditemukan.';
        }

        return view('admin.pengaturan.logs', compact('logs'));
    }

    public function clearLogs(Request $request)
    {
        try {
            $logFile = storage_path('logs/laravel.log');
            
            if (file_exists($logFile)) {
                file_put_contents($logFile, '');
            }

            return back()->with('success', 'Logs berhasil dibersihkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membersihkan logs: ' . $e->getMessage());
        }
    }

    /**
     * Check if maintenance mode is enabled
     */
    public static function isMaintenanceMode()
    {
        return Pengaturan::getValue('maintenance_mode', '0') === '1';
    }

    public function maintenance(Request $request)
    {
        try {
            // Ensure table exists
            Pengaturan::createTableIfNotExists();

            if ($request->isMethod('post')) {
                $maintenanceMode = $request->has('maintenance_mode') ? '1' : '0';
                
                Pengaturan::setValue('maintenance_mode', $maintenanceMode);
                Pengaturan::setValue('maintenance_message', $request->maintenance_message);
                Pengaturan::setValue('maintenance_start', $request->maintenance_start);
                Pengaturan::setValue('maintenance_end', $request->maintenance_end);
                
                $message = $maintenanceMode === '1' 
                    ? 'Maintenance mode diaktifkan!' 
                    : 'Maintenance mode dinonaktifkan!';
                    
                return back()->with('success', $message);
            }
            
            // Get current maintenance settings
            $maintenanceSettings = [
                'maintenance_mode' => Pengaturan::getValue('maintenance_mode', '0'),
                'maintenance_message' => Pengaturan::getValue('maintenance_message', 'Sistem sedang dalam pemeliharaan.'),
                'maintenance_start' => Pengaturan::getValue('maintenance_start', now()->format('Y-m-d\TH:i')),
                'maintenance_end' => Pengaturan::getValue('maintenance_end', now()->addHours(2)->format('Y-m-d\TH:i')),
            ];
            
            return view('admin.pengaturan.maintenance', compact('maintenanceSettings'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengakses pengaturan maintenance: ' . $e->getMessage());
        }
    }

    public function toggleMaintenance(Request $request)
{
    try {
        $current = Pengaturan::getValue('maintenance_mode', '0');

        if ($current === '0') {
            // Aktifkan maintenance mode di database saja
            // Middleware akan menangani sisanya
            Pengaturan::setValue('maintenance_mode', '1');
            Pengaturan::setValue('maintenance_message', $request->maintenance_message ?? 'Sistem sedang dalam pemeliharaan.');
            Pengaturan::setValue('maintenance_start', $request->maintenance_start ?? now()->format('Y-m-d\TH:i'));
            Pengaturan::setValue('maintenance_end', $request->maintenance_end ?? now()->addHours(2)->format('Y-m-d\TH:i'));
            
            $message = 'Mode maintenance telah diaktifkan. Halaman admin tetap dapat diakses.';
        } else {
            // Nonaktifkan maintenance mode
            Pengaturan::setValue('maintenance_mode', '0');
            $message = 'Mode maintenance telah dinonaktifkan.';
        }

        return redirect()->back()->with('success', $message);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengubah status maintenance: ' . $e->getMessage());
    }
}
}