@extends('dashboard.layout.main')

@section('style')

@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Jam Off</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard <a href="{{ route('dashboard.routines') }}"> | Daftar Rutinitas </a> <a href="{{ route('dashboard.off.create') }}"> | <strong> Tambah Jam Off</strong> </a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="row d-flex justify-content-center">
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
                            <form action="{{ route('dashboard.off.store') }}" method="POST" class="p-3 mt-2">
                                @csrf
                                @if(auth()->user()->role == "admin")
                                    <input value="{{ request('id') }}" name="user_id" id="user_id" type="number" hidden>
                                @else
                                    <input value="{{ auth()->id() }}" name="user_id" id="user_id" type="number" hidden>
                                @endif
                                <h4 class="card-title fs-5">Jam Off</h4>
                                <p class="card-title-desc">
                                    Ini merupakan menu untuk mengatur jam off dari dosen
                                </p>
                                <input name="keterangan" type="text" class="form-control" value="off" hidden>
                                <label for="hari" class="form-label fs-5">Tanggal</label>
                                <div>
                                    <input id="date" name="tanggal" type="text" class="form-control datepicker" onchange="saveDate()" required>
                                </div>
                                <div class="mb-3 mt-3 d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary" onclick="pilihJam()" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                        <span id="tentukan-jam-pertemuan">Tentukan Jam Pertemuan</span>
                                    </button>

                                    <style>
                                        .btn-group-vertical .btn:not(:first-child),
                                        .btn-group-vertical .btn:not(:last-child) {
                                            border-radius: 0;
                                        }

                                        .btn-group-vertical input[type="radio"] {
                                            margin: 5px 0;
                                            border-radius: 0;
                                        }
                                    </style>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><strong>Pilih Jam yang tersedia</strong></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body" id="modal-body">
                                                    <div class="d-grid">
                                                        <div id="demos" class="btn-group flex-column" role="group" aria-label="Basic radio toggle button group">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="pilih()" data-bs-dismiss="modal">Pilih</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap 4 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        let todayWithoutFormat = new Date().toLocaleDateString('en-US');
        let today = todayWithoutFormat.replace(/\//g, '-');
        let datesForDisable = [];

        if (datesForDisable.includes(today)) {
            $('.datepicker').datepicker({
                format: 'mm-dd-yyyy',
                autoclose: true,
                datesDisabled: datesForDisable,
                startDate: new Date(),
                daysOfWeekDisabled: [0, 6],
            });
        } else {
            $('.datepicker').datepicker({
                format: 'mm-dd-yyyy',
                autoclose: true,
                todayHighlight: true,
                datesDisabled: datesForDisable,
                startDate: new Date(),
                daysOfWeekDisabled: [0, 6],
            });
        }

        $('.input-link').on('click', function() {
            var input_id = $(this).data('input-id');
            $('#' + input_id).focus();
        });

        let user_id, day, date, jam;

        function saveUserId() {
            user_id = document.getElementById("user_id").value;
            getDisableDate();
        }

        function myConvertDate(yourDates){
            let myDates = yourDates.split("/");
            let bulan = myDates[1] < 10?"0"+myDates[1]:myDates[1];
            let tanggal = myDates[0] < 10?"0"+myDates[0]:myDates[0];

            return myDates[2]+"-"+bulan+"-"+tanggal
        }

        function saveDate() {
            const dates = new Date(document.getElementById("date").value);
            const options = {
                weekday: 'long',
                timeZone: 'Asia/Jakarta'
            };

            date = myConvertDate(dates.toLocaleDateString('id-ID', {timeZone: 'Asia/Jakarta'}));
            day = dates.toLocaleString('id-ID', options);
            saveUserId();
        }

        function changeButtonJam(value){
            jam = value;
        }

        function pilih(){
            document.getElementById('tentukan-jam-pertemuan').innerHTML = jam;
            document.getElementById('jam').value = jam;
        }

        function getDisableDate(){
            fetch('/dashboard/getDisableData?'+ new URLSearchParams(
                {
                    queryUserId: user_id
                }))
                .then(response => response.json())
                .then(datas => {datesForDisable = datas;});
        }

        function pilihJam() {
            if(date){
                fetch('/dashboard/pilihJamOff?'+ new URLSearchParams(
                    {
                        queryUserId: user_id,
                        queryDay: day,
                        queryDate: date
                    }))
                    .then(response => response.json())
                    .then(datas => {
                        console.log(datas);
                        let index = 0;
                        document.getElementById('demos').innerHTML = '';
                        datas.forEach((data) => {
                            if(data.status){
                                document.getElementById('demos').innerHTML += `<input type="checkbox" class="btn-check" name="fakeJam[]" id="jam-${index}" autocomplete="off" value="${data.time}" onclick="changeButtonJam('${data.time}')"><label class="btn btn-outline-primary" for="jam-${index}">${data.time}</label>`;
                            }else{
                                document.getElementById('demos').innerHTML += `<input type="checkbox" class="btn-check" name="fakeJam[]" id="jam-${index}" autocomplete="off" value="${data.time}" disabled><label class="btn btn-secondary" for="jam-${index}">${data.time}</label>`;
                            }
                            index++;
                        });
                    });
            }else{
                document.getElementById('demos').innerHTML = '<p class="text-center">Silahkan pilih Tanggal terlebih dahulu</p>';
            }
        }

    </script>
@endsection
