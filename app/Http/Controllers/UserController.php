<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function show($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Return the view with the user data
        return view('admin.user.show', compact('user'));
    }

    public function store(Request $request)
{
    // Validasi data yang masuk
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Menangani upload foto profil jika ada
    $imagePath = null;
    if ($request->hasFile('profile_picture')) {
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Menentukan status verifikasi berdasarkan checkbox
    $verifikasi = $request->has('verifikasi') ? true : false;

    // Jika email sudah diverifikasi, simpan waktu sekarang di kolom email_verified_at
    $emailVerifiedAt = $verifikasi ? now() : null;

    // Membuat user baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_picture' => $imagePath,
        'verifikasi' => $verifikasi, // Menyimpan status verifikasi
        'email_verified_at' => $emailVerifiedAt, // Menyimpan waktu verifikasi email
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
}



    public function edit($id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    // Validasi data yang masuk
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Menangani upload foto profil jika ada
    $imagePath = $user->profile_picture; // Pertahankan foto profil lama
    if ($request->hasFile('profile_picture')) {
        // Hapus foto profil lama jika ada
        if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // Upload foto profil baru
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Menentukan status verifikasi berdasarkan checkbox
    $verifikasi = $request->has('verifikasi') ? true : false;

    // Jika email sudah diverifikasi, simpan waktu sekarang di kolom email_verified_at
    $emailVerifiedAt = $verifikasi ? now() : null;
    // Update data user
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'profile_picture' => $imagePath,
        'verifikasi' => $verifikasi, // Update status verifikasi
        'email_verified_at' => $emailVerifiedAt,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
}

    public function destroy(User $user)
    {
        // Delete profile picture if it exists
        if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // Delete the user
        $user->delete();

        // Redirect with success message
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }
}
