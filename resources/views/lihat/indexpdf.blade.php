{{-- <!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Invoice Detail | Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16" align="right">Order # 12345</h4>
                                        <div class="mb-4">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo" height="20" align="left"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <address>
                                                    <strong>DARI</strong><br>
                                                    {{ $choose->create->nip }}<br>
                                                    {{ $choose->create->name }}<br>
                                                    {{ $choose->create->email }}<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <address class="mt-2 mt-sm-0">
                                                    <strong>KEPADA</strong><br>
                                                    {{ $choose->user->nip }}<br>
                                                    {{ $choose->user->name }}<br>
                                                    {{ $choose->user->email }}<br>
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

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="rightbar-overlay"></div>

        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>

</body>


</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Detail</title>
</head>
<style>
.right{
    float:right;
}

.left{
    float:left;
}
</style>
<body>
    <div class="invoice-title">
        <h4 class="float-end font-size-16" align="right">{{$choose->no_pdf}}</h4>
        <div class="mb-4">
            {{-- <img src="public/img/kominfo.png" alt="logo" height="20" align="left"/> --}}
        </div>
    </div>
    <hr>
    <br>
    <h1 style="text-align: center">BUKTI RESERVASI</h1>
    <br>
    <br>
    <br>
    <span class="right" style="text-align: right">
        <b>KEPADA</b> <br>
        {{ $choose->user->nim }}<br>
        {{ $choose->user->name }}<br>
        {{-- {{ $choose->user->email }}<br> --}}
        Springfield, ST 54321

        <br>
        <br>
        <br>
        <br>
        <br>

        <b>WAKTU RESERVASI</b> <br>
        {{ \Carbon\Carbon::parse($choose->datetime)->translatedFormat('l, d F Y H:i') }}<br><br>
    </span>
    <span class="left" style="text-align: left">


        <b>DARI </b> <br>
        {{ $choose->create->nim }}<br>
        {{ $choose->create->name }}<br>
        {{-- {{ $choose->create->email }}<br>  --}}

        <br>
        <br>
        <br>
        <br>
        <br>
    </span>

</body>
</html>
