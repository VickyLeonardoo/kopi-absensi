<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Absensi;
use App\Models\Keterangan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function viewIzin(){
        if (Auth::guard('user')->user()->role == 1 || Auth::guard('user')->user()->role == 2) {
            return view('admin.izin.viewIzin',[
                'title' => 'Izin',
                'izin' => Izin::get(),
            ]);
        } else {
            $id = auth()->id();
            $ket = Keterangan::all();
            return view('karyawan.izin.viewIzin', [
                'title' => 'Izin',
                'izin' => Izin::where('user_id', $id)->get(),
                'ket' => $ket,
                'riwayat' => Izin::whereIn('status', ['Setuju', 'Ditolak'])
                ->where('user_id', $id)
                ->paginate(5),
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
            'keterangan_id.required' => 'Keterangan Wajib Diisi',
            'nama.required' => 'Keterangan Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'tglIzin.required' => 'Tanggal Wajib Diisi',
        ]);
        if ($file = $request->file('foto')) {
            $path = $file->store('public/izin'); // Simpan file gambar di direktori storage/app/public/uploads
            $data['fotoIzin'] = str_replace('public/', '', $path); // Simpan path relatif tanpa prefix 'public/' di database
        }
        //Cek Izin
        $cekIzin = Izin::where('tglIzin',$data['tglIzin'])->first();
        $carbonDate = Carbon::parse($data['tglIzin']);
        $formattedDate = $carbonDate->isoFormat('D MMMM Y');

        if ($cekIzin == True) {
            return redirect()->back()->withToastError('Anda sudah mengambil Cuti pada Tanggal '.$formattedDate);
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
        return redirect()->route('izin.home')->withToastSuccess('Izin Berhasil Disetujui');

    }

    public function tolakIzin(Request $request,$id){
        $user_id = $request->user_id;
        $izin = Izin::find($id);
        $izin->update([
            'status' => 'Ditolak'
        ]);
        return redirect()->route('izin.home')->withToastSuccess('Izin Berhasil Ditolak');

    }

    public function viewDetailIzin($id){
        $izin = Izin::findOrFail($id);
        return view('admin.izin.viewDetail',[
            'title' => 'View Detail Izin',
            'izin' => $izin
        ]);
    }
}
