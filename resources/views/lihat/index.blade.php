@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Bukti Reservasi</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard | <a href="{{ route('dashboard.list') }}">Daftar Pertemuan | </a>
                    <strong>Bukti Reservasi</strong>
                    </li>
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
                                {{-- <a href="{{ route('dashboard.list.pdf') }}"> --}}
                                {{-- <a href="">
                                    <button class="btn btn-danger buttons-pdf buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button"><i class="bi bi-file-earmark-pdf"> </i>PDF</button>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16">{{ $choose->no_pdf }}</h4>
                                    <div>
                                        <img src="{{ asset('img/kominfo.png') }}" alt="logo2" style="height: 80px;" />
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <h1 style="text-align: center">BUKTI RESERVASI</h1>
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <address>
                                            <strong>DARI</strong><br>
                                            {{ $choose->create->nim }}<br>
                                            <span class="text-capitalize"> {{ $choose->create->name }}</span><br>
                                            {{-- {{ $choose->create->email }}<br> --}}
                                            Semester {{ $choose->semester }}<br>
                                            {{ $choose->prodi }}<br>

                                            {{-- {{ $list_semester->find($item->semester)->isi_semester }} --}}
                                            {{-- @php
                                                $prodi = Illuminate\Support\Facades\DB::table('program_studi')->where('prodi_create_user_id','=',$item->create_user_id)->first();
                                            @endphp
                                            {{ $prodi?$prodi->nama_program_studi:"" }} --}}
                                        </address>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <address class="mt-2 mt-sm-0">
                                            <strong>KEPADA</strong><br>
                                            {{ $choose->user->nim }}<br>
                                            <span class="text-capitalize"> {{ $choose->user->name }}</span><br>
                                            {{-- {{ $choose->user->email }}<br> --}}
                                            <span class="text-capitalize">{{ $choose->jabatan }}</span><br>
                                        </address>
                                    </div>
                                <br>
                                <hr>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mt-3">
                                        <address>

                                        </address>
                                    </div>
                                    <div class="col-sm-6 mt-3 text-sm-end">
                                        <address>
                                            <strong>WAKTU RESERVASI</strong><br>
                                            {{ \Carbon\Carbon::parse($choose->datetime)->translatedFormat('l, d F Y H:i') }}<br><br>
                                        </address>
                                    </div>
                                </div>
                                {{-- <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">Order summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Item</th>
                                                        <th class="text-end">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>02</td>
                                                        <td>Template</td>
                                                        <td class="text-end">$399.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>03</td>
                                                        <td>Veltrix - Admin Dashboard Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-end">Sub Total</td>
                                                        <td class="text-end">$1397.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="border-0 text-end">
                                                            <strong>Shipping</strong></td>
                                                        <td class="border-0 text-end">$13.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="border-0 text-end">
                                                            <strong>Total</strong></td>
                                                        <td class="border-0 text-end"><h4 class="m-0">$1410.00</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> --}}
                                {{-- <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="{{ route('dashboard.list.pdf'), $item->id }}" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                <a href="javascript: void(0);" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                            </div>
                                        </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
@endsection
{{-- @section('topdf')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dt-buttons btn-group flex-wrap">
                                <a href="{{ route('dashboard.list.pdf') }}">
                                <a href="">
                                    <button class="btn btn-danger buttons-pdf buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button"><i class="bi bi-file-earmark-pdf"> </i>PDF</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive pdfsection">
                    <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <h4 class="float-end font-size-16">Order # 12345</h4>
                                            <div class="mb-4">
                                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo" height="20"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <address>
                                                    <strong>DARI</strong><br>
                                                    {{ $choose->create->nim }}<br>
                                                    {{ $choose->create->name }}<br>
                                                    {{ $choose->create->email }}<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <address class="mt-2 mt-sm-0">
                                                    <strong>KEPADA</strong><br>
                                                    {{ $choose->user->nim }}<br>
                                                    {{ $choose->user->name }}<br>
                                                    {{ $choose->user->email }}<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                            <div class="col-sm-6">
                                                <address>
                                                    <strong>DARI</strong><br>
                                                    {{ $choose->nim }}<br>
                                                    {{ $choose->name }}<br>
                                                    {{ $choose->email }}<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <address class="mt-2 mt-sm-0">
                                                    <strong>KEPADA</strong><br>
                                                    {{ $choose->nim }}<br>
                                                    {{ $choose->name }}<br>
                                                    {{ $choose->email }}<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 mt-3">
                                                <address>
                                                    <strong>Payment Method:</strong><br>
                                                    Visa ending **** 4242<br>
                                                    jsmith@email.com
                                                </address>
                                            </div>
                                            <div class="col-sm-6 mt-3 text-sm-end">
                                                <address>
                                                    <strong>WAKTU RESERVASI</strong><br>
                                                    {{ \Carbon\Carbon::parse($choose->datetime)->translatedFormat('l, d F Y H:i') }}<br><br>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">Order summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Item</th>
                                                        <th class="text-end">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>02</td>
                                                        <td>Template</td>
                                                        <td class="text-end">$399.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>03</td>
                                                        <td>Veltrix - Admin Dashboard Template</td>
                                                        <td class="text-end">$499.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-end">Sub Total</td>
                                                        <td class="text-end">$1397.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="border-0 text-end">
                                                            <strong>Shipping</strong></td>
                                                        <td class="border-0 text-end">$13.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="border-0 text-end">
                                                            <strong>Total</strong></td>
                                                        <td class="border-0 text-end"><h4 class="m-0">$1410.00</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="{{ route('dashboard.list.pdf'), $item->id }}" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                <a href="javascript: void(0);" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
