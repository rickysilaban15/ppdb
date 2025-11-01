<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';
    protected $fillable = ['key_name', 'value'];
    public $timestamps = true;

    /**
     * Get setting value with caching
     */
    public static function getValue($key, $default = null)
    {
        return Cache::remember("pengaturan.{$key}", 3600, function () use ($key, $default) {
            $pengaturan = self::where('key_name', $key)->first();
            return $pengaturan ? $pengaturan->value : $default;
        });
    }

    /**
     * Set setting value with cache invalidation
     */
    public static function setValue($key, $value)
    {
        $pengaturan = self::updateOrCreate(
            ['key_name' => $key],
            ['value' => $value]
        );

        // Clear cache for this key
        Cache::forget("pengaturan.{$key}");

        return $pengaturan;
    }

    /**
     * Get all settings as array
     */
    public static function getAll()
    {
        return Cache::remember('pengaturan.all', 3600, function () {
            return self::pluck('value', 'key_name')->toArray();
        });
    }

    /**
     * Check if maintenance mode is enabled
     */
    public static function isMaintenanceMode()
    {
        // First check if table exists
        if (!Schema::hasTable('pengaturan')) {
            return false;
        }

        return self::getValue('maintenance_mode', '0') === '1';
    }

    /**
     * Get maintenance message
     */
    public static function getMaintenanceMessage()
    {
        if (!Schema::hasTable('pengaturan')) {
            return 'Sistem sedang dalam pemeliharaan. Silakan coba lagi beberapa saat lagi.';
        }

        return self::getValue('maintenance_message', 'Sistem sedang dalam pemeliharaan. Silakan coba lagi beberapa saat lagi.');
    }

    /**
     * Get maintenance schedule
     */
    public static function getMaintenanceSchedule()
    {
        if (!Schema::hasTable('pengaturan')) {
            return [
                'start' => now()->format('Y-m-d H:i:s'),
                'end' => now()->addHours(2)->format('Y-m-d H:i:s')
            ];
        }

        return [
            'start' => self::getValue('maintenance_start', now()->format('Y-m-d H:i:s')),
            'end' => self::getValue('maintenance_end', now()->addHours(2)->format('Y-m-d H:i:s'))
        ];
    }

    /**
     * Check if table exists (for error handling)
     */
    public static function tableExists()
    {
        return Schema::hasTable('pengaturan');
    }

    /**
     * Create table if not exists (for emergency)
     */
    public static function createTableIfNotExists()
    {
        if (!self::tableExists()) {
            Schema::create('pengaturan', function ($table) {
                $table->id();
                $table->string('key_name')->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            });
            
            // Insert default settings
            self::insertDefaultSettings();
            
            return true;
        }
        
        return false;
    }

    /**
     * Insert default settings
     */
    private static function insertDefaultSettings()
    {
        $defaultSettings = [
            ['key_name' => 'nama_sekolah', 'value' => 'SMK N 2 Siatas Barita'],
            ['key_name' => 'alamat_sekolah', 'value' => 'Jl. Pendidikan No. 123, Siatas Barita'],
            ['key_name' => 'telepon_sekolah', 'value' => '(0621) 12345'],
            ['key_name' => 'email_sekolah', 'value' => 'info@smkn2siatasbarita.sch.id'],
            ['key_name' => 'tahun_ajaran', 'value' => '2024/2025'],
            ['key_name' => 'tanggal_mulai', 'value' => date('Y-m-d')],
            ['key_name' => 'tanggal_selesai', 'value' => date('Y-m-d', strtotime('+30 days'))],
            ['key_name' => 'status_pendaftaran', 'value' => 'buka'],
            ['key_name' => 'min_nilai', 'value' => '75'],
            ['key_name' => 'max_mapel_rendah', 'value' => '3'],
            ['key_name' => 'smtp_host', 'value' => ''],
            ['key_name' => 'smtp_port', 'value' => '587'],
            ['key_name' => 'smtp_username', 'value' => ''],
            ['key_name' => 'smtp_password', 'value' => ''],
            ['key_name' => 'maintenance_mode', 'value' => '0'],
            ['key_name' => 'maintenance_message', 'value' => 'Sistem sedang dalam pemeliharaan. Silakan coba lagi beberapa saat lagi.'],
            ['key_name' => 'maintenance_start', 'value' => now()->format('Y-m-d H:i:s')],
            ['key_name' => 'maintenance_end', 'value' => now()->addHours(2)->format('Y-m-d H:i:s')],
        ];

        foreach ($defaultSettings as $setting) {
            self::create($setting);
        }
    }
}