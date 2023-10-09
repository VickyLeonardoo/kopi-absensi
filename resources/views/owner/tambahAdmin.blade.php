@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container container-fluid">
        <div class="text-right">
            <a href="{{ route('owner.admin') }}" class="btn btn-primary">Kembali</a>
        </div>
        <h4><b>Karyawan Penkopi To Go</b></h4>
        <h1 style="color: #2d64ed; font-weight:bold;"></h1>
        <form action="{{ route('owner.admin.simpan') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Nama Admin:</label>
                <input type="text" value="{{ old('nama') }}" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" placeholder="Masukkan Nama">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"  class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Masukkan Email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">No Telpon:</label>
                <input type="number" value="{{ old('noTelp') }}" name="noTelp" class="form-control {{ $errors->has('noTelp') ? 'is-invalid' : '' }}" placeholder="Masukkan No Telpon">
                @error('noTelp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan" style="border-radius: 20px">
            </div>
        </form>
    </section>
</section>
@endsection
