@foreach ($izin as $data)
<div class="modal fade" id="modal-default-{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Setujui Izin
            </div>
            <form action="{{ route('izin.setuju',$data->id) }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Setuju</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
