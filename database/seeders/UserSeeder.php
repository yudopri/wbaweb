<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk menambah data ke tabel users.
     *
     * @return void
     */
    public function run()
    {
        // Menambah data pengguna dengan status verifikasi true
        User::create([
            'name' => 'yudo',
            'email' => 'yudopri71@gmail.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),// Gunakan bcrypt untuk mengenkripsi password
            'verifikasi' => true, // Menandakan pengguna ini sudah terverifikasi
            'role' => 'head',
        ]);

        User::create([
            'name' => 'yl',
            'email' => 'e41230009@student.polije.ac.id',
            'password' => bcrypt('password123'), // Gunakan bcrypt untuk mengenkripsi password
            'email_verified_at' => now(),// Gunakan bcrypt untuk mengenkripsi password
            'verifikasi' => true, // Menandakan pengguna ini sudah terverifikasi
            'role' => 'karyawan',
        ]);
    }
}
