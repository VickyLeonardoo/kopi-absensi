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
            'email' => 'required',
            'password' => 'required', ]
        );

        $kredensil = $request->only('email','password');
        if (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role == '1') {
                return redirect()->route('admin.home')->withToastSuccess('Kamu Berhasil Masuk!');
            }else if($user->role == '2'){
                return redirect()->route('admin.home')->withToastSuccess('Kamu Berhasil Masuk!');
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
