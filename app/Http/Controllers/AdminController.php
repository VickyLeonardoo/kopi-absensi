<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg = date("Y-m-d");

        return view('admin.viewHome',[
            'title' => 'Penkopi - Home',
            'karyawan' => User::where('role' , 3)->count(),
            'outlet' => Outlet::count(),
            'alfa' => Absensi::where('tglAbsen', $tgl_skrg)->where('status', 'Tidak Hadir')->count(),
            'izin' => Izin::where('status','Pending')->count(),
        ]);
    }
}
