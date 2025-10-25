<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan form register (hanya untuk admin)
    public function showRegister()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/login');
        }

        return view('auth.register');
    }

    // Proses register user baru (hanya admin)
    public function register(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:sarpras,toolman',
            'category_id' => 'required_if:role,toolman|exists:categories,id',
            'phone' => 'nullable|string|max:15',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/users')->with('success', 'User berhasil ditambahkan!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}