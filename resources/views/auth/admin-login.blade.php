@extends('layouts.app-tailwind')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-lock text-white text-xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Admin Login</h2>
                <p class="mt-2 text-gray-600">PPDB SMK N 2 Siatas Barita</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-700 font-medium">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                        placeholder="Masukkan username Anda"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                        placeholder="Masukkan password Anda"
                    >
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-primary text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 hover:bg-primary-dark hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login ke Sistem
                </button>
            </form>

            <!-- Back Link -->
            <div class="mt-6 text-center">
                <a 
                    href="/" 
                    class="inline-flex items-center text-primary font-medium hover:text-primary-dark transition-colors duration-300"
                >
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} SMK N 2 Siatas Barita. All rights reserved.
            </p>
        </div>
    </div>
</div>
@endsection