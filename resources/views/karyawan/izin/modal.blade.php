<div class="modal fade" id="modal-request">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Keterangan </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('izin.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Keterangan Izin</label>
                            <select class="form-control" name="keterangan_id">
                                <option value="" selected disabled>Pilih Keterangan</option>
                                @foreach ($ket as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Foto Izin</label>
                            <input type="file" class="form-control" name="foto" value="{{ old('foto') }}" placeholder="Masukkan Nama Keterangan Izin">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Izin</label>
                            <input type="date" class="form-control" name="tglIzin">
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
