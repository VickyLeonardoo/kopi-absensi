<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use App\Models\Outlet;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function viewKaryawan(){
        $karyawan = User::where('role','3')->get();
        return view('admin.karyawan.viewKaryawan',[
            'title' => 'View Karyawan',
            'karyawan' => $karyawan,

        ]);
    }

    public function viewTambahData(){
        return view('admin.karyawan.viewTambahData',[
            'title' => 'Tambah Data Karyawan',
            'outlet' => Outlet::all(),
        ]);
    }

    public function simpanData(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'noTelp' => 'required',
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'noTelp' => 'No Telp Wajib Diisi'
        ]);
        $str = strtolower($request->nama);
        $slug = preg_replace('/\s+/', '-', $str);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'noTelp' => $request->noTelp,
            'outlet_id' => $request->outlet_id,
            'role' => 3,
            'password' => bcrypt('12345'),
            'slug' => $slug,
        ];

        User::create($data);
        return redirect()->route('karyawan.master')->withToastSuccess('Data Berhasil Disimpan');
    }

    public function viewEdit($slug){
        $karyawan = User::where('slug',$slug)->first();
        return  view('admin.karyawan.viewEdit',[
            'title' => 'Edit Karyawan',
            'karyawan' => $karyawan,
            'outlet' => Outlet::all(),
        ]);
    }

    public function updateData(Request $request, $slug){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'noTelp' => 'required',
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'noTelp' => 'No Telp Wajib Diisi'
        ]);
        $str = strtolower($request->nama);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'noTelp' => $request->noTelp,
            'outlet_id' => $request->outlet_id,
            'role' => 3,
            'password' => bcrypt('12345'),
            'slug' =>preg_replace('/\s+/', '-', $str),
        ];
        User::where('slug',$slug)->update($data);
        return redirect()->route('karyawan.edit',$data['slug'])->withToastSuccess('Data Berhasil Diupdate');
    }

    public function resetPassword($slug){
        $data = [
            'password' => bcrypt('12345')
        ];

        User::where('slug',$slug)->update($data);
        return redirect()->back()->withToastSuccess('Password Berhasil Direset');
    }

    public function hapusData($slug){
        User::where('slug',$slug)->delete();
        return redirect()->back()->withToastSuccess('Pegawai Berhasil Dihapus');
    }

    public function viewMappingShift($slug){
        $karyawan =  User::where('slug',$slug)->first();
        $id = $karyawan->id;

        return view('admin.karyawan.viewMappingShift',[
            'title' => 'Mapping Shift',
            'shift' => Shift::all(),
            'karyawan' => User::where('slug',$slug)->first(),
            'absensi' => Absensi::where('user_id',$id)->get(),
        ]);
    }

    public function simpanMappingShift(Request $request, $slug){
        date_default_timezone_set('Asia/Jakarta');
        $karyawan = User::where('slug',$slug)->first();
        $id = $karyawan->id;
        $begin = new \DateTime($request["tglMulai"]);
        $end = new \DateTime($request["tglAkhir"]);
        $end = $end->modify('+1 day');

        $interval = new \DateInterval('P1D'); //referensi : https://en.wikipedia.org/wiki/ISO_8601#Durations
        $daterange = new \DatePeriod($begin, $interval ,$end);

        foreach ($daterange as $date) {
            $tanggal = $date->format("Y-m-d");
            $validatedData = $request->validate([
                'shift_id' => 'required',
                'tglMulai' => 'required',
                'tglAkhir' => 'required',
            ],
            [
                'shift_id.required' => 'Shift Wajib Diisi',
                'tglMulai.required' => 'Tanggal Mulai Wajib Diisi',
                'tglAkhir.required' => 'Tanggal Akhir Wajib Diisi',
            ]);
            $validatedData["user_id"] = $id;
            $validatedData["tglAbsen"] = $tanggal;

            Absensi::create($validatedData);
        }
        return redirect()->back()->withToastSuccess('Mapping Shift Berhasil Ditambahkan');
    }

    public function editProfile(){
        return view('karyawan.viewEditProfile',[
            'title' => ' View Profile'
        ]);
    }

    public function updateProfile(Request $request){
        $idProfile = Auth()->user()->id;
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'noTelp' => 'required',
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'noTelp.required' => 'No Hp Wajib Diisi',
        ]);

        User::where('id',$idProfile)->update($validatedData);
        return redirect()->back()->withToastSuccess('Data Berhasil Diupdate');
    }

    public function updatePassword(Request $request){
        $idProfile = Auth()->user()->id;

        $this->validate($request, [
            'password_lama' => 'required',
            'password' => 'required|min:8',
            'password_konfirmasi' => 'same:password'
        ], [
            'password_lama.required' => 'Password Lama Wajib Diisi',
            'password.required' => 'Password Bary Wajib Diisi',
            'password.min' => 'Password Minimal 8 Karakter',
            'password_konfirmasi.same' => 'Password Tidak Sama',
        ]);

        $data = $request->all();
        $user = User::find(auth()->user()->id);
        // $user = Auth::guard('pelapor')->user()->id ;
        if (!Hash::check($data['password_lama'], $user->password)) {
            return redirect()->back()->withToastError('Kamu Salah Memasukkan Password Lama');
        } else {
            User::where('id', $idProfile)->update([
                'password' => bcrypt(Request()->password)
            ]);

            return redirect()->back()->withToastSuccess('Password Berhasil Diganti.');
        }
    }


}
