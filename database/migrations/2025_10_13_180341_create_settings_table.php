<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('nama_sekolah')->default('SMK N 2 Siatas Barita');
    $table->string('tahun_ajaran')->default(date('Y').'/'.(date('Y')+1));
    $table->string('email_ppdb')->default('ppdb@smkn2siatasbarita.sch.id');
    $table->string('no_telp_ppdb')->default('0812-3456-7890');
    $table->text('alamat_sekolah')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
