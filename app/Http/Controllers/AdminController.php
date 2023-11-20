<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request){

        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d'); //Ngambil Tanggal Sekarang
        $data_absen = Absensi::where('tglAbsen', $tglskrg); //mengambil semua data absensi berdasarkan tanggal yang sudah di deklarasi
        $tglFormat = Carbon::now()->isoFormat('dddd, D MMMM Y');
        return view('admin.viewHome',[
            'title' => 'Penkopi - Home',
            'karyawan' => User::where('role' , 3)->where('is_active','0')->count(),
            'outlet' => Outlet::where('is_active','0')->count(),
            'izin' => Izin::where('status','Pending')->count(),
            'data_absen' => $data_absen->get(),
            'tglFormat' => $tglFormat,
            'admin' => User::where('role','2')->where('is_active', '0')->count(),
        ]);
    }

    public function showProfile(){
        return view('admin.profile',[
            'title' => 'Profile'
        ]);
    }

    public function showPassword(){
        return view('admin.password',[
            'title' => 'Password'
        ]);
    }

    public function updateProfile(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'noTelp' => 'required'
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'noTelp.required' => 'No Telfon Wajib Diisi',
        ]);

        User::where('id',auth()->user()->id)->update($validatedData);
        return redirect()->back()->withToastSuccess('Data Profile Berhasil Diupdate');
    }

    public function updatePassword(Request $request){
        $idProfile = Auth()->user()->id;

        $this->validate($request, [
            'password_sekarang' => 'required',
            'password_baru' => 'required|min:8',
            'konfirmasi_password' => 'same:password_baru'
        ], [
            'password_sekarang.required' => 'Password Lama Wajib Diisi',
            'password_baru.required' => 'Password Baru Wajib Diisi',
            'password_baru.min' => 'Password Minimal 8 Karakter',
            'konfirmasi_password.same' => 'Password Tidak Sama',
        ]);

        $data = $request->all();
        $user = User::find(auth()->user()->id);
        // $user = Auth::guard('pelapor')->user()->id ;
        if (!Hash::check($data['password_sekarang'], $user->password)) {
            return redirect()->back()->withToastError('Kamu Salah Memasukkan Password Lama');
        } else {
            User::where('id', $idProfile)->update([
                'password' => bcrypt(Request()->password_baru)
            ]);

            return redirect()->back()->withToastSuccess('Password Berhasil Diganti.');
        }
    }


}
