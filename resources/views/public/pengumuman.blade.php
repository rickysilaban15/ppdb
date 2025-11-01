@extends('layouts.app-tailwind')

@section('title', 'Pengumuman - PPDB SMK N 2 Siatas Barita')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-primary-dark text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-white/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Pengumuman
            </h1>
            <p class="text-xl text-white/90">
                Informasi terbaru seputar hasil seleksi PPDB SMK N 2 Siatas Barita.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            @if(!$pengumumanAktif)
            <!-- Pengumuman Tutup -->
            <div class="bg-white border border-yellow-400 rounded-2xl shadow-lg">
                <div class="bg-yellow-400 text-gray-900 px-6 py-4 rounded-t-2xl">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-bold mb-0 flex items-center">
                            <i class="fas fa-clock mr-2"></i>Pengumuman Belum Tersedia
                        </h4>
                        <span class="bg-gray-900 text-white text-xs px-3 py-1 rounded-full font-medium">Tutup</span>
                    </div>
                </div>
                <div class="p-8 text-center">
                    <div class="mb-6">
                        <i class="fas fa-calendar-times text-6xl text-yellow-500 mb-4"></i>
                        <h3 class="text-2xl font-bold text-yellow-600">Pengumuman Sedang Tidak Aktif</h3>
                    </div>
                    <p class="text-lg text-gray-700 mb-6">
                        Pengumuman hasil seleksi PPDB akan diumumkan sesuai jadwal yang telah ditentukan.
                        Silakan pantau terus website ini untuk informasi terbaru.
                    </p>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                        <h5 class="font-semibold text-blue-800 mb-2 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Jadwal Pengumuman
                        </h5>
                        <p class="text-blue-700 mb-1"><strong>Perkiraan Pengumuman:</strong> 15 Juli 2024</p>
                        <p class="text-blue-700"><strong>Waktu:</strong> 10:00 WIB</p>
                    </div>
                    <a href="{{ route('jadwal') }}" class="inline-flex items-center bg-primary text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 hover:bg-primary-dark hover:-translate-y-1">
                        <i class="fas fa-calendar-alt mr-2"></i>Lihat Jadwal Lengkap
                    </a>
                </div>
            </div>
            @else
            <!-- Pengumuman Aktif -->
            <div class="bg-white border border-green-500 rounded-2xl shadow-lg">
                <div class="bg-green-500 text-white px-6 py-4 rounded-t-2xl">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-bold mb-0 flex items-center">
                            <i class="fas fa-bullhorn mr-2"></i>{{ $pengumumanJudul }}
                        </h4>
                        <span class="bg-white text-green-600 text-xs px-3 py-1 rounded-full font-medium">Aktif</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-check text-2xl text-green-600 mr-3"></i>
                            <div>
                                <h5 class="font-semibold text-green-800 mb-1">Pengumuman Resmi</h5>
                                <p class="text-green-700">
                                    <strong>Tanggal:</strong> {{ $pengumumanTanggal }} | 
                                    <strong>Waktu:</strong> {{ $pengumumanWaktu }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 mb-6">
                        {!! nl2br(e($pengumumanKonten)) !!}
                    </div>

                    <!-- Daftar Siswa Diterima -->
                    <div class="mt-8">
                        <h5 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-list-ol mr-2"></i>Daftar Siswa yang Diterima
                        </h5>
                        <div class="overflow-x-auto">
                            <table class="w-full bg-white rounded-lg overflow-hidden">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left">No</th>
                                        <th class="px-4 py-3 text-left">No. Pendaftaran</th>
                                        <th class="px-4 py-3 text-left">Nama Siswa</th>
                                        <th class="px-4 py-3 text-left">Jurusan</th>
                                        <th class="px-4 py-3 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center">
                                            <div class="text-gray-500 flex flex-col items-center">
                                                <i class="fas fa-info-circle text-2xl mb-2"></i>
                                                <p>Daftar lengkap siswa yang diterima akan tersedia pada saat pengumuman resmi.</p>
                                                <p>Silakan cek status pendaftaran Anda melalui menu "Cek Status".</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('pendaftaran.cek-status') }}" class="inline-flex items-center justify-center border border-primary text-primary font-semibold px-6 py-3 rounded-lg transition-all duration-300 hover:bg-primary hover:text-white">
                            <i class="fas fa-search mr-2"></i>Cek Status Pendaftaran
                        </a>
                        <a href="{{ route('jadwal') }}" class="inline-flex items-center justify-center border border-green-500 text-green-600 font-semibold px-6 py-3 rounded-lg transition-all duration-300 hover:bg-green-500 hover:text-white">
                            <i class="fas fa-calendar mr-2"></i>Lihat Jadwal Lengkap
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Informasi Tambahan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mt-6">
                <h5 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-question-circle mr-2"></i>Informasi Penting
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Pastikan data yang diinput sesuai</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Bawa dokumen asli saat daftar ulang</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Batas waktu daftar ulang 3 hari</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Konfirmasi kehadiran via WhatsApp</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kontak Panitia -->
            <div class="bg-white border border-blue-500 rounded-2xl shadow-lg p-6 mt-6">
                <div class="bg-blue-500 text-white px-6 py-4 -mx-6 -mt-6 rounded-t-2xl mb-4">
                    <h5 class="text-lg font-bold mb-0 flex items-center">
                        <i class="fas fa-phone mr-2"></i>Kontak Panitia PPDB
                    </h5>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <p class="flex items-center text-gray-700">
                            <i class="fas fa-phone text-blue-500 mr-2 w-5"></i>
                            <span><strong>Telepon:</strong> (0621) 12345</span>
                        </p>
                        <p class="flex items-center text-gray-700">
                            <i class="fas fa-whatsapp text-green-500 mr-2 w-5"></i>
                            <span><strong>WhatsApp:</strong> +62 812-3456-7890</span>
                        </p>
                    </div>
                    <div class="space-y-3">
                        <p class="flex items-center text-gray-700">
                            <i class="fas fa-envelope text-blue-500 mr-2 w-5"></i>
                            <span><strong>Email:</strong> ppdb@smkn2siatasbarita.sch.id</span>
                        </p>
                        <p class="flex items-center text-gray-700">
                            <i class="fas fa-clock text-blue-500 mr-2 w-5"></i>
                            <span><strong>Jam Operasional:</strong> 07:30 - 16:00 WIB</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection