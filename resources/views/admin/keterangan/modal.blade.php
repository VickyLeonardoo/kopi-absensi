<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Keterangan </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('keterangan.simpan') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Keterangan Izin">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($ket as $data)
<div class="modal fade" id="modal-edit-{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Keterangan </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('keterangan.update',$data->id) }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" placeholder="Masukkan Nama Keterangan Izin">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($ket as $data)
<div class="modal fade" id="modal-hapus-{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Keterangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('keterangan.hapus',$data->id) }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <p>Hapus Data {{ $data->nama }}</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
