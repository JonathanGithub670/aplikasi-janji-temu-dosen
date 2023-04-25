<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>404 Error Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="account-pages my-3 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1>
                        <h4 class="text-uppercase">Mohon Maaf, Halaman Yang dituju tidak ditemukan</h4>
                        <div class="mt-5 text-center">


                            {{-- @if (Auth::user()->role != 'superadmin'){
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.choose') }}">Kembali Ke Aplikasi Reservasi</a>
                            }@elseif((Auth::user()->role != 'admin' || (Auth::user()->role != 'user'))){
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">Kembali Ke Aplikasi Reservasi</a>
                            }@else{

                            }
                            @endif --}}
                            {{-- @if (Auth::user()->role == 'superadmin'){
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">Kembali
                                Ke Aplikasi Reservasi</a>
                            }@elseif(Auth::user()->role == 'admin'){
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.list') }}">Kembali
                                Ke Aplikasi Reservasi</a>
                            }@else{
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.choose') }}">Kembali
                                Ke Aplikasi Reservasi</a>
                            }
                            @endif --}}
                            {{-- <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">
                                Kembali Ke Aplikasi Reservasi
                            </a> --}}
                            {{-- @dd(info(Auth::user())) --}}
                            {{-- {{ info(Auth::user()) }} --}}
                            {{-- @if (Auth::user())
                                @if (Auth::user()->can('isSuperAdmin'))
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">
                                    Kembali Ke Aplikasi Reservasi
                                    </a>
                                @elseif (Auth::user()->can('isAdmin'))
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.calendar') }}">
                                    Kembali Ke Aplikasi Reservasi
                                    </a>
                                @else
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.choose') }}">
                                    Kembali Ke Aplikasi Reservasi
                                    </a>
                                @endif
                            @else
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.choose') }}">
                                    Kembali Ke Aplikasi Reservasi
                                    </a>
                            @endif --}}
                            
                            {{-- {{ info(Auth::user()); }} --}}
                            {{-- @can('isSuperAdmin')
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">
                                    Kembali Ke  Aplikasi Reservasi Super
                                </a>
                            @elsecan('isAdmin')
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.calendar') }}">
                                    Kembali Ke Aplikasi Reservasi Admin
                                </a>
                            @else
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.choose') }}">
                                    Kembali Ke Aplikasi Reservasi Mahasiswa
                                </a>
                            @endcan --}}

                            {{-- @can('isSuperadmin')
                                <form onsubmit="return confirm('Publish post ini?');"
                                    action="{{ route('dashboard') }}" method="POST">

                                    @csrf
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Kembali Ke Aplikasi Reservasi</button>
                                </form>
                            @endcan
                            @can('isAdmin', 'isUser')
                                <form onsubmit="return confirm('Publish post ini?');"
                                    action="{{ route('dashboard.choose') }}" method="POST">

                                    @csrf
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Kembali Ke Aplikasi Reservasi</button>
                                </form>
                            @endcan --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img src="{{ asset('assets/images/error-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>



</html>
