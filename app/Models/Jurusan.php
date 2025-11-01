<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan', 
        'nama_lengkap',
        'bidang_keahlian',
        'kuota_reguler',
        'kuota_unggulan',
        'kuota_terisi_reguler',
        'kuota_terisi_unggulan',
        'deskripsi'
    ];

    protected $casts = [
        'kuota_reguler' => 'integer',
        'kuota_unggulan' => 'integer',
        'kuota_terisi_reguler' => 'integer',
        'kuota_terisi_unggulan' => 'integer',
    ];

    // PERBAIKI: Gunakan nama kolom yang sesuai dengan database
    public function siswaPilihan1()
    {
        return $this->hasMany(Siswa::class, 'pilihan_jurusan_1'); // Ganti 'jurusan_pilihan_1' menjadi 'pilihan_jurusan_1'
    }

    public function siswaPilihan2()
    {
        return $this->hasMany(Siswa::class, 'pilihan_jurusan_2'); // Ganti 'jurusan_pilihan_2' menjadi 'pilihan_jurusan_2'
    }

    public function siswaDiterima()
    {
        return $this->hasMany(Siswa::class, 'jurusan_diterima');
    }

    // Accessor untuk kuota tersisa
    public function getKuotaTersisaRegulerAttribute()
    {
        return $this->kuota_reguler - $this->kuota_terisi_reguler;
    }

    public function getKuotaTersisaUnggulanAttribute()
    {
        return $this->kuota_unggulan - $this->kuota_terisi_unggulan;
    }

    // Tambahkan accessor untuk menghitung peminat
    public function getTotalPeminatAttribute()
    {
        return $this->siswaPilihan1()->count() + $this->siswaPilihan2()->count();
    }
}