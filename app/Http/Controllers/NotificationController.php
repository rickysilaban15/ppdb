<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            $notifications = Auth::guard('admin')->user()->notifications()->orderBy('created_at', 'desc')->paginate(20);
            return view('admin.notifications.index', compact('notifications'));
        } catch (\Exception $e) {
            // Jika tabel notifications belum ada, kirim array kosong
            return view('admin.notifications.index', ['notifications' => collect([])]);
        }
    }
    
    public function getNew()
    {
        try {
            $lastId = request()->input('last_id', 0);
            $notifications = Auth::guard('admin')->user()
                ->notifications()
                ->where('id', '>', $lastId)
                ->orderBy('created_at', 'desc')
                ->get();
                
            return response()->json([
                'notifications' => $notifications
            ]);
        } catch (\Exception $e) {
            // Jika tabel notifications belum ada, kirim array kosong
            return response()->json([
                'notifications' => []
            ]);
        }
    }
    
    public function markRead($id)
    {
        try {
            $notification = Auth::guard('admin')->user()
                ->notifications()
                ->findOrFail($id);
                
            $notification->markAsRead();
            
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan'
            ], 404);
        }
    }
    
    public function markAllRead()
    {
        try {
            Auth::guard('admin')->user()->unreadNotifications->markAsRead();
            
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai notifikasi sebagai dibaca'
            ], 500);
        }
    }

    public function getRecent()
{
    try {
        $notifications = Auth::guard('admin')->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->data['title'] ?? 'Notifikasi',
                    'message' => $notification->data['message'] ?? 'Tidak ada pesan',
                    'time' => $notification->created_at->diffForHumans(),
                    'read_at' => $notification->read_at
                ];
            });
            
        return response()->json([
            'notifications' => $notifications
        ]);
    } catch (\Exception $e) {
        // Jika tabel notifications belum ada, kirim array kosong
        return response()->json([
            'notifications' => []
        ]);
    }
}

public function getUnreadCount()
{
    try {
        $count = Auth::guard('admin')->user()
            ->unreadNotifications()
            ->count();
            
        return response()->json([
            'count' => $count
        ]);
    } catch (\Exception $e) {
        // Jika tabel notifications belum ada, kirim 0
        return response()->json([
            'count' => 0
        ]);
    }
}
}