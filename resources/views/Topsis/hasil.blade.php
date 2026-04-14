@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Hasil Perhitungan TOPSIS</h4>
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

{{-- Table Kecocokan --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="card-title fs-5">Kecocokan</h4>
                    <p class="card-title-desc">
                        Nilai Kecocokan Terhadap Alternatif
                    </p>
                </div>

                <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">

                </div>
                <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align:center">No</th>
                            <th style="text-align:center">Nama Alternatif</th>
                            @foreach ($kriteria as $dataK)
                                  <th style="text-align:center" >{{$dataK->nama_kriteria}}</th>
                                  @php
                                      $id[] = $dataK->kode;
                                  @endphp
                              @endforeach
                        </tr>
                    </thead>
                        @foreach ($alternatif as $keyT => $dataT)
                              <tbody>
                                  <td>{{$keyT+1}}</td>
                                  <td>{{$dataT->nama_alternatif}}</td>
                                  @foreach ($kriteria as $keyK => $dataK)
                                      <td style="text-align:center">
                                          {{DB::table('relations')
                                          ->where('alternatif', $dataT->kode_alternatif)
                                          ->where('kriteria', $id[$keyK])
                                          ->orderBy('nilai', 'ASC')
                                          ->value('nilai')
                                          ;}}
                                      </td>
                                  @endforeach
                              </tbody>
                              @endforeach

                </table>
            </div>
        </div>
    </div>
{{-- Table Normalisasi --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="card-title fs-5">Normalisasi</h4>
                    <p class="card-title-desc">
                        Nilai Normalisasi
                    </p>
                </div>

                <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">

                </div>
                <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align:center">No</th>
                            <th style="text-align:center">Nama Alternatif</th>
                            @foreach ($kriteria as $dataK)
                                  <th style="text-align:center" >{{$dataK->nama_kriteria}}</th>
                                  @php
                                      $id[] = $dataK->kode;
                                  @endphp
                              @endforeach
                        </tr>
                    </thead>
                    @foreach ($alternatif as $keyA => $dataA)
                              <tbody>
                                  <td>{{$keyA+1}}</td>
                                  <td>{{$dataA->nama_alternatif}}</td>
                                      @for ($j = 0; $j < $jmlh_kriteria; $j++)
                                          <td style="text-align:center">{{$normalisasi[$keyA][$j]}}</td>
                                      @endfor
                              </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
{{-- Table Normalisasi Terbobot --}}
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="card-title fs-5">Normalisasi Terbobot</h4>
                <p class="card-title-desc">
                    Nilai Normalisasi Terbobot
                </p>
            </div>

            <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

            </div>
            <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                <thead>
                        <tr class="table-secondary">
                            <th style="text-align:center">No</th>
                            <th style="text-align:center">Nama Alternatif</th>
                            @foreach ($kriteria as $dataK)
                                  <th style="text-align:center" >{{$dataK->nama_kriteria}}</th>
                                  @php
                                      $id[] = $dataK->kode;
                                  @endphp
                              @endforeach
                        </tr>
                    </thead>
                    @foreach ($alternatif as $keyA => $dataA)
                          <tbody>
                              <td>{{$keyA+1}}</td>
                              <td>{{$dataA->nama_alternatif}}</td>
                                  @for ($j = 0; $j < $jmlh_kriteria; $j++)
                                      <td style="text-align:center">{{$normalisasi_terbobot[$keyA][$j]}}</td>
                                  @endfor
                          </tbody>
                          @endforeach
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Table Matriks Solusi Ideal Positif --}}
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="card-title fs-5">Matriks Solusi Ideal Positif</h4>
                <p class="card-title-desc">
                    Nilai Matriks Solusi Ideal Positif
                </p>
            </div>

            <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

            </div>
            <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                <thead>
                    <tr class="table-secondary">
                        @foreach ($kriteria as $dataK)
                              <th style="text-align:center">{{$dataK->kode}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteria as $keyK => $dataK)
                              <td style="text-align:center">{{$positif[$keyK]}}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Table Matriks Solusi Ideal Negatif --}}
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="card-title fs-5">Matriks Solusi Ideal Negatif</h4>
                <p class="card-title-desc">
                    Nilai Matriks Solusi Ideal Negatif
                </p>
            </div>

            <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

            </div>
            <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                <thead>
                    <tr class="table-secondary">
                        <tr class="table-secondary">
                            @foreach ($kriteria as $dataK)
                                  <th style="text-align:center">{{$dataK->kode}}</th>
                            @endforeach
                        </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteria as $keyK => $dataK)
                              <td style="text-align:center">{{$negatif[$keyK]}}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Table Jarak Solusi --}}
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="card-title fs-5">Jarak Solusif</h4>
                <p class="card-title-desc">
                    Nilai Jarak Solusi
                </p>
            </div>

            <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

            </div>
            <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                <thead>
                    <tr class="table-secondary">
                        <th style="text-align:center">NO</th>
                        <th style="text-align:center">Jarak Solusi Ideal Positif (+)</th>
                        <th style="text-align:center">Jarak Solusi Ideal Negatif (-)</th>
                    </tr>
                </thead>
                    @foreach ($alternatif as $keyA => $dataA)
                          <tbody>
                              <td style="text-align:center">{{$keyA+1}}</td>
                              <td style="text-align:center">{{$hasil_positif[$keyA]}}</td>
                              <td style="text-align:center">{{$hasil_negatif[$keyA]}}</td>

                          </tbody>
                    @endforeach
            </table>
        </div>
    </div>
