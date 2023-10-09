@extends('partials.admin.header')
@section('content')
<section class="content ml-5 mr-5">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body box-profile">
                <div class="text-left" style="font-size: 30px; font-weight:bold;">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('asset') }}/dist/img/user4.jpg " alt="User profile picture">
                        &nbsp;&nbsp;&nbsp;&nbsp;Admin <br>
                </div>
                <br>
                <br>
                <div class="col-md-6">
                    <h4><b>Password</b></h4>
                </div>
                <br>
                <br>
                <form action="/admin/update-password" method="POST">
                    @csrf
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="">Password Sekarang</label>
                        <input type="password" class="form-control" style="background-color: #d9d9d9" name="password_sekarang">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="">Password Baru</label>
                        <input type="password" class="form-control" style="background-color: #d9d9d9" name="password_baru">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="">Konfirmasi Password</label>
                        <input type="password" class="form-control" style="background-color: #d9d9d9" name="konfirmasi_password">
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
</section>
@endsection
