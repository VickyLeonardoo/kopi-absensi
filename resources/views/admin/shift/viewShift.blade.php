@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div>
                        <a href="{{ route('shift.tambah') }}" class="btn btn-primary">Tambah</a>
                        <hr>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Toleransi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shift as $data)
                                <tr>
                                    <td>{{ $data->jamMasuk }}</td>
                                    <td>{{ $data->jamPulang }}</td>
                                    <td>{{ $data->toleransi }}</td>
                                    <td>
                                        <a href="{{ route('shift.edit', $data->id) }}" class="btn btn-primary" title="Edit Shift"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default-{{ $data->id }}"><i class="fas fa-trash"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Toleransi</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
        @foreach ($shift as $data)
        <div class="modal fade" id="modal-default-{{ $data->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Shift </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Menghapus Data !&hellip;</p>
                    </div>
                    <form action="{{ route('shift.hapus',$data->id) }}" method="post">
                        @csrf
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @endsection
