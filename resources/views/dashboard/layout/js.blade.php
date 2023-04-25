<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<!-- apexcharts -->
{{-- <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

<!-- dashboard init -->
{{-- <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script> --}}

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
    integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
</script>

<!-- Tempus Dominus JavaScript -->
<script src="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@v6.0.0-beta9/dist/js/tempus-dominus.js"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
</script>

<script src="{{ asset('assets/libs/table-edits/build/table-edits.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/table-editable.int.js') }}"></script>

{{-- <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script> --}}

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>

<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

{{-- <script src="{{ asset('assets/js/pages/calendars-full.init.js') }}"></script> --}}



<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/libs/%40fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/%40fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/%40fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/%40fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/%40fullcalendar/interaction/main.min.js') }}"></script>

<!-- Sweet Alerts js -->
{{-- <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script> --}}

<!-- Sweet alert init js-->
{{-- <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script> --}}
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    ! function(t) {
        "use strict";

        function e() {}
        e.prototype.init = function() {
            t("#sa-basic").on("click", function() {
                Swal.fire({
                    title: "Any fool can use a computer",
                    confirmButtonColor: "#556ee6"
                })
            }), t("#sa-title").click(function() {
                Swal.fire({
                    title: "The Internet?",
                    text: "That thing is still around?",
                    icon: "question",
                    confirmButtonColor: "#556ee6"
                })
            }), t("#sa-success").click(function() {
                Swal.fire({
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success",
                    showCancelButton: !0,
                    confirmButtonColor: "#556ee6",
                    cancelButtonColor: "#f46a6a"
                })
            }), t("#sa-warning").click(function() {
                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Akun kamu akan dihapus secara permanent",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Ya, Hapus!"
                }).then(function(t) {
                    t.value && Swal.fire("Tunggu!", "Segera melapor ke admin untuk menghapus akun",
                        "success")
                })
            }), t("#sa-params").click(function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ms-2 mt-2",
                    buttonsStyling: !1
                }).then(function(t) {
                    t.value ? Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    }) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    })
                })
            }), t("#sa-image").click(function() {
                Swal.fire({
                    title: "Sweet!",
                    text: "Modal with a custom image.",
                    imageUrl: "assets/images/logo-dark.png",
                    imageHeight: 20,
                    confirmButtonColor: "#556ee6",
                    animation: !1
                })
            }), t("#sa-close").click(function() {
                var t;
                Swal.fire({
                    title: "Auto close alert!",
                    html: "I will close in <strong></strong> seconds.",
                    timer: 2e3,
                    confirmButtonColor: "#556ee6",
                    onBeforeOpen: function() {
                        Swal.showLoading(), t = setInterval(function() {
                            Swal.getContent().querySelector("strong").textContent = Swal
                                .getTimerLeft()
                        }, 100)
                    },
                    onClose: function() {
                        clearInterval(t)
                    }
                }).then(function(t) {
                    t.dismiss === Swal.DismissReason.timer && console.log(
                        "I was closed by the timer")
                })
            }), t("#custom-html-alert").click(function() {
                Swal.fire({
                    title: "<i>HTML</i> <u>example</u>",
                    icon: "info",
                    html: 'You can use <b>bold text</b>, <a href="//Themesbrand.in/">links</a> and other HTML tags',
                    showCloseButton: !0,
                    showCancelButton: !0,
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger ms-1",
                    confirmButtonColor: "#47bd9a",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: '<i class="fas fa-thumbs-up me-1"></i> Great!',
                    cancelButtonText: '<i class="fas fa-thumbs-down"></i>'
                })
            }), t("#sa-position").click(function() {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your work has been saved",
                    showConfirmButton: !1,
                    timer: 1500
                })
            }), t("#custom-padding-width-alert").click(function() {
                Swal.fire({
                    title: "Custom width, padding, background.",
                    width: 600,
                    padding: 100,
                    confirmButtonColor: "#556ee6",
                    background: "#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)"
                })
            }), t("#ajax-alert").click(function() {
                Swal.fire({
                    title: "Submit email to run ajax request",
                    input: "email",
                    showCancelButton: !0,
                    confirmButtonText: "Submit",
                    showLoaderOnConfirm: !0,
                    confirmButtonColor: "#556ee6",
                    cancelButtonColor: "#f46a6a",
                    preConfirm: function(n) {
                        return new Promise(function(t, e) {
                            setTimeout(function() {
                                "taken@example.com" === n ? e(
                                    "This email is already taken.") : t()
                            }, 2e3)
                        })
                    },
                    allowOutsideClick: !1
                }).then(function(t) {
                    Swal.fire({
                        icon: "success",
                        title: "Ajax request finished!",
                        html: "Submitted email: " + t,
                        confirmButtonColor: "#556ee6"
                    })
                })
            }), t("#chaining-alert").click(function() {
                Swal.mixin({
                    input: "text",
                    confirmButtonText: "Next &rarr;",
                    showCancelButton: !0,
                    confirmButtonColor: "#556ee6",
                    cancelButtonColor: "#74788d",
                    progressSteps: ["1", "2", "3"]
                }).queue([{
                    title: "Question 1",
                    text: "Chaining swal2 modals is easy"
                }, "Question 2", "Question 3"]).then(function(t) {
                    t.value && Swal.fire({
                        title: "All done!",
                        html: "Your answers: <pre><code>" + JSON.stringify(t.value) +
                            "</code></pre>",
                        confirmButtonText: "Lovely!",
                        confirmButtonColor: "#556ee6"
                    })
                })
            }), t("#dynamic-alert").click(function() {
                swal.queue([{
                    title: "Your public IP",
                    confirmButtonColor: "#556ee6",
                    confirmButtonText: "Show my public IP",
                    text: "Your public IP will be received via AJAX request",
                    showLoaderOnConfirm: !0,
                    preConfirm: function() {
                        return new Promise(function(e) {
                            t.get("https://api.ipify.org?format=json").done(
                                function(t) {
                                    swal.insertQueueStep(t.ip), e()
                                })
                        })
                    }
                }]).catch(swal.noop)
            })
        }, t.SweetAlert = new e, t.SweetAlert.Constructor = e
    }(window.jQuery),
    function() {
        "use strict";
        window.jQuery.SweetAlert.init()
    }();
</script>

@yield('script')
