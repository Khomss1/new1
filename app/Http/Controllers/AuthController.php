<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek login
        if (Auth::attempt($credentials)) {
            // Regenerasi session (keamanan)
            $request->session()->regenerate();

            // --- LOGIKA REDIRECT ADMIN VS BP ---
            
            // Jika Role ADMIN
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } 
            
            // Jika Role BP (Badan Publik)
            elseif (Auth::user()->role === 'bp') {
                return redirect()->route('bp.dashboard');
            }
        }

        // Jika gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    } // <--- TANDA KURUNG KURAWAL INI PENTING!

    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}