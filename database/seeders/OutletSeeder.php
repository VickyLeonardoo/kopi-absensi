<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $outlets = [
            [
                'nama' => 'Outlet A',
                'alamat' => 'Jl. Contoh No. 123',
                'foto' => 'uploads/959776b99b006e5785c3a3364949ce47.png',
                'slug' => 'outlet-a',
                'is_active' => '0'
            ],
            [
                'nama' => 'Outlet B',
                'alamat' => 'Jl. Contoh No. 456',
                'foto' => 'uploads/959776b99b006e5785c3a3364949ce47.png',
                'slug' => 'outlet-b',
                'is_active' => '0'
            ],
            [
                'nama' => 'Owner Admin',
                'alamat' => 'Jl. Contoh No. 456',
                'foto' => 'uploads/959776b99b006e5785c3a3364949ce47.png',
                'slug' => 'owner-admin',
                'is_active' => '1'
            ]
            // Tambahkan data outlet lainnya di sini
        ];

        // Masukkan data contoh ke dalam tabel outlets
        DB::table('outlets')->insert($outlets);
    }
}

