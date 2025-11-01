<?php
namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Hapus admin lama jika ada
        Admin::truncate();

        // Buat admin baru dengan password yang benar
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@smkn2siatasbarita.sch.id',
            'password' => Hash::make('admin123'),
            'nama_lengkap' => 'Administrator Sistem PPDB',
        ]);

        $this->command->info('Admin user created:');
        $this->command->info('Username: admin');
        $this->command->info('Password: admin123');
    }
}