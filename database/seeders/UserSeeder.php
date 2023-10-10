<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = [
            [
                'nama' => 'Owner',
                'noTelp' => '081212',
                'email' => 'owner@example.com',
                'password' => bcrypt('12345'),
                'role' => '1',
                'outlet_id' => '1',
                'slug' => 'owner',
                'is_active' => 0
            ],
            [
                'nama' => 'Admin',
                'noTelp' => '081213',
                'email' => 'admin@example.com',
                'password' => bcrypt('12345'),
                'role' => '2',
                'outlet_id' => '1',
                'slug' => 'admin',
                'is_active' => 0

            ],
            [
                'nama' => 'Andi',
                'noTelp' => '0812143',
                'email' => 'Karyawan@example.com',
                'password' => bcrypt('12345'),
                'role' => '3',
                'outlet_id' => '2',
                'slug' => 'andi',
                'is_active' => 0

            ],
            [
                'nama' => 'Deni',
                'noTelp' => '0812142',
                'email' => 'Karyawan1@example.com',
                'password' => bcrypt('12345'),
                'role' => '3',
                'outlet_id' => '2',
                'slug' => 'deni',
                'is_active' => 0

            ],
            [
                'nama' => 'Roy',
                'noTelp' => '0812141',
                'email' => 'Karyawan2@example.com',
                'password' => bcrypt('12345'),
                'role' => '3',
                'outlet_id' => '2',
                'slug' => 'roy',
                'is_active' => 1

            ],

            // Tambahkan data outlet lainnya di sini
        ];

        // Masukkan data contoh ke dalam tabel outlets
        DB::table('users')->insert($user);
    }
}
