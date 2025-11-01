<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            
            // Data Identitas
            $table->string('nama_lengkap');
            $table->string('nisn')->nullable();
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('kewarganegaraan')->default('Indonesia');
            
            // Data Demografi
            $table->text('alamat_jalan');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('status_tempat_tinggal')->nullable();
            
            // Data Kontak
            $table->string('email')->nullable();
            $table->string('no_telepon');
            
            // Data Keluarga
            $table->integer('jumlah_saudara')->default(0);
            $table->integer('anak_ke')->nullable();
            
            // Data Orang Tua/Wali
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('pekerjaan_wali')->nullable();
            $table->string('no_telepon_ayah');
            $table->string('no_telepon_ibu');
            $table->string('no_telepon_wali')->nullable();
            
            // Data Akademik
            $table->string('asal_sekolah');
            $table->text('alamat_sekolah_asal');
            $table->string('tahun_lulus');
            $table->decimal('rerata_nilai_rapor', 5, 2)->nullable();
            $table->decimal('nilai_akreditasi_sekolah', 5, 2)->nullable();
            $table->decimal('indeks_sekolah_asal', 5, 2)->nullable();
            
            // Jalur Pendaftaran
            $table->string('jalur_pendaftaran');
            
            // Pilihan Jurusan
            $table->foreignId('pilihan_jurusan_1')->constrained('jurusans');
            $table->foreignId('pilihan_jurusan_2')->constrained('jurusans');
            
            // Status dan Hasil Seleksi
            $table->decimal('skor_akhir', 5, 2)->nullable();
            $table->string('status_seleksi')->default('pending');
            $table->foreignId('jurusan_diterima')->nullable()->constrained('jurusans');
            $table->boolean('kelas_unggulan')->default(false);
            $table->integer('ranking')->nullable();
            $table->boolean('penerima_hadiah')->default(false);
            
            // File Uploads
            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_pas_foto')->nullable();
            $table->string('file_foto_ijazah')->nullable();
            $table->string('file_transkrip_nilai')->nullable();
            $table->string('file_dokumen_tambahan_1')->nullable();
            $table->string('file_dokumen_tambahan_2')->nullable();
            $table->string('file_dokumen_tambahan_3')->nullable();
            
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('siswas');
    }
};