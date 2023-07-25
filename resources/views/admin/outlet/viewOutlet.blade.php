@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div>
                        <a href="/admin/master-data/outlet/tambah-data" class="btn btn-primary">Tambah</a>
                        <hr>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outlets as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td><img src="{{ asset('storage/' . $data->foto) }}" alt="Gambar Outlet" width="50">
                                    </td>
                                    </td>
                                    <td>
                                        <a href="{{ route('outlet.edit', $data->slug) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default-{{ $data->slug }}"><i class="fas fa-trash"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Aksi</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
        @foreach ($outlets as $data)
        <div class="modal fade" id="modal-default-{{ $data->slug }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Outlet {{ $data->nama }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Menghapus Data !&hellip;</p>
                    </div>
                    <form action="{{ route('outlet.hapus',$data->slug) }}" method="post">
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
