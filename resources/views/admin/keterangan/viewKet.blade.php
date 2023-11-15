@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div>
                    <button type="button" class="btn btn-info" title="Tambah Data" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i></button>
                    <hr>
                </div>
                <table id="keteranganIzin" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ket as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" title="Edit Data" data-toggle="modal" data-target="#modal-edit-{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" title="Hapus Data" data-toggle="modal" data-target="#modal-hapus-{{ $data->id }}"><i class="fas fa-trash"></i></button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</section>
@include('admin.keterangan.modal')
@endsection
