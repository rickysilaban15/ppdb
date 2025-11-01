<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahkan ini

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
    public function boot(): void // Hapus duplikat & tambahkan :void
    {
        View::composer('layouts.admin', function ($view) {
            $view->with([
                'totalSiswa' => \App\Models\Siswa::count(),
                'totalJurusan' => \App\Models\Jurusan::count(),
            ]);
        });
    }
}