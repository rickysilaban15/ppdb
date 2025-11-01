<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('jurusans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jurusan')->unique();
            $table->string('nama_jurusan');
            $table->string('nama_lengkap');
            $table->string('bidang_keahlian');
            $table->integer('kuota_reguler')->default(36);
            $table->integer('kuota_unggulan')->default(12);
            $table->integer('kuota_terisi_reguler')->default(0);
            $table->integer('kuota_terisi_unggulan')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('jurusans');
    }
};