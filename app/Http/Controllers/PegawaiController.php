<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index(){
        $user_login = Auth::guard('user')->user()->id;
        $tanggal = "";
            $tglskrg = date('Y-m-d');
            $tglkmrn = date('Y-m-d', strtotime('-1 days'));
            $mapping_shift = Absensi::where('user_id', $user_login)->where('tglAbsen', $tglkmrn)->get();
            if($mapping_shift->count() > 0) {
                foreach($mapping_shift as $mp) {
                    $jam_absen = $mp->jam_absen;
                    $jam_pulang = $mp->jam_pulang;
                }
            } else {
                $jam_absen = "-";
                $jam_pulang = "-";
            }
            if($jam_absen != null && $jam_pulang == null) {
                $tanggal = $tglkmrn;
            } else {
                $tanggal = $tglskrg;
            }
        $karyawan = User::where('role','3')->get();
        return view('karyawan.viewHome',[
            'title' => 'View Karyawan',
            'karyawan' => $karyawan,
            'shift_karyawan' => Absensi::where('user_id', $user_login)->where('tglAbsen', $tanggal)->get()
        ]);
    }
}