@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        <div style="text-align: right;">
                <a href="{{ url('admin/master-data/outlet/tambah-data/') }}" class="btn btn-primary" style="border-radius: 40px; width:25%"><i class="fas fa-plus"></i>Tambah</a>
        </div>
            <div class="row">
                @forelse($outlets as $data)
                    <div class="col-md-4">
                        <h6><b>{{ $data->alamat }}</b></h6>
                        <img src="{{ asset('storage/' . $data->foto) }}"
                            class="card-img-top-custom" alt="..." style="height: 250px;  border-radius: 40px">
                            <a class="button-container-custom" href="{{ route('outlet.edit', $data->slug) }}" style="color: black; font-weight:bold;">Selengkapnya ></a>
                            {{-- <a style="color: black" href="#"> Selengkapnya ></a> --}}
                    </div>
                @empty
                <h1>Data Outlet Tidak Ditemukan</h1>
                @endforelse
            </div>
        <br>
        <div class="row">
            {{ $outlets->links() }}
        </div>
    </section>
</section>

    @foreach($outlets as $data)
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
