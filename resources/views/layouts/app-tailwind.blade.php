<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPDB SMK N 2 Siatas Barita')</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS - PASTIKAN INI ADA -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-inter text-dark bg-white">
    <!-- Navigation -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50 bg-white shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Brand -->
                <a class="navbar-brand flex items-center gap-2 font-sora font-bold text-xl text-primary hover:scale-105 transition-transform duration-300" href="{{ route('beranda') }}">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <span class="hidden sm:inline">SMK N 2</span>
                    <span class="sm:hidden">SMK N 2</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                    <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
                    <a class="nav-link {{ request()->routeIs('jurusan') ? 'active' : '' }}" href="{{ route('jurusan') }}">Jurusan</a>
                    <a class="nav-link {{ request()->routeIs('persyaratan') ? 'active' : '' }}" href="{{ route('persyaratan') }}">Persyaratan</a>
                    <a class="nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}" href="{{ route('jadwal') }}">Jadwal</a>
                    <a class="nav-link {{ request()->routeIs('pengumuman.public') ? 'active' : '' }}" href="{{ route('pengumuman.public') }}">Pengumuman</a>
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                    
                    <a href="{{ route('pendaftaran.form') }}" class="btn-daftar ml-2">
                        <i class="fas fa-edit"></i>
                        <span class="hidden sm:inline">Daftar</span>
                    </a>
                    
                    <a href="{{ route('admin.login') }}" class="btn-admin ml-2">
                        <i class="fas fa-lock"></i>
                        <span class="hidden sm:inline">Admin</span>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button class="lg:hidden border-2 border-primary border-opacity-20 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-10 hover:bg-primary hover:bg-opacity-5 transition-all duration-300 mobile-menu-button">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="lg:hidden mobile-menu bg-white border-t border-gray-200 shadow-lg">
            <div class="px-4 py-3 space-y-1">
                <a class="block nav-link-mobile {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a class="block nav-link-mobile {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">
                    <i class="fas fa-info-circle mr-2"></i>Tentang
                </a>
                <a class="block nav-link-mobile {{ request()->routeIs('jurusan') ? 'active' : '' }}" href="{{ route('jurusan') }}">
                    <i class="fas fa-book mr-2"></i>Jurusan
                </a>
                <a class="block nav-link-mobile {{ request()->routeIs('persyaratan') ? 'active' : '' }}" href="{{ route('persyaratan') }}">
                    <i class="fas fa-list-check mr-2"></i>Persyaratan
                </a>
                <a class="block nav-link-mobile {{ request()->routeIs('jadwal') ? 'active' : '' }}" href="{{ route('jadwal') }}">
                    <i class="fas fa-calendar mr-2"></i>Jadwal
                </a>
                <a class="block nav-link-mobile {{ request()->routeIs('pengumuman.public') ? 'active' : '' }}" href="{{ route('pengumuman.public') }}">
                    <i class="fas fa-bullhorn mr-2"></i>Pengumuman
                </a>
                <a class="block nav-link-mobile {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                    <i class="fas fa-phone mr-2"></i>Kontak
                </a>
                
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <a href="{{ route('pendaftaran.form') }}" class="btn-daftar w-full justify-center">
                        <i class="fas fa-edit"></i>
                        <span>Daftar Sekarang</span>
                    </a>
                    
                    <a href="{{ route('admin.login') }}" class="btn-admin w-full justify-center mt-2">
                        <i class="fas fa-lock"></i>
                        <span>Portal Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16 min-h-[calc(100vh-4rem)]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-gray-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- School Info -->
                <div class="lg:col-span-1">
                    <div class="footer-section">
                        <div class="footer-logo flex items-center gap-2 mb-4">
                            <i class="fas fa-graduation-cap text-2xl text-yellow-400"></i>
                            <span class="font-bold text-lg">SMK N 2 Siatas Barita</span>
                        </div>
                        <p class="footer-desc text-gray-300 text-sm mb-4">
                            Membangun generasi penerus yang kompeten, berkarakter, dan siap bersaing di era global dengan pendidikan berkualitas dan fasilitas modern.
                        </p>
                        <div class="social-links flex gap-3">
                            <a href="#" class="social-link facebook w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center hover:bg-blue-700 transition-colors" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link instagram w-10 h-10 rounded-full bg-pink-600 flex items-center justify-center hover:bg-pink-700 transition-colors" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link youtube w-10 h-10 rounded-full bg-red-600 flex items-center justify-center hover:bg-red-700 transition-colors" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="social-link whatsapp w-10 h-10 rounded-full bg-green-600 flex items-center justify-center hover:bg-green-700 transition-colors" aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="social-link twitter w-10 h-10 rounded-full bg-blue-400 flex items-center justify-center hover:bg-blue-500 transition-colors" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="lg:col-span-1">
                    <div class="footer-section">
                        <h5 class="text-lg font-semibold mb-4 text-yellow-400">Menu Utama</h5>
                        <ul class="footer-links space-y-2">
                            <li><a href="{{ route('beranda') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Beranda</a></li>
                            <li><a href="{{ route('tentang') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Tentang Sekolah</a></li>
                            <li><a href="{{ route('jurusan') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Program Jurusan</a></li>
                            <li><a href="{{ route('persyaratan') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Persyaratan</a></li>
                            <li><a href="{{ route('jadwal') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Jadwal PPDB</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Important Links -->
                <div class="lg:col-span-1">
                    <div class="footer-section">
                        <h5 class="text-lg font-semibold mb-4 text-yellow-400">Informasi PPDB</h5>
                        <ul class="footer-links space-y-2">
                            <li><a href="{{ route('pendaftaran.form') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Daftar Online</a></li>
                            <li><a href="{{ route('pengumuman.public') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Pengumuman</a></li>
                            <li><a href="{{ route('kontak') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Hubungi Kami</a></li>
<li>
    <a href="{{ route('faq') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
        <i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> FAQ
    </a>
</li><li><a href="{{ route('admin.login') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-yellow-400"></i> Portal Admin</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="lg:col-span-1">
                    <div class="footer-section">
                        <h5 class="text-lg font-semibold mb-4 text-yellow-400">Kontak Kami</h5>
                        <ul class="contact-info space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt text-yellow-400 mt-1 mr-3"></i>
                                <span class="text-gray-300 text-sm">Jl. Pendidikan No. 123, Siatas Barita, Tapanuli Utara</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone text-yellow-400 mr-3"></i>
                                <span class="text-gray-300 text-sm">(0631) 12345678</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope text-yellow-400 mr-3"></i>
                                <span class="text-gray-300 text-sm">info@smkn2siatasbarita.sch.id</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-globe text-yellow-400 mr-3"></i>
                                <span class="text-gray-300 text-sm">www.smkn2siatasbarita.sch.id</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Operating Hours -->
            <div class="mt-8">
                <div class="schedule-box bg-gray-800 rounded-lg p-4">
                    <h5 class="text-lg font-semibold mb-4 text-yellow-400">Jam Operasional</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="schedule-item bg-gray-700 rounded p-3">
                            <span class="schedule-day block text-yellow-400 font-medium">Senin - Jumat</span>
                            <span class="schedule-time block text-gray-300 text-sm">07:30 - 16:00</span>
                        </div>
                        <div class="schedule-item bg-gray-700 rounded p-3">
                            <span class="schedule-day block text-yellow-400 font-medium">Sabtu</span>
                            <span class="schedule-time block text-gray-300 text-sm">08:00 - 14:00</span>
                        </div>
                        <div class="schedule-item bg-gray-700 rounded p-3">
                            <span class="schedule-day block text-yellow-400 font-medium">Minggu</span>
                            <span class="schedule-time block text-gray-300 text-sm">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom mt-8 pt-6 border-t border-gray-800">
                <div class="copyright text-center text-gray-400 text-sm">
                    <p>
                        &copy; {{ date('Y') }} <a href="{{ route('beranda') }}" class="text-yellow-400 hover:text-yellow-300 transition-colors">PPDB SMK N 2 Siatas Barita</a>. All rights reserved. 
                        | Developed By | Ricky Steven Silaban
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
      // Mobile menu toggle
      document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        // Initially hide mobile menu
        mobileMenu.classList.add('hidden');
        
        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', function() {
            const icon = this.querySelector('i');
            
            // Toggle menu
            mobileMenu.classList.toggle('hidden');
            
            // Toggle icon
            if (mobileMenu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target) && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.querySelector('i').classList.remove('fa-times');
                mobileMenuButton.querySelector('i').classList.add('fa-bars');
            }
        });

        // Close mobile menu when link is clicked
        document.querySelectorAll('.mobile-menu .nav-link-mobile').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.querySelector('i').classList.remove('fa-times');
                mobileMenuButton.querySelector('i').classList.add('fa-bars');
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-fade-in-up');
            elements.forEach(element => {
                const position = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (position < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
      });
    </script>
    
    @stack('scripts')
</body>
</html>