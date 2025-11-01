@extends('layouts.app-tailwind')

@section('title', 'Tentang - SMK N 2 Siatas Barita')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-gradient-primary text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-20"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-gold animate-fade-in-down">
                Tentang SMK N 2 Siatas Barita
            </h1>
            <p class="text-xl md:text-2xl text-gold-light max-w-3xl mx-auto animate-fade-in-up">
                Menjadi sekolah kejuruan unggulan yang menghasilkan lulusan berkompeten dan berkarakter.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50 text-gray-900">
        <div class="container mx-auto px-4">
            <!-- Vision and Mission Section -->
            <div class="flex flex-col lg:flex-row items-center gap-8 mb-16">
                <div class="w-full lg:w-1/2">
                    <div class="bg-white rounded-2xl shadow-card p-8 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2">
                        <h2 class="text-3xl font-bold text-primary mb-8 relative inline-block after:content-[''] after:absolute after:-bottom-3 after:left-0 after:w-16 after:h-1 after:bg-gold after:rounded">
                            Visi dan Misi
                        </h2>
                        
                        <div class="mb-8">
                            <h3 class="text-2xl font-semibold text-primary mb-4 flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-primary animate-pulse"></div>
                                Visi
                            </h3>
                            <p class="text-lg text-secondary leading-relaxed">
                                Menjadi SMK unggulan yang menghasilkan lulusan berkompetensi tinggi, berkarakter, dan mampu bersaing di tingkat nasional maupun internasional.
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-2xl font-semibold text-primary mb-4 flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-gold animate-pulse"></div>
                                Misi
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-secondary">
                                    <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold mt-1 flex-shrink-0">✓</span>
                                    <span>Menyelenggarakan pendidikan kejuruan yang berkualitas</span>
                                </li>
                                <li class="flex items-start gap-3 text-secondary">
                                    <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold mt-1 flex-shrink-0">✓</span>
                                    <span>Mengembangkan potensi siswa secara maksimal</span>
                                </li>
                                <li class="flex items-start gap-3 text-secondary">
                                    <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold mt-1 flex-shrink-0">✓</span>
                                    <span>Membentuk karakter siswa yang berakhlak mulia</span>
                                </li>
                                <li class="flex items-start gap-3 text-secondary">
                                    <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold mt-1 flex-shrink-0">✓</span>
                                    <span>Menjalin kerjasama dengan dunia industri</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2 relative z-10">
                    <div class="rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 hover:scale-105">
                        <img 
                            src="https://images.unsplash.com/photo-1588072432836-4d7a76dffb2d?auto=format&fit=crop&w=1470&q=80" 
                            alt="Sekolah" 
                            class="w-full aspect-video object-cover">
                    </div>
                </div>
            </div>

            <!-- School Description -->
            <div class="bg-white text-gray-900 rounded-2xl p-8 md:p-12 mb-16 relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gold rounded-full opacity-20"></div>
                
                <h3 class="text-3xl font-bold text-primary mb-6">SMK Negeri 2 Siatas Barita</h3>
                
                <div class="space-y-4 text-lg leading-relaxed relative z-10">
                    <p>
                        SMK Negeri 2 Siatas Barita adalah salah satu sekolah menengah kejuruan unggulan yang terletak di Kabupaten Tapanuli Utara, Sumatera Utara. 
                        Sekolah ini telah berdiri sejak tahun 1985 dan terus berkembang menjadi pusat pendidikan vokasi yang diakui di tingkat regional maupun nasional.
                    </p>
                    <p>
                        Dengan luas area sekitar 2 hektar, SMK N 2 Siatas Barita memiliki lingkungan belajar yang nyaman dan kondusif. 
                        Sekolah ini dilengkapi dengan berbagai fasilitas modern yang mendukung proses pembelajaran praktik sesuai dengan standar industri.
                    </p>
                    <p>
                        SMK N 2 Siatas Barita memiliki komitmen kuat untuk mencetak lulusan yang tidak hanya cerdas secara akademis, 
                        tetapi juga memiliki keterampilan praktis yang siap digunakan di dunia kerja.
                    </p>
                </div>
            </div>

            <!-- Achievement Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-primary text-center mb-12 relative inline-block after:content-[''] after:absolute after:-bottom-3 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-gold after:rounded">
                    Prestasi Sekolah
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-t-4 border-primary">
                        <div class="text-4xl text-gold mb-4">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="text-3xl font-bold text-primary mb-2">150+</div>
                        <div class="text-lg font-semibold text-secondary">Prestasi Nasional</div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-t-4 border-primary">
                        <div class="text-4xl text-gold mb-4">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="text-3xl font-bold text-primary mb-2">50+</div>
                        <div class="text-lg font-semibold text-secondary">Mitra Industri</div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-t-4 border-primary">
                        <div class="text-4xl text-gold mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="text-3xl font-bold text-primary mb-2">95%</div>
                        <div class="text-lg font-semibold text-secondary">Tingkat Penyerapan</div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 text-center transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-t-4 border-primary">
                        <div class="text-4xl text-gold mb-4">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="text-3xl font-bold text-primary mb-2">A</div>
                        <div class="text-lg font-semibold text-secondary">Akreditasi</div>
                    </div>
                </div>
            </div>

            <!-- History Section -->
            <div>
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-primary mb-4 relative inline-block after:content-[''] after:absolute after:-bottom-3 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-gold after:rounded">
                        Sejarah Singkat
                    </h2>
                    <p class="text-lg text-secondary max-w-3xl mx-auto">
                        SMK N 2 Siatas Barita didirikan pada tahun 1985 dengan tujuan untuk memenuhi kebutuhan tenaga terampil di daerah Siatas Barita dan sekitarnya. 
                        Selama lebih dari 35 tahun, kami telah berkontribusi dalam mencetak lulusan yang kompeten di bidangnya.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl shadow-card p-6 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-l-4 border-primary">
                        <div class="text-2xl font-bold text-primary mb-4 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-10 after:h-1 after:bg-gold after:rounded">
                            1985
                        </div>
                        <p class="text-secondary leading-relaxed">
                            SMK N 2 Siatas Barita didirikan dengan 3 program keahlian pertama: Teknik Mesin, Teknik Listrik, dan Teknik Bangunan.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-l-4 border-primary">
                        <div class="text-2xl font-bold text-primary mb-4 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-10 after:h-1 after:bg-gold after:rounded">
                            2000
                        </div>
                        <p class="text-secondary leading-relaxed">
                            Pengembangan program keahlian di bidang teknologi informasi dengan pembukaan jurusan Teknik Komputer dan Jaringan.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-l-4 border-primary">
                        <div class="text-2xl font-bold text-primary mb-4 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-10 after:h-1 after:bg-gold after:rounded">
                            2010
                        </div>
                        <p class="text-secondary leading-relaxed">
                            Memperoleh akreditasi A dari Badan Akreditasi Nasional Sekolah/Madrasah untuk semua program keahlian.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-2 border-l-4 border-primary">
                        <div class="text-2xl font-bold text-primary mb-4 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-10 after:h-1 after:bg-gold after:rounded">
                            2024
                        </div>
                        <p class="text-secondary leading-relaxed">
                            Memiliki 15 program keahlian dengan fasilitas modern dan kerjasama dengan lebih dari 50 perusahaan mitra.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation on scroll
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const animatedElements = document.querySelectorAll('.bg-white');
        animatedElements.forEach(el => observer.observe(el));

        // Counter animation
        const counters = document.querySelectorAll('.text-3xl.font-bold.text-primary');
        const speed = 200;
        const countUp = (counter) => {
            const target = +counter.innerText.replace(/\D/g, '');
            const count = +counter.innerText.replace(/\D/g, '');
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment) + (counter.innerText.includes('%') ? '%' : '+');
                setTimeout(() => countUp(counter), 10);
            } else {
                counter.innerText = target + (counter.innerText.includes('%') ? '%' : '+');
            }
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    countUp(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            if (counter.innerText.match(/\d/)) counterObserver.observe(counter);
        });
    });
</script>
@endsection
