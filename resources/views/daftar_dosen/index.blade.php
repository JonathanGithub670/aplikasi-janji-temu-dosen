@extends('dashboard.layout.main')

@section('style')

@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Daftar Dosen</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        Dashboard | <a href="{{ route('dashboard.daftar_dosen') }}"><strong>Daftar Dosen</strong></a>
                    </li>
                </ol>
            </div>

        </div>
    </div>
@endsection

@section('container')
    <div class="row">
        @foreach($dosens as $dosen)
        <div class="col-xl-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body pb-0">
                    <div class="avatar-sm mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                            {{ substr($dosen->name, 0, 1) }}
                        </span>
                    </div>
                    <h5 class="font-size-15"><span class="text-dark">{{ $dosen->name }}</span></h5>
                    <p class="text-muted mb-0">{{ $dosen->nim }}</p>
{{--                    <p class="text-muted">Teknik Informatika</p>--}}
                    {{-- <div>
                        <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">Photoshop</a>
                        <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">illustrator</a>
                    </div> --}}
                </div>
                <div class="card-footer bg-transparent border-top pt-0">
                    <div class="contact-links d-flex font-size-20">
                        <div class="flex-fill">
                            {{-- <a href="{{ route('dashboard.jadwal_dosen') }}"><i class="bx bx-calendar"><span class="font-size-15 mb-1"> Lihat Jadwal </span></i></a> --}}
                            <a href="{{ route('dashboard.jadwal-dosen', $dosen->id) }}"><i class="bx bx-calendar"><span class="font-size-15 mb-1"> Lihat Jadwal </span></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {!! $dosens->links('vendor.pagination.custom') !!}
@endsection

@section('script')
    {{-- <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script> --}}
@endsection
<!-- end row -->

        {{-- <div class="card">
            <div class="card-body">
                <div class="d-sm-flex flex-wrap">
                    <h4 class="card-title mb-4">Email Sent</h4>
                    <div class="ms-auto">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Year</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div> --}}
