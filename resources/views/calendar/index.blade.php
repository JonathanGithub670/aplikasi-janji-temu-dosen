@extends('dashboard.layout.main')

@section('style')
    {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"> --}}

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css"> --}}

    <link href="{{ asset('assets/libs/%40fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/%40fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/%40fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/%40fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
    @can('isAdmin')
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Halaman Kalender</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard | <a href="{{ route('dashboard.daftar_dosen') }}"> Daftar Dosen | </a><a href="{{ route('dashboard.calendar') }}"><strong>Calendar</strong> </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    @elsecan('isMahasiswa')
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Halaman Jadwal Dosen</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard | <a href="{{ route('dashboard.daftar_dosen') }}"> Daftar Dosen | </a><a href="{{ route('dashboard.calendar') }}"><strong>Calendar</strong> </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    @else
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Halaman Jadwal Dosen</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard | <a href="{{ route('dashboard.calendar') }}"><strong>Calendar</strong> </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('container')
    <div class="col-12">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title text-light">Jadwal Dosen Nama Dosen</h4>
                <p class="card-title-desc text-light">
                    ini merupakan halaman untuk menampilkan jadwal dosen berbentuk kalender
                </p>
                <div class="row">
                    <div>
                        <div id="external-events" class="mt-2">

                        </div>
                    </div> <!-- end col-->
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    {{-- <script src="{{ asset('assets/js/pages/calendars-full.init.js') }}"></script> --}}
    <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40fullcalendar/core/main.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40fullcalendar/bootstrap/main.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40fullcalendar/daygrid/main.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40fullcalendar/timegrid/main.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40fullcalendar/interaction/main.min.js') }}"></script>

    {{-- @foreach ($lists as $item) --}}
        {{-- @dd($lists) --}}
{{--    <style>--}}
{{--        .fc-time-grid-event{--}}
{{--            height: 30px;--}}
{{--        }--}}
{{--    </style>--}}
    <style>
        .fc-time-grid-event{
            width: 18%;
            height: 27px;
            padding: 0;
        }
        .border-success {
            border-color: #28a745 !important;
        }

        .border-danger {
            border-color: #dc3545 !important;
        }
    </style>
    <script>
        let pageMode = "dayGridMonth";
        @if(isset($_GET['view']))
            @if(request()->get('view') == "week")
            pageMode = "timeGridWeek";
            @elseif(request()->get('view') == "day")
                pageMode = "timeGridDay";
            @else
                pageMode = "dayGridMonth";
            @endif
        @endif
        let pageDefaultDate = 0;
        @if(request()->get('month') && request()->get('year'))
            pageDefaultDate = `{{ request()->get('year') }}-{{ request()->get('month') }}-01`;
        @else
            pageDefaultDate = `{{ date('Y') }}-{{ date('m') }}-01`;
        @endif
        ! function(g) {
            "use strict";

            function e() {}
            e.prototype.init = function() {
                var l = g("#event-modal"),
                    t = g("#modal-title"),
                    a = g("#form-event"),
                    i = null,
                    r = null,
                    s = document.getElementsByClassName("needs-validation"),
                    i = null,
                    r = null,
                    e = new Date,
                    n = e.getDate(),
                    d = e.getMonth(),
                    o = e.getFullYear();
                new FullCalendarInteraction.Draggable(document.getElementById("external-events"), {
                    itemSelector: ".external-event",
                    eventData: function(e) {
                        return {
                            title: e.innerText,
                            className: g(e).data("class")
                        }
                    }
                });
                var c = [

                    @foreach ($lists as $item)
                    {
                        title: "{{ $item->keterangan }}",
                        start: '{{ $item->datetime }}',
                        // IF $item->keterangan mengajar, then class name is bg-blue outline-blue, if pertemuan success outline-sucess, if istirahat danger outline-danger
                        @php
                            $className = 'bg-primary';
                            switch ($item->keterangan) {
                                case 'mengajar':
                                    $className = "bg-success border-success";
                                    break;
                                case 'istirahat':
                                    $className = "bg-danger border-danger";
                                    break;
                                default:
                                    break;
                            }
                        @endphp
                        className: '{{ $className }}'
                    },
                    @endforeach
                    ],
                    v = (document.getElementById("external-events"), document.getElementById("calendar"));

                // function u(e) {
                //     l.modal("show"), a.removeClass("was-validated"), a[0].reset(), g("#event-title").val(), g(
                //         "#event-category").val(), t.text("Add Event"), r = e
                // }
                var m = new FullCalendar.Calendar(v, {
                    plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
                    // editable: !0,
                    editable: false,
                    // droppable: !0,
                    droppable: false,
                    // selectable: !0,
                    selectable: false,
                    defaultView: pageMode,
                    defaultDate: pageDefaultDate,
                    themeSystem: "bootstrap",
                    header: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                    },
                    // eventClick: function(e) {
                    //     l.modal("show"), a[0].reset(), i = e.event, g("#event-title").val(i.title), g(
                    //             "#event-category").val(i.classNames[0]), r = null, t.text("Edit Event"), r =
                    //         null
                    // },
                    // dateClick: function(e) {
                    //     u(e)
                    // },
                    events: c,
                    hiddenDays: [0,6],
                    minTime: '08:00:00',
                    maxTime: '18:00:00',
                    views: {
                        dayGridMonth: {
                            eventLimit: 4
                        }
                    }
                        });
                m.render(), g(a).on("submit", function(e) {
                    console.log("Hell");
                    e.preventDefault();
                    g("#form-event :input");
                    var t, a = g("#event-title").val(),
                        n = g("#event-category").val();
                    !1 === s[0].checkValidity() ? (event.preventDefault(), event.stopPropagation(), s[0]
                        .classList.add("was-validated")) : (i ? (i.setProp("title", a), i.setProp(
                        "classNames", [n])) : (t = {
                        title: a,
                        start: r.date+"sslx",
                        allDay: r.allDay,
                        className: n
                    }, m.addEvent(t)), l.modal("hide"))
                    }), g("#btn-delete-event").on("click", function(e) {
                        i && (i.remove(), i = null, l.modal("hide"))
                    }), g("#btn-new-event").on("click", function(e) {
                        u({
                            date: new Date,
                            allDay: !0
                        })
                    });
            }, g.CalendarPage = new e, g.CalendarPage.Constructor = e
        }(window.jQuery),
        function() {
            "use strict";
            window.jQuery.CalendarPage.init()
        }();
    </script>
    <script>
        const monthMap = {
            'January': '01',
            'February': '02',
            'March': '03',
            'April': '04',
            'May': '05',
            'June': '06',
            'July': '07',
            'August': '08',
            'September': '09',
            'October': '10',
            'November': '11',
            'December': '12'
        };
        const todayButton = document.querySelectorAll('.fc-today-button');
        todayButton.forEach(button => {
            button.addEventListener('click', () => {
                let today = new Date();

                let year = today.getFullYear();
                let month = ('0' + (today.getMonth() + 1)).slice(-2); // Add leading zero if needed
                let day = ('0' + today.getDate()).slice(-2); // Add leading zero if needed

                pageDefaultDate = year + '-' + month + '-' + day;
                // Refresh the page with the updated URL
                let url = window.location.href.split('?')[0];
                @if(isset($_GET['view']))
                    url = url + "?view="+ {{request()->get('view')}};
                @endif
                    console.log(pageDefaultDate);
                window.location.href = url;
            });
        });
        const prevButtons = document.querySelectorAll('.fc-prev-button');
        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                const monthYearElement = document.querySelector(".fc-center");
                const MonthYear = monthYearElement.querySelector("h2").innerHTML;
                const getMonthYear = MonthYear.split(' ');
                const theMonth = monthMap[getMonthYear[0]];
                const theYear = getMonthYear[1];
                const queryString = `month=${theMonth}&year=${theYear}`;

                // Get the current URL
                const url = new URL(window.location.href);

                // Update the query string
                url.search = new URLSearchParams(queryString).toString();

                // Refresh the page with the updated URL
                window.location.href = url.toString();
            });
        });
        const nextButtons = document.querySelectorAll('.fc-next-button');
        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                const monthYearElement = document.querySelector(".fc-center");
                const MonthYear = monthYearElement.querySelector("h2").innerHTML;
                const getMonthYear = MonthYear.split(' ');
                const theMonth = monthMap[getMonthYear[0]];
                const theYear = getMonthYear[1];
                const queryString = `month=${theMonth}&year=${theYear}`;

                // Get the current URL
                const url = new URL(window.location.href);

                // Update the query string
                url.search = new URLSearchParams(queryString).toString();

                // Refresh the page with the updated URL
                window.location.href = url.toString();
            });
        });
        const monthButton = document.querySelectorAll('.fc-dayGridMonth-button');
        monthButton.forEach(button => {
            button.addEventListener('click', () => {
                const monthYearElement = document.querySelector(".fc-center");
                const MonthYear = monthYearElement.querySelector("h2").innerHTML;
                const getMonthYear = MonthYear.split(' ');
                const theMonth = monthMap[getMonthYear[0]];
                const theYear = getMonthYear[1];
                const queryString = `month=${theMonth}&year=${theYear}&view=month`;

                // Get the current URL
                const url = new URL(window.location.href);

                // Update the query string
                url.search = new URLSearchParams(queryString).toString();

                // Refresh the page with the updated URL
                window.location.href = url.toString();
            });
        });
        const weekButton = document.querySelectorAll('.fc-timeGridWeek-button');
        weekButton.forEach(button => {
            button.addEventListener('click', () => {
                const monthYearElement = document.querySelector(".fc-center");
                const MonthYear = monthYearElement.querySelector("h2").innerHTML;
                const getMonthYear = MonthYear.split(' ');
                const theMonth = monthMap[getMonthYear[0]];
                const theYear = getMonthYear[1];
                const queryString = `month=${theMonth}&year=${theYear}&view=week`;

                // Get the current URL
                const url = new URL(window.location.href);

                // Update the query string
                url.search = new URLSearchParams(queryString).toString();

                // Refresh the page with the updated URL
                window.location.href = url.toString();
            });
        });
        const dayButton = document.querySelectorAll('.fc-timeGridDay-button');
        dayButton.forEach(button => {
            button.addEventListener('click', () => {
                let monthYearElement = document.querySelector(".fc-center");
                let MonthYear = monthYearElement.querySelector("h2").innerHTML;
                let getMonthYear = MonthYear.split(' ');
                let theMonth = monthMap[getMonthYear[0]];
                let theYear = getMonthYear[1];
                @if(isset($_GET['month']) && isset($_GET['year']))
                    theMonth = {{strval(request()->get('month'))}};
                    theYear = {{request()->get('year')}};
                @endif

                const queryString = `month=${theMonth}&year=${theYear}&view=day`;

                // Get the current URL
                const url = new URL(window.location.href);

                // Update the query string
                url.search = new URLSearchParams(queryString).toString();

                // Refresh the page with the updated URL
                window.location.href = url.toString();
            });
        });
    </script>
    {{-- @endforeach --}}

@endsection
