<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){

        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d');
        $data_absen = Absensi::where('tglAbsen', $tglskrg);

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["user_id"] && $request["mulai"] && $request["akhir"]) {
            $data_absen = Absensi::where('user_id', $request["user_id"])->whereBetween('tglAbsen', [$request["mulai"], $request["akhir"]]);
        }

        return view('admin.viewHome',[
            'title' => 'Penkopi - Home',
            'karyawan' => User::where('role' , 3)->count(),
            'outlet' => Outlet::count(),
            'alfa' => Absensi::where('tglAbsen', $tglskrg)->where('status', 'Tidak Hadir')->count(),
            'izin' => Izin::where('status','Pending')->count(),
            'user' => User::where('role', '3')->get(),
            'data_absen' => $data_absen->get()

        ]);
    }
}
