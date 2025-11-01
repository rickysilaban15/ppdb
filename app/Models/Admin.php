<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'admin';
    
    protected $fillable = [
        'nama_lengkap', 'email',    'username', 'password',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
    
    public function unreadNotifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->whereNull('read_at')->orderBy('created_at', 'desc');
    }
}