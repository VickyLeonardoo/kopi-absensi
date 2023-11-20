@extends('partials.admin.header')
@section('content')

    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div>
                        <a href="{{ route('karyawan.tambah') }}" class="btn btn-primary">Tambah</a>
                        <hr>
                    </div>
                    <table id="dataKaryawan" class="display">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->noTelp }}</td>
                                    <td>
                                        <a href="{{ route('karyawan.edit', $data->slug) }}" class="btn btn-primary" title="Edit Pegawai"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-warning" title="Reset Password" data-toggle="modal" data-target="#modal-reset-password-{{ $data->slug }}"><i class="fas fa-key"></i></button>
                                        <a href="{{ route('karyawan.shift', $data->slug) }}" class="btn btn-success" title="Mapping Shift"><i class="fas fa-clock"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus Pegawai" data-toggle="modal" data-target="#modal-default-{{ $data->slug }}"><i class="fas fa-trash"></i></button>
                                        <a href="{{ route('karyawan.statistik',$data->slug) }}" class="btn btn-info" title="Statistik Karyawan"><i class="fa-solid fa-chart-simple"></i></a>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </section>
       @include('admin.karyawan.modal')

    @endsection
