<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL; // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // FORCE HTTPS UNTUK SEMUA URL - Tambahkan ini
        if (env('APP_ENV') === 'production' || env('APP_ENV') === 'staging') {
            URL::forceScheme('https');
        }

        // View composer untuk layouts.admin
        View::composer('layouts.admin', function ($view) {
            $view->with([
                'totalSiswa' => \App\Models\Siswa::count(),
                'totalJurusan' => \App\Models\Jurusan::count(),
            ]);
        });
    }
}
