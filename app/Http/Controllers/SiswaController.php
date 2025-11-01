<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\NilaiSiswa;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    public function index(Request $request)
{
    $query = Siswa::with(['jurusanPilihan1', 'jurusanPilihan2']);
    
    // Filter berdasarkan status_seleksi
    if ($request->has('status') && $request->status != '') {
        $query->where('status_seleksi', $request->status);
    }
    
    // Filter pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('nisn', 'like', "%{$search}%")
              ->orWhere('no_pendaftaran', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }
    
    // Filter jalur pendaftaran
    if ($request->has('jalur') && $request->jalur != '') {
        $query->where('jalur_pendaftaran', $request->jalur);
    }
    
    $siswas = $query->orderBy('created_at', 'desc')->paginate(20);
    
    // STATISTIK - Pastikan menggunakan status_seleksi
    $stats = [
        'total' => Siswa::count(),
        'diterima' => Siswa::where('status_seleksi', 'diterima')->count(),
        'ditolak' => Siswa::where('status_seleksi', 'ditolak')->count(),
        'pending' => Siswa::where('status_seleksi', 'pending')->count()
    ];
    
    // Debug: Log statistik
    Log::info('Siswa Statistics:', $stats);
    
    return view('admin.siswa.index', compact('siswas', 'stats'));
}

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.siswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswas,nisn',
            'nik' => 'required|string|unique:siswas,nik',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'alamat_jalan' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
            'no_telepon' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'no_telepon_ayah' => 'required|string',
            'no_telepon_ibu' => 'required|string',
            'asal_sekolah' => 'required|string',
            'alamat_sekolah_asal' => 'required|string',
            'tahun_lulus' => 'required|integer',
            'jurusan_pilihan_1' => 'required|exists:jurusans,id',
            'jurusan_pilihan_2' => 'required|exists:jurusans,id',
            'jalur_pendaftaran' => 'required|in:zonasi,prestasi,afirmasi,mutasi',
            'rerata_nilai_rapor' => 'required|numeric|min:0|max:100',
            'nilai_akreditasi_sekolah' => 'required|numeric|min:0|max:100',
            'indeks_sekolah_asal' => 'required|numeric|min:0|max:100',
            'foto_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'transkrip_nilai' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Hitung skor akhir
        $skor_akhir = ($validated['rerata_nilai_rapor'] * 0.5) + 
                     ($validated['nilai_akreditasi_sekolah'] * 0.2) + 
                     ($validated['indeks_sekolah_asal'] * 0.3);

        $validated['skor_akhir'] = round($skor_akhir, 2);
        $validated['status_kelulusan'] = 'pending';
        $validated['no_pendaftaran'] = $this->generateNoPendaftaran();

        // Handle file uploads
        if ($request->hasFile('foto_kk')) {
            $validated['foto_kk'] = $request->file('foto_kk')->store('documents', 'public');
        }
        if ($request->hasFile('foto_akta')) {
            $validated['foto_akta'] = $request->file('foto_akta')->store('documents', 'public');
        }
        if ($request->hasFile('foto_ijazah')) {
            $validated['foto_ijazah'] = $request->file('foto_ijazah')->store('documents', 'public');
        }
        if ($request->hasFile('pas_foto')) {
            $validated['pas_foto'] = $request->file('pas_foto')->store('photos', 'public');
        }
        if ($request->hasFile('transkrip_nilai')) {
            $validated['transkrip_nilai'] = $request->file('transkrip_nilai')->store('documents', 'public');
        }

        Siswa::create($validated);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load(['jurusanPilihan1', 'jurusanPilihan2', 'jurusanDiterima', 'nilaiSiswa', 'prestasi']);
        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $jurusans = Jurusan::all();
        return view('admin.siswa.edit', compact('siswa', 'jurusans'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswas,nisn,' . $siswa->id,
            'nik' => 'required|string|unique:siswas,nik,' . $siswa->id,
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'alamat_jalan' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
            'no_telepon' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'no_telepon_ayah' => 'required|string',
            'no_telepon_ibu' => 'required|string',
            'asal_sekolah' => 'required|string',
            'alamat_sekolah_asal' => 'required|string',
            'tahun_lulus' => 'required|integer',
            'jurusan_pilihan_1' => 'required|exists:jurusans,id',
            'jurusan_pilihan_2' => 'required|exists:jurusans,id',
            'jalur_pendaftaran' => 'required|in:zonasi,prestasi,afirmasi,mutasi',
            'rerata_nilai_rapor' => 'required|numeric|min:0|max:100',
            'nilai_akreditasi_sekolah' => 'required|numeric|min:0|max:100',
            'indeks_sekolah_asal' => 'required|numeric|min:0|max:100',
            'status_kelulusan' => 'required|in:lulus,tidak_lulus,pending',
            'jurusan_diterima' => 'nullable|exists:jurusans,id',
            'kelas_unggulan' => 'nullable|boolean',
            'ranking' => 'nullable|integer',
            'foto_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'transkrip_nilai' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Hitung ulang skor akhir jika nilai berubah
        if ($request->has(['rerata_nilai_rapor', 'nilai_akreditasi_sekolah', 'indeks_sekolah_asal'])) {
            $skor_akhir = ($validated['rerata_nilai_rapor'] * 0.5) + 
                         ($validated['nilai_akreditasi_sekolah'] * 0.2) + 
                         ($validated['indeks_sekolah_asal'] * 0.3);
            $validated['skor_akhir'] = round($skor_akhir, 2);
        }

        // Handle file uploads
        if ($request->hasFile('foto_kk')) {
            // Delete old file
            if ($siswa->foto_kk) Storage::disk('public')->delete($siswa->foto_kk);
            $validated['foto_kk'] = $request->file('foto_kk')->store('documents', 'public');
        }
        if ($request->hasFile('foto_akta')) {
            if ($siswa->foto_akta) Storage::disk('public')->delete($siswa->foto_akta);
            $validated['foto_akta'] = $request->file('foto_akta')->store('documents', 'public');
        }
        if ($request->hasFile('foto_ijazah')) {
            if ($siswa->foto_ijazah) Storage::disk('public')->delete($siswa->foto_ijazah);
            $validated['foto_ijazah'] = $request->file('foto_ijazah')->store('documents', 'public');
        }
        if ($request->hasFile('pas_foto')) {
            if ($siswa->pas_foto) Storage::disk('public')->delete($siswa->pas_foto);
            $validated['pas_foto'] = $request->file('pas_foto')->store('photos', 'public');
        }
        if ($request->hasFile('transkrip_nilai')) {
            if ($siswa->transkrip_nilai) Storage::disk('public')->delete($siswa->transkrip_nilai);
            $validated['transkrip_nilai'] = $request->file('transkrip_nilai')->store('documents', 'public');
        }

        // Convert boolean values
        $validated['kelas_unggulan'] = $request->has('kelas_unggulan') ? 1 : 0;

        $siswa->update($validated);

    return redirect()->route('admin.siswa.index')
        ->with('success', 'Data siswa berhasil diperbarui.');
}

    public function destroy(Siswa $siswa)
    {
        // Hapus file yang diupload
        if ($siswa->foto_kk) Storage::disk('public')->delete($siswa->foto_kk);
        if ($siswa->foto_akta) Storage::disk('public')->delete($siswa->foto_akta);
        if ($siswa->foto_ijazah) Storage::disk('public')->delete($siswa->foto_ijazah);
        if ($siswa->pas_foto) Storage::disk('public')->delete($siswa->pas_foto);
        if ($siswa->transkrip_nilai) Storage::disk('public')->delete($siswa->transkrip_nilai);

        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function updateStatus(Request $request, Siswa $siswa)
    {
        $request->validate([
        'status_seleksi' => 'required|in:diterima,ditolak,pending',
            'jurusan_diterima' => 'nullable|exists:jurusans,id',
            'kelas_unggulan' => 'nullable|boolean',
        ]);

        $updateData = $request->only(['status_kelulusan', 'jurusan_diterima']);
        $updateData['kelas_unggulan'] = $request->has('kelas_unggulan') ? 1 : 0;

        $siswa->update($updateData);

        return back()->with('success', 'Status siswa berhasil diperbarui.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,lulus,tidak_lulus,pending',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:siswas,id'
        ]);

        $action = $request->action;
        $ids = $request->selected_ids;

        if ($action === 'delete') {
            // Delete files and records
            $siswas = Siswa::whereIn('id', $ids)->get();
            foreach ($siswas as $siswa) {
                if ($siswa->foto_kk) Storage::disk('public')->delete($siswa->foto_kk);
                if ($siswa->foto_akta) Storage::disk('public')->delete($siswa->foto_akta);
                if ($siswa->foto_ijazah) Storage::disk('public')->delete($siswa->foto_ijazah);
                if ($siswa->pas_foto) Storage::disk('public')->delete($siswa->pas_foto);
                if ($siswa->transkrip_nilai) Storage::disk('public')->delete($siswa->transkrip_nilai);
            }
            Siswa::whereIn('id', $ids)->delete();
            return back()->with('success', 'Siswa terpilih berhasil dihapus.');
        } elseif (in_array($action, ['lulus', 'tidak_lulus', 'pending'])) {
            Siswa::whereIn('id', $ids)->update(['status_kelulusan' => $action]);
            return back()->with('success', 'Status siswa berhasil diperbarui.');
        }

        return back()->with('error', 'Aksi tidak valid.');
    }

    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:excel,pdf,csv'
        ]);

        $format = $request->format;
        
        switch ($format) {
            case 'excel':
                return Excel::download(new SiswaExport, 'data-siswa-'.date('Y-m-d').'.xlsx');
            case 'pdf':
                return $this->exportPdf();
            case 'csv':
                return $this->exportCsv();
            default:
                return redirect()->back()->with('error', 'Format export tidak valid.');
        }
    }
    
    private function exportPdf()
    {
        $siswas = Siswa::with(['jurusanPilihan1', 'jurusanPilihan2', 'jurusanDiterima'])->get();
        $pdf = PDF::loadView('admin.siswa.export-pdf', compact('siswas'));
        return $pdf->download('data-siswa-'.date('Y-m-d').'.pdf');
    }
    
    private function exportCsv()
    {
        $siswas = Siswa::with(['jurusanPilihan1', 'jurusanPilihan2', 'jurusanDiterima'])->get();
        
        $filename = 'data-siswa-'.date('Y-m-d').'.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function() use ($siswas) {
            $handle = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($handle, "\xEF\xBB\xBF");
            
            // Add CSV headers
            fputcsv($handle, [
                'No Pendaftaran', 'Nama Lengkap', 'NISN', 'NIK', 'Tempat Lahir', 'Tanggal Lahir',
                'Jenis Kelamin', 'Agama', 'Alamat', 'Kelurahan', 'Kecamatan', 'Kabupaten/Kota',
                'Provinsi', 'Kode Pos', 'No Telepon', 'Nama Ayah', 'Nama Ibu', 'Pekerjaan Ayah',
                'Pekerjaan Ibu', 'No Telepon Ayah', 'No Telepon Ibu', 'Asal Sekolah', 'Alamat Sekolah',
                'Tahun Lulus', 'Jurusan Pilihan 1', 'Jurusan Pilihan 2', 'Jalur Pendaftaran',
                'Rerata Nilai Rapor', 'Nilai Akreditasi Sekolah', 'Indeks Sekolah Asal',
                'Skor Akhir', 'Status Kelulusan', 'Jurusan Diterima', 'Kelas Unggulan'
            ]);
            
            foreach ($siswas as $siswa) {
                fputcsv($handle, [
                    $siswa->no_pendaftaran ?? '-',
                    $siswa->nama_lengkap,
                    $siswa->nisn,
                    $siswa->nik,
                    $siswa->tempat_lahir,
                    $siswa->tanggal_lahir,
                    $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    $siswa->agama,
                    $siswa->alamat_jalan,
                    $siswa->kelurahan,
                    $siswa->kecamatan,
                    $siswa->kabupaten_kota,
                    $siswa->provinsi,
                    $siswa->kode_pos,
                    $siswa->no_telepon,
                    $siswa->nama_ayah,
                    $siswa->nama_ibu,
                    $siswa->pekerjaan_ayah,
                    $siswa->pekerjaan_ibu,
                    $siswa->no_telepon_ayah,
                    $siswa->no_telepon_ibu,
                    $siswa->asal_sekolah,
                    $siswa->alamat_sekolah_asal,
                    $siswa->tahun_lulus,
                    $siswa->jurusanPilihan1->nama_jurusan ?? '-',
                    $siswa->jurusanPilihan2->nama_jurusan ?? '-',
                    ucfirst($siswa->jalur_pendaftaran),
                    $siswa->rerata_nilai_rapor,
                    $siswa->nilai_akreditasi_sekolah,
                    $siswa->indeks_sekolah_asal,
                    $siswa->skor_akhir,
                    $this->getStatusText($siswa->status_kelulusan),
                    $siswa->jurusanDiterima->nama_jurusan ?? '-',
                    $siswa->kelas_unggulan ? 'Ya' : 'Tidak'
                ]);
            }
            
            fclose($handle);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    private function generateNoPendaftaran()
    {
        $year = date('Y');
        $lastSiswa = Siswa::whereYear('created_at', $year)->latest()->first();
        
        if ($lastSiswa && $lastSiswa->no_pendaftaran) {
            $lastNumber = intval(substr($lastSiswa->no_pendaftaran, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return 'PPDB' . $year . $newNumber;
    }

    private function getStatusText($status)
    {
        $statuses = [
            'lulus' => 'Lulus',
            'tidak_lulus' => 'Tidak Lulus',
            'pending' => 'Menunggu'
        ];
        
        return $statuses[$status] ?? $status;
    }
}