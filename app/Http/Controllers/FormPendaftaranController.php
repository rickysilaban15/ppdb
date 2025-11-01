<?php
namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\NilaiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class FormPendaftaranController extends Controller
{
    public function showForm()
    {
        try {
            $jurusans = Jurusan::orderBy('kode_jurusan')->get();

            if ($jurusans->isEmpty()) {
                // Auto seed jika belum ada data
                Artisan::call('db:seed', ['--class' => 'JurusanSeeder']);
                $jurusans = Jurusan::orderBy('kode_jurusan')->get();
            }
        } catch (\Exception $e) {
            // Fallback ke dummy data jika terjadi error
            $jurusans = $this->createDummyJurusans();
        }

        return view('public.form-pendaftaran', compact('jurusans'));
    }

    private function createDummyJurusans()
    {
        return collect([
            (object)[
                'id' => 1, 
                'kode_jurusan' => 'TKRO', 
                'nama_jurusan' => 'TKRO', 
                'nama_lengkap' => 'Teknik Kendaraan Ringan Otomotif',
                'bidang_keahlian' => 'Teknik dan Kejuruan Otomotif',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 2, 
                'kode_jurusan' => 'TBSM', 
                'nama_jurusan' => 'TBSM', 
                'nama_lengkap' => 'Teknik dan Bisnis Sepeda Motor',
                'bidang_keahlian' => 'Teknik dan Kejuruan Otomotif',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 3, 
                'kode_jurusan' => 'TSM', 
                'nama_jurusan' => 'TSM', 
                'nama_lengkap' => 'Teknik Sepeda Motor',
                'bidang_keahlian' => 'Teknik dan Kejuruan Otomotif',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 4, 
                'kode_jurusan' => 'TKJ', 
                'nama_jurusan' => 'TKJ', 
                'nama_lengkap' => 'Teknik Komputer dan Jaringan',
                'bidang_keahlian' => 'Teknik Komputer dan Informasi',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 5, 
                'kode_jurusan' => 'RPL', 
                'nama_jurusan' => 'RPL', 
                'nama_lengkap' => 'Rekayasa Perangkat Lunak',
                'bidang_keahlian' => 'Teknik Komputer dan Informasi',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 6, 
                'kode_jurusan' => 'TITL', 
                'nama_jurusan' => 'TITL', 
                'nama_lengkap' => 'Teknik Instalasi Tenaga Listrik',
                'bidang_keahlian' => 'Teknik Ketenagalistrikan',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 7, 
                'kode_jurusan' => 'AKL', 
                'nama_jurusan' => 'AKL', 
                'nama_lengkap' => 'Akuntansi dan Keuangan Lembaga',
                'bidang_keahlian' => 'Bisnis dan Manajemen',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 8, 
                'kode_jurusan' => 'OTKP', 
                'nama_jurusan' => 'OTKP', 
                'nama_lengkap' => 'Otomatisasi dan Tata Kelola Perkantoran',
                'bidang_keahlian' => 'Bisnis dan Manajemen',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 9, 
                'kode_jurusan' => 'PEMASARAN', 
                'nama_jurusan' => 'Pemasaran', 
                'nama_lengkap' => 'Pemasaran',
                'bidang_keahlian' => 'Bisnis dan Manajemen',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 10, 
                'kode_jurusan' => 'ATPH', 
                'nama_jurusan' => 'ATPH', 
                'nama_lengkap' => 'Agribisnis Tanaman Pangan dan Hortikultura',
                'bidang_keahlian' => 'Pertanian dan Perkebunan',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 11, 
                'kode_jurusan' => 'DKV', 
                'nama_jurusan' => 'DKV', 
                'nama_lengkap' => 'Desain Komunikasi Visual',
                'bidang_keahlian' => 'Desain',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 12, 
                'kode_jurusan' => 'DPIB', 
                'nama_jurusan' => 'DPIB', 
                'nama_lengkap' => 'Desain Pemodelan dan Informasi Bangunan',
                'bidang_keahlian' => 'Desain',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 13, 
                'kode_jurusan' => 'TM', 
                'nama_jurusan' => 'Teknik Mesin', 
                'nama_lengkap' => 'Teknik Mesin',
                'bidang_keahlian' => 'Teknik Mesin',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 14, 
                'kode_jurusan' => 'TP', 
                'nama_jurusan' => 'Teknik Pemesinan', 
                'nama_lengkap' => 'Teknik Pemesinan',
                'bidang_keahlian' => 'Teknik Mesin',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 15, 
                'kode_jurusan' => 'MM', 
                'nama_jurusan' => 'Multimedia', 
                'nama_lengkap' => 'Multimedia',
                'bidang_keahlian' => 'Teknologi Informasi dan Komunikasi',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 16, 
                'kode_jurusan' => 'FARMASI', 
                'nama_jurusan' => 'Farmasi', 
                'nama_lengkap' => 'Farmasi',
                'bidang_keahlian' => 'Kesehatan dan Pekerjaan Sosial',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 17, 
                'kode_jurusan' => 'TATA_BOGA', 
                'nama_jurusan' => 'Tata Boga', 
                'nama_lengkap' => 'Tata Boga',
                'bidang_keahlian' => 'Pariwisata',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
            (object)[
                'id' => 18, 
                'kode_jurusan' => 'TATA_BUSANA', 
                'nama_jurusan' => 'Tata Busana', 
                'nama_lengkap' => 'Tata Busana',
                'bidang_keahlian' => 'Kriya',
                'kuota_reguler' => 36,
                'kuota_unggulan' => 12
            ],
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:siswas,nisn',
            'nik' => 'required|string|max:20|unique:siswas,nik',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'agama' => 'required|string|max:20',
            'kewarganegaraan' => 'required|string|max:50',
            'alamat_jalan' => 'required|string|max:500',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'status_tempat_tinggal' => 'required|string|max:50',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'jumlah_saudara' => 'required|integer|min:0',
            'anak_ke' => 'required|integer|min:1',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:100',
            'no_telepon_ayah' => 'required|string|max:15',
            'no_telepon_ibu' => 'required|string|max:15',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:100',
            'no_telepon_wali' => 'nullable|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'alamat_sekolah_asal' => 'required|string|max:500',
            'tahun_lulus' => 'required|string|max:4',
            'rerata_nilai_rapor' => 'required|numeric|min:0|max:100',
            'nilai_akreditasi_sekolah' => 'required|numeric|min:0|max:100',
            'indeks_sekolah_asal' => 'required|numeric|min:0|max:100',
            'jalur_pendaftaran' => 'required|in:zonasi,prestasi,afirmasi,mutasi',
            'pilihan_jurusan_1' => 'required|exists:jurusans,id',
            'pilihan_jurusan_2' => 'required|exists:jurusans,id|different:pilihan_jurusan_1',
            'file_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'file_transkrip_nilai' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'pilihan_jurusan_2.different' => 'Pilihan jurusan 2 harus berbeda dengan pilihan jurusan 1',
            'pilihan_jurusan_1.exists' => 'Pilihan jurusan 1 tidak valid',
            'pilihan_jurusan_2.exists' => 'Pilihan jurusan 2 tidak valid',
            'nisn.unique' => 'NISN sudah terdaftar dalam sistem',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pendaftaran.form')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Generate nomor pendaftaran
            $noPendaftaran = Siswa::generateNoPendaftaran();

            // Hitung skor akhir
            $skorAkhir = ($request->rerata_nilai_rapor * 0.5) +
                         ($request->nilai_akreditasi_sekolah * 0.2) +
                         ($request->indeks_sekolah_asal * 0.3);

            // Handle file uploads
            $filePaths = [];
            $fileFields = ['file_kk', 'file_akta', 'file_ijazah', 'file_pas_foto', 'file_transkrip_nilai'];
            
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    try {
                        $file = $request->file($field);
                        $fileName = time() . '_' . $noPendaftaran . '_' . $field . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('dokumen_siswa', $fileName, 'public');
                        $filePaths[$field] = $path;
                    } catch (\Exception $e) {
                        Log::error("Error uploading {$field}: " . $e->getMessage());
                        // Continue without breaking the process
                    }
                }
            }

            // Create siswa record
            $siswa = Siswa::create([
                'no_pendaftaran' => $noPendaftaran,
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'kewarganegaraan' => $request->kewarganegaraan,
                'alamat_jalan' => $request->alamat_jalan,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten_kota' => $request->kabupaten_kota,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'status_tempat_tinggal' => $request->status_tempat_tinggal,
                'email' => $request->email,
                'no_telepon' => $request->no_telepon,
                'jumlah_saudara' => $request->jumlah_saudara,
                'anak_ke' => $request->anak_ke,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'no_telepon_ayah' => $request->no_telepon_ayah,
                'no_telepon_ibu' => $request->no_telepon_ibu,
                'no_telepon_wali' => $request->no_telepon_wali,
                'asal_sekolah' => $request->asal_sekolah,
                'alamat_sekolah_asal' => $request->alamat_sekolah_asal,
                'tahun_lulus' => $request->tahun_lulus,
                'rerata_nilai_rapor' => $request->rerata_nilai_rapor,
                'nilai_akreditasi_sekolah' => $request->nilai_akreditasi_sekolah,
                'indeks_sekolah_asal' => $request->indeks_sekolah_asal,
                'jalur_pendaftaran' => $request->jalur_pendaftaran,
                'pilihan_jurusan_1' => $request->pilihan_jurusan_1,
                'pilihan_jurusan_2' => $request->pilihan_jurusan_2,
                'skor_akhir' => round($skorAkhir, 2),
                'status_seleksi' => 'pending',
                'file_kk' => $filePaths['file_kk'] ?? null,
                'file_akta' => $filePaths['file_akta'] ?? null,
                'file_ijazah' => $filePaths['file_ijazah'] ?? null,
                'file_pas_foto' => $filePaths['file_pas_foto'] ?? null,
                'file_transkrip_nilai' => $filePaths['file_transkrip_nilai'] ?? null,
            ]);

            // Simpan nilai default
            $this->simpanNilaiDefault($siswa->id, $request->rerata_nilai_rapor);

            return redirect()->route('pendaftaran.form')
                ->with('success', "Pendaftaran berhasil! Nomor pendaftaran Anda: <strong>{$noPendaftaran}</strong>. Silakan simpan nomor ini untuk cek status pendaftaran.");

        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pendaftaran: ' . $e->getMessage());
            
            return redirect()->route('pendaftaran.form')
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.')
                ->withInput();
        }
    }

    private function simpanNilaiDefault($siswaId, $rerataNilai)
    {
        $mataPelajaran = [
            'Pendidikan Agama dan Budi Pekerti',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Bahasa Indonesia',
            'Matematika',
            'Ilmu Pengetahuan Alam',
            'Ilmu Pengetahuan Sosial',
            'Bahasa Inggris',
            'Seni Budaya',
            'Pendidikan Jasmani, Olahraga, dan Kesehatan',
            'Prakarya dan Kewirausahaan',
            'Sejarah Indonesia',
            'Bahasa Daerah'
        ];

        foreach ($mataPelajaran as $mapel) {
            $nilai = max(50, min(100, $rerataNilai + rand(-10, 10)));
            NilaiSiswa::create([
                'siswa_id' => $siswaId,
                'mata_pelajaran' => $mapel,
                'nilai' => $nilai,
                'semester' => 6,
            ]);
        }
    }

    public function checkStatus($no_pendaftaran)
    {
        $siswa = Siswa::where('no_pendaftaran', $no_pendaftaran)->first();

        if (!$siswa) {
            return view('public.status-notfound', [
                'noPendaftaran' => $no_pendaftaran
            ]);
        }

        return view('public.status-pendaftaran', compact('siswa'));
    }

    public function showStatusForm()
    {
        return view('public.cek-status');
    }
}