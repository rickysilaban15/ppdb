@extends('layouts.app-tailwind')

@section('title', 'Persyaratan Pendaftaran - PPDB SMK N 2 Siatas Barita')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-primary-dark text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-white/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Persyaratan Pendaftaran
            </h1>
            <p class="text-xl text-white/90">
                Pastikan Anda memenuhi semua persyaratan sebelum melakukan pendaftaran.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Persyaratan Umum</h3>
                
                <!-- Persyaratan Administrasi -->
                <div class="mb-8">
                    <h5 class="text-primary font-semibold text-lg mb-4 flex items-center gap-2">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                        A. Persyaratan Administrasi
                    </h5>
                    <ul class="space-y-3 ml-6">
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Foto copy ijazah SMP/sederajat (2 lembar) yang telah dilegalisir</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Foto copy SKHUN (2 lembar) yang telah dilegalisir</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Foto copy akta kelahiran (2 lembar)</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Foto copy Kartu Keluarga (2 lembar)</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Foto copy KTP orang tua (2 lembar)</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Pas foto 3x4 (4 lembar) background merah</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Surat keterangan sehat dari dokter</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Surat pernyataan bermaterai dari orang tua</span>
                        </li>
                    </ul>
                </div>

                <!-- Persyaratan Akademik -->
                <div class="mb-8">
                    <h5 class="text-primary font-semibold text-lg mb-4 flex items-center gap-2">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                        B. Persyaratan Akademik
                    </h5>
                    <ul class="space-y-3 ml-6">
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Usia maksimal 21 tahun pada saat pendaftaran</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Lulus SMP/sederajat maksimal 3 tahun terakhir</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Nilai rata-rata ijazah minimal 7.0</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Nilai Matematika dan IPA minimal 7.0 (untuk jurusan teknik)</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Mengikuti tes seleksi masuk yang diselenggarakan sekolah</span>
                        </li>
                    </ul>
                </div>

                <!-- Persyaratan Khusus -->
                <div class="mb-8">
                    <h5 class="text-primary font-semibold text-lg mb-4 flex items-center gap-2">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                        C. Persyaratan Khusus
                    </h5>
                    <ul class="space-y-3 ml-6">
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Bersedia mengikuti program magang industri di kelas XII</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Bersedia mematuhi peraturan dan tata tertib sekolah</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Bersedia mengikuti kegiatan ekstrakurikuler wajib</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Tidak buta warna (khusus jurusan teknik)</span>
                        </li>
                    </ul>
                </div>

                <!-- Dokumen Tambahan -->
                <div class="mb-8">
                    <h5 class="text-primary font-semibold text-lg mb-4 flex items-center gap-2">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                        D. Dokumen Tambahan (Jika Ada)
                    </h5>
                    <ul class="space-y-3 ml-6">
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Surat keterangan tidak mampu dari kelurahan/desa</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Foto copy prestasi akademik/non-akademik</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Surat rekomendasi dari SMP asal</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                            <span>Portofolio karya (untuk jurusan seni dan desain)</span>
                        </li>
                    </ul>
                </div>

                <!-- Alert Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 text-xl mt-1 flex-shrink-0"></i>
                        <div>
                            <h6 class="font-semibold text-blue-800 mb-2">Informasi Penting</h6>
                            <p class="text-blue-700 leading-relaxed">
                                Semua dokumen harus diserahkan dalam bentuk fotocopy yang telah dilegalisir. 
                                Pendaftaran dapat dilakukan secara online melalui website ini atau langsung ke sekolah. 
                                Dokumen asli akan diperiksa pada saat daftar ulang.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Alert Warning -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mt-1 flex-shrink-0"></i>
                        <div>
                            <h6 class="font-semibold text-yellow-800 mb-2">Perhatian</h6>
                            <p class="text-yellow-700 leading-relaxed">
                                Pendaftar yang terbukti memalsukan dokumen akan dikenakan sanksi berupa pembatalan penerimaan tanpa pemberitahuan lebih lanjut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection