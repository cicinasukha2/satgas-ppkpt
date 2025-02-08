<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Pastikan hanya role 1 dan 2 yang bisa melihat daftar user
        if (!in_array(Auth::user()->role_id, [1, 2])) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $users = User::all();
        return view('user.userList', compact('users'));
    }

    public function create()
    {
        // Hanya role 1 yang bisa menambah user
        if (Auth::user()->role_id != 1) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk menambah user.');
        }

        return view('user.userForm');
    }

    public function store(Request $request)
    {
        // Pastikan hanya role 1 yang bisa menambah user
        if (Auth::user()->role_id != 1) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk menambah user.');
        }

        $request->validate([
            'nama' => 'nullable|string|max:100',
            'nipn_nim' => 'required|string|max:50|unique:user,nipn_nim',
            'email' => 'required|string|email|max:100|unique:user,email',
            'password' => 'required|string|min:8',
            'kontak' => 'required|string|max:20',
            'role_id' => 'required|in:1,2,3',
        ]);

        User::create([
            'nama' => $request->nama,
            'nipn_nim' => $request->nipn_nim,
            'email' => $request->email,
            'password' => md5($request->password), // Hash dengan MD5
            'kontak' => $request->kontak,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Berhasil menambahkan user baru.');
    }

    public function edit(User $user)
    {
        // Hanya role 1 yang bisa mengedit user
        if (Auth::user()->role_id != 1) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk mengedit user.');
        }

        return view('user.userForm', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Hanya role 1 yang bisa mengedit user
        if (Auth::user()->role_id != 1) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui user.');
        }

        $request->validate([
            'name' => 'nullable|string|max:100',
            'nipn_nim' => 'required|string|max:50|unique:user,nipn_nim,' . $user->user_id . ',user_id',
            'email' => 'required|string|email|max:100|unique:user,email,' . $user->user_id . ',user_id',
            'password' => 'nullable|string|min:8',
            'kontak' => 'required|string|max:20',
            'role_id' => 'required|in:1,2',
        ]);

        $data = $request->only(['nama','nipn_nim', 'email', 'kontak', 'role_id']);

        if ($request->filled('password')) {
            $data['password'] = md5($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', "User {$user->nama} berhasil diperbarui.");
    }

    public function destroy(User $user)
    {
        // Hanya role 1 yang bisa menghapus user
        if (Auth::user()->role_id != 1) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk menghapus user.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', "User {$user->nama} berhasil dihapus.");
    }
}