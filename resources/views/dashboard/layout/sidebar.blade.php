<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        {{-- @role(['superadmin']) --}}
        @role(['admin'])
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
            <a href="{{ route('dashboard') }}" class="waves-effect">
                <i class="bx bx-home-circle"></i><span class="badge rounded-pill float-end"></span>
                <span key="t-dashboards">Dashboards</span>
            </a>
        </li>
        @endrole
        {{-- @role(['admin','mahasiswa'])
        <li>
            <a href="{{ route('dashboard.daftar_dosen') }}" class="waves-effect">
                <i class="fas fa-clipboard-list"></i>
                <span key="t-layouts">Daftar Dosen</span>
            </a>
        </li>
        @endrole --}}
        <li class="menu-title" key="t-apps">Aplikasi</li>
        {{-- @role(['user']) --}}
        @role(['mahasiswa'])
        <li>
            <a href="{{ route('dashboard.choose') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-dashboards">Choose User</span>
            </a>
        </li>
        @endrole
        @role(['admin','dosen','chaplin','fungsionaris'])
        <li>
            <a href="{{ route('dashboard.list') }}" class="waves-effect">
                {{-- <i class="bx bx-file"></i> --}}
                <i class="bx bx-table"></i>
                <span class="badge rounded-pill float-end" key="t-new"></span>
                <span key="t-file-manager">Daftar Pertemuan</span>
            </a>
        </li>
        @endrole
        @role(['admin'])
        <li class="menu-title" key="t-pages">Kelola Akun</li>

        <li>
            <a href="{{ route('dashboard.verification.index') }}" class="waves-effect">
                <span class="badge rounded-pill float-end" key="t-new">
                </span>
                <i class="bx bx-user-circle"></i>
                <span key="t-authentication">Verifikasi User</span>
            </a>
        </li>

        <li>
            <a href="{{ route('register') }}" class="waves-effect">
                {{-- <i class="bx bx-send"></i> --}}
                <i class="bi bi-person-add"></i>
                <span key="t-utility">Buat Akun</span>
            </a>
        </li>
        @endrole
        <li class="menu-title" key="t-components">History</li>
        @role(['admin','mahasiswa'])

        <li>
            <a href="{{ route('dashboard.history') }}" class="waves-effect">
                <i class="bx bx-send"></i>
                <span key="t-ui-elements">Riwayat Reservasi</span>
            </a>
        </li>
        @endrole
        @role(['dosen','chaplin','fungsionaris'])
        <li>
            <a href="{{ route('dashboard.calendar') }}" class="waves-effect">
                <i class="bx bx-calendar"></i>
                <span class="badge rounded-pillfloat-end"></span>
                <span key="t-forms">Jadwal Dosen</span>
            </a>
        </li>
        @endrole
        @role(['admin','mahasiswa'])
        <li>
            <a href="{{ route('dashboard.daftar_dosen') }}" class="waves-effect">
                <i class="bx bx-calendar"></i>
                {{-- <i class="fas fa-clipboard-list"></i> --}}
                <span key="t-layouts">Jadwal Dosen</span>
            </a>
        </li>
        @endrole
    </ul>
</div>
