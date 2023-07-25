<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KetIzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ket = [
            [
                'nama' => 'Sakit',
            ],
            [
                'nama' => 'Menikah',
            ],
        ];
        DB::table('ket_izins')->insert($ket);
    }
}
