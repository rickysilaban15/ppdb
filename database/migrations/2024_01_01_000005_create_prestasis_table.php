<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->string('jenis_prestasi');
            $table->string('nama_prestasi');
            $table->string('tingkat');
            $table->integer('tahun');
            $table->integer('poin_prestasi')->default(0);
            $table->string('file_sertifikat')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('prestasis');
    }
};