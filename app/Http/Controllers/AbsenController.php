<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsenController extends Controller
{
    public function viewDataAbsen(Request $request){

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

        return view('admin.absensi.viewDataAbsensi',[
            'title' => 'Data Absensi',
            'user' => User::where('role', '3')->get(),
            'data_absen' => $data_absen->get()
        ]);
    }

    public function viewAbsen(){
        $user_login = Auth::guard('user')->user()->id;
        $tanggal = "";
        $tglskrg = date('Y-m-d');
        $tglkmrn = date('Y-m-d', strtotime('-1 days'));
        $mapping_shift = Absensi::where('user_id', $user_login)->where('tglAbsen', $tglkmrn)->get();
        if($mapping_shift->count() > 0) {
            foreach($mapping_shift as $mp) {
                $jam_absen = $mp->jamIn;
                $jam_pulang = $mp->jamOut;
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
        return view('karyawan.absensi.viewAbsensi',[
            'title' => 'Absensi',
            'shift_karyawan' => Absensi::where('user_id', $user_login)->where('tglAbsen', $tanggal)->get(),
        ]);
    }


    public function jamMasuk(Request $request, $id){
        date_default_timezone_set('Asia/Jakarta');

        $request["jamIn"] = date('H:i');
        $foto = $request["fotoMasuk"];

        $image_parts = explode(";base64,", $foto);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'public/foto_jam_absen/' . uniqid() . '.jpeg';
        Storage::put($fileName, $image_base64);
        $request["fotoMasuk"] = str_replace('public/', '', $fileName);
        $request["status"] = "Pending";
        $mapping_shift = Absensi::where('id', $id)->get();

        foreach ($mapping_shift as $mp) {
            $shift = $mp->shift->toleransi;
            $tanggal = $mp->tglAbsen;
        }

        $tgl_skrg = date("Y-m-d");

        $awal  = strtotime($tanggal . $shift);
        $akhir = strtotime($tgl_skrg . $request["jamIn"]);
        $diff  = $akhir - $awal;
        if ($diff <= 0) {
            $request["telat"] = 0;
        } else {
            $request["telat"] = $diff;
        }
        $validatedData = $request->validate([
            'jamIn' => 'required',
            'fotoMasuk' => 'required',
            'status' => 'required',
            'telat' => 'required',
        ]);

        Absensi::where('id', $id)->update($validatedData);
        return redirect()->back()->withToastSuccess('Berhasil Absen Masuk');
    }

    public function jamPulang(Request $request, $id){
        date_default_timezone_set('Asia/Jakarta');

        $request["jamOut"] = date('H:i');
        $foto = $request["fotoPulang"];
        $image_parts = explode(";base64,", $foto);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'public/foto_jam_pulang/' . uniqid() . '.jpeg';
        Storage::put($fileName, $image_base64);
        $request["fotoPulang"] = str_replace('public/', '', $fileName);
        $mapping_shift = Absensi::where('id', $id)->get();

        foreach ($mapping_shift as $mp) {
            $shiftmasuk = $mp->shift->jamMasuk;
            $shiftpulang = $mp->shift->jamPulang;
            $tanggal = $mp->tglAbsen;
        }
        $new_tanggal = "";
        $timeMasuk = strtotime($shiftmasuk);
        $timePulang = strtotime($shiftpulang);


        if ($timePulang < $timeMasuk) {
            $new_tanggal = date('Y-m-d', strtotime('+1 days', strtotime($tanggal)));
        } else {
            $new_tanggal = $tanggal;
        }

        $tgl_skrg = date("Y-m-d");

        $akhir = strtotime($new_tanggal . $shiftpulang);
        $awal  = strtotime($tgl_skrg . $request["jamOut"]);
        $diff  = $akhir - $awal;

        if ($diff <= 0) {
            $request["pulangCepat"] = 0;
        } else {
            $request["pulangCepat"] = $diff;
        }

        $validatedData = $request->validate([
            'jamOut' => 'required',
            'fotoPulang' => 'required',
            'pulangCepat' => 'required',
        ]);

        Absensi::where('id', $id)->update($validatedData);
        return redirect()->back()->withToastSuccess('Berhasil Absen Pulang');
    }

    public function konfirmasiAbsen(Request $request, $id){
        $absensi = Absensi::find($id);
        $user = User::find($request->user_id);
        if ($request->status == 'Hadir') {
            if ($absensi->status != 'Hadir') {
                $absensi->update(['status' => 'Hadir']);
                return redirect()->back()->withToastSuccess('Berhasil Konfirmasi Kehadiran '.$user->nama);
            }else{
                return redirect()->back()->with('toast_warning',$user->nama.' Sudah Dikonfirmasi');
            }
        }else{
            $absensi->update(['status' => 'Ditolak']);
            return redirect()->back()->withToastSuccess('Berhasil Konfirmasi Kehadiran '.$user->nama);
        }
    }

    public function viewUpload(){
        $user_login = Auth::guard('user')->user()->id;
        $tanggal = "";
        $tglskrg = date('Y-m-d');
        $tglkmrn = date('Y-m-d', strtotime('-1 days'));
        $mapping_shift = Absensi::where('user_id', $user_login)->where('tglAbsen', $tglkmrn)->get();
        return view('karyawan.absensi.viewUpload',[
            'title' => 'Absensi',
            'shift_karyawan' => Absensi::where('user_id', $user_login)->where('tglAbsen', $tglskrg)->get(),
        ]);
    }

    public function uploadFoto(Request $request, $id){
        $absensi = Absensi::find($id);
        $this->hapusFotoLama($absensi);
        $foto = $request["fotoMasuk"];
        $image_parts = explode(";base64,", $foto);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'public/foto_jam_absen/' . uniqid() . '.jpeg';
        Storage::put($fileName, $image_base64);
        $request["fotoMasuk"] = str_replace('public/', '', $fileName);
        $request["status"] = "Pending";
        $validatedData = $request->validate([
            'fotoMasuk' => 'required',
            'status' => 'required',
        ]);

        Absensi::where('id', $id)->update($validatedData);
        return redirect()->back()->withToastSuccess('Berhasil Update Foto Absen Masuk');
    }

    private function hapusFotoLama($absensi){
        if ($absensi->fotoMasuk) {
            // Konversi path relatif menjadi path absolut menggunakan storage_path()
            $path = storage_path('app/public/' . $absensi->fotoMasuk);

            // Hapus foto lama dari direktori penyimpanan
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

}
