<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\FormPendaftaranController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\FAQController;

/*
|--------------------------------------------------------------------------
| Public Routes - PPDB SMK N 2 Siatas Barita
|--------------------------------------------------------------------------
*/

// Public Routes - Halaman Utama
Route::get('/', [PublicController::class, 'beranda'])->name('beranda');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/jurusan', [PublicController::class, 'jurusan'])->name('jurusan');
Route::get('/persyaratan', [PublicController::class, 'persyaratan'])->name('persyaratan');
Route::get('/jadwal', [PublicController::class, 'jadwal'])->name('jadwal');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');

// Form Pendaftaran PPDB
Route::get('/pendaftaran', [FormPendaftaranController::class, 'showForm'])->name('pendaftaran.form');
Route::post('/pendaftaran', [FormPendaftaranController::class, 'store'])->name('pendaftaran.store');

// Cek Status Pendaftaran
Route::get('/cek-status', [FormPendaftaranController::class, 'showStatusForm'])->name('pendaftaran.cek-status');
Route::get('/status/{no_pendaftaran}', [FormPendaftaranController::class, 'checkStatus'])->name('siswa.status');

// Pengumuman Public
Route::get('/pengumuman', [PengumumanController::class, 'public'])->name('pengumuman.public');

// Route FAQ
Route::get('/faq', [FAQController::class, 'publicIndex'])->name('faq');

