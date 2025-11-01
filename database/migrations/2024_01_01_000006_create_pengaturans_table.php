<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('key_name')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('pengaturan')->insert([
            ['key_name' => 'nama_sekolah', 'value' => 'SMK N 2 Siatas Barita', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'alamat_sekolah', 'value' => 'Jl. Pendidikan No. 123, Siatas Barita', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'telepon_sekolah', 'value' => '(0621) 12345', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'email_sekolah', 'value' => 'info@smkn2siatasbarita.sch.id', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'tahun_ajaran', 'value' => '2024/2025', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'tanggal_mulai', 'value' => date('Y-m-d'), 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'tanggal_selesai', 'value' => date('Y-m-d', strtotime('+30 days')), 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'status_pendaftaran', 'value' => 'buka', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'min_nilai', 'value' => '75', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'max_mapel_rendah', 'value' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'smtp_host', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'smtp_port', 'value' => '587', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'smtp_username', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ['key_name' => 'smtp_password', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('pengaturan');
    }
};