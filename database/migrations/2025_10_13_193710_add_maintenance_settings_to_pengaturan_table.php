<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Insert maintenance settings
        DB::table('pengaturan')->insert([
            [
                'key_name' => 'maintenance_mode', 
                'value' => '0', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'key_name' => 'maintenance_message', 
                'value' => 'Sistem sedang dalam pemeliharaan. Silakan coba lagi beberapa saat lagi.', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'key_name' => 'maintenance_start', 
                'value' => now()->format('Y-m-d H:i:s'), 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'key_name' => 'maintenance_end', 
                'value' => now()->addHours(2)->format('Y-m-d H:i:s'), 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('pengaturan')
            ->whereIn('key_name', [
                'maintenance_mode',
                'maintenance_message', 
                'maintenance_start',
                'maintenance_end'
            ])
            ->delete();
    }
};