@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="form">
                        <form action="{{ route('karyawan.simpan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Pegawai</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Pegawai" name="nama" value="{{ old('nama') }}">
                            </div>

                            <div class="form-group">
                                <label for="">Email Pegawai</label>
                                <input type="text" class="form-control" placeholder="Masukkan Email Pegawai" name="email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="">No Telp Pegawai</label>
                                <input type="text" class="form-control" placeholder="Masukkan No Telp Pegawai" name="noTelp" value="{{ old('noTelp') }}">
                            </div>

                            <div class="form-group">
                                <label for="">Outlet</label>
                                <select name="outlet_id" id="" class="form-control">
                                    @foreach ($outlet as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Simpan" class="form-control  btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection
