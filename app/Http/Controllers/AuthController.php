<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================
    public function showLogin()
    {
        return view('login');
    }


    // =========================
    // PROSES LOGIN
    // =========================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {

            $request->session()->regenerate();

            $user = Auth::user();

            // ADMIN
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            // KARYAWAN
            if ($user->role === 'karyawan') {
                return redirect('/karyawan/dashboard');
            }

            // PELANGGAN
            if ($user->role === 'pelanggan') {
                return redirect('/dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();

            return redirect('/login')
                ->withErrors([
                    'email' => 'Role akun tidak dikenali.',
                ]);
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput();
    }


    // =========================
    // HALAMAN REGISTER
    // =========================
    public function showRegister()
    {
        return view('register');
    }


    // =========================
    // PROSES REGISTER
    // =========================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'no_hp' => 'required|string|max:20',

            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'password' => Hash::make($validated['password']),

            // Semua akun yang daftar melalui register
            // otomatis menjadi pelanggan
            'role' => 'pelanggan',
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan login menggunakan akun Anda.'
            );
    }


    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}