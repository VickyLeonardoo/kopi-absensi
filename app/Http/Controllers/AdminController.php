<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.viewHome',[
            'title' => 'Penkopi - Home',
            'karyawan' => User::where('role' , 3)->count(),
            'outlet' => Outlet::count(),
        ]);
    }
}
