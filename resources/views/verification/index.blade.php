@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Verifikasi User </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard<a href="{{ route('dashboard.verification.index') }}"> | <strong>Verifikasi User</strong></a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

{{-- @section('')
    <div class="row">
        @if (session('alert_message'))
            <div class="mt-5">
                <div class="alert alert-{{session('alert_type')}} alert-dismissible fade show" role="alert">
                    {{ session('alert_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="mb-4 mt-5">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nip }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('dashboard.verification.accepttance', ['user' => $user->id, 'accept' => 1]) }}"
                                        class="btn btn-primary btn-sm d-inline border-0">Accept<i
                                            data-feather="check"></i></a>
                                    <a href="{{ route('dashboard.verification.accepttance', ['user' => $user->id, 'accept' => 0]) }}"
                                        class="btn btn-danger btn-sm d-inline border-0">Decline<i data-feather="x"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum Terdapat Pengguna Baru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection --}}

@section('container')
    @if (session('alert_message'))
        <div class="mt-5">
            <div class="alert alert-{{session('alert_type')}} alert-dismissible fade show" role="alert">
                {{ session('alert_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Verifikasi Akun</h4>
                    <p class="card-title-desc">
                        ini merupakan halaman untuk menampilkan akun mahasiswa yang sudah dibuat tetapi belum di verifikasi
                    </p>
                    {{-- <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100"> --}}
                    <div class="row" style="float: right">
                        <div>
                            <form action="" method="get">
                                @csrf
                                <div class="input-group mb-3 mt-1 col-xs-4">
                                    <input type="text" class="form-control form-control-sm" autocomplete="off"
                                        placeholder="Search.." name="search">
                                    <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i
                                            class="bi bi-search"></i></button>
                                    <button class="btn btn-outline-dark" type="submit" id="button-addon3"><i
                                            class="bi bi-arrow-repeat"><a href="{{ route('dashboard.verification.index') }}"
                                                class="text-decoration-none"></i></a></button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive  nowrap w-100 ">
                        <thead>
                            <tr class="table-secondary">
                                <th style="text-align:center">No</th>
                                <th style="text-align:center">NIM</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">Waktu</th>
                                <th colspan="2" style="text-align:center">Aksi</th>
                                {{-- <th style="text-align:center">Lupa Password</th>
                                <th style="text-align:center">Hapus Akun</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse ($users as $user) --}}
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td style="text-align:center">
                                        {{ ($users->currentpage() - 1) * $users->perpage() + $key + 1 }}
                                        {{-- {{ $loop->iteration }} --}}

                                    </td>
                                    <td style="text-align:center">{{ $user->nim }}</td>
                                    <td style="text-align:center">{{ $user->name }}</td>
                                    <td style="text-align:center">
                                        {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('l, d F Y H:i') }}
                                    </td>
                                    <td style="text-align:center">
                                        {{-- <a href="{{ route('dashboard.verification.accepttance', ['user' => $user->id, 'accept' => 1]) }}"
                                            class="btn btn-primary btn-sm d-inline border-0"><i class="bx bx-check"></i>
                                            Accept</a> --}}

                                        <a
                                            href="{{ route('dashboard.verification.accepttance', ['user' => $user->id, 'accept' => 1]) }}"><button
                                                type="button"
                                                class="btn btn-info btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-check-double label-icon"></i> Accept</button></a>
                                    </td>
                                    <td style="text-align:center">
                                        {{-- <a href="{{ route('dashboard.verification.accepttance', ['user' => $user->id, 'accept' => 2]) }}"
                                            class="btn btn-danger btn-sm d-inline border-0"><i class="bx bx-x"></i>
                                            Decline</a> --}}
                                        <a
                                            href="{{ route('dashboard.verification.accepttance', ['user' => $user->id, 'accept' => 2]) }}"><button
                                                type="button"
                                                class="btn btn-danger btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-block label-icon "></i> Decline</button>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum Terdapat Pengguna Baru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination justify-content-begin ">
                        Showing
                        {!! $users->firstItem() !!}
                        to
                        {!! $users->lastItem() !!}
                        of
                        {!! $users->total() !!}
                        entries
                    </div>
                    <nav aria-label="Page navigation example">
                        <div class="pagination justify-content-end">{!! $users->links('vendor.pagination.custom') !!} </div>
                        {{-- {{ $users->links() }} --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
@endsection

{{-- <td style="text-align:center">
    
    <form action="{{ route('dashboard.verification.ubahpassword') }}" method="POST">
        @csrf

        <button type="submit" class="btn btn-success btn-label btn-sm w-xs d-inline border-0"><i
                class="bx bx-pencil label-icon"></i> Ubah Password</button>
    </form>
</td>
<td style="text-align:center">
    <a href="#"><button type="submit" class="btn btn-danger btn-label btn-sm w-xs d-inline border-0"><i
                class="bx bx-trash label-icon"></i>Hapus</button></a>
</td> --}}
