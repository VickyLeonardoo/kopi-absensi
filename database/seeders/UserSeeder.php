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
            ],
            [
                'nama' => 'Admin',
                'noTelp' => '081213',
                'email' => 'admin@example.com',
                'password' => bcrypt('12345'),
                'role' => '2',
                'outlet_id' => '1',
                'slug' => 'admin'

            ],
            [
                'nama' => 'Andi',
                'noTelp' => '0812143',
                'email' => 'Karyawan@example.com',
                'password' => bcrypt('12345'),
                'role' => '3',
                'outlet_id' => '2',
                'slug' => 'andi'

            ],
            [
                'nama' => 'Deni',
                'noTelp' => '0812142',
                'email' => 'Karyawan1@example.com',
                'password' => bcrypt('12345'),
                'role' => '3',
                'outlet_id' => '2',
                'slug' => 'deni'

            ],
            [
                'nama' => 'Roy',
                'noTelp' => '0812141',
                'email' => 'Karyawan2@example.com',
                'password' => bcrypt('12345'),
                'role' => '3',
                'outlet_id' => '2',
                'slug' => 'roy'

            ],

            // Tambahkan data outlet lainnya di sini
        ];

        // Masukkan data contoh ke dalam tabel outlets
        DB::table('users')->insert($user);
    }
}
