<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use Exception;
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
        try {
            $keterangan = Keterangan::find($id);
            if ($keterangan) {
                $keterangan->delete();
                return redirect()->back()->withToastSuccess('Data Berhasil Dihapus.');
            } else {
                return redirect()->back()->withToastError('Data Tidak Ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withToastError('Data Tidak Dapat Dihapus. ');
        }
    }
    

   
    
}
