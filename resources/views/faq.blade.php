@extends('layouts.app-tailwind')

@section('title', 'FAQ - PPDB SMK Harapan Bangsa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-16">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-800 to-purple-700 text-white py-8 shadow-lg relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex items-center justify-center animate__animated animate__fadeInDown">
                <div class="bg-yellow-400 rounded-full p-4 shadow-lg mr-4">
                    <i class="fas fa-graduation-cap text-2xl text-blue-800"></i>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold font-playfair mb-2">Frequently Asked Questions</h1>
                    <p class="text-lg opacity-90">Pertanyaan yang Sering Diajukan - PPDB SMK Harapan Bangsa</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Content -->
    <div class="container mx-auto py-12 px-4">
        <!-- Categories -->
        <div class="flex flex-wrap justify-center gap-4 mb-12 animate__animated animate__fadeInUp">
            <button class="category-btn active bg-white border-2 border-yellow-400 text-blue-800 px-6 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-yellow-400 hover:shadow-lg transform hover:-translate-y-1" data-category="all">
                <i class="fas fa-layer-group mr-2"></i>Semua
            </button>
            <button class="category-btn bg-white border-2 border-yellow-400 text-blue-800 px-6 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-yellow-400 hover:shadow-lg transform hover:-translate-y-1" data-category="pendaftaran">
                <i class="fas fa-user-plus mr-2"></i>Pendaftaran
            </button>
            <button class="category-btn bg-white border-2 border-yellow-400 text-blue-800 px-6 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-yellow-400 hover:shadow-lg transform hover:-translate-y-1" data-category="seleksi">
                <i class="fas fa-tasks mr-2"></i>Seleksi
            </button>
            <button class="category-btn bg-white border-2 border-yellow-400 text-blue-800 px-6 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-yellow-400 hover:shadow-lg transform hover:-translate-y-1" data-category="biaya">
                <i class="fas fa-money-bill-wave mr-2"></i>Biaya
            </button>
            <button class="category-btn bg-white border-2 border-yellow-400 text-blue-800 px-6 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-yellow-400 hover:shadow-lg transform hover:-translate-y-1" data-category="akademik">
                <i class="fas fa-book mr-2"></i>Akademik
            </button>
        </div>

        <!-- FAQ Items -->
        <div class="max-w-6xl mx-auto">
            <div class="grid gap-6">
                @foreach($faqs as $index => $faq)
                <div class="faq-item bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-yellow-400 animate__animated animate__fadeInUp" 
                     data-category="{{ $faq['category'] ?? 'all' }}" 
                     style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="faq-question cursor-pointer p-6 flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-question-circle text-yellow-500 text-lg"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 pr-4">{{ $faq['question'] }}</h3>
                        </div>
                        <div class="faq-toggle w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center transition-all duration-300">
                            <i class="fas fa-chevron-down text-yellow-500 transition-transform duration-300"></i>
                        </div>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 max-h-0">
                        <div class="px-6 pb-6 pt-2 border-t border-gray-100">
                            <div class="prose prose-lg max-w-none">
                                <p class="text-gray-600 leading-relaxed">{!! nl2br(e($faq['answer'])) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Contact CTA Section -->
        <div class="max-w-4xl mx-auto mt-16 animate__animated animate__fadeInUp">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-2xl p-8 text-white text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-4 font-playfair">Masih Punya Pertanyaan?</h3>
                    <p class="text-lg mb-8 opacity-90">Tim kami siap membantu menjawab semua pertanyaan Anda</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('kontak') }}" 
                           class="bg-yellow-400 text-blue-800 px-8 py-4 rounded-full font-semibold hover:bg-yellow-300 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <i class="fas fa-phone-alt"></i>
                            <span>Hubungi Kami</span>
                        </a>
                        <a href="{{ route('pendaftaran.form') }}" 
                           class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Contact Info -->
        <div class="max-w-6xl mx-auto mt-12 grid md:grid-cols-3 gap-6 animate__animated animate__fadeInUp">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-blue-600 text-2xl"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">Telepon</h4>
                <p class="text-gray-600">(0623) 123-4567</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-green-600 text-2xl"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">Email</h4>
                <p class="text-gray-600">ppdb@smkharapanbangsa.sch.id</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-purple-600 text-2xl"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">Alamat</h4>
                <p class="text-gray-600">Jl. Pendidikan No. 123</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-to-top fixed bottom-8 right-8 w-12 h-12 bg-yellow-400 text-blue-800 rounded-full flex items-center justify-center shadow-lg cursor-pointer opacity-0 invisible transition-all duration-300 hover:bg-yellow-300 hover:shadow-xl transform hover:scale-110" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    .font-playfair {
        font-family: 'Playfair Display', serif;
    }

    .category-btn.active {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: white;
        border-color: #F59E0B;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
    }

    .faq-item.active {
        border-left-color: #3B82F6;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .faq-item.active .faq-toggle {
        background: #3B82F6;
        transform: rotate(180deg);
    }

    .faq-item.active .faq-toggle i {
        color: white;
    }

    .faq-item.active .faq-answer {
        max-height: 500px;
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }

    /* Smooth animations */
    .faq-answer {
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hover effects */
    .faq-question:hover {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.05), transparent);
    }

    /* Custom scrollbar for FAQ answers */
    .faq-answer-content::-webkit-scrollbar {
        width: 6px;
    }

    .faq-answer-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .faq-answer-content::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 3px;
    }

    .faq-answer-content::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    /* Gradient text for headings */
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Pulse animation for CTA */
    @keyframes pulse-gold {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(245, 158, 11, 0);
        }
    }

    .pulse-animation {
        animation: pulse-gold 2s infinite;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ Toggle Functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            
            question.addEventListener('click', () => {
                // Close other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-answer').style.maxHeight = '0';
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
                
                if (item.classList.contains('active')) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                } else {
                    answer.style.maxHeight = '0';
                }
            });
        });
        
        // Category Filter Functionality
        const categoryBtns = document.querySelectorAll('.category-btn');
        
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active button
                categoryBtns.forEach(otherBtn => {
                    otherBtn.classList.remove('active');
                });
                btn.classList.add('active');
                
                // Filter FAQ items
                const category = btn.getAttribute('data-category');
                
                faqItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (category === 'all' || itemCategory === category) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.classList.add('animate__animated', 'animate__fadeInUp');
                        }, 100);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Back to Top Button
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Intersection Observer for animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe all FAQ items and other elements
        const animatedElements = document.querySelectorAll('.faq-item, .category-btn, .bg-gradient-to-r');
        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Auto-open first FAQ item
        setTimeout(() => {
            if (faqItems.length > 0) {
                const firstItem = faqItems[0];
                const firstAnswer = firstItem.querySelector('.faq-answer');
                firstItem.classList.add('active');
                firstAnswer.style.maxHeight = firstAnswer.scrollHeight + 'px';
            }
        }, 1000);
    });

    // Add hover effects with GSAP-like smoothness
    function addSmoothHoverEffects() {
        const hoverElements = document.querySelectorAll('.faq-item, .category-btn, .bg-white');
        
        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            
            el.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }

    // Initialize hover effects
    document.addEventListener('DOMContentLoaded', addSmoothHoverEffects);
</script>
@endpush