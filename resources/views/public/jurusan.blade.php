@extends('layouts.app-tailwind')

@section('title', 'Program Jurusan - SMK N 2 Siatas Barita')

@section('content')
<!-- Hero Header -->
<section class="relative bg-gradient-to-r from-primary to-primary-dark text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-white/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Program Jurusan
            </h1>
            <p class="text-xl text-white/90">
                Temukan passion Anda dan bangun karir impian dengan memilih program jurusan yang tepat untuk masa depan cemerlang Anda.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="relative py-16 bg-gray-50">
    <!-- Background Shape -->
    <div class="absolute top-0 left-0 w-full h-32 bg-gray-50"></div>
    
    <div class="container mx-auto px-4">
        <!-- Statistics Bar -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-6xl mx-auto -mt-24 mb-16 grid grid-cols-1 md:grid-cols-3 gap-8 relative z-30">
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent mb-2">
                    {{ count($jurusans) }}
                </div>
                <div class="text-gray-600 font-medium">Program Jurusan</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent mb-2">
                    {{ $jurusans->sum('kuota_reguler') + $jurusans->sum('kuota_unggulan') }}
                </div>
                <div class="text-gray-600 font-medium">Total Kuota</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent mb-2">
                    100%
                </div>
                <div class="text-gray-600 font-medium">Akreditasi</div>
            </div>
        </div>

        <!-- Jurusan Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 max-w-7xl mx-auto">
            @foreach($jurusans as $jurusan)
            <div class="group bg-white rounded-3xl p-8 relative overflow-hidden transition-all duration-400 hover:-translate-y-2 hover:shadow-2xl cursor-pointer">
                <!-- Top Border -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-cyan-500 transform scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                
                <!-- Background Circle -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-500 to-purple-600 opacity-5 rounded-full transform translate-x-1/2 -translate-y-1/2 transition-all duration-500 group-hover:scale-150 group-hover:opacity-10"></div>

                <!-- Icon -->
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-8 shadow-lg shadow-indigo-500/30 transition-all duration-400 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-indigo-500/40 relative z-10">
                    @if($jurusan->nama_jurusan === 'RPL')
                        <i class="fas fa-laptop-code text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'TKJ')
                        <i class="fas fa-network-wired text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'TKRO' || $jurusan->nama_jurusan === 'TBSM' || $jurusan->nama_jurusan === 'TSM')
                        <i class="fas fa-tools text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'TITL')
                        <i class="fas fa-bolt text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'AKL' || $jurusan->nama_jurusan === 'OTKP' || $jurusan->nama_jurusan === 'Pemasaran')
                        <i class="fas fa-briefcase text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'ATPH')
                        <i class="fas fa-seedling text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'DKV' || $jurusan->nama_jurusan === 'DPIB')
                        <i class="fas fa-paint-brush text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'TM' || $jurusan->nama_jurusan === 'TP')
                        <i class="fas fa-cogs text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'MM')
                        <i class="fas fa-photo-video text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'Farmasi')
                        <i class="fas fa-pills text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'Tata Boga')
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    @elseif($jurusan->nama_jurusan === 'Tata Busana')
                        <i class="fas fa-tshirt text-white text-2xl"></i>
                    @else
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    @endif
                </div>

                <!-- Content -->
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                        {{ $jurusan->nama_lengkap }}
                        <span class="text-xs px-3 py-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg font-semibold tracking-wide">
                            {{ $jurusan->nama_jurusan }}
                        </span>
                    </h3>
                    
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ $jurusan->deskripsi }}
                    </p>
                    
                    <!-- Info List -->
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center py-2 border-b border-gray-100 transition-all duration-300 hover:pl-2 hover:text-indigo-600">
                            <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center mr-3 text-sm">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <span class="text-gray-700"><strong>Bidang:</strong> {{ $jurusan->bidang_keahlian }}</span>
                        </li>
                        <li class="flex items-center py-2 border-b border-gray-100 transition-all duration-300 hover:pl-2 hover:text-indigo-600">
                            <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center mr-3 text-sm">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="text-gray-700"><strong>Kuota Reguler:</strong> {{ $jurusan->kuota_reguler }} siswa</span>
                        </li>
                        <li class="flex items-center py-2 transition-all duration-300 hover:pl-2 hover:text-indigo-600">
                            <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center mr-3 text-sm">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-700"><strong>Kuota Unggulan:</strong> {{ $jurusan->kuota_unggulan }} siswa</span>
                        </li>
                    </ul>
                    
                    <!-- Badge -->
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
                            <i class="fas fa-chart-line"></i>
                            Total: {{ $jurusan->kuota_reguler + $jurusan->kuota_unggulan }} Siswa
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection