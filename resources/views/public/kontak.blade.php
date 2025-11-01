@extends('layouts.app-tailwind')

@section('title', 'Kontak - SMK N 2 Siatas Barita')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-primary-dark text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-white/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Kontak Kami
            </h1>
            <p class="text-xl text-white/90">
                Hubungi kami untuk informasi lebih lanjut tentang PPDB SMK N 2 Siatas Barita.
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Contact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <!-- Alamat -->
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transition-all duration-300 hover:shadow-xl h-full">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Alamat</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Jl. Pendidikan No. 123, Kelurahan Siatas Barita, Kecamatan Siatas Barita, 
                        Kota Medan, Sumatera Utara 20154
                    </p>
                </div>

                <!-- Telepon -->
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transition-all duration-300 hover:shadow-xl h-full">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Telepon</h4>
                    <div class="space-y-2 text-gray-600">
                        <p>(0621) 12345</p>
                        <p>(0621) 67890</p>
                        <p>+62 812-3456-7890 (WhatsApp)</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transition-all duration-300 hover:shadow-xl h-full">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Email</h4>
                    <div class="space-y-2 text-gray-600">
                        <p>info@smkn2siatasbarita.sch.id</p>
                        <p>ppdb@smkn2siatasbarita.sch.id</p>
                        <p>humas@smkn2siatasbarita.sch.id</p>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center transition-all duration-300 hover:shadow-xl h-full">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Jam Operasional</h4>
                    <div class="space-y-2 text-gray-600">
                        <p>Senin - Jumat: 07:30 - 16:00 WIB</p>
                        <p>Sabtu: 08:00 - 14:00 WIB</p>
                        <p>Minggu: Tutup</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
                <h3 class="text-2xl font-bold text-center text-gray-800 mb-8">Kirim Pesan</h3>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-2">
                                No. Telepon/HP
                            </label>
                            <input type="tel" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label for="subject" class="block text-gray-700 font-medium mb-2">
                                Subjek <span class="text-red-500">*</span>
                            </label>
                            <select id="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" required>
                                <option value="">Pilih Subjek</option>
                                <option value="ppdb">Informasi PPDB</option>
                                <option value="jurusan">Konsultasi Jurusan</option>
                                <option value="beasiswa">Beasiswa</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-medium mb-2">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-primary text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 hover:bg-primary-dark hover:-translate-y-1">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Location Map -->
            <div>
                <h4 class="text-2xl font-bold text-center text-gray-800 mb-6">Lokasi Sekolah</h4>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15949.761590794024!2d98.98293815541992!3d1.9782514999999987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e6fe61d5d847d%3A0x3a1eddbccfa766cf!2sSMK%20N%202%20Siatasbarita!5e0!3m2!1sid!2sid!4v1760368099661!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection