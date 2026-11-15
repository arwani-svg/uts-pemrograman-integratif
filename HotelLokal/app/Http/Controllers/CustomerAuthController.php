<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    // Tampilkan form login customer
    public function showLogin()
    {
        return view('hotellocal.auth.login');
    }

    // Proses login customer
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Berhasil masuk ke akun HotelLokal!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // Tampilkan form register customer
    public function showRegister()
    {
        return view('hotellocal.auth.register');
    }

    // Proses register customer baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Akun berhasil dibuat dan otomatis masuk!');
    }

    // Logout customer
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil keluar dari akun.');
    }
}