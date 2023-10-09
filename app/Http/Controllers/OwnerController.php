<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function viewAdmin(){
        return view('owner.viewAdmin',[
            'title' => 'Data Admin',
            'admins' => User::where('role','2')->paginate(10),
        ]);
    }

    public function viewTambah(){
        return view('owner.tambahAdmin',[
            'title' => 'Tambah Admin'
        ]);
    }

    public function simpanAdmin(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|unique:users,email',
            'noTelp' => 'required'
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'noTelp.required' => 'No Telpon Wajib Diisi',
            'nama.string' => 'Nama Tidak Boleh Ada Karakter Khusus',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Ada, Silahkan Ganti'
        ]);
        $str = strtolower($request->nama);
        $slug = preg_replace('/\s+/', '-', $str);
        $validatedData['slug'] = $slug;
        $validatedData['outlet_id'] = 1;
        $validatedData['role'] = 2;
        $validatedData['password'] = bcrypt('12345');

        User::create($validatedData);
        return redirect()->route('owner.admin')->withToastSuccess('Data Admin Berhasil Ditambahkan');
    }

    public function viewEditAdmin($id){
        $admin = User::findOrFail($id);
        return view('owner.editAdmin',[
            'title' => 'Edit Admin',
            'admin' => $admin,
        ]);
    }

    public function updateAdmin(Request $request, $id){
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'noTelp' => 'required',
            'email' => 'required'
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'noTelp.required' => 'No Telpon Wajib Diisi',
            'nama.string' => 'Nama Tidak Boleh Ada Karakter Khusus',
            'email.required' => 'Email Wajib Diisi',
        ]);

        User::where('id',$id)->update($validatedData);
        return redirect()->back()->withToastSuccess('Data Berhasil Diupdate');
    }

    public function hapusAdmin($id){
        $user = User::findOrFail($id);
        $name = $user->nama;
        $user->delete();
        return redirect()->route('owner.admin')->withToastSuccess('Admin'.' '.$name.' '.'Berhasil Dihapus');
    }
}
