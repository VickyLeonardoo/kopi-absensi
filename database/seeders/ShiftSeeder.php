<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Contoh data untuk tabel shifts
        $shifts = [
            [
                'nama' => 'Pagi',
                'jamMasuk' => '08:00:00',
                'jamPulang' => '14:00:00',
                'toleransi' => '08:15:00',
            ],
            [
                'nama' => 'Malam',
                'jamMasuk' => '15:00:00',
                'jamPulang' => '20:00:00',
                'toleransi' => '20:15:00',

            ],
            // Tambahkan contoh data shift lainnya di sini
        ];

        // Masukkan data contoh ke dalam tabel shifts
        DB::table('shifts')->insert($shifts);
    }
}
