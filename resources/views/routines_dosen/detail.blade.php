@extends('dashboard.layout.main')

@section('style')

@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Daftar Rutinitas - {{ $data['dosen']->name }} ({{ $data['dosen']->nim }})</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard<a href="{{ route('dashboard.list') }}"> | <strong> Daftar Rutinitas</strong> </a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="row d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.routines.perkuliahan') }}" method="POST" class="p-3 mt-2">
                    @csrf
                    @if (session()->has('tanggal_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('tanggal_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('tanggal_loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('tanggal_loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h4 class="card-title fs-5">Rutinitas Dosen</h4>
                    <p class="card-title-desc">
                        Ini merupakan menu untuk mengatur jangka waktu rutinitas dosen
                    </p>
                    <input value="{{ request('id') }}" name="user_id" type="number" hidden>
                    <label for="nim" class="form-label fs-5">Tanggal Mulai Perkuliahan</label>
                    <div>
                        <input value="{{ $data['period']?$data['period']->mulai_perkuliahan:null }}" name="mulai_perkuliahan" type="date" class="form-control mb-3" autocomplete="off" required>
                    </div>
                    <label for="nim" class="form-label fs-5 ">Tanggal Selesai Perkuliahan</label>
                    <div>
                        <input value="{{ $data['period']?$data['period']->selesai_perkuliahan:null }}" name="selesai_perkuliahan" type="date" class="form-control mb-3" autocomplete="off" required>
                    </div>
                    <div class="d-grid gap-2 justify-content-end">
                        <div class="row ">
                            <div class="col-md-8 mt-3">
                                <button class="btn btn-primary" type="submit">Ganti</button>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    // Create a new date object with the current date and time in the Asia/Jakarta time zone
                    let now = new Date();
                    let options = { timeZone: 'Asia/Jakarta' };
                    let jakartaDate = new Date(now.toLocaleString('en-US', options));

                    // Get the YYYY-MM-DD format of the date
                    let today = jakartaDate.toISOString().split('T')[0];

                    // Set the min attribute of the input elements to the current date
                    document.getElementsByName("mulai_perkuliahan")[0].setAttribute('min', today);
                    document.getElementsByName("selesai_perkuliahan")[0].setAttribute('min', today);
                </script>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if (session()->has('success-off'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success-off') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error-off'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error-off') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Button to trigger modal -->
                        <h4 class="card-title fs-5">Rutinitas Dosen</h4>
                        <p class="card-title-desc">
                            Ini merupakan menu untuk menambahkan jam off pada dosen
                        </p>
                        <a href="{{route('dashboard.off.create', ['id' => request('id')])}}" class="btn btn-primary">
                            Tambah Jam Off <span class="bx bx-plus"></span>
                        </a>
                    </div>
                    <table class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr class="table-secondary">
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = $data['jam_off']->currentPage() == 1 ? 1 : ($data['jam_off']->currentPage() * 10) - 9;
                        @endphp
                        @foreach($data['jam_off'] as $jam_off)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td style="text-align: left;">{{ $jam_off->keterangan }}</td>
                                <td>{{ $jam_off->tanggal }}</td>
                                <td>{{ $jam_off->jam_mulai }}</td>
                                <td>{{ $jam_off->jam_selesai }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="btn btn-sm btn-danger text-left" href="{{ route('dashboard.off.delete', ['id' => $jam_off->id]) }}" style="float:left;"><span class="bx bx-trash"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="mt-2">
            <div class="pagination justify-content-end">{!! $data['jam_off']->links('vendor.pagination.custom') !!} </div>
        </nav>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if (session()->has('success-routines'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success-routines') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error-routines'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error-routines') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Button to trigger modal -->
                        <h4 class="card-title fs-5">Rutinitas Dosen</h4>
                        <p class="card-title-desc">
                            Ini merupakan menu untuk membuat rutinitas dosen selama 5 hari
                        </p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahRutinitas">
                            Tambah Rutinitas <span class="bx bx-plus"></span>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="tambahRutinitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Tambah Rutinitas</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('dashboard.routines.store') }}" method="POST" class="p-3 mt-2">
                                            @csrf
                                            @if(auth()->user()->role == "admin")
                                                <input value="{{ request('id') }}" name="user_id" type="number" hidden>
                                            @else
                                                <input value="{{ auth()->id() }}" name="user_id" type="number" hidden>
                                            @endif
                                            <label for="nim" class="form-label fs-5">Nama Kegiatan</label>
                                            <div>
                                                <input name="keterangan" type="text" class="form-control" required>
                                            </div>
                                            <label for="hari" class="form-label fs-5">Hari</label>
                                            <div>
                                                <select name="hari" class="form-control" required>
                                                    <option readonly hidden>-- Pilih Hari --</option>
                                                    <option value="senin">Senin</option>
                                                    <option value="selasa">Selasa</option>
                                                    <option value="rabu">Rabu</option>
                                                    <option value="kamis">Kamis</option>
                                                    <option value="jumat">Jumat</option>
                                                    <option value="sabtu">Sabtu</option>
                                                    <option value="minggu">Minggu</option>
                                                </select>
                                            </div>

                                            <label for="nim" class="form-label fs-5">Jam Mulai</label>
                                            <div>
                                                <input name="jam_mulai" type="time" class="form-control" required>
                                            </div>
                                            <label for="nim" class="form-label fs-5">Jam Selesai</label>
                                            <div>
                                                <input name="jam_selesai" type="time" class="form-control" required>
                                            </div>
                                            <div class="d-grid gap-2 justify-content-center">
                                                <div class="row ">
                                                    <div class="col-md-8 mt-3">
                                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr class="table-secondary">
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = $data['routines']->currentPage() == 1 ? 1 : ($data['routines']->currentPage() * 10) - 9;
                        @endphp
                        @foreach($data['routines'] as $routine)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td style="text-align: left;">{{ $routine->keterangan }}</td>
                                <td>{{ $routine->hari }}</td>
                                <td>{{ $routine->jam_mulai }}</td>
                                <td>{{ $routine->jam_selesai }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <!-- Button to trigger modal -->
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editRutinitas{{$routine->id}}">
                                                <span class="bx bx-edit"></span>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editRutinitas{{$routine->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Edit Rutinitas</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('dashboard.routines.edit') }}" method="POST" class="p-3 mt-2">
                                                                @csrf
                                                                <input value="{{ request('id') }}" name="user_id" type="number" hidden>
                                                                <input name="id" type="number" value="{{$routine->id}}" hidden>
                                                                <label for="nim" class="form-label fs-5">Nama Kegiatan</label>
                                                                <div>
                                                                    <input value="{{$routine->keterangan}}" name="keterangan" type="text" class="form-control" required>
                                                                </div>
                                                                <label for="hari" class="form-label fs-5">Hari</label>
                                                                <div>
                                                                    <select name="hari" class="form-control" required>
                                                                        <option hidden readonly="">Pilih Hari</option>
                                                                        <option value="senin" {{ $routine->hari == "senin" ? "selected" : "" }}>Senin</option>
                                                                        <option value="selasa" {{ $routine->hari == "selasa" ? "selected" : "" }}>Selasa</option>
                                                                        <option value="rabu" {{ $routine->hari == "rabu" ? "selected" : "" }}>Rabu</option>
                                                                        <option value="kamis" {{ $routine->hari == "kamis" ? "selected" : "" }}>Kamis</option>
                                                                        <option value="jumat" {{ $routine->hari == "jumat" ? "selected" : "" }}>Jumat</option>
                                                                        <option value="sabtu" {{ $routine->hari == "sabtu" ? "selected" : "" }}>Sabtu</option>
                                                                        <option value="minggu" {{ $routine->hari == "minggu" ? "selected" : "" }}>Minggu</option>
                                                                    </select>
                                                                </div>


                                                                <label for="nim" class="form-label fs-5">Jam Mulai</label>
                                                                <div>
                                                                    <input value="{{$routine->jam_mulai}}" name="jam_mulai" type="time" class="form-control" required>
                                                                </div>
                                                                <label for="nim" class="form-label fs-5">Jam Selesai</label>
                                                                <div>
                                                                    <input value="{{$routine->jam_selesai}}" name="jam_selesai" type="time" class="form-control" required>
                                                                </div>
                                                                <div class="d-grid gap-2 justify-content-center">
                                                                    <div class="row ">
                                                                        <div class="col-md-8 mt-3">
                                                                            <button class="btn btn-primary" type="submit">Edit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <a class="btn btn-sm btn-danger text-left" href="{{ route('dashboard.routines.delete', ['id' => $routine->id]) }}" style="float:left;"><span class="bx bx-trash"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="mt-2">
            <div class="pagination justify-content-end">{!! $data['routines']->links('vendor.pagination.custom') !!} </div>
        </nav>
    </div>
@endsection
