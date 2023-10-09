@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="form">
                        <form action="{{ route('karyawan.update',$karyawan->slug) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Pegawai</label>
                                <input type="text" class="form-control" name="nama" value="{{ $karyawan->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email Pegawai</label>
                                <input type="text" class="form-control" name="email" value="{{ $karyawan->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">No Telp Pegawai</label>
                                <input type="text" class="form-control" name="noTelp" value="{{ $karyawan->noTelp }}">
                            </div>
                            <div class="form-group">
                                <label for="">Outlet</label>
                                <select name="outlet_id" id="" class="form-control">
                                    {{-- <option value="{{ $karyawan->outlet_id }}">{{ $karyawan->outlet->nama }} - {{ $karyawan->outlet->alamat }}</option>
                                    <option value="" disabled>----</option> --}}
                                    @foreach ($outlet as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $karyawan->outlet_id ? 'selected':''}}>{{ $data->nama }} - {{ $karyawan->outlet->alamat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn-primary form-control" value="SIMPAN">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection
