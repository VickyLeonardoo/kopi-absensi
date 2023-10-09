@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-info" title="Tambah Data" data-toggle="modal" data-target="#modal-request"><i class="fas fa-plus"></i>Request Izin</button>
            </div>
            <hr>
            <div class="card-body">
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ket Izin</th>
                            <th>Tanggal</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izin as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->keterangan->nama }}</td>
                                <td>{{ $data->tglIzin }}</td>
                                <td><img src="{{ asset('storage/' . $data->fotoIzin) }}" alt="Gambar Izin" width="50">
                                <td>
                                    <a href="/admin/izin/detail-izin/{{ $data->id }}" class="btn btn-info" title="Detail">Cek Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ket Izin</th>
                            <th>Tanggal</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</section>
@include('admin.izin.modal')
@endsection
