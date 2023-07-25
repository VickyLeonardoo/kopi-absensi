@foreach ($karyawan as $data)
<div class="modal fade" id="modal-default-{{ $data->slug }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Shift </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Menghapus Data {{ $data->nama }} !&hellip;</p>
            </div>
            <form action="{{ route('karyawan.hapus',$data->slug) }}" method="post">
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

@foreach ($karyawan as $data)
<div class="modal fade" id="modal-reset-password-{{ $data->slug }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Shift </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Reset Password {{ $data->nama }} ?&hellip;</p>
            </div>
            <form action="{{ route('karyawan.reset',$data->slug) }}" method="post">
                @csrf
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
