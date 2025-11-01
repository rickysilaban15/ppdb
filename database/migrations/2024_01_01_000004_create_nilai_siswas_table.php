<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('nilai_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->string('mata_pelajaran');
            $table->decimal('nilai', 5, 2);
            $table->integer('semester');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('nilai_siswas');
    }
};