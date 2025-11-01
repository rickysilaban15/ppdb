@extends('layouts.app-tailwind')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-6xl mx-auto">
                <!-- Header -->
                <div class="bg-gradient-to-r from-red-800 to-red-600 text-white p-6 text-center relative overflow-hidden">
                    <div class="relative z-10">
                        <h1 class="font-bold text-2xl md:text-3xl mb-2">
                            <i class="fas fa-user-graduate mr-2"></i>
                            FORM PENDAFTARAN PPDB
                        </h1>
                        <p class="mb-0 opacity-90">SMK NEGERI 2 SIATAS BARITA - TAHUN AJARAN 2026/2027</p>
                        <div class="mt-2">
                            <span class="bg-yellow-500 text-gray-800 px-2 py-1 rounded text-sm">Pendaftaran Online</span>
                            <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-sm ml-1">18 Jurusan Tersedia</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Steps -->
                <div class="p-6">
                    <div class="flex justify-between mb-8 relative">
                        <div class="absolute top-5 left-0 right-0 h-0.5 bg-gray-200 z-0"></div>
                        
                        <div class="text-center relative z-10 flex-1" data-step="1">
                            <div class="w-10 h-10 bg-yellow-500 text-white rounded-full flex items-center justify-center mx-auto mb-2 font-semibold">1</div>
                            <div class="text-xs text-gray-600 font-medium">Data Pribadi</div>
                        </div>
                        
                        <div class="text-center relative z-10 flex-1" data-step="2">
                            <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-semibold">2</div>
                            <div class="text-xs text-gray-600 font-medium">Data Keluarga</div>
                        </div>
                        
                        <div class="text-center relative z-10 flex-1" data-step="3">
                            <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-semibold">3</div>
                            <div class="text-xs text-gray-600 font-medium">Data Akademik</div>
                        </div>
                        
                        <div class="text-center relative z-10 flex-1" data-step="4">
                            <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-semibold">4</div>
                            <div class="text-xs text-gray-600 font-medium">Pilihan Jurusan</div>
                        </div>
                        
                        <div class="text-center relative z-10 flex-1" data-step="5">
                            <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-semibold">5</div>
                            <div class="text-xs text-gray-600 font-medium">Upload Dokumen</div>
                        </div>
                        
                        <div class="text-center relative z-10 flex-1" data-step="6">
                            <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-semibold">6</div>
                            <div class="text-xs text-gray-600 font-medium">Konfirmasi</div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            {!! session('success') !!}
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Terjadi Kesalahan!</strong>
                            <ul class="mb-0 mt-2 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <form id="pendaftaranForm" method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1: Data Pribadi -->
                        <div class="form-section" id="step1">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-user mr-2"></i>Data Identitas Pribadi
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nama_lengkap') border-red-500 @enderror" 
                                                   name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                            @error('nama_lengkap')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">NISN <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nisn') border-red-500 @enderror" 
                                                   name="nisn" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">NIK <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nik') border-red-500 @enderror" 
                                                   name="nik" value="{{ old('nik') }}" required maxlength="16">
                                            @error('nik')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Jenis Kelamin <span class="text-red-500">*</span></label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('jenis_kelamin') border-red-500 @enderror" 
                                                    name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Tempat Lahir <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('tempat_lahir') border-red-500 @enderror" 
                                                   name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                            @error('tempat_lahir')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Tanggal Lahir <span class="text-red-500">*</span></label>
                                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('tanggal_lahir') border-red-500 @enderror" 
                                                   name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                            @error('tanggal_lahir')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Agama <span class="text-red-500">*</span></label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('agama') border-red-500 @enderror" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Kewarganegaraan <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('kewarganegaraan') border-red-500 @enderror" 
                                                   name="kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}" required>
                                            @error('kewarganegaraan')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-home mr-2"></i>Data Tempat Tinggal
                                </div>
                                <div class="p-5">
                                    <div class="mb-4">
                                        <label class="block font-medium mb-2 text-sm">Alamat Jalan <span class="text-red-500">*</span></label>
                                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('alamat_jalan') border-red-500 @enderror" 
                                                  name="alamat_jalan" rows="2" required>{{ old('alamat_jalan') }}</textarea>
                                        @error('alamat_jalan')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">RT</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" name="rt" value="{{ old('rt') }}">
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">RW</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" name="rw" value="{{ old('rw') }}">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block font-medium mb-2 text-sm">Kelurahan <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('kelurahan') border-red-500 @enderror" 
                                                   name="kelurahan" value="{{ old('kelurahan') }}" required>
                                            @error('kelurahan')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Kecamatan <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('kecamatan') border-red-500 @enderror" 
                                                   name="kecamatan" value="{{ old('kecamatan') }}" required>
                                            @error('kecamatan')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Kabupaten/Kota <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('kabupaten_kota') border-red-500 @enderror" 
                                                   name="kabupaten_kota" value="{{ old('kabupaten_kota') }}" required>
                                            @error('kabupaten_kota')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Provinsi <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('provinsi') border-red-500 @enderror" 
                                                   name="provinsi" value="{{ old('provinsi') }}" required>
                                            @error('provinsi')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Kode Pos <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('kode_pos') border-red-500 @enderror" 
                                                   name="kode_pos" value="{{ old('kode_pos') }}" required>
                                            @error('kode_pos')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="block font-medium mb-2 text-sm">Status Tempat Tinggal <span class="text-red-500">*</span></label>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('status_tempat_tinggal') border-red-500 @enderror" 
                                                name="status_tempat_tinggal" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Rumah Pribadi" {{ old('status_tempat_tinggal') == 'Rumah Pribadi' ? 'selected' : '' }}>Rumah Pribadi</option>
                                            <option value="Rumah Keluarga" {{ old('status_tempat_tinggal') == 'Rumah Keluarga' ? 'selected' : '' }}>Rumah Keluarga</option>
                                            <option value="Kontrak/Sewa" {{ old('status_tempat_tinggal') == 'Kontrak/Sewa' ? 'selected' : '' }}>Kontrak/Sewa</option>
                                            <option value="Lainnya" {{ old('status_tempat_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('status_tempat_tinggal')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-phone mr-2"></i>Data Kontak
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Email</label>
                                            <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('email') border-red-500 @enderror" 
                                                   name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">No. Telepon/HP <span class="text-red-500">*</span></label>
                                            <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('no_telepon') border-red-500 @enderror" 
                                                   name="no_telepon" value="{{ old('no_telepon') }}" required>
                                            @error('no_telepon')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <div></div>
                                <button type="button" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold py-2 px-6 rounded-md hover:from-yellow-500 hover:to-yellow-600 transition-all next-step" data-next="2">
                                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Data Keluarga -->
                        <div class="form-section hidden" id="step2">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-users mr-2"></i>Data Keluarga
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Jumlah Saudara Kandung <span class="text-red-500">*</span></label>
                                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('jumlah_saudara') border-red-500 @enderror" 
                                                   name="jumlah_saudara" value="{{ old('jumlah_saudara', 0) }}" min="0" required>
                                            @error('jumlah_saudara')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Anak Ke- <span class="text-red-500">*</span></label>
                                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('anak_ke') border-red-500 @enderror" 
                                                   name="anak_ke" value="{{ old('anak_ke') }}" min="1" required>
                                            @error('anak_ke')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-male mr-2"></i>Data Ayah
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Nama Ayah <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nama_ayah') border-red-500 @enderror" 
                                                   name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                                            @error('nama_ayah')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('pekerjaan_ayah') border-red-500 @enderror" 
                                                   name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required>
                                            @error('pekerjaan_ayah')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block font-medium mb-2 text-sm">No. Telepon Ayah <span class="text-red-500">*</span></label>
                                        <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('no_telepon_ayah') border-red-500 @enderror" 
                                               name="no_telepon_ayah" value="{{ old('no_telepon_ayah') }}" required>
                                        @error('no_telepon_ayah')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-female mr-2"></i>Data Ibu
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Nama Ibu <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nama_ibu') border-red-500 @enderror" 
                                                   name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                                            @error('nama_ibu')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('pekerjaan_ibu') border-red-500 @enderror" 
                                                   name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required>
                                            @error('pekerjaan_ibu')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block font-medium mb-2 text-sm">No. Telepon Ibu <span class="text-red-500">*</span></label>
                                        <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('no_telepon_ibu') border-red-500 @enderror" 
                                               name="no_telepon_ibu" value="{{ old('no_telepon_ibu') }}" required>
                                        @error('no_telepon_ibu')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-user-friends mr-2"></i>Data Wali (Jika Ada)
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Nama Wali</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" name="nama_wali" value="{{ old('nama_wali') }}">
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Pekerjaan Wali</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}">
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block font-medium mb-2 text-sm">No. Telepon Wali</label>
                                        <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" name="no_telepon_wali" value="{{ old('no_telepon_wali') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-md hover:bg-gray-300 transition-all prev-step" data-prev="1">
                                    <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                                </button>
                                <button type="button" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold py-2 px-6 rounded-md hover:from-yellow-500 hover:to-yellow-600 transition-all next-step" data-next="3">
                                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Data Akademik -->
                        <div class="form-section hidden" id="step3">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-graduation-cap mr-2"></i>Data Sekolah Asal
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Asal Sekolah <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('asal_sekolah') border-red-500 @enderror" 
                                                   name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                                            @error('asal_sekolah')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Tahun Lulus <span class="text-red-500">*</span></label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('tahun_lulus') border-red-500 @enderror" 
                                                   name="tahun_lulus" value="{{ old('tahun_lulus', '2025') }}" required>
                                            @error('tahun_lulus')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block font-medium mb-2 text-sm">Alamat Sekolah Asal <span class="text-red-500">*</span></label>
                                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('alamat_sekolah_asal') border-red-500 @enderror" 
                                                  name="alamat_sekolah_asal" rows="2" required>{{ old('alamat_sekolah_asal') }}</textarea>
                                        @error('alamat_sekolah_asal')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-chart-line mr-2"></i>Nilai Akademik
                                </div>
                                <div class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Rata-rata Nilai Rapor <span class="text-red-500">*</span></label>
                                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('rerata_nilai_rapor') border-red-500 @enderror" 
                                                   name="rerata_nilai_rapor" value="{{ old('rerata_nilai_rapor') }}" 
                                                   step="0.01" min="0" max="100" required>
                                            @error('rerata_nilai_rapor')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Nilai Akreditasi Sekolah <span class="text-red-500">*</span></label>
                                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nilai_akreditasi_sekolah') border-red-500 @enderror" 
                                                   name="nilai_akreditasi_sekolah" value="{{ old('nilai_akreditasi_sekolah') }}" 
                                                   step="0.01" min="0" max="100" required>
                                            @error('nilai_akreditasi_sekolah')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Indeks Sekolah Asal <span class="text-red-500">*</span></label>
                                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('indeks_sekolah_asal') border-red-500 @enderror" 
                                                   name="indeks_sekolah_asal" value="{{ old('indeks_sekolah_asal') }}" 
                                                   step="0.01" min="0" max="100" required>
                                            @error('indeks_sekolah_asal')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-route mr-2"></i>Jalur Pendaftaran
                                </div>
                                <div class="p-5">
                                    <div>
                                        <label class="block font-medium mb-2 text-sm">Pilih Jalur Pendaftaran <span class="text-red-500">*</span></label>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('jalur_pendaftaran') border-red-500 @enderror" 
                                                name="jalur_pendaftaran" required>
                                            <option value="">Pilih Jalur</option>
                                            <option value="zonasi" {{ old('jalur_pendaftaran') == 'zonasi' ? 'selected' : '' }}>Zonasi</option>
                                            <option value="prestasi" {{ old('jalur_pendaftaran') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                            <option value="afirmasi" {{ old('jalur_pendaftaran') == 'afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                                            <option value="mutasi" {{ old('jalur_pendaftaran') == 'mutasi' ? 'selected' : '' }}>Mutasi Orang Tua</option>
                                        </select>
                                        @error('jalur_pendaftaran')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-md hover:bg-gray-300 transition-all prev-step" data-prev="2">
                                    <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                                </button>
                                <button type="button" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold py-2 px-6 rounded-md hover:from-yellow-500 hover:to-yellow-600 transition-all next-step" data-next="4">
                                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 4: Pilihan Jurusan -->
                        <div class="form-section hidden" id="step4">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-list-alt mr-2"></i>Pilihan Program Keahlian
                                </div>
                                <div class="p-5">
                                    <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-md mb-4">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Pilih 2 (dua) program keahlian yang diminati. Pilihan 1 merupakan prioritas utama.
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Pilihan Jurusan 1 (Prioritas) <span class="text-red-500">*</span></label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('pilihan_jurusan_1') border-red-500 @enderror" 
                                                    name="pilihan_jurusan_1" id="pilihan_jurusan_1" required>
                                                <option value="">-- Pilih Jurusan Pertama --</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('pilihan_jurusan_1') == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->kode_jurusan }} - {{ $jurusan->nama_lengkap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pilihan_jurusan_1')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Pilihan Jurusan 2 (Alternatif) <span class="text-red-500">*</span></label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('pilihan_jurusan_2') border-red-500 @enderror" 
                                                    name="pilihan_jurusan_2" id="pilihan_jurusan_2" required>
                                                <option value="">-- Pilih Jurusan Kedua --</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('pilihan_jurusan_2') == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->kode_jurusan }} - {{ $jurusan->nama_lengkap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pilihan_jurusan_2')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Daftar Program Keahlian -->
                                    <div class="mt-6">
                                        <h6 class="text-blue-600 font-semibold mb-3">
                                            <i class="fas fa-graduation-cap mr-2"></i>
                                            Daftar 18 Program Keahlian SMK N 2 Siatas Barita:
                                        </h6>
                                        
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                            @php
                                                $groupedJurusans = $jurusans->groupBy('bidang_keahlian');
                                            @endphp
                                            
                                            @foreach($groupedJurusans as $bidang => $jurusansBidang)
                                                <div class="border border-gray-200 rounded-lg shadow-sm h-full">
                                                    <div class="bg-blue-600 text-white py-2 px-4">
                                                        <strong>{{ $bidang }}</strong>
                                                    </div>
                                                    <div class="p-3">
                                                        @foreach($jurusansBidang as $jurusan)
                                                            <div class="flex items-center mb-2 p-2 rounded" style="background: rgba(212, 175, 55, 0.1);">
                                                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                                                <div>
                                                                    <strong class="text-gray-800">{{ $jurusan->kode_jurusan }}</strong>
                                                                    <small class="text-gray-600 block">{{ $jurusan->nama_lengkap }}</small>
                                                                    <small class="text-blue-600">
                                                                        <i class="fas fa-users mr-1"></i>
                                                                        Kuota: {{ $jurusan->kuota_reguler }} Reguler + {{ $jurusan->kuota_unggulan }} Unggulan
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-md mt-4">
                                        <i class="fas fa-lightbulb mr-2"></i>
                                        <strong>Tips Pemilihan Jurusan:</strong>
                                        <ul class="mb-0 mt-2 pl-5">
                                            <li>Pilih jurusan sesuai minat, bakat, dan cita-cita Anda</li>
                                            <li>Pilihan 1 adalah prioritas utama, pilihan 2 sebagai alternatif</li>
                                            <li>Setiap jurusan memiliki kuota terbatas</li>
                                            <li>Pertimbangkan peluang kerja setelah lulus</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-md hover:bg-gray-300 transition-all prev-step" data-prev="3">
                                    <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                                </button>
                                <button type="button" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold py-2 px-6 rounded-md hover:from-yellow-500 hover:to-yellow-600 transition-all next-step" data-next="5">
                                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 5: Upload Dokumen -->
                        <div class="form-section hidden" id="step5">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-file-upload mr-2"></i>Upload Dokumen Persyaratan
                                </div>
                                <div class="p-5">
                                    <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-md mb-4">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Informasi:</strong> Upload dokumen dalam format JPG, PNG, atau PDF (maksimal 2MB per file).
                                        <strong class="text-yellow-600 block mt-2">Dokumen dapat diupload nanti melalui dashboard setelah pendaftaran.</strong>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Kartu Keluarga -->
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Kartu Keluarga (KK)</label>
                                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors" onclick="document.getElementById('file_kk').click()">
                                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                                <h6 class="font-medium text-gray-700">Upload Kartu Keluarga</h6>
                                                <p class="text-sm text-gray-600 mb-1">Seret file ke sini atau klik untuk memilih</p>
                                                <small class="text-gray-500">Format: JPG, PNG, PDF (Max 2MB)</small>
                                                <input type="file" id="file_kk" name="file_kk" class="hidden" 
                                                       accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                            <div id="preview_file_kk"></div>
                                        </div>
                                        
                                        <!-- Akta Kelahiran -->
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Akta Kelahiran</label>
                                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors" onclick="document.getElementById('file_akta').click()">
                                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                                <h6 class="font-medium text-gray-700">Upload Akta Kelahiran</h6>
                                                <p class="text-sm text-gray-600 mb-1">Seret file ke sini atau klik untuk memilih</p>
                                                <small class="text-gray-500">Format: JPG, PNG, PDF (Max 2MB)</small>
                                                <input type="file" id="file_akta" name="file_akta" class="hidden" 
                                                       accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                            <div id="preview_file_akta"></div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <!-- Ijazah SMP/MTs -->
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Ijazah SMP/MTs</label>
                                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors" onclick="document.getElementById('file_ijazah').click()">
                                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                                <h6 class="font-medium text-gray-700">Upload Ijazah</h6>
                                                <p class="text-sm text-gray-600 mb-1">Seret file ke sini atau klik untuk memilih</p>
                                                <small class="text-gray-500">Format: JPG, PNG, PDF (Max 2MB)</small>
                                                <input type="file" id="file_ijazah" name="file_ijazah" class="hidden" 
                                                       accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                            <div id="preview_file_ijazah"></div>
                                        </div>
                                        
                                        <!-- Pas Foto 3x4 -->
                                        <div>
                                            <label class="block font-medium mb-2 text-sm">Pas Foto 3x4</label>
                                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors" onclick="document.getElementById('file_pas_foto').click()">
                                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                                <h6 class="font-medium text-gray-700">Upload Pas Foto</h6>
                                                <p class="text-sm text-gray-600 mb-1">Seret file ke sini atau klik untuk memilih</p>
                                                <small class="text-gray-500">Format: JPG, PNG (Max 2MB)</small>
                                                <input type="file" id="file_pas_foto" name="file_pas_foto" class="hidden" 
                                                       accept=".jpg,.jpeg,.png">
                                            </div>
                                            <div id="preview_file_pas_foto"></div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <!-- Transkrip Nilai -->
                                        <label class="block font-medium mb-2 text-sm">Transkrip Nilai Rapor</label>
                                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors" onclick="document.getElementById('file_transkrip_nilai').click()">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                            <h6 class="font-medium text-gray-700">Upload Transkrip Nilai</h6>
                                            <p class="text-sm text-gray-600 mb-1">Seret file ke sini atau klik untuk memilih</p>
                                            <small class="text-gray-500">Format: JPG, PNG, PDF (Max 2MB)</small>
                                            <input type="file" id="file_transkrip_nilai" name="file_transkrip_nilai" class="hidden" 
                                                   accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                        <div id="preview_file_transkrip_nilai"></div>
                                    </div>

                                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-md mt-4">
                                        <i class="fas fa-lightbulb mr-2"></i>
                                        <strong>Catatan:</strong> Jika mengalami kesalahan upload, Anda dapat mengupload dokumen melalui dashboard setelah pendaftaran.
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-md hover:bg-gray-300 transition-all prev-step" data-prev="4">
                                    <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                                </button>
                                <button type="button" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold py-2 px-6 rounded-md hover:from-yellow-500 hover:to-yellow-600 transition-all next-step" data-next="6">
                                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 6: Konfirmasi -->
                        <div class="form-section hidden" id="step6">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-5 overflow-hidden">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold p-4 border-0">
                                    <i class="fas fa-check-circle mr-2"></i>Konfirmasi Pendaftaran
                                </div>
                                <div class="p-5">
                                    <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-md mb-4">
                                        <i class="fas fa-check mr-2"></i>
                                        <strong>Data pendaftaran Anda sudah lengkap!</strong> Silakan periksa kembali data yang telah diisi sebelum submit.
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h6 class="text-blue-600 font-semibold mb-3">Data Pribadi</h6>
                                            <table class="w-full text-sm">
                                                <tr><td class="py-1"><strong>Nama</strong></td><td class="py-1" id="confirm_nama"></td></tr>
                                                <tr><td class="py-1"><strong>NISN</strong></td><td class="py-1" id="confirm_nisn"></td></tr>
                                                <tr><td class="py-1"><strong>NIK</strong></td><td class="py-1" id="confirm_nik"></td></tr>
                                                <tr><td class="py-1"><strong>TTL</strong></td><td class="py-1" id="confirm_ttl"></td></tr>
                                                <tr><td class="py-1"><strong>Jenis Kelamin</strong></td><td class="py-1" id="confirm_jk"></td></tr>
                                            </table>
                                        </div>
                                        <div>
                                            <h6 class="text-blue-600 font-semibold mb-3">Data Akademik</h6>
                                            <table class="w-full text-sm">
                                                <tr><td class="py-1"><strong>Asal Sekolah</strong></td><td class="py-1" id="confirm_sekolah"></td></tr>
                                                <tr><td class="py-1"><strong>Rata-rata Nilai</strong></td><td class="py-1" id="confirm_nilai"></td></tr>
                                                <tr><td class="py-1"><strong>Jalur</strong></td><td class="py-1" id="confirm_jalur"></td></tr>
                                                <tr><td class="py-1"><strong>Pilihan 1</strong></td><td class="py-1" id="confirm_jurusan1"></td></tr>
                                                <tr><td class="py-1"><strong>Pilihan 2</strong></td><td class="py-1" id="confirm_jurusan2"></td></tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" id="confirm_data" class="mr-2" required>
                                            <span class="text-sm">Saya menyatakan bahwa data yang saya berikan adalah benar dan siap menerima konsekuensi jika terdapat ketidaksesuaian data.</span>
                                        </label>
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-800 font-semibold py-3 px-6 rounded-md hover:from-yellow-500 hover:to-yellow-600 transition-all" id="submitBtn">
                                            <i class="fas fa-paper-plane mr-2"></i>
                                            SUBMIT PENDAFTARAN
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between mt-3">
                                <button type="button" class="bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-md hover:bg-gray-300 transition-all prev-step" data-prev="5">
                                    <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                                </button>
                                <a href="/" class="bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-md hover:bg-gray-300 transition-all">
                                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('[data-step]');
    const sections = document.querySelectorAll('.form-section');
    let currentStep = 1;

    // Show first step
    document.getElementById('step1').classList.remove('hidden');
    steps[0].querySelector('div').classList.add('bg-yellow-500', 'text-white');
    steps[0].querySelector('div').classList.remove('bg-gray-200', 'text-gray-600');

    // Next step button
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = parseInt(this.dataset.next);
            if (validateStep(currentStep)) {
                goToStep(nextStep);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    });

    // Previous step button
    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = parseInt(this.dataset.prev);
            goToStep(prevStep);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    function goToStep(step) {
        // Hide all sections
        sections.forEach(section => {
            section.classList.add('hidden');
        });

        // Show target section
        document.getElementById(`step${step}`).classList.remove('hidden');

        // Update step indicators
        steps.forEach(stepEl => {
            const stepNumber = parseInt(stepEl.dataset.step);
            const stepCircle = stepEl.querySelector('div');
            
            stepCircle.classList.remove('bg-yellow-500', 'text-white', 'bg-green-500', 'text-white', 'bg-gray-200', 'text-gray-600');
            
            if (stepNumber === step) {
                stepCircle.classList.add('bg-yellow-500', 'text-white');
            } else if (stepNumber < step) {
                stepCircle.classList.add('bg-green-500', 'text-white');
            } else {
                stepCircle.classList.add('bg-gray-200', 'text-gray-600');
            }
        });

        currentStep = step;

        // Update confirmation data on last step
        if (step === 6) {
            updateConfirmationData();
        }
    }

    function validateStep(step) {
        const currentSection = document.getElementById(`step${step}`);
        
        // Step 5: Allow proceed without file validation
        if (step === 5) {
            return true;
        }
        
        // Validate required inputs
        const inputs = currentSection.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        let firstInvalid = null;

        inputs.forEach(input => {
            // Remove previous validation classes
            input.classList.remove('border-red-500');
            
            if (!input.value || (input.type === 'select-one' && input.value === '')) {
                input.classList.add('border-red-500');
                isValid = false;
                if (!firstInvalid) firstInvalid = input;
            } else {
                // Special validation for jurusan selection
                if (step === 4 && input.name === 'pilihan_jurusan_2') {
                    const jurusan1 = document.querySelector('[name="pilihan_jurusan_1"]').value;
                    const jurusan2 = input.value;
                    
                    if (jurusan1 === jurusan2 && jurusan1 !== '') {
                        input.classList.add('border-red-500');
                        isValid = false;
                        if (!firstInvalid) firstInvalid = input;
                        alert('Pilihan jurusan 2 harus berbeda dengan pilihan jurusan 1');
                    }
                }
            }
        });

        if (!isValid && firstInvalid) {
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
            alert('Silakan lengkapi semua field yang wajib diisi sebelum melanjutkan.');
        }

        return isValid;
    }

    // File upload handling
    function initializeFileUpload() {
        document.querySelectorAll('input[type="file"]').forEach(input => {
            const previewId = 'preview_' + input.id;
            const preview = document.getElementById(previewId);
            
            input.addEventListener('change', function() {
                handleFileSelect(this, preview);
            });
        });
    }

    function handleFileSelect(input, preview) {
        const file = input.files[0];
        
        if (!file) return;
        
        // Check file size (2MB max)
        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('File terlalu besar! Maksimal 2MB');
            input.value = '';
            preview.innerHTML = '';
            return;
        }
        
        // Check file type
        const allowedTypes = input.accept.split(',').map(type => type.trim());
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
        
        if (!allowedTypes.includes(fileExtension)) {
            alert('Format file tidak didukung!');
            input.value = '';
            preview.innerHTML = '';
            return;
        }
        
        // Create preview
        preview.innerHTML = `
            <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-md mt-2 flex items-center justify-between">
                <div>
                    <i class="fas fa-file mr-2"></i>
                    <span class="font-medium">${file.name}</span>
                    <small class="block text-gray-600">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                </div>
                <button type="button" class="bg-red-500 text-white px-2 py-1 rounded text-sm" onclick="removeFile('${input.id}')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    }

    window.removeFile = function(inputId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById('preview_' + inputId);
        
        input.value = '';
        preview.innerHTML = '';
    };

    // Initialize file upload
    initializeFileUpload();

    function updateConfirmationData() {
        document.getElementById('confirm_nama').textContent = document.querySelector('[name="nama_lengkap"]').value || '-';
        document.getElementById('confirm_nisn').textContent = document.querySelector('[name="nisn"]').value || '-';
        document.getElementById('confirm_nik').textContent = document.querySelector('[name="nik"]').value || '-';
        
        const tempatLahir = document.querySelector('[name="tempat_lahir"]').value;
        const tanggalLahir = document.querySelector('[name="tanggal_lahir"]').value;
        document.getElementById('confirm_ttl').textContent = tempatLahir && tanggalLahir ? `${tempatLahir}, ${tanggalLahir}` : '-';
        
        document.getElementById('confirm_jk').textContent = document.querySelector('[name="jenis_kelamin"]').value || '-';
        document.getElementById('confirm_sekolah').textContent = document.querySelector('[name="asal_sekolah"]').value || '-';
        document.getElementById('confirm_nilai').textContent = document.querySelector('[name="rerata_nilai_rapor"]').value || '-';
        
        const jalurSelect = document.querySelector('[name="jalur_pendaftaran"]');
        document.getElementById('confirm_jalur').textContent = jalurSelect.options[jalurSelect.selectedIndex]?.text || '-';
        
        const jurusan1Select = document.querySelector('[name="pilihan_jurusan_1"]');
        const jurusan2Select = document.querySelector('[name="pilihan_jurusan_2"]');
        document.getElementById('confirm_jurusan1').textContent = jurusan1Select.options[jurusan1Select.selectedIndex]?.text || '-';
        document.getElementById('confirm_jurusan2').textContent = jurusan2Select.options[jurusan2Select.selectedIndex]?.text || '-';
    }

    // Form submission
    document.getElementById('pendaftaranForm').addEventListener('submit', function(e) {
        const confirmCheckbox = document.getElementById('confirm_data');
        if (!confirmCheckbox.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui pernyataan konfirmasi data sebelum submit.');
            confirmCheckbox.focus();
            return false;
        }

        // Show loading state
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
    });

    // Auto-scroll to error on page load
    @if($errors->any())
        setTimeout(function() {
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 500);
    @endif
});
</script>
@endsection