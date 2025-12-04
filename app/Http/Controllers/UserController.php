<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.home', ['mode' => 'login']);
    }

    public function showRegisterForm()
    {
        return view('auth.home', ['mode' => 'register']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Coba login
        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect ke /home setelah login berhasil
            return redirect()->route('assets.index');
        }

        // Kalau gagal → lempar error bahasa Indonesia
        throw ValidationException::withMessages([
            'username' => 'Username atau password yang kamu masukkan salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:50',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah digunakan, pilih yang lain.',
            'username.max'      => 'Username sudah tidak boleh lebih dari 50 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        // Buat user baru (otomatis admin)
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        // Auto login setelah daftar
        Auth::login($user);

        return redirect()->route('assets.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Kamu telah keluar dari sistem.');
    }

    public function profile()
{
    return view('profile.index');
}

public function editProfile()
{
    return view('profile.edit');
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'username' => [
            'required',
            'string',
            'max:50',
            Rule::unique('users')->ignore($user->id), // boleh sama kalau milik sendiri
        ],
        'password' => 'nullable|string|min:6|confirmed',
    ], [
        'name.required'     => 'Nama wajib diisi.',
        'username.required' => 'Username wajib diisi.',
        'username.unique'   => 'Username sudah digunakan orang lain.',
        'username.max'      => 'Username sudah tidak boleh lebih dari 50 karakter.',
        'password.min'      => 'Password minimal 6 karakter.',
        'password.confirmed'=> 'Konfirmasi password tidak cocok.',
    ]);

    $data = [
        'name'     => $request->name,
        'username' => $request->username,
    ];

    // Hanya update password jika diisi
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()
        ->route('profile.index')
        ->with('success', 'Profil berhasil diperbarui!');
}
}
