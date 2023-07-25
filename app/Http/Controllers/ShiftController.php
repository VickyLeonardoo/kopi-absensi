<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function viewShift(){
        $shift = Shift::all();
        return view('admin.shift.viewShift',[
            'title' => 'Master Data Shift',
            'shift' => $shift,
        ]);
    }

    public function viewTambahData(){
        return view('admin.shift.viewTambahData',[
            'title' => 'Tambah Data Shift'
        ]);
    }

    public function simpanData(Request $request){
        $data = $request->validate([
            'jamMasuk' => 'required',
            'jamPulang' => 'required',
            'toleransi' => 'required'
        ],[
            'jamMasuk' => 'Jam Masuk Wajib Diisi',
            'jamPulang' => 'Jam Pulang Wajib Diisi',
            'toleransi' => 'Toleransi Wajib Diisi',
        ]);

        $data = request()->except(['_token']);
        Shift::create($data);
        return redirect()->route('shift.master')->withToastSuccess('Data Shift Berhasil Ditambahkan');
    }

    public function viewEdit($id){
        return view('admin.shift.viewEdit',[
            'title' => 'Edit Shift',
            'shift' => Shift::where('id',$id)->first(),
        ]);
    }

    public function updateData(Request $request,$id){
        $data = $request->validate([
            'jamMasuk' => 'required',
            'jamPulang' => 'required',
            'toleransi' => 'required'
        ],[
            'jamMasuk' => 'Jam Masuk Wajib Diisi',
            'jamPulang' => 'Jam Pulang Wajib Diisi',
            'toleransi' => 'Toleransi Wajib Diisi',
        ]);
        $data = request()->except(['_token']);
        Shift::where('id',$id)->update($data);
        return redirect()->route('shift.edit',$id)->withToastSuccess('Data Shift Berhasil Ditambahkan');
    }

    public function hapusData($id){
        Shift::where('id',$id)->delete();
        return redirect()->route('shift.master')->withToastSuccess('Data Shift Berhasil Dihapus');

    }
}
