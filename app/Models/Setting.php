<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'tahun_ajaran',
        'email_ppdb',
        'no_telp_ppdb',
        'alamat_sekolah',
    ];
}
