<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'role_id' => 1,
                'nama' => 'Admin Satgas',
                'email' => 'admin@satgas.com',
                'nipn_nim' => 'NIP123456',
                'kontak' => '081234567890',
                'password' => md5('password123'), // Menggunakan MD5 (sebaiknya pakai bcrypt)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'nama' => 'Ketua Satgas',
                'email' => 'ketua@satgas.com',
                'nipn_nim' => 'NIP654321',
                'kontak' => '081298765432',
                'password' => md5('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3,
                'nama' => 'Pelapor Umum',
                'email' => 'pelapor@satgas.com',
                'nipn_nim' => 215410035,
                'kontak' => '081212341234',
                'password' => md5('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
