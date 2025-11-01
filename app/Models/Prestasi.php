<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'jenis_prestasi',
        'nama_prestasi',
        'tingkat',
        'tahun',
        'poin_prestasi',
        'file_sertifikat'
    ];

    public static $jenisPrestasiOptions = [
        'akademik' => 'Akademik',
        'non-akademik' => 'Non-Akademik'
    ];

    public static $tingkatPrestasiOptions = [
        'sekolah' => 'Sekolah',
        'kecamatan' => 'Kecamatan',
        'kabupaten' => 'Kabupaten',
        'provinsi' => 'Provinsi',
        'nasional' => 'Nasional',
        'internasional' => 'Internasional'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function getJenisPrestasiFormattedAttribute()
    {
        return self::$jenisPrestasiOptions[$this->jenis_prestasi] ?? $this->jenis_prestasi;
    }

    public function getTingkatPrestasiFormattedAttribute()
    {
        return self::$tingkatPrestasiOptions[$this->tingkat] ?? $this->tingkat;
    }
}