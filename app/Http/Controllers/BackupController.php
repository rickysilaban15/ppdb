<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class BackupController extends Controller
{
    public function index()
    {
        // Get existing backup files
        $backupFiles = [];
        $totalSize = 0;
        $lastBackup = null;

        if (Storage::exists('backups')) {
            $backupFiles = Storage::files('backups');
            
            // Calculate total size
            foreach ($backupFiles as $file) {
                $totalSize += Storage::size($file);
            }
            
            // Get last backup date
            if (count($backupFiles) > 0) {
                $lastFile = $backupFiles[count($backupFiles) - 1];
                $lastBackup = date('d M Y H:i', Storage::lastModified($lastFile));
            }
            
            // Format total size
            $totalSize = $this->formatFileSize($totalSize);
        } else {
            $totalSize = '0 Bytes';
        }

        return view('admin.backup.index', compact('backupFiles', 'totalSize', 'lastBackup'));
    }
    
    public function createBackup(Request $request)
    {
        try {
            $backupName = $request->input('backup_name', '');
            $backupType = $request->input('backup_type', 'full');
            
            // Ensure directory exists
            if (!Storage::exists('backups')) {
                Storage::makeDirectory('backups');
            }
            
            $timestamp = date('Y-m-d_His');
            $nameSuffix = $backupName ? '_' . Str::slug($backupName) : '';
            $filename = "backup_{$timestamp}{$nameSuffix}.sql";
            
            // Get all tables
            $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
            
            $backupContent = "-- PPDB SMK N 2 Siatas Barita Backup\n";
            $backupContent .= "-- Created: " . date('Y-m-d H:i:s') . "\n";
            $backupContent .= "-- Type: " . $backupType . "\n";
            $backupContent .= "-- Name: " . ($backupName ?: 'Auto Backup') . "\n\n";
            
            foreach ($tables as $table) {
                $tableName = $table->name;
                
                $backupContent .= "\n\n-- Table: $tableName\n";
                $backupContent .= "DROP TABLE IF EXISTS `$tableName`;\n";
                
                // Get table structure
                $createTable = DB::select("SELECT sql FROM sqlite_master WHERE type='table' AND name='$tableName'")[0];
                $backupContent .= $createTable->sql . ";\n\n";
                
                // Backup data
                $rows = DB::table($tableName)->get();
                if ($rows->count() > 0) {
                    $backupContent .= "-- Data for table: $tableName (" . $rows->count() . " rows)\n";
                    
                    foreach ($rows as $row) {
                        $columns = implode("`, `", array_keys((array)$row));
                        $values = implode("', '", array_map(function($value) {
                            if ($value === null) return 'NULL';
                            // Escape single quotes for SQL
                            return str_replace("'", "''", $value);
                        }, array_values((array)$row)));
                        
                        $backupContent .= "INSERT INTO `$tableName` (`$columns`) VALUES ('$values');\n";
                    }
                }
            }
            
            Storage::put('backups/' . $filename, $backupContent);
            
            return back()->with('success', 'Backup database berhasil dibuat: ' . $filename);
            
        } catch (\Exception $e) {
            \Log::error('Backup error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }
    
    public function downloadBackup($filename)
    {
        $filePath = 'backups/' . $filename;
        
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
        
        return back()->with('error', 'File backup tidak ditemukan');
    }
    
    public function deleteBackup($filename)
    {
        $filePath = 'backups/' . $filename;
        
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return back()->with('success', 'Backup berhasil dihapus');
        }
        
        return back()->with('error', 'File backup tidak ditemukan');
    }
    
    private function formatFileSize($bytes)
    {
        if ($bytes === 0) return '0 Bytes';
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes) / log($k));
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }
}