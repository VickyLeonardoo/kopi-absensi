@foreach ($data_absen as $da)
<div class="modal fade" id="modal-default-{{ $da->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Konfirmasi Kehadiran
            </div>
            <form action="{{ route('absensi.konfirmasi',$da->id) }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $da->user_id }}">
                <div class="container-fluid">
                    <label for="">Status: </label>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="Hadir">Hadir</option>
                            <option value="Ditolak">Upload Foto Ulang</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