</div>
{{-- Table Nilai Preferensi --}}
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="card-title fs-5">Nilai Preferensi</h4>
                <p class="card-title-desc">
                    Nilai Preferensi
                </p>
            </div>

            <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

            </div>
            <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                <thead>
                    <tr class="table-secondary">
                        <th style="text-align:center">No</th>
                        <th style="text-align:center">Nama</th>
                        <th style="text-align:center">Prefrensi</th>
                    </tr>
                </thead>
                @foreach ($alternatif as $keyA => $dataA)
                          <tbody>
                              <td style="text-align:center">{{$keyA+1}}</td>

                              <td style="text-align:center">{{$dataA->nama_alternatif}}</td>

                              <td style="text-align:center">{{$preferensi[$keyA]}}</td>
                          </tbody>
                          @endforeach
            </table>
        </div>
    </div>
</div>
{{-- Table Hasil Akhir --}}
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="card-title fs-5">Hasil Akhir</h4>
                <p class="card-title-desc">
                    Nilai Hasil Akhir
                </p>
            </div>

            <div class="modal fade" id="exampleModalAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

            </div>
            <table class="table table-bordered dt-responsive  nowrap w-100 mt-4">
                <thead>
                    <tr class="table-secondary">
                        <th style="text-align:center">Rangking</th>
                        <th style="text-align:center">Nama</th>
                        <th style="text-align:center">Prefrensi</th>
                    </tr>
                </thead>
                @foreach ($rangking as $key => $data)
                          <tbody>
                              <td style="text-align:center">{{$key+1}}</td>

                              <td style="text-align:center">{{DB::table('alternatif')
                                ->where('kode_alternatif', $data->alternatif)
                                ->value('nama_alternatif')

                             }}</td>

                              <td style="text-align:center">{{$data->hasil}}</td>
                          </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

    <div class="d-grid gap-2 justify-content-center">
        <a href="{{route('dashboard.topsis')}}"><button type="Back" class="btn btn-outline-success btn-lg">Back</button></a>
    </div>
    <nav aria-label="Page navigation example" class="mt-2">
        {{-- <div class="pagination justify-content-end">{!! $data['routines']->links('vendor.pagination.custom') !!} </div> --}}
    </nav>
    </div>
@endsection
