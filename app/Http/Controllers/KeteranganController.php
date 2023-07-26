<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use Illuminate\Http\Request;

class KeteranganController extends Controller
{
    public function viewKet(){
        return view('admin.keterangan.viewKet',[
            'title' => 'Keterangan Izin',
            'ket' => Keterangan::all(),
        ]);
    }

    public function simpanData(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama Wajib Diisi'
        ]);
        Keterangan::create($validatedData);
        return redirect()->back()->withToastSuccess('Data Berhasil Disimpan.');
    }

    public function updateData(Request $request,$id){
        $validatedData = $request->validate([
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama Wajib Diisi'
        ]);

        Keterangan::find($id)->update($validatedData);
        return redirect()->back()->withToastSuccess('Data Berhasil Disimpan.');
    }

    public function hapusData($id){
        Keterangan::find($id)->delete();
        return redirect()->back()->withToastSuccess('Data Berhasil Dihapus.');
    }

}
