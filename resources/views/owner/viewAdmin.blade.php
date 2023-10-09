@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container container-fluid">
        <div style="text-align: right">
            <a href="{{ route('owner.admin.tambah') }}" class="btn btn-primary" style="border-radius: 30px"><i class="fas fa-plus"></i>Tambah</a>
        </div>
        <br><br>
        <h4><b>Karyawan Penkopi To Go</b></h4>
        @forelse ($admins as $admin)
        <div class="card" style="height: 80px">
            <div class="row ml-5 mr-5 mt-4" style="font-weight: bold;">
                <div class="col-md-3">
                    {{ $admin->nama }}
                </div>
                <div class="col-md-3">
                    100{{ $admin->id }}
                </div>
                <div class="col-md-6" style="text-align:right;">
                    <a href="{{ route('owner.admin.edit', $admin->id) }}" style="color: black">>></a>
                </div>
            </div>
        </div>
        @empty
            <h4>Tidak Ada Data Admin</h4>
        @endforelse
        <div>
            {{ $admins->links() }}
        </div>
    </section>
</section>
@endsection
