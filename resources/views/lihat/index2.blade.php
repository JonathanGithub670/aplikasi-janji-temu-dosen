{{-- @extends('dashboard.layout.main')

@section('style')
    
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Bukti Reservasi</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard | <a href="{{ route('dashboard.list') }}">Daftar Pertemuan | </a><a href="{{ route('dashboard.list-lihat') }}">Bukti Reservasi</a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button class="btn btn-danger buttons-pdf buttons-html5 print-window" tabindex="0" aria-controls="datatable-buttons" type="button"><i class="bi bi-file-earmark-pdf"> </i>PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <center>
                        <h1 >Bukti Reservasi</h1><br>
                    </center>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th class="table-dark w-25">Nama</th>
                                <th>{{ $choose->create->name }}</th>
                            </tr>
                            <tr>
                                <th class="table-dark">NPM</th>
                                <th>{{ $choose->create->nim }}</th>
                            </tr>
                            <tr>
                                <th class="table-dark">Penerima</th>
                                <th>{{ $choose->user->name }}</th>
                            </tr>
                            <tr>
                                <th class="table-dark">Waktu</th>
                                <th>{{ \Carbon\Carbon::parse($choose->datetime)->translatedFormat('l, d F Y H:i') }}</th>
                            </tr>
                            <tr>
                                <th class="table-dark">Status</th>
                                <th>
                                    @if ($choose->status === 1)
                                            <span class="badge bg-success">Reservasi Diterima</span>
                                        @elseif($choose->status === 0)
                                            <span class="badge bg-danger">Reservasi Ditolak</span>
                                        @elseif ($choose->status == null)
                                        <span class="badge bg-warning">Reservasi Sedang Diproses</span>
                                    @endif
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    $('.print-window').click(function() {
    window.print();
});
@endsection --}}
