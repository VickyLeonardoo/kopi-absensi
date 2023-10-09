<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewLogin(){
        return view('auth.login');
    }

    public function prosesLogin(Request $request){
        request()->validate([
            'email' => 'required', // Required => Wajib Diisi
            'password' => 'required',
        ],
        [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi'
        ]
        );

        $kredensil = $request->only('email','password'); //Menyimpan Data Email dan Password

        if (Auth::guard('user')->attempt($kredensil)) { //Melakukan pengecekan tabel users apakah memiliki email dan password yang sama
            $user = Auth::guard('user')->user();
            if ($user->role == '1') {
                return redirect()->route('admin.home')->withToastSuccess('Kamu Berhasil Masuk!')->with('message','Berhasil');
            }else if($user->role == '2'){
                return redirect()->route('admin.home')->withToastSuccess('Kamu Berhasil Masuk!')->with('message','Selamat Datang!');
            }else if($user->role == '3'){
                return redirect()->route('pegawai.home')->withToastSuccess('Kamu Berhasil Masuk!');
            }
        }
        return redirect()->back()->withToastError('Login Gagal, Email atau Password Kamu Salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login')->withToastSuccess('Anda Berhasil Keluar!');
    }
}