// Route untuk preview maintenance (PUBLIC - bisa diakses tanpa login)
Route::get('/preview-maintenance', function() {
    return view('maintenance', [
        'message' => 'Sistem sedang dalam pemeliharaan untuk pengalaman yang lebih baik. Kami akan segera kembali online.',
        'schedule' => [
            'start' => now()->format('Y-m-d H:i:s'),
            'end' => now()->addHours(2)->format('Y-m-d H:i:s')
        ]
    ]);
})->name('preview.maintenance');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes (auth:admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');

    // Admin Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    /*
    |--------------------------------------------------------------------------
    | Data Siswa
    |--------------------------------------------------------------------------
    */
    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('/', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
        Route::post('/{siswa}/status', [SiswaController::class, 'updateStatus'])->name('siswa.updateStatus');
        Route::post('/bulk-action', [SiswaController::class, 'bulkAction'])->name('siswa.bulkAction');
        Route::get('/export/{format}', [SiswaController::class, 'export'])->name('siswa.export');
        // API Routes untuk AJAX
        Route::get('/data', [SiswaController::class, 'getData'])->name('siswa.data');
        Route::get('/count', [SiswaController::class, 'getCount'])->name('siswa.getCount');
    });

    /*
    |--------------------------------------------------------------------------
    | Jurusan
    |--------------------------------------------------------------------------
    */
    Route::prefix('jurusan')->group(function () {
        Route::get('/', [JurusanController::class, 'index'])->name('jurusan.index');
        Route::get('/create', [JurusanController::class, 'create'])->name('jurusan.create');
        Route::post('/', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::get('/{jurusan}', [JurusanController::class, 'show'])->name('jurusan.show');
        Route::get('/{jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
        Route::put('/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
        Route::post('/{jurusan}/kuota', [JurusanController::class, 'updateKuota'])->name('jurusan.updateKuota');
        // API Routes untuk AJAX
        Route::get('/data', [JurusanController::class, 'getData'])->name('jurusan.data');
        Route::get('/count', [JurusanController::class, 'getCount'])->name('jurusan.getCount');
    });

    /*
    |--------------------------------------------------------------------------
    | Nilai & Seleksi - PERBAIKAN BESAR DI SINI
    |--------------------------------------------------------------------------
    */
    Route::prefix('nilai')->group(function () {
    // Route seleksi & ranking dulu (HARUS DI ATAS)
    Route::get('/seleksi', [NilaiController::class, 'showSeleksiForm'])->name('nilai.seleksi');
    Route::post('/seleksi/proses', [NilaiController::class, 'prosesSeleksi'])->name('nilai.seleksi.proses');
    Route::get('/seleksi/hasil', [NilaiController::class, 'hasilSeleksi'])->name('nilai.seleksi.hasil');

    Route::get('/ranking', [NilaiController::class, 'showRanking'])->name('nilai.ranking');
    Route::post('/ranking/proses', [NilaiController::class, 'prosesRanking'])->name('nilai.ranking.proses');

    // Legacy routes
    Route::get('/seleksi/proses/legacy', [NilaiController::class, 'prosesSeleksiLegacy'])->name('nilai.prosesSeleksi.legacy');
    Route::get('/ranking/proses/legacy', [NilaiController::class, 'prosesRankingLegacy'])->name('nilai.prosesRanking.legacy');

    // Route untuk manajemen nilai (SETELAH YANG STATIS)
    Route::get('/', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/{siswa}', [NilaiController::class, 'show'])->name('nilai.show');
    Route::get('/{siswa}/edit', [NilaiController::class, 'editNilai'])->name('nilai.edit');
    Route::put('/{siswa}/update', [NilaiController::class, 'updateNilai'])->name('nilai.update');
    Route::post('/{siswa}/prestasi', [NilaiController::class, 'addPrestasi'])->name('nilai.prestasi.add');
    Route::delete('/prestasi/{prestasi}', [NilaiController::class, 'deletePrestasi'])->name('nilai.prestasi.delete');
});


    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/statistik', [LaporanController::class, 'statistik'])->name('laporan.statistik');
        Route::get('/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.exportExcel');
        Route::get('/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Pengumuman
    |--------------------------------------------------------------------------
    */
    Route::prefix('pengumuman')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::post('/', [PengumumanController::class, 'update'])->name('pengumuman.update');
        Route::post('/toggle', [PengumumanController::class, 'toggleStatus'])->name('pengumuman.toggle');
    });

    /*
    |--------------------------------------------------------------------------
    | Pengaturan
    |--------------------------------------------------------------------------
    */
    Route::prefix('pengaturan')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::post('/', [PengaturanController::class, 'update'])->name('pengaturan.update');
        Route::post('/optimasi', [PengaturanController::class, 'optimasi'])->name('pengaturan.optimasi');
        Route::get('/logs', [PengaturanController::class, 'logs'])->name('pengaturan.logs');
        Route::post('/logs/clear', [PengaturanController::class, 'clearLogs'])->name('pengaturan.clearLogs');
        // Route Maintenance
        Route::get('/maintenance', [PengaturanController::class, 'maintenance'])->name('pengaturan.maintenance');
        Route::post('/maintenance', [PengaturanController::class, 'toggleMaintenance'])->name('pengaturan.maintenance.toggle');
    });

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/new', [NotificationController::class, 'getNew'])->name('notifications.getNew');
        Route::get('/recent', [NotificationController::class, 'getRecent'])->name('notifications.getRecent');
        Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.getUnreadCount');
        Route::post('/mark-read/{id}', [NotificationController::class, 'markRead'])->name('notifications.markRead');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
        Route::delete('/delete/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Bantuan
    |--------------------------------------------------------------------------
    */
    Route::prefix('bantuan')->group(function () {
        Route::get('/', [BantuanController::class, 'index'])->name('bantuan');
        Route::get('/dokumentasi', [BantuanController::class, 'dokumentasi'])->name('bantuan.dokumentasi');
        Route::get('/faq', [BantuanController::class, 'faq'])->name('bantuan.faq');
        Route::get('/kontak', [BantuanController::class, 'kontak'])->name('bantuan.kontak');
    });

    /*
    |--------------------------------------------------------------------------
    | Backup
    |--------------------------------------------------------------------------
    */
    Route::prefix('backup')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('backup');
        Route::post('/create', [BackupController::class, 'createBackup'])->name('backup.create');
        Route::get('/download/{filename}', [BackupController::class, 'downloadBackup'])->name('backup.download');
        Route::delete('/delete/{filename}', [BackupController::class, 'deleteBackup'])->name('backup.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | API Routes for AJAX
    |--------------------------------------------------------------------------
    */
    Route::prefix('api')->group(function () {
        Route::get('/stats', function() {
            return response()->json([
                'total_siswa' => \App\Models\Siswa::count(),
                'siswa_pending' => \App\Models\Siswa::where('status', 'Pending')->count(),
                'siswa_diterima' => \App\Models\Siswa::where('status', 'Diterima')->count(),
                'siswa_ditolak' => \App\Models\Siswa::where('status', 'Ditolak')->count(),
                'total_jurusan' => \App\Models\Jurusan::count(),
            ]);
        })->name('api.stats');
    });
});