@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Daftar Pertemuan </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard<a href="{{ route('dashboard.list') }}"> | <strong> Daftar Pertemuan</strong> </a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    @if (session('alert_message'))
        <div class="mt-5">
            <div class="alert alert-{{ session('alert_type') }}">{{ session('alert_message') }}</div>
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Pertemuan</h4>
                <p class="card-title-desc">
                    ini merupakan halaman untuk menampilkan reservasi pertemuan dari mahasiswa
                </p>
                @can('isAdmin')
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
                                            class="bi bi-arrow-repeat"><a href="{{ route('dashboard.list') }}"
                                                                          class="text-decoration-none"></i></a></button>

                                </div>
                            </form>
                        </div>
                    </div>
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
                                            class="bi bi-arrow-repeat"><a href="{{ route('dashboard.list') }}"
                                                                          class="text-decoration-none"></i></a></button>

                                </div>
                            </form>
                        </div>
                    </div>
                @else
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
                                            class="bi bi-arrow-repeat"><a href="{{ route('dashboard.list') }}"
                                                                          class="text-decoration-none"></i></a></button>
                                </div>
                            </form>
                        </div>
                    </div>
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

                <table class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr class="table-secondary">
                        <th style="text-align:center">No</th>
                        {{-- <th style="text-align:center">Nama</th>
                        <th style="text-align:center">NPM</th> --}}
                        <th style="text-align:center">Mahasiswa</th>
                        @can('isAdmin')
                            <th style="text-align:center">Dosen</th>
                        @endcan
                        <th style="text-align:center">Waktu</th>
                        <th style="text-align:center">Status</th>
                        <th style="text-align:center">Pembahasan</th>
                        <th colspan="2" style="text-align:center">Keterangan</th>
                        @can('isAdmin')
                            <th style="text-align:center">Verifikasi</th>
                            <th colspan="2" style="text-align:center">Aksi</th>
                        @elsecan('isMahasiswa')
                            {{-- <th style="text-align:center">Verifikasi</th> --}}
                            {{-- <th style="text-align:center">Aksi</th> --}}
                        @else
                            <th style="text-align:center">Verifikasi</th>
                            <th style="text-align:center">Aksi</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @can('isAdmin')
                        @forelse ($lists as $key => $item)
                            <tr>
                                <td style="text-align:center">
                                    {{ ($lists->currentpage() - 1) * $lists->perpage() + $key + 1 }}</td>
                                <td style="text-align:center">
                                    <button type="button" class="badge bg-info d-inline border-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalAdmin{{ $item->id }}"><i
                                            class="bx bx-info-circle fa-2x"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalAdmin{{ $item->id }}" tabindex="-1"
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
                                                                {{-- {{ $item->name }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->name }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> NPM Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->nip ?: $item->create->nip }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->nim }}
                                                            </span>
                                                        </span><br><br>
                                                    {{-- <span style="font-size: x-large"> Email : <br>
                                                        <span class="badge bg-primary" style="font-size: x-large">

                                                            @php
                                                                $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                            @endphp
                                                            {{ $mahasiswa->email }}
                                                        </span>
                                                    </span><br><br> --}}
                                                    <span style="font-size: x-large"> Semester Berjalan : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{ $list_semester->find($item->semester)->isi_semester }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> Program Studi : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $list_semester->find($item->semester)->isi_semester }} --}}
                                                                @php
                                                                    $prodi = Illuminate\Support\Facades\DB::table('program_studi')->where('prodi_create_user_id','=',$item->create_user_id)->first();
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
                                    @php
                                        $dosen = \App\Models\User::where('id', $item->user_id)->first();
                                    @endphp
                                    {{ $dosen->name }}

                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y H:i') }}
                                </td>
                                <td>
                                    @if ($item->status === 1)
                                        <span class="badge bg-success"><i
                                                class="bx bx-check-double font-size-16 align-middle me-2"></i>Diterima</span>
                                    @elseif($item->status === 0)
                                        <span class="badge bg-danger"><i
                                                class="bx bx-block font-size-16 align-middle me-2"></i>Ditolak</span>
                                        {{-- @elseif ($item->status == null) --}}
                                    @else
                                        <span class="badge bg-warning"><i
                                                class="bx bx-hourglass bx-spin font-size-16 align-middle me-2 label-icon"></i>Proses</span>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    {{ $list_pembahasan->find($item->pembahasan)->ide_pembahasan }}
                                </td>
                                <td style="text-align:center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#keterangan{{ $item->id }}"><i
                                            class="bi bi-file-earmark-font fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="keterangan{{ $item->id }}" data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"> Isi
                                                        Keterangan
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $item->keterangan }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#gambar{{ $item->id }}"><i
                                            class="bi bi-file-earmark-image fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="gambar{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Isi Gambar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('upload-images/' . $item->image) }}"
                                                         alt="" style="max-width: 900px; max-height: 900px"></img>
                                                    @if($item->image == null)
                                                        <p>Tidak ada gambar</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                {{-- @can('isAdmin') --}}
                                <td style="text-align:center">
                                    @if ($item->status !== null)
                                        <span class="badge bg-dark">Sudah Dilakukan Aksi</span>
                                    @else
                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => true]) }}"><button
                                                type="button"
                                                class="btn btn-primary btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-check-double label-icon "></i> Accept</button></a>

                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => false]) }}"><button
                                                type="button"
                                                class="btn btn-danger btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-block label-icon "></i> Decline</button></a>
                                    @endif
                                </td>
                                @if ($item->status === null)
                                @else
                                    <td style="text-align:center">
                                        @if ($item->status === 1)
                                            <a href="{{ route('dashboard.list-lihat', $item->id) }}"
                                               class="badge bg-info "><i class="bi bi-eye-fill fa-2x"></i>
                                        @endif
                                    </td>
                                    <td style="text-align:center">
                                        @if ($item->status === 1)
                                            <a href="{{ route('dashboard.list-pdf', $item->id) }}" class="badge bg-info"><i
                                                    class="fa fa-print fa-2x"></i></a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Belum Ada Jadwal Reservasi</td>
                            </tr>
                        @endforelse
                    @elsecan('isDosen')
                        @forelse ($lists as $key => $item)
                            <tr>
                                <td style="text-align:center">
                                    {{ ($lists->currentpage() - 1) * $lists->perpage() + $key + 1 }}</td>

                                <td style="text-align:center">
                                    <button type="button" class="badge bg-info d-inline border-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalDosen{{ $item->id }}"><i
                                            class="bx bx-info-circle fa-2x"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalDosen{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Mahasiswa yang
                                                        Membuat Pertemuan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <span style="font-size: x-large"> Nama Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->name }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->name }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> NPM Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->nip ?: $item->create->nip }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->nim }}
                                                            </span>
                                                        </span><br><br>
                                                    {{-- <span style="font-size: x-large"> Email : <br>
                                                        <span class="badge bg-primary" style="font-size: x-large">

                                                            @php
                                                                $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                            @endphp
                                                            {{ $mahasiswa->email }}
                                                        </span>
                                                    </span><br><br> --}}
                                                    <span style="font-size: x-large"> Semester Berjalan : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{ $list_semester->find($item->semester)->isi_semester }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> Program Studi : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $list_semester->find($item->semester)->isi_semester }} --}}
                                                            </span>
                                                        </span><br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="text-align:center">
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y H:i') }}</td>
                                <td style="text-align:center">
                                    @if ($item->status === 1)
                                        <span class="badge bg-success"><i
                                                class="bx bx-check-double font-size-16 align-middle me-2"></i>Diterima</span>
                                    @elseif($item->status === 0)
                                        <span class="badge bg-danger"><i
                                                class="bx bx-block font-size-16 align-middle me-2"></i>Ditolak</span>
                                    @elseif ($item->status == null)
                                        <span class="badge bg-warning"><i
                                                class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Proses</span>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    {{ $list_pembahasan->find($item->pembahasan)->ide_pembahasan }}</td>
                                <td style="text-align:center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#keterangan{{ $item->id }}"><i
                                            class="bi bi-file-earmark-font fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="keterangan{{ $item->id }}" data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"> Isi
                                                        Keterangan
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $item->keterangan }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#gambar{{ $item->id }}"><i
                                            class="bi bi-file-earmark-image fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="gambar{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Isi Gambar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('upload-images/' . $item->image) }}"
                                                         alt="" style="max-width: 900px; max-height: 900px"></img>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    @if ($item->status !== null)
                                        <span class="badge bg-dark">Sudah Dilakukan Aksi</span>
                                    @else
                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => true]) }}"><button
                                                type="button"
                                                class="btn btn-primary btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-check-double label-icon "></i> Accept</button></a>

                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => false]) }}"><button
                                                type="button"
                                                class="btn btn-danger btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-block label-icon "></i> Decline</button></a>
                                    @endif
                                </td>
                                <td style="text-align:center">

                                    @if ($item->status === 1)
                                        {{-- @can('isDosen') --}}
                                        <a href="{{ route('dashboard.list-lihat', $item->id) }}" class="badge bg-info"><i
                                                class="bi bi-eye fa-2x"></i></a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Belum Ada Jadwal Reservasi</td>
                            </tr>
                        @endforelse
                    @elsecan('isChaplin')
                        @forelse ($lists as $key => $item)
                            <tr>
                                <td style="text-align:center">
                                    {{ ($lists->currentpage() - 1) * $lists->perpage() + $key + 1 }}</td>

                                <td style="text-align:center">
                                    <button type="button" class="badge bg-info d-inline border-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalChaplin{{ $item->id }}"><i
                                            class="bx bx-info-circle fa-2x"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalChaplin{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Mahasiswa yang
                                                        Membuat Pertemuan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <span style="font-size: x-large"> Nama Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->name ?: $item->create->name }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->name }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> NPM Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->nip }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->nim }}
                                                            </span>
                                                        </span><br><br>
                                                    {{-- <span style="font-size: x-large"> Email : <br>
                                                        <span class="badge bg-primary" style="font-size: x-large">

                                                            @php
                                                                $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                            @endphp
                                                            {{ $mahasiswa->email }}
                                                        </span>
                                                    </span><br><br> --}}
                                                    <span style="font-size: x-large"> Semester Berjalan : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{ $list_semester->find($item->semester)->isi_semester }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> Program Studi : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $list_semester->find($item->semester)->isi_semester }} --}}
                                                            </span>
                                                        </span><br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="text-align:center">
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y H:i') }}</td>
                                <td style="text-align:center">
                                    @if ($item->status === 1)
                                        <span class="badge bg-success"><i
                                                class="bx bx-check-double font-size-16 align-middle me-2"></i>Diterima</span>
                                    @elseif($item->status === 0)
                                        <span class="badge bg-danger"><i
                                                class="bx bx-block font-size-16 align-middle me-2"></i>Ditolak</span>
                                    @elseif ($item->status == null)
                                        <span class="badge bg-warning"><i
                                                class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Proses</span>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    {{ $list_pembahasan->find($item->pembahasan)->ide_pembahasan }}</td>
                                <td style="text-align:center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#keterangan{{ $item->id }}"><i
                                            class="bi bi-file-earmark-font fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="keterangan{{ $item->id }}" data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"> Isi
                                                        Keterangan
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $item->keterangan }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#gambar{{ $item->id }}"><i
                                            class="bi bi-file-earmark-image fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="gambar{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Isi Gambar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('upload-images/' . $item->image) }}"
                                                         alt="" style="max-width: 900px; max-height: 900px" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    @if ($item->status !== null)
                                        <span class="badge bg-dark">Sudah Dilakukan Aksi</span>
                                    @else
                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => true]) }}"><button
                                                type="button"
                                                class="btn btn-primary btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-check-double label-icon "></i> Accept</button></a>

                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => false]) }}"><button
                                                type="button"
                                                class="btn btn-danger btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-block label-icon "></i> Decline</button></a>
                                    @endif
                                </td>
                                <td style="text-align:center">

                                    @if ($item->status === 1)
                                        {{-- @can('isDosen') --}}
                                        <a href="{{ route('dashboard.list-lihat', $item->id) }}" class="badge bg-info"><i
                                                class="bi bi-eye fa-2x"></i></a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Belum Ada Jadwal Reservasi</td>
                            </tr>
                        @endforelse
                    @elsecan('isFungsionaris')
                        @forelse ($lists as $key => $item)
                            <tr>
                                <td style="text-align:center">
                                    {{ ($lists->currentpage() - 1) * $lists->perpage() + $key + 1 }}</td>

                                <td style="text-align:center">
                                    <button type="button" class="badge bg-info d-inline border-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalFungsionaris{{ $item->id }}"><i
                                            class="bx bx-info-circle fa-2x"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalFungsionaris{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Mahasiswa yang
                                                        Membuat Pertemuan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <span style="font-size: x-large"> Nama Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->name ?: $item->create->name }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->name }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> NPM Mahasiswa : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $item->nip }} --}}
                                                                @php
                                                                    $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                                @endphp
                                                                {{ $mahasiswa->nim }}
                                                            </span>
                                                        </span><br><br>
                                                    {{-- <span style="font-size: x-large"> Email : <br>
                                                        <span class="badge bg-primary" style="font-size: x-large">

                                                            @php
                                                                $mahasiswa = \App\Models\User::where('id', $item->create_user_id)->first();
                                                            @endphp
                                                            {{ $mahasiswa->email }}
                                                        </span>
                                                    </span><br><br> --}}
                                                    <span style="font-size: x-large"> Semester Berjalan : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{ $list_semester->find($item->semester)->isi_semester }}
                                                            </span>
                                                        </span><br><br>
                                                    <span style="font-size: x-large"> Program Studi : <br>
                                                            <span class="badge bg-primary" style="font-size: x-large">
                                                                {{-- {{ $list_semester->find($item->semester)->isi_semester }} --}}
                                                            </span>
                                                        </span><br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="text-align:center">
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y H:i') }}</td>
                                <td style="text-align:center">
                                    @if ($item->status === 1)
                                        <span class="badge bg-success"><i
                                                class="bx bx-check-double font-size-16 align-middle me-2"></i>Diterima</span>
                                    @elseif($item->status === 0)
                                        <span class="badge bg-danger"><i
                                                class="bx bx-block font-size-16 align-middle me-2"></i>Ditolak</span>
                                    @elseif ($item->status == null)
                                        <span class="badge bg-warning"><i
                                                class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Proses</span>
                                    @endif
                                </td>
                                <td>{{ $list_pembahasan->find($item->pembahasan)->ide_pembahasan }}</td>
                                <td style="text-align:center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#keterangan{{ $item->id }}"><i
                                            class="bi bi-file-earmark-font fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="keterangan{{ $item->id }}" data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"> Isi
                                                        Keterangan
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $item->keterangan }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <button type="button" class="badge border-0 btn btn-secondary text-white"
                                            data-bs-toggle="modal" data-bs-target="#gambar{{ $item->id }}"><i
                                            class="bi bi-file-earmark-image fa-2x"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="gambar{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Isi Gambar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('upload-images/' . $item->image) }}"
                                                         alt="" style="max-width: 900px; max-height: 900px"></img>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    @if ($item->status !== null)
                                        <span class="badge bg-dark">Sudah Dilakukan Aksi</span>
                                    @else
                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => true]) }}"><button
                                                type="button"
                                                class="btn btn-primary btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-check-double label-icon "></i> Accept</button></a>

                                        <a
                                            href="{{ route('dashboard.list-accepttance', ['id' => $item->id, 'accept' => false]) }}"><button
                                                type="button"
                                                class="btn btn-danger btn-sm w-xs d-inline border-0 btn-label"><i
                                                    class="bx bx-block label-icon "></i> Decline</button></a>
                                    @endif
                                </td>
                                <td style="text-align:center">

                                    @if ($item->status === 1)
                                        <a href="{{ route('dashboard.list-lihat', $item->id) }}" class="badge bg-info"><i
                                                class="bi bi-eye fa-2x"></i></a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Belum Ada Jadwal Reservasi</td>
                            </tr>
                        @endforelse
                    @endcan
                    </tbody>
                </table>
                <div class="pagination justify-content-begin ">
                    Showing
                    {!! $lists->firstItem() !!}
                    to
                    {!! $lists->lastItem() !!}
                    of
                    {!! $lists->total() !!}
                    entries
                </div>
                <nav aria-label="Page navigation example">
                    <div class="pagination justify-content-end">{!! $lists->appends($_GET)->links('vendor.pagination.custom') !!} </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
