<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 🔹 Tampilkan daftar semua user
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 🔹 Edit role user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 🔹 Update role user
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,vendor,customer',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Role pengguna berhasil diperbarui.');
    }

    // 🔹 Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
