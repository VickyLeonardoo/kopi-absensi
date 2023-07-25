<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutletController extends Controller
{
    public function viewOutlet(){

        return view('admin.outlet.viewOutlet',[
            'title' => 'Data Master Outlet',
            'outlets' => Outlet::get(),
            'slug' => '',
        ]);
    }

    public function viewTambahData(){
        return view('admin.outlet.viewTambahData',[
            'title' => 'Tambah Data',
            'slug' => '',
        ]);
    }

    public function simpanData(Request $request){
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi bahwa yang diunggah adalah gambar dengan maksimal ukuran 2MB
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);
        $str = strtolower($request->nama);
        $slug = preg_replace('/\s+/', '-', $str);
        if ($file = $request->file('foto')) {
            $path = $file->store('public/file'); // Simpan file gambar di direktori storage/app/public/uploads
            $data['foto'] = str_replace('public/', '', $path); // Simpan path relatif tanpa prefix 'public/' di database
        }

        $data['slug'] = $slug;
        Outlet::create($data);
        return redirect()->back()->withToastSuccess('Data Berhasil Disimpan');
    }


    public function viewEdit($slug){
        $outlet = Outlet::where('slug',$slug)->first();
        return view('admin.outlet.viewEdit',[
            'title' => 'Edit Outlet',
            'outlet' => $outlet,
            'slug' => $slug,
        ]);
    }

    public function updateData(Request $request, $slug)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional dengan maksimal ukuran 2MB
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $outlet = Outlet::where('slug', $slug)->firstOrFail();
        $str = strtolower(Request()->nama);
        $slug = preg_replace('/\s+/', '-', $str);
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'slug' => $slug,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            $this->hapusFotoLama($outlet);

            // Simpan foto baru
            $path = $request->file('foto')->store('public/file');
            $data['foto'] = str_replace('public/', '', $path); // Simpan path relatif tanpa prefix 'public/' di database
        }

        $outlet->update($data);
        return redirect()->route('outlet.edit', $slug)->withToastSuccess('Data Outlet Berhasil Diedit');
    }



    public function hapusData($slug){
        $outlet = Outlet::where('slug', $slug)->firstOrFail();
        $this->hapusFotoLama($outlet);

        $outlet->delete();

        return redirect()->route('outlet.master')->withToastSuccess('Data Outlet Berhasil Dihapus');

    }

    private function hapusFotoLama($outlet){
        if ($outlet->foto) {
            // Konversi path relatif menjadi path absolut menggunakan storage_path()
            $path = storage_path('app/public/' . $outlet->foto);

            // Hapus foto lama dari direktori penyimpanan
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

}
