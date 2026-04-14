@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Perhitungan TOPSIS</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard <a href="{{ route('dashboard') }}"></a> | <strong>
                            TOPSIS</strong></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="card-title fs-5">Kriteria</h4>
                    <p class="card-title-desc">
                        Ini merupakan menu untuk membuat Kriteria
                    </p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalKriteria"
                    data-bs-whatever="@fat"><i class="bx bx-plus"></i> Kriteria</button>

                <div class="modal fade" id="exampleModalKriteria" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kriteria</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kriteria.create') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="kode-kriteria" class="col-form-label">Kode :</label>
                                        <input type="text" class="form-control" id="kode-kriteria" name="kode">
                                        <small id="nama-kriteria-help" class="text-muted"></small>
                                    </div>
                                        <script>
                                            var input = document.getElementById('kode-kriteria');
                                            var helpText = document.getElementById('nama-kriteria-help');
                                            input.addEventListener('input', function() {
                                                if (input.value.length > 10) {
                                                    helpText.textContent = 'Maksimal 10 karakter.';
                                                } else {
                                                    helpText.textContent = '';
                                                }
                                            });
                                        </script>
                                    <div class="mb-3">
                                        <label for="nama-kriteria" class="col-form-label">Nama Kriteria :</label>
                                        <input type="text" class="form-control" id="nama-kriteria" name="nama">
                                    </div>
                                    <div class="mb-3">
                                        <label for="atribut-kriteria" class="col-form-label">Atribut :</label>
                                        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="atribut">
                                            <option selected disabled>-- Silahkan Pilih --</option>
                                            <option value="1">Benefit</option>
                                            <option value="2">Cost</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bobot-kriteria" class="col-form-label">Bobot :</label>
                                        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="bobot">
                                            <option selected disabled>-- Silahkan Pilih --</option>
                                            <option value="1">Sangat Rendah</option>
                                            <option value="2">Rendah</option>
                                            <option value="3">Cukup</option>
                                            <option value="4">Tinggi</option>
                                            <option value="5">Sangat Tinggi</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align:center">No</th>
                            <th style="text-align:center">Kode</th>
                            <th style="text-align:center">Nama Kriteria</th>
                            <th style="text-align:center">Atribut</th>
                            <th style="text-align:center">Bobot</th>
                            <th style="text-align:center" colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $k)
                            <tr>
                                <td style="text-align:center">{{ $loop->iteration }}</td>
                                <td style="text-align:center">{{ $k->kode }}</td>
                                <td style="text-align:center">{{ $k->nama_kriteria }}</td>
                                <td style="text-align:center">
                                    @if ($k->atribut == "1") Benefit @endif
                                    @if ($k->atribut == "2") Cost @endif
                                </td>
                                <td style="text-align:center">
                                    @if ($k->bobot == "1") Sangat Rendah @endif
                                    @if ($k->bobot == "2") Rendah @endif
                                    @if ($k->bobot == "3") Cukup @endif
                                    @if ($k->bobot == "4") Tinggi @endif
                                    @if ($k->bobot == "5") Sangat Tinggi @endif

                                </td>
                                <td style="text-align:center">
                                    <a href="#" data-toggle="modal" data-target="#editModal{{ $k->kode }}">Edit</a>
                                    |
                                    <a href="{{ route('kriteria.destroy', $k->kode) }}" onclick="event.preventDefault(); confirmDelete('{{ $k->kode }}')">Hapus</a>
                                        <form id="delete-form-{{ $k->kode }}" action="{{ route('kriteria.destroy', $k->kode) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <script>
                                            function confirmDelete(kode) {
                                                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                                                    document.getElementById('delete-form-' + kode).submit();
                                                }
                                            }
                                        </script>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $k->kode }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $k->kode }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="editModalLabel{{ $k->kode }}">Edit Kriteria</h5>

                                        </div>
                                        <div class="modal-body">
                                            <form form action="{{ route('kriteria.update', $k->kode) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Input fields for editing data -->
                                                <div class="mb-3">
                                                    <label for="edit-kode-kriteria" class="col-form-label">Kode :</label>
                                                    <input type="text" class="form-control" id="edit-kode-kriteria" name="kode" value="{{ $k->kode }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-kriteria" class="col-form-label">Nama Kriteria :</label>
                                                    <input type="text" class="form-control" id="edit-nama-kriteria" name="nama" value="{{ $k->nama_kriteria }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-atribut-kriteria" class="col-form-label">Atribut :</label>
                                                    <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="atribut">
                                                        <option value="Benefit" @if ($k->atribut == "Benefit") selected @endif>Benefit</option>
                                                        <option value="Cost" @if ($k->atribut == "Cost") selected @endif>Cost</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-bobot-kriteria" class="col-form-label">Bobot :</label>
                                                    <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="bobot">
                                                        <option value="1" @if ($k->bobot == "1") selected @endif>Sangat Rendah</option>
                                                        <option value="2" @if ($k->bobot == "2") selected @endif>Rendah</option>
                                                        <option value="3" @if ($k->bobot == "3") selected @endif>Cukup</option>
                                                        <option value="4" @if ($k->bobot == "4") selected @endif>Tinggi</option>
                                                        <option value="5" @if ($k->bobot == "5") selected @endif>Sangat Tinggi</option>
                                                    </select>
                                                </div>
                                                <!-- Submit button -->
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="card-title fs-5">Alternatif</h4>
                    <p class="card-title-desc">
                        Ini merupakan menu untuk membuat Alternatif
                    </p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModalAlternatif" data-bs-whatever="@fat"><i class="bx bx-plus"></i>
                    Alternatif</button>

                <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Alternatif</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('alternatif.create') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="kode-alternatif" class="col-form-label">Kode :</label>
                                        <input type="text" class="form-control" id="kode-alternatif" name="kode">
                                        <small id="nama-alternatif-help" class="text-muted"></small>
                                    </div>
                                        <script>
                                            var input = document.getElementById('kode-alternatif');
                                            var helpText = document.getElementById('nama-alternatif-help');
                                            input.addEventListener('input', function() {
                                                if (input.value.length > 10) {
                                                    helpText.textContent = 'Maksimal 10 karakter.';
                                                } else {
                                                    helpText.textContent = '';
                                                }
                                            });
                                        </script>
                                    <div class="mb-3">
                                        <label for="nama-alternatif" class="col-form-label">Nama Alternatif :</label>
                                        <input type="text" class="form-control" id="nama-alternatif" name="nama">
                                    </div>
                                    <button type="submit" class="btn btn-primary">ADD</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align:center">No</th>
                            <th style="text-align:center">Kode</th>
                            <th style="text-align:center">Nama Alternatif</th>
                            <th style="text-align:center" colspan="3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif as $k )
                            <tr>
                                <td style="text-align:center">{{ $loop->iteration }}</td>
                                <td style="text-align:center">{{ $k->kode_alternatif }}</td>
                                <td style="text-align:center">{{ $k->nama_alternatif }}</td>
                                <td style="text-align:center">
                                    <a href="#" data-toggle="modal" data-target="#editModalpenilaianalternatif{{ $k->kode_alternatif }}">Penilaian</a>
                                    |
                                    <a href="#" data-toggle="modal" data-target="#editModalalternatif{{ $k->kode_alternatif }}">Edit</a>
                                    |
                                    <a href="{{ route('alternatif.destroy', $k->kode_alternatif) }}" onclick="event.preventDefault(); confirmDelete('{{ $k->kode_alternatif }}')">Hapus</a>
                                            <form id="delete-form-{{ $k->kode_alternatif }}" action="{{ route('alternatif.destroy', $k->kode_alternatif) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                                <script>
                                                    function confirmDelete(kode) {
                                                        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-' + kode).submit();
                                                        }
                                                    }
                                                </script>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModalalternatif{{ $k->kode_alternatif }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $k->kode_alternatif }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="editModalLabel{{ $k->kode_alternatif }}">Edit alternatif</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form form action="{{ route('alternatif.update', $k->kode_alternatif) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Input fields for editing data -->
                                                <div class="mb-3">
                                                    <label for="edit-kode-alternatif" class="col-form-label">Kode :</label>
                                                    <input type="text" class="form-control" id="edit-kode-alternatif" name="kode" value="{{ $k->kode_alternatif }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-alternatif" class="col-form-label">Nama alternatif :</label>
                                                    <input type="text" class="form-control" id="edit-nama-alternatif" name="nama" value="{{ $k->nama_alternatif }}">
                                                </div>

                                                <!-- Submit button -->
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal penilaian -->
                            <div class="modal fade" id="editModalpenilaianalternatif{{ $k->kode_alternatif }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $k->kode_alternatif }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="editModalLabel{{ $k->kode_alternatif }}">Penilaian alternatif</h5>

                                        </div>
                                        <div class="modal-body">
                                            <form form action="{{ route('alternatif.penilaian', $k->kode_alternatif) }}" method="POST">
                                                @csrf
                                                <!-- Input fields for editing data -->
                                                <div class="mb-3">
                                                    <label for="edit-kode-alternatif" class="col-form-label">Kode :</label>
                                                    <input type="text" class="form-control" id="edit-kode-alternatif" name="kode" value="{{ $k->kode_alternatif }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-alternatif" class="col-form-label">Nama alternatif :</label>
                                                    <input type="text" class="form-control" id="edit-nama-alternatif" name="nama" value="{{ $k->nama_alternatif }}" readonly>
                                                </div>

                                                @foreach($kriteria as $item)
                                                <div class="mb-3">
                                                    <label for="penilaian" class="col-form-label">{{$item->nama_kriteria}}</label>
                                                    <input type="hidden" name="id_alternatif" value="{{ $k->kode_alternatif }}">
                                                    <input type="hidden" name="id_kriteria[]" value="{{ $item->kode}}">
                                                        @php
                                                            $existingData = DB::table('relations')
                                                                ->where('alternatif', $k->kode_alternatif)
                                                                ->where('kriteria', $item->kode)
                                                                ->first();

                                                                if ($existingData) {
                                                                    $nilai = $existingData->nilai;
                                                                } else {
                                                                    $nilai = 0;
                                                                }
                                                        @endphp
                                                    <input type="number" class="form-control" id="edit-nama-alternatif" name="nilai[]" value="{{$nilai}}" step="0.1">
                                                </div>
                                                @endforeach

                                                <!-- Submit button -->
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-grid gap-2 justify-content-center">
        <a href="{{ route('hasil')}}"><button type="submit" class="btn btn-outline-success btn-lg">Hasil</button></a>
    </div>
    <nav aria-label="Page navigation example" class="mt-2">
        {{-- <div class="pagination justify-content-end">{!! $data['routines']->links('vendor.pagination.custom') !!} </div> --}}
    </nav>
    </div>
@endsection
