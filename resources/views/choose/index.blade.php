@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Choose User</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard<a href="{{ route('dashboard.choose') }}"> | <strong> Choose
                                User</strong></a></li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="col-12" onload="refreshPage()">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Choose User</h4>
                <p class="card-title-desc">
                    ini merupakan halaman untuk membuat reservasi pertemuan dengan Dosen, Fungsionaris dan Chaplin.
                </p>
                <form action="{{ route('dashboard.choose') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('alert_message'))
                        <div class="mt-5">
                            <div class="alert alert-{{ session('alert_type') }} alert-dismissible fade show" role="alert">
                                {{ session('alert_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="mb-4 mt-3">
                        <label for="user_id" class="form-label fs-5 ">Pilih Pengguna</label>
                        <select id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            aria-label="Default select example" name="user_id" required>
                            <option selected disabled>Pilih Orang yang ingin ditemui</option>

                            @foreach ($users->where('role') as $item)
                                <option value="{{ $item->id }}">{{ $item->role }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}
                    {{-- <div class="mb-4 mt-3">
                        <label for="user_id" class="form-label fs-5 ">Pilih Pengguna</label>
                        <select id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            aria-label="Default select example" name="user_id" required>
                            <option selected disabled>Pilih Orang yang ingin ditemui</option>

                            @foreach ($users->where('role') as $item)
                                <option value="{{ $item->id }}">{{ $item->role }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}
                    {{-- <div class="mb-4 mt-3">
                        <label for="user_id" class="form-label fs-5 ">Pilih Jabatan</label>
                        <select id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            aria-label="Default select example" name="user_id" required>
                            <option selected disabled>Pilih Orang yang ingin ditemui</option>
                            <option value="1">Dosen</option>
                            <option value="2">Fungsionaris</option>
                            <option value="3">Chaplin</option>
                            @foreach ($users->where('id', 3) as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}
                    <style>
                        select,
                        option {
                            text-transform: capitalize;
                        }
                    </style>
                    <div class="mb-4 mt-3">
                        <label for="user_id" class="form-label fs-5 ">Pilih Dosen dan Chaplin</label>
                        <select id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            aria-label="select example" name="user_id" required onchange="saveUserId()">
                            <option selected disabled>Pilih Orang yang ingin ditemui</option>

                            {{-- @foreach ($users->where('id', 4) as $item) --}}
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}"><span>{{ $item->name }}</span>
                                    ({{ $item->jabatan }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4 mt-3">
                        <label for="semester" class="form-label fs-5 ">Pilih Semester</label>
                        <select id="semester" class="form-select @error('semester') is-invalid @enderror"
                            aria-label="select example" name="semester" required>
                            <option selected disabled>Pilih Semester </option>
                            @foreach ($list_semester as $item)
                                <option value="{{ $item->id }}">{{ $item->isi_semester }}</option>
                            @endforeach
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- <div class="mb-4 mt-3">
                        <label for="user_id" class="form-label fs-5 ">Pilih Jabatan</label>
                        <select id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                            aria-label="Default select example" name="user_id" required>
                            <option selected disabled>Pilih Orang yang ingin ditemui</option>

                            @foreach ($users->where('id', 3) as $item)
                                <option value="{{ $item->id }}"><span class="text-capitalize">{{ $item->name }} | {{ $item->jabatan }}</span></option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fs-5">Pilih Tanggal</label>
                        <style>
                            .datepicker {
                                border-color: #ced4da;
                                cursor: default;
                            }
                            .datepicker::placeholder {
                                color: #495057;
                            }
                            .datepicker td.disabled {
                                /*background-color: #f2f2f2; !* Change the background color of disabled selected cells *!*/
                                color: #e3e5e8; /* Change the font color of disabled selected cells */
                                pointer-events: none; /* Disable pointer events on disabled selected cells */
                            }
                        </style>
                        <div class='input-group'>
{{--                            <input id='datetimepicker1Input' type='text' class='form-control' name="date"--}}
{{--                                value="{{ old('date') }}" placeholder="Tentukan Tanggal Pertemuan"--}}
{{--                                data-td-target='#datetimepicker1' data-td-toggle='datetimepicker' required />--}}
{{--                            <span class='input-group-text' data-td-target='#datetimepicker1'--}}
{{--                                data-td-toggle='datetimepicker'>--}}
{{--                                --}}{{-- <span class='fa-solid fa-calendar'></span> --}}
{{--                                <i class="bi bi-calendar-day"></i>--}}
{{--                            </span>--}}
                            <input type="text" class="form-control datepicker" placeholder="Pilih Tanggal Pertemuan" name="date" id="date" autocomplete="off" aria-describedby="icon-date" onchange="saveDate()">
                            <div class="input-group-append">
                                <span class="input-group-text input-link" data-input-id="date" id="icon-date" style="border-radius: 0; padding-bottom: 10px;"><i class="bi bi-calendar-day"></i>
</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" id="jam" name="jam" hidden>
                        <button type="button" class="btn btn-primary" onclick="pilihJam()" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Tentukan Jam Pertemuan
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
                                        <button type="button" class="btn btn-primary">Pilih</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pembahasan" class="form-label fs-5 ">Pilih Pembahasan</label>
                        <select id="pembahasan" name="pembahasan"
                            class="form-select @error('pembahasan') is-invalid @enderror"
                            aria-label="Default select example">
                            <option selected value="" disabled>Pilih Jenis Pertemuan</option>
                            @foreach ($list_pembahasan as $item)
                                <option value="{{ $item->id }}">{{ $item->ide_pembahasan }}</option>
                            @endforeach
                        </select>
                        @error('pembahasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label fs-5 ">Masukkan Gambar</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="keterangan" class="form-label fs-5">Hal yang ingin dibahas</label>
                    <div class="form-floating mb-3">
                        <textarea name="keterangan" class="form-control  @error('keterangan') is-invalid @enderror"
                            placeholder="Leave a comment here" id="keterangan" style="height: 100px"></textarea>
                        <label for="keterangan">Comments</label>
                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 justify-content-center">
                        <div class="row ">
                            <div class="col=md-8 mt-3">
                                <button class="btn btn-outline-primary" type="submit">Buat Pertemuan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

{{--    <script>--}}
{{--        new tempusDominus.TempusDominus(document.getElementById('datetimepicker1'), {--}}
{{--            display: {--}}
{{--                components: {--}}
{{--                    date: true,--}}
{{--                    time: false--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

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
        let datesForDisable = ["4-22-2023", "4-23-2023", "4-25-2023", "4-27-2023"];

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

    </script>
    <script>
        $('.input-link').on('click', function() {
            var input_id = $(this).data('input-id');
            $('#' + input_id).focus();
        });

        let user_id, day, date;

        function saveUserId() {
            user_id = document.getElementById("user_id").value;
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
        }

        function pilihJam() {
            fetch('/dashboard/pilihJam?'+ new URLSearchParams(
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
                        document.getElementById('demos').innerHTML += `<input type="radio" class="btn-check" name="jam" id="jam-${index}" autocomplete="off" value="${data.time}"><label class="btn btn-outline-primary" for="jam-${index}">${data.time}</label>`;
                        index++;
                    });
                })
        }

    </script>
@endsection
