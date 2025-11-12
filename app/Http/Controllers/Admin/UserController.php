<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,vendor,customer',
        ]);

        // 🔹 Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // 🔹 Jika user dibuat sebagai vendor, otomatis buat toko
        if ($user->role === 'vendor') {
            Shop::create([
                'user_id' => $user->id,
                'name' => 'Toko ' . $user->name,
                'description' => 'Toko milik ' . $user->name,
                'status' => 'approved', // bisa diubah ke 'pending' kalau butuh verifikasi admin
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,vendor,customer',
        ]);

        $user = User::findOrFail($id);
        $user->update(['role' => $request->role]);

        // 🔹 Jika role diubah menjadi vendor dan belum punya toko, buat otomatis
        if ($user->role === 'vendor' && !$user->shop) {
            Shop::create([
                'user_id' => $user->id,
                'name' => 'Toko ' . $user->name,
                'description' => 'Toko milik ' . $user->name,
                'status' => 'approved',
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Role pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
