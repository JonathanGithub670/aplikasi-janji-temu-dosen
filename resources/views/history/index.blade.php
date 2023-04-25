@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Riwayat Reservasi </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard<a href="{{ route('dashboard.history') }}"> | <strong> Riwayat Reservasi</strong></a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    {{-- @if (session('alert_message'))
        <div class="mt-5">
            <div class="alert alert-{{ session('alert_type') }}">{{ session('alert_message') }}</div>
        </div>
    @endif --}}
    @if (session('alert_message'))
        <div class="mt-5">
            <div class="alert alert-{{ session('alert_type') }} alert-dismissible fade show" role="alert">
                {{ session('alert_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Riwayat Reservasi</h4>
                <p class="card-title-desc">
                    ini merupakan halaman untuk menampilkan reservasi pertemuan yang telah dibuat dan telah di setujui
                    oleh Dosen atau Fungsionaris atau Chaplin.
                </p>
                @can('isAdmin')
                    <div class="row" style="float: right">
                        <form action="" method="get">
                            @csrf
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                    value="{{ Request::get('start_date') }}" />
                                <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                    value="{{ Request::get('end_date') }}" />
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div><br><br>
                @endcan
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
                                        class="bi bi-arrow-repeat"><a href="{{ route('dashboard.history') }}"
                                            class="text-decoration-none"></i></a></button>
                                {{-- <button class="btn btn-outline-dark" type="submit" id="button-addon4">
                                    <i class="bi bi-calendar-range-fill"></i> --}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @can('isDosen')
                    <div class="row" style="float: left">
                        <form action="" method="get">
                            @csrf
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                    value="{{ Request::get('start_date') }}" />
                                <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                    value="{{ Request::get('end_date') }}" />
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                @elsecan('isMahasiswa')
                    <div class="row" style="float: left">
                        <form action="" method="get">
                            @csrf
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                    value="{{ Request::get('start_date') }}" />
                                <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                    value="{{ Request::get('end_date') }}" />
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                @elsecan('isChaplin')
                    <div class="row" style="float: left">
                        <form action="" method="get">
                            @csrf
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                    value="{{ Request::get('start_date') }}" />
                                <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                    value="{{ Request::get('end_date') }}" />
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                @elsecan('isFungsionaris')
                    <div class="row" style="float: left">
                        <form action="" method="get">
                            @csrf
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                    value="{{ Request::get('start_date') }}" />
                                <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                    value="{{ Request::get('end_date') }}" />
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                @endcan
                @can('isAdmin')
                    <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <a
                                        href="{{ route('dashboard.history.export', ['start_date' => Request::get('start_date'), 'end_date' => Request::get('end_date')]) }}">
                                        <button class="btn btn-success buttons-excel buttons-html5" tabindex="0"
                                            aria-controls="datatable-buttons" type="button"><i
                                                class="bi bi-file-spreadsheet">
                                            </i>Excel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <table class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align:center">No</th>
                            @can('isAdmin')
                                <th style="text-align:center">Penerima</th>
                                <th style="text-align:center">Pengirim</th>
                            @elsecan('isMahasiswa')
                                <th style="text-align:center">Penerima</th>
                            @else
                            <th style="text-align:center">Pengirim</th>
                            @endcan
                            <th style="text-align:center">Waktu</th>
                            <th style="text-align:center">Status</th>
                            <th style="text-align:center">Verifikasi</th>
                            <th colspan="3" style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $key => $history)
                            <tr>
                                <td style="text-align:center">
                                    {{ ($histories->currentpage() - 1) * $histories->perpage() + $key + 1 }}</td>
                                @can('isMahasiswa')
                                    <td style="text-align:center">{{ $history->user->name }}</td>
                                    {{-- <td style="text-align:center">{{ $history->create->name }}</td> --}}
                                    
                                    <td style="text-align:center">
                                        {{ \Carbon\Carbon::parse($history->datetime)->translatedFormat('l, d F Y H:i') }}</td>
                                    <td style="text-align:center">
                                        @if ($history->status_reservasi == 1)
                                            <span class="badge bg-success"><i
                                                    class="bx bx-check-double font-size-16 align-middle me-2"></i>Diterima</span>
                                        @elseif($history->status_reservasi == 0)
                                            <span class="badge bg-danger"><i
                                                    class="bx bx-block font-size-16 align-middle me-2"></i>Ditolak</span>
                                        @elseif ($history->status_reservasi == null)
                                            <span class="badge bg-warning"><i
                                                    class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Proses</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center">
                                        @if ($history->status_reservasi !== null)
                                            <span class="badge bg-dark">Sudah Dilakukan Aksi</span>
                                        @else
                                            <a href="{{ route('dashboard.list-accepttance', ['id' => $history->id, 'accept' => true]) }}"
                                                class="btn btn-primary btn-sm d-inline border-0"">Accept<i
                                                    data-feather="check"></i></a>
                                            <a href="{{ route('dashboard.list-accepttance', ['id' => $history->id, 'accept' => false]) }}"
                                                class="btn btn-danger btn-sm d-inline border-0">Decline<i
                                                    data-feather="x"></i></a>
                                        @endif
                                    </td>
                                    {{-- ini untuk bukti reservasi di history --}}
                                    @if ($history->status_reservasi === 1)
                                        <td style="text-align:center">
                                            <a href="{{ route('dashboard.list-pdf', $history->id) }}" class="badge bg-info"><i
                                                    class="fa fa-print fa-2x"></i></a>
                                        </td>
                                    @endif 
                                @elsecan('isAdmin')
                                    {{-- <td style="text-align:center">{{ $history->create->name }}</td> --}}
                                    {{-- <td style="text-align:center">{{ $history->user->name }}</td> --}}
                                    {{-- @elsecan('isAdmin')
                                    <td>{{ $history->create->name }}</td> --}}
                                    @can('isAdmin')
                                        <td style="text-align:center">{{ $history->user->name }}</td>
                                    @else
                                        <td style="text-align:center">{{ $history->create->name }}</td>
                                    @endcan
                                    {{-- <td style="text-align:center">{{ $history->user->name }}</td> --}}
                                    {{-- <td style="text-align:center">{{ $history->create->name }}</td> --}}
                                    <td style="text-align:center">
                                        <button type="button" class="badge bg-info d-inline border-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $history->id }}"><i
                                                class="bx bx-info-circle fa-2x"></i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $history->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mahasiswa yang
                                                            Membuat Pertemuan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: x-large"> Nama Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $history->name ?: $history->create->name }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $history->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->name }}
                                                            </span>
                                                        </span><br><br>
                                                        <span style="font-size: x-large"> NPM Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $history->nip ?: $history->create->nip  }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $history->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->nim }}
                                                            </span>
                                                        </span><br><br>
                                                        {{-- <span style="font-size: x-large"> Email : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $history->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->email }}
                                                            </span>
                                                        </span><br><br> --}}
                                                        <span style="font-size: x-large"> Semester Berjalan : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{ $list_semester->find($history->semester)->isi_semester }}
                                                            </span>
                                                        </span><br><br>
                                                        <span style="font-size: x-large"> Program Studi : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $list_semester->find($history->semester)->isi_semester }} --}}
                                                                @php
                                                                    $prodi = Illuminate\Support\Facades\DB::table('program_studi')->where('prodi_create_user_id','=',$history->create_user_id)->first();
                                                                @endphp
                                                                {{ $prodi?$prodi->nama_program_studi:"" }}
                                                            </span>
                                                        </span><br><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align:center">
                                        {{ \Carbon\Carbon::parse($history->datetime)->translatedFormat('l, d F Y H:i') }}</td>
                                    <td style="text-align:center">
                                        {{-- @dd($item->status) --}}
                                        @if ($history->status_reservasi === 1)
                                            <span class="badge bg-success"><i
                                                    class="bx bx-check-double font-size-16 align-middle me-2"></i>Diterima</span>
                                        @elseif($history->status_reservasi === 0)
                                            <span class="badge bg-danger"><i
                                                    class="bx bx-block font-size-16 align-middle me-2"></i>Ditolak</span>
                                        @elseif ($history->status_reservasi == null)
                                            <span class="badge bg-warning"><i
                                                    class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Proses</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center">
                                        @if ($history->status_reservasi !== null)
                                            <span class="badge bg-dark">Sudah Dilakukan Aksi</span>
                                        @else
                                            <a href="{{ route('dashboard.list-accepttance', ['id' => $history->id, 'accept' => true]) }}"
                                                class="btn btn-primary btn-sm d-inline border-0"">Accept<i
                                                    data-feather="check"></i></a>
                                            <a href="{{ route('dashboard.list-accepttance', ['id' => $history->id, 'accept' => false]) }}"
                                                class="btn btn-danger btn-sm d-inline border-0">Decline<i
                                                    data-feather="x"></i></a>
                                        @endif
                                    </td>
                                    {{-- ini untuk bukti reservasi di history --}}
                                    {{-- @can('isMahasiswa') --}}
                                    {{-- <td style="text-align:center">
                                    <a href="{{ route('dashboard.list-lihat', $history->id) }}" class="badge bg-info "><i
                                            class="bi bi-eye fa-2x"></i></a>
                                    
                                    </td> --}}
                                    {{-- @if ($history->status_reservasi === 1)
                                        <td style="text-align:center">
                                            <a href="{{ route('dashboard.list-pdf', $history->id) }}" class="badge bg-info"><i
                                                    class="fa fa-print fa-2x"></i></a>
                                    @endif
                                    </td> --}}
                                    {{-- @endcan --}}
                                    {{-- @elsecan('isAdmin') --}}
                                    {{-- @if ($history->status_reservasi === 1)
                                        <td style="text-align:center">
                                            <a href="{{ route('dashboard.list-lihat', $history->id ) }}"
                                                class="badge bg-info"><i class="bi bi-eye fa-2x"></i></a>
                                        </td>
                                        <td style="text-align:center">
                                            <a href="{{ route('dashboard.list-pdf', $history->id) }}"
                                                class="badge bg-info"><i class="fa fa-print fa-2x"></i></a>
                                        </td>
                                    @endif --}}
                                    <td style="text-align:center">
                                        <a href="{{ route('dashboard.history-destroy', $history->id) }}"
                                            class="badge bg-danger"><i class="bi bi-trash fa-2x"></i></a>
                                    </td>
                                    {{-- @else
                                    @if ($history->status_reservasi === 1)
                                        <td style="text-align:center">
                                            <a href="{{ route('dashboard.list-lihat', $history->id) }}"
                                                class="badge bg-info"><i class="bi bi-eye fa-2x"></i></a>
                                    @endif
                                    </td> --}}
                                
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum Ada Reservasi Terkirim</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination justify-content-begin ">
                    Showing
                    {!! $histories->firstItem() !!}
                    to
                    {!! $histories->lastItem() !!}
                    of
                    {!! $histories->total() !!}
                    entries
                </div>
                <nav aria-label="Page navigation example">
                    <div class="pagination justify-content-end">{!! $histories->links('vendor/pagination/custom') !!}</div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
