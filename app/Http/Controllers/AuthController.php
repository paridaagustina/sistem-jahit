<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('login');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN EMAIL DAN PASSWORD
    |--------------------------------------------------------------------------
    */

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

            return $this->redirectByRole(Auth::user());
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput($request->only('email'));
    }

    /*
    |--------------------------------------------------------------------------
    | ARAHKAN PENGGUNA BERDASARKAN ROLE
    |--------------------------------------------------------------------------
    */

    private function redirectByRole(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'karyawan') {
            return redirect()->route('karyawan.dashboard');
        }

        if ($user->role === 'pelanggan') {
            return redirect()->route('dashboard');
        }

        Auth::logout();

        return redirect()->route('login')->withErrors([
            'email' => 'Role akun tidak dikenali.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ARAHKAN PENGGUNA KE GOOGLE
    |--------------------------------------------------------------------------
    */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /*
    |--------------------------------------------------------------------------
    | CALLBACK LOGIN GOOGLE
    |--------------------------------------------------------------------------
    */

        public function handleGoogleCallback(Request $request)
        {
            try {
                // Ambil informasi akun Google
                $googleUser = Socialite::driver('google')->user();

                // Informasi mentah dari respons Google
                $googleData = $googleUser->user;

                $email = $googleUser->getEmail();

                // Pastikan email tersedia dan sudah terverifikasi
                if (
                    empty($email) ||
                    !isset($googleData['verified_email']) ||
                    $googleData['verified_email'] !== true
                ) {
                    return redirect()->route('login')->withErrors([
                        'email' => 'Email Google tidak tersedia atau belum terverifikasi.',
                    ]);
                }

                // Cari akun yang sudah terdaftar di database JAITIN
                $user = User::whereRaw(
                    'LOWER(email) = ?',
                    [strtolower($email)]
                )->first();

                // Jangan membuat akun otomatis jika email belum terdaftar
                if (!$user) {
                    return redirect()->route('login')->withErrors([
                        'email' => 'Email Google belum terdaftar di JAITIN. Silakan registrasi terlebih dahulu.',
                    ]);
                }

                // Login menggunakan akun yang ditemukan
                Auth::login($user);

                // Perbarui session untuk keamanan
                $request->session()->regenerate();

                // Arahkan ke dashboard sesuai role
                return $this->redirectByRole($user);

            } catch (\Throwable $e) {
                // Simpan detail error ke log Laravel
                report($e);

                return redirect()->route('login')->withErrors([
                    'email' => 'Login Google gagal. Silakan coba kembali.',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HALAMAN REGISTRASI
        |--------------------------------------------------------------------------
        */

        public function showRegister()
        {
            return view('register');
        }

        /*
        |--------------------------------------------------------------------------
        | PROSES REGISTRASI PELANGGAN
        |--------------------------------------------------------------------------
        */

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
                'role' => 'pelanggan',
            ]);

            return redirect()->route('login')->with(
                'success',
                'Registrasi berhasil. Silakan login menggunakan akun Anda.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }
    }