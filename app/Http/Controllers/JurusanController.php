<?php
namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk mendapatkan data jurusan dengan count peminat dan diterima
        $query = Jurusan::withCount([
            'siswaPilihan1 as peminat_1',
            'siswaPilihan2 as peminat_2',
            'siswaDiterima as diterima'
        ]);
        
        // Filter berdasarkan pencarian jika ada
        if ($request->has('search')) {
            $query->where('nama_jurusan', 'like', "%{$request->search}%")
                  ->orWhere('kode_jurusan', 'like', "%{$request->search}%")
                  ->orWhere('bidang_keahlian', 'like', "%{$request->search}%");
        }
        
        $jurusans = $query->paginate(10);
        
        // Hitung total kuota dan terisi
        $totalKuota = $jurusans->sum('kuota_reguler') + $jurusans->sum('kuota_unggulan');
        
        // Hitung total terisi dari semua jurusan
        $totalTerisi = 0;
        foreach ($jurusans as $jurusan) {
            $totalTerisi += ($jurusan->peminat_1 + $jurusan->peminat_2);
        }
        
        // Data statistik untuk ditampilkan di view
        $stats = [
            'total_jurusan' => Jurusan::count(),
            'total_pendaftar' => Siswa::count(),
            'total_diterima' => Siswa::whereNotNull('jurusan_diterima')->count(),
            'total_peminat_1' => Siswa::whereNotNull('pilihan_jurusan_1')->count(),
            'total_peminat_2' => Siswa::whereNotNull('pilihan_jurusan_2')->count(),
        ];

        return view('admin.jurusan.index', compact('jurusans', 'totalKuota', 'totalTerisi', 'stats'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jurusan' => 'required|string|unique:jurusans,kode_jurusan',
            'nama_jurusan' => 'required|string|max:100',
            'nama_lengkap' => 'required|string|max:255',
            'bidang_keahlian' => 'required|string|max:255',
            'kuota_reguler' => 'required|integer|min:0',
            'kuota_unggulan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Jurusan::create($validated);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show(Jurusan $jurusan)
    {
        // Load jurusan dengan counts
        $jurusan->loadCount([
            'siswaPilihan1 as peminat_1',
            'siswaPilihan2 as peminat_2',
            'siswaDiterima as diterima'
        ]);
        
        return view('admin.jurusan.show', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode_jurusan' => 'required|string|unique:jurusans,kode_jurusan,' . $jurusan->id,
            'nama_jurusan' => 'required|string|max:100',
            'nama_lengkap' => 'required|string|max:255',
            'bidang_keahlian' => 'required|string|max:255',
            'kuota_reguler' => 'required|integer|min:0',
            'kuota_unggulan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $jurusan->update($validated);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        // Cek jika ada siswa yang terkait
        if ($jurusan->siswaPilihan1()->count() > 0 || 
            $jurusan->siswaPilihan2()->count() > 0 || 
            $jurusan->siswaDiterima()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus jurusan yang sudah memiliki siswa terdaftar.');
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }

    public function updateKuota(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kuota_reguler' => 'required|integer|min:0',
            'kuota_unggulan' => 'required|integer|min:0',
        ]);

        $jurusan->update($request->only(['kuota_reguler', 'kuota_unggulan']));

        return back()->with('success', 'Kuota jurusan berhasil diperbarui.');
    }
}