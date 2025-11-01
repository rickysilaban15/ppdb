<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }

    public function dashboard()
    {
        // Data statis dulu tanpa model
        $data = [
            'totalSiswa' => 0,
            'siswaPending' => 0,
            'siswaLulus' => 0,
            'totalJurusan' => 18,
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Display the admin profile page.
     */
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Update the admin profile.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        $admin->nama_lengkap = $request->nama_lengkap;
        $admin->email = $request->email;
        $admin->username = $request->username;
        
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        
        $admin->save();
        
        return redirect()->route('admin.profile')->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Display the admin settings page.
     */
   public function settings()
{
    // Ambil data dari database, atau pakai default jika belum ada
    $pengaturan = Setting::first();

    if (!$pengaturan) {
        $pengaturan = [
            'nama_sekolah' => 'SMK N 2 Siatas Barita',
            'tahun_ajaran' => date('Y') . '/' . (date('Y') + 1),
            'tanggal_mulai' => date('Y-m-d'),
            'tanggal_selesai' => date('Y-m-d', strtotime('+1 month')),
            'alamat_sekolah' => 'Jl. Pendidikan No. 1, Siatas Barita, Tapanuli Utara',
            'telepon_sekolah' => '0812-3456-7890',
            'email_sekolah' => 'ppdb@smkn2siatasbarita.sch.id',
            'status_pendaftaran' => 'buka',
            'min_nilai' => 60,
            'max_mapel_rendah' => 2,
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_username' => '',
            'smtp_password' => '',
        ];
    }

    return view('admin.pengaturan.index', compact('pengaturan'));
}


    /**
     * Update the admin settings.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
            'email_ppdb' => 'required|string|email|max:255',
            'no_telp_ppdb' => 'required|string|max:20',
            'alamat_sekolah' => 'required|string',
        ]);
        
        // Update config file (simplified approach)
        // In production, you might want to store these in a database table
        
        // For now, we'll just flash a success message
        // In a real application, you would update the config file or database
        
return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil diperbarui');
    }

    /**
     * Get admin data for API requests.
     */
    public function getAdminData()
    {
        $admin = Auth::guard('admin')->user();
        
        return response()->json([
            'id' => $admin->id,
            'nama_lengkap' => $admin->nama_lengkap,
            'email' => $admin->email,
            'username' => $admin->username,
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($admin->nama_lengkap) . '&background=D4AF37&color=2C001E&size=150',
        ]);
    }

    
}