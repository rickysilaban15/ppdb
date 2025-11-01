<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_pendaftaran', 'nama_lengkap', 'nisn', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'agama', 'kewarganegaraan', 'alamat_jalan', 'rt', 'rw',
        'kelurahan', 'kecamatan', 'kabupaten_kota', 'provinsi', 'kode_pos', 'status_tempat_tinggal',
        'email', 'no_telepon', 'jumlah_saudara', 'anak_ke', 'nama_ayah', 'nama_ibu', 'nama_wali',
        'pekerjaan_ayah', 'pekerjaan_ibu', 'pekerjaan_wali', 'no_telepon_ayah', 'no_telepon_ibu',
        'no_telepon_wali', 'asal_sekolah', 'alamat_sekolah_asal', 'tahun_lulus', 'rerata_nilai_rapor',
        'nilai_akreditasi_sekolah', 'indeks_sekolah_asal', 'jalur_pendaftaran', 'pilihan_jurusan_1',
        'pilihan_jurusan_2', 'skor_akhir', 'status_seleksi', 'jurusan_diterima', 'kelas_unggulan',
        'ranking', 'penerima_hadiah', 'file_kk', 'file_akta', 'file_ijazah', 'file_pas_foto',
        'file_foto_ijazah', 'file_transkrip_nilai', 'file_dokumen_tambahan_1', 'file_dokumen_tambahan_2',
        'file_dokumen_tambahan_3'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'kelas_unggulan' => 'boolean',
        'penerima_hadiah' => 'boolean',
    ];

    // Relasi
    public function jurusanPilihan1()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_jurusan_1');
    }

    public function jurusanPilihan2()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_jurusan_2');
    }

    public function jurusanDiterima()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_diterima');
    }

    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    // Generate nomor pendaftaran
    public static function generateNoPendaftaran()
{
    $year = date('Y');
    $lastSiswa = self::where('no_pendaftaran', 'like', "PPDB{$year}%")->latest()->first();
    
    if ($lastSiswa) {
        $lastNumber = intval(substr($lastSiswa->no_pendaftaran, -4));
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $newNumber = '0001';
    }
    
    return "PPDB{$year}{$newNumber}";
}

    // Hitung skor akhir
    public function hitungSkorAkhir()
    {
        $skor = ($this->rerata_nilai_rapor * 0.5) + 
                ($this->nilai_akreditasi_sekolah * 0.2) + 
                ($this->indeks_sekolah_asal * 0.3);
        
        $this->skor_akhir = round($skor, 2);
        return $this->skor_akhir;
    }

    // Tentukan kelulusan
    public function tentukanKelulusan()
    {
        // Cek rata-rata nilai minimal
        if ($this->rerata_nilai_rapor < 75) {
            $this->status_seleksi = 'tidak_lulus';
            $this->save();
            return false;
        }

        // Cek jumlah mata pelajaran di bawah 60
        $mataPelajaranRendah = $this->nilaiSiswa()
            ->where('nilai', '<', 60)
            ->count();

        if ($mataPelajaranRendah > 3) {
            $this->status_seleksi = 'tidak_lulus';
            $this->save();
            return false;
        }

        $this->status_seleksi = 'lulus';
        $this->save();
        return true;
    }

    public function jurusan()
{
    return $this->belongsTo(Jurusan::class, 'jurusan_diterima');
}

}