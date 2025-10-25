<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Hanya admin yang bisa akses
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return redirect('/dashboard')->with('error', 'Akses ditolak!');
            }
            return $next($request);
        });
    }

    // Tampilkan daftar user
    public function index()
    {
        $users = User::with('category')->paginate(10);
        return view('users.index', compact('users'));
    }

    // Tampilkan form create user
    public function create()
    {
        $categories = Category::where('type', 'jurusan')->get();
        return view('users.create', compact('categories'));
    }

    // Simpan user baru
    public function store(Request $request)
    {
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

    // Tampilkan form edit user
    public function edit(User $user)
    {
        $categories = Category::where('type', 'jurusan')->get();
        return view('users.edit', compact('user', 'categories'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:sarpras,toolman',
            'category_id' => 'required_if:role,toolman|exists:categories,id',
            'phone' => 'nullable|string|max:15',
            'is_active' => 'boolean',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect('/users')->with('success', 'User berhasil diperbarui!');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User berhasil dihapus!');
    }
}