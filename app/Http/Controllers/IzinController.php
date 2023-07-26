<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Absensi;
use App\Models\Keterangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function viewIzin(){
        if (Auth::guard('user')->user()->role == 1 || Auth::guard('user')->user()->role == 2) {
            return view('admin.izin.viewIzin',[
                'title' => 'Izin',
                'izin' => Izin::where('status', 'Pending')->get(),
            ]);
        } else {
            $id = auth()->id();
            $ket = Keterangan::all();
            return view('karyawan.izin.viewIzin', [
                'title' => 'Izin',
                'izin' => Izin::where('user_id', $id)->get(),
                'ket' => $ket,
            ]);
        }
    }

    public function simpanIzin(Request $request){
        $id = auth()->id();
        $request['user_id'] = $id;
        $data = $request->validate([
            'keterangan_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi bahwa yang diunggah adalah gambar dengan maksimal ukuran 2MB
            'user_id' => 'required',
            'tglIzin' => 'required',
        ], [
            'nama.required' => 'Keterangan Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'tglIzin.require' => 'Tanggal Wajib Diisi',
        ]);

        if ($file = $request->file('foto')) {
            $path = $file->store('public/izin'); // Simpan file gambar di direktori storage/app/public/uploads
            $data['fotoIzin'] = str_replace('public/', '', $path); // Simpan path relatif tanpa prefix 'public/' di database
        }
        Izin::create($data);
        return redirect()->back()->withToastSuccess('Data Berhasil Disimpan');
    }

    public function setujuIzin(Request $request,$id){
        $user_id = $request->user_id;
        $izin = Izin::find($id);
        $tglIzin = $izin->tglIzin;
        $absensi = Absensi::where('tglAbsen', $tglIzin)->where('user_id', $user_id)->first();
        if ($absensi == '') {
            Izin::find($id)->update(['status'=> 'Setuju']);
        }else{
            $absensi->delete();
            Izin::find($id)->update(['status'=> 'Setuju']);
        }
        return redirect()->back()->withToastSuccess('Izin Berhasil Disetujui');

    }
}
