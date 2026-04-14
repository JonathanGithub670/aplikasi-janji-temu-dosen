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
                <h4 class="card-title text-light">Jadwal Dosen : {{ $data['dosen']->name }} ({{ $data['dosen']->nim }})</h4>
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

    {{-- @foreach ($data['lists'] as $item) --}}
        {{-- @dd($data['lists']) --}}
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
        let asd = 1;
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
        let nowDay = ('0' + new Date().getDate()).slice(-2);
        @if(request()->get('month') && request()->get('year'))
            pageDefaultDate = `{{ request()->get('year') }}-{{ request()->get('month') }}-${nowDay}`;
        @else
            pageDefaultDate = `{{ date('Y') }}-{{ date('m') }}-${nowDay}`;
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

                    @foreach ($data['lists'] as $item)
                    {
                        title: "{{ $item->keterangan }}",
                        start: '{{ $item->jam_mulai }}',
                        end: '{{ $item->jam_selesai }}',
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
                    maxTime: '21:00:00',
                    views: {
                        dayGridMonth: {
                            eventLimit: 4
                        },
                        title: "ss"
                    },
                        });
                m.render(), g(a).on("submit", function(e) {
                    e.preventDefault();
                    g("#form-event :input");
                    var t, a = g("#event-title").val(),
                        n = g("#event-category").val();
                    !1 === s[0].checkValidity() ? (event.preventDefault(), event.stopPropagation(), s[0]
                        .classList.add("was-validated")) : (i ? (i.setProp("title", a), i.setProp(
                        "classNames", [n])) : (t = {
                        title: a,
                        start: r.date,
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

        $('#calendar').fullCalendar({
            // options...
            eventRender: function(event, element) {
                element.find('.fc-title').append('<br>' + event.start.format('h:mm a') + ' - ' + event.end.format('h:mm a'));
            }
        });
    </script>
    {{-- @endforeach --}}

@endsection
