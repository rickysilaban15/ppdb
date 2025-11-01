<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Halaman utama laporan
     */
    public function index()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'lulus' => Siswa::where('status_kelulusan', 'lulus')->count(),
            'tidak_lulus' => Siswa::where('status_kelulusan', 'tidak_lulus')->count(),
            'pending' => Siswa::where('status_kelulusan', 'pending')->count(),
            
            'zonasi' => Siswa::where('jalur_pendaftaran', 'zonasi')->count(),
            'prestasi' => Siswa::where('jalur_pendaftaran', 'prestasi')->count(),
            'afirmasi' => Siswa::where('jalur_pendaftaran', 'afirmasi')->count(),
            'mutasi' => Siswa::where('jalur_pendaftaran', 'mutasi')->count(),
        ];

        $jurusans = Jurusan::withCount([
            'siswaPilihan1 as peminat_1',
            'siswaPilihan2 as peminat_2',
            'siswaDiterima as diterima'
        ])->get();

        return view('admin.laporan.index', compact('stats', 'jurusans'));
    }

    /**
     * Export laporan ke Excel
     */
    public function exportExcel(Request $request)
    {
        $type = $request->type ?? 'all';
        $filename = 'laporan_ppdb_' . $type . '_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new LaporanExport($type), $filename);
    }

    /**
     * Export laporan ke PDF
     */
    public function exportPdf(Request $request)
    {
        $type = $request->type ?? 'all';

        switch ($type) {

            case 'siswa':
                $siswas = Siswa::with(['jurusanPilihan1', 'jurusanPilihan2'])->get();
                $jurusans = Jurusan::all();
                $view = 'admin.laporan.pdf.siswa';
                $filename = 'laporan_siswa.pdf';
                $pdf = Pdf::loadView($view, compact('siswas', 'jurusans'));
                break;

            case 'kelulusan':
                $lulus = Siswa::where('status_kelulusan', 'lulus')->get();
                $tidak_lulus = Siswa::where('status_kelulusan', 'tidak_lulus')->get();
                $view = 'admin.laporan.pdf.kelulusan';
                $filename = 'laporan_kelulusan.pdf';
                $pdf = Pdf::loadView($view, compact('lulus', 'tidak_lulus'));
                break;

            case 'jurusan':
                $jurusans = Jurusan::withCount([
                    'siswaPilihan1 as peminat_1',
                    'siswaPilihan2 as peminat_2',
                    'siswaDiterima as diterima'
                ])->get();
                $view = 'admin.laporan.pdf.jurusan';
                $filename = 'laporan_jurusan.pdf';
                $pdf = Pdf::loadView($view, compact('jurusans'));
                break;

            default:
                $siswas = Siswa::with(['jurusanPilihan1', 'jurusanPilihan2'])->get();
                $jurusans = Jurusan::withCount(['siswaPilihan1', 'siswaPilihan2', 'siswaDiterima'])->get();
                $stats = [
                    'total' => Siswa::count(),
                    'lulus' => Siswa::where('status_kelulusan', 'lulus')->count(),
                    'tidak_lulus' => Siswa::where('status_kelulusan', 'tidak_lulus')->count(),
                ];
                $view = 'admin.laporan.pdf.all';
                $filename = 'laporan_ppdb_complete.pdf';
                $pdf = Pdf::loadView($view, compact('siswas', 'jurusans', 'stats'));
                break;
        }

        return $pdf->download($filename);
    }

    /**
     * Statistik data siswa
     */
    public function statistik()
    {
        $statistikJalur = [
            'labels' => ['Zonasi', 'Prestasi', 'Afirmasi', 'Mutasi'],
            'data' => [
                Siswa::where('jalur_pendaftaran', 'zonasi')->count(),
                Siswa::where('jalur_pendaftaran', 'prestasi')->count(),
                Siswa::where('jalur_pendaftaran', 'afirmasi')->count(),
                Siswa::where('jalur_pendaftaran', 'mutasi')->count(),
            ]
        ];

        $statistikKelulusan = [
            'labels' => ['Lulus', 'Tidak Lulus', 'Pending'],
            'data' => [
                Siswa::where('status_kelulusan', 'lulus')->count(),
                Siswa::where('status_kelulusan', 'tidak_lulus')->count(),
                Siswa::where('status_kelulusan', 'pending')->count(),
            ]
        ];

        $statistikJurusan = Jurusan::withCount(['siswaPilihan1 as peminat'])->get();

        return view('admin.laporan.statistik', compact('statistikJalur', 'statistikKelulusan', 'statistikJurusan'));
    }
}
