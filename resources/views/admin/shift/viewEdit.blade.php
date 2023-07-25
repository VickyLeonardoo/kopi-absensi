@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="form">
                        <form action="{{ route('shift.update',$shift->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Jam Masuk</label>
                                <input type="time" class="form-control" placeholder="Masukkan Nama Outlet" name="jamMasuk" value="{{ $shift->jamMasuk }}">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Pulang</label>
                                <input type="time" class="form-control" placeholder="Masukkan Alamat Outlet" name="jamPulang" value="{{ $shift->jamPulang }}">
                            </div>
                            <div class="form-group">
                                <label for="">Toleransi</label>
                                <input type="time" class="form-control" name="toleransi" value="{{ $shift->toleransi }}" required>
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
