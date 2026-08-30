<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $validEmail    = config('app.admin_email',    env('ADMIN_EMAIL',    'admin@gmail.com'));
        $validPassword = config('app.admin_password', env('ADMIN_PASSWORD', 'password'));

        if ($request->email === $validEmail && $request->password === $validPassword) {
            $request->session()->put('admin_authenticated', true);
            $request->session()->put('admin_email', $request->email);
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang di Panel Administrasi.');
        }

        return back()->withInput()->with('error', 'Email atau password salah.');
    }

    public function showRegister()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:150',
            'password' => 'required|min:6|confirmed',
            'role'     => 'nullable|string',
        ]);

        // Auto authenticate newly registered user session
        $request->session()->put('admin_authenticated', true);
        $request->session()->put('admin_email', $request->email);
        $request->session()->put('admin_name', $request->name);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Akun berhasil didaftarkan dan Anda telah masuk sebagai Petugas Maintenance.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_authenticated', 'admin_email', 'admin_name']);
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar (Logged out).');
    }
}
