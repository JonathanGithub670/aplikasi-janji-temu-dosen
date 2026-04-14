@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Buat Akun</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard<a href="{{ route('register') }}"> | <strong>Buat
                                Akun</strong></a> </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Register User</h4>
                <p class="card-title-desc">
                    ini merupakan halaman untuk membuat akun mahasiswa, dosen, fungsionaris, dan chaplin
                </p>
                <form action="{{ route('register') }}" method="POST" class="p-3 mt-2">
                    @csrf
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <label for="nim" class="form-label fs-5">Nomor Induk Mahasiswa | Nomor Induk Dosen Nasional</label>
                    <div>
                        <input type="text" class="form-control  @error('nim') is-invalid @enderror" name="nim" id="nim"
                            placeholder="Masukkan NIM atau NIDN" autofocus required value="{{ old('nim') }}"
                            autocomplete="off">
                        @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="nama" class="form-label mt-3 fs-5">Nama</label>
                    <div class="form-field d-flex align-items-center">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                            placeholder="NAMA" autofocus required value="{{ old('name') }}" autocomplete="off">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <label for="email" class="form-label fs-5 mt-3">Email</label>
                    <div class="form-field d-flex align-items-center">
                        <div>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="EMAIL" autofocus required value="{{ old('email') }}"
                                autocomplete="off">
                            <label for="nip">NIP</label>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}

                        <label for="password" class="form-label mt-3 fs-5">Password</label>
                        <div>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password" autofocus required
                                value="{{ old('password') }}" autocomplete="off">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <label for="password" class="form-label fs-5 mt-3">password</label>
                        <div class="form-field d-flex align-items-center">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password" autofocus required
                                value="{{ old('password') }}" autocomplete="off"><br>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}
                        {{-- <label for="password" class="form-label fs-5 mt-3">Password</label>
                        <div class="form-field d-flex align-items-center">
                            <input class="form-control " type="password" name="password" id="password"
                                placeholder="Password" required>
                        </div> --}}
                        {{-- <label for="role" class="form-label fs-5 mt-3">Pilih role</label>
                        <select class="form-select form-select-m" aria-label=".form-select-lg example" id="pilih_role"
                            onchange="pilihJabatan()" required>
                            <option hidden>Open this select menu</option>
                            <option value="1">Dosen</option>
                            <option value="2">Fungsionaris</option>
                            <option value="3">chaplin</option>
                            <option value="4">mahasiswa</option>
                            @foreach ($users->where('id', 3) as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}

                        <label for="role" class="form-label fs-5 mt-3">Pilih role</label>
                        <div>
                            <select class="form-select form-select-m @error('role') is-invalid @enderror"
                                aria-label=".form-select-lg example" id="pilih_role" onchange="pilihJabatan()" name="role"
                                required>
                                <option hidden>Open this select menu</option>
                                <option value="dosen">Dosen</option>
                                <option value="fungsionaris">Fungsionaris</option>
                                <option value="chaplin">Chaplin</option>
                                <option value="mahasiswa">Mahasiswa</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div id="semesterDiv" class="mt-3 mb-4" style="display: none;">
                            <label for="semester" class="form-label fs-5 ">Pilih Semester</label>
                            <select id="semester" class="form-select @error('semester') is-invalid @enderror"
                                aria-label="select example" name="semester">
                                <option value="" hidden readonly>Pilih Semester </option>
                                @foreach ($data['list_semester'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->isi_semester }}</option>
                                @endforeach
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div id="jabatan"></div>

                        {{-- <button class="btn mt-3" type="submit btn btn-primary">Register</button> --}}
                        {{-- <select id="role" class="form-select @error('role') is-invalid @enderror"
                            aria-label="Default select example" name="role" required>
                            <option selected disabled>Pilih Role</option>
                            @foreach ($users->where('role', 1) as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}

                        <div id="program_studi"></div>

                        <div class="d-grid gap-2 justify-content-center">
                            <div class="row ">
                                <div class="col=md-8 mt-3">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function pilihJabatan() {
            const x = document.getElementById("pilih_role").value;
            if (x == 'dosen' || x == 'chaplin') {
                document.getElementById("jabatan").innerHTML = '';
                document.getElementById("program_studi").innerHTML = '<label for="role" class="form-label fs-5 mt-3">Pilih Program Studi</label><br>                    {{-- <select class="form-select form-select-m mb-3" aria-label=".form-select-lg example">                        <option selected>                        Open this select menu</option>                        <option value="Sistem Informasi">                        Sistem Informasi</option>                        <option value="Teknik Informatika">                        Teknik Informatika</option>                        <option value="Pendidikan Teknologi Informasi">                        Pendidikan Teknologi Informasi</option>                    </select> --}}                     <div class="form-check form-check-inline">                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="nama_program_studi[]" value="Sistem Informasi">                        <label class="form-check-label" for="inlineCheckbox1">                        Sistem Informasi</label>                    </div>                    <div class="form-check form-check-inline">                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="nama_program_studi[]" value="Teknik Informatika">                        <label class="form-check-label" for="inlineCheckbox2">                        Teknik Informatika</label>                    </div>                    <div class="form-check form-check-inline">                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="nama_program_studi[]" value="Pendidikan Teknologi Informasi">                        <label class="form-check-label" for="inlineCheckbox3">                        Pendidikan Teknologi Informasi</label>                    </div>';
                semesterDiv.style.display = "none";
            } else if (x == 'fungsionaris') {
                document.getElementById("jabatan").innerHTML = '<label for="role" class="form-label fs-5 mt-3">Pilih Jabatan</label>                    <select name="jabatan" class="form-select form-select-m" aria-label=".form-select-lg example">                        <option hidden>Open this select menu</option>                        <option value="dekan">Dekan</option>                        <option value="wakil dekan 1">Wakil Dekan I</option>                        <option value="wakil dekan 2">Wakil Dekan II</option>                        <option value="wakil dekan 3">Wakil Dekan III</option>                        <option value="kaprodi si">Kaprodi SI</option>                        <option value="kaprodi ti">Kaprodi TI</option>                        <option value="kaprodi pti">Kaprodi PTI</option>                        {{-- <option value="lektor">Lektor</option> --}}                        {{-- @foreach ($users->where("id", 3) as $item)                            <option value="{{ $item->id }}">{{ $item->name }}</option>                        @endforeach --}}                    </select>';
                document.getElementById("program_studi").innerHTML = '<label for="role" class="form-label fs-5 mt-3">Pilih Program Studi</label><br>                    {{-- <select class="form-select form-select-m mb-3" aria-label=".form-select-lg example">                        <option selected>                        Open this select menu</option>                        <option value="Sistem Informasi">                        Sistem Informasi</option>                        <option value="Teknik Informatika">                        Teknik Informatika</option>                        <option value="Pendidikan Teknologi Informasi">                        Pendidikan Teknologi Informasi</option>                    </select> --}}                     <div class="form-check form-check-inline">                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="nama_program_studi[]" value="Sistem Informasi">                        <label class="form-check-label" for="inlineCheckbox1">                        Sistem Informasi</label>                    </div>                    <div class="form-check form-check-inline">                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="nama_program_studi[]" value="Teknik Informatika">                        <label class="form-check-label" for="inlineCheckbox2">                        Teknik Informatika</label>                    </div>                    <div class="form-check form-check-inline">                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="nama_program_studi[]" value="Pendidikan Teknologi Informasi">                        <label class="form-check-label" for="inlineCheckbox3">                        Pendidikan Teknologi Informasi</label>                    </div>';
                semesterDiv.style.display = "none";
            } else if (x == 'mahasiswa') {
                semesterDiv.style.display = "block";
                document.getElementById("jabatan").innerHTML = '';
                document.getElementById("program_studi").innerHTML = '<label for="role" class="form-label fs-5 mt-3">Pilih Program Studi</label><br><div class="form-check form-check-inline mt-3">                        <input class="form-check-input" type="radio" name="nama_program_studi" id="inlineRadio1"                            value="Sistem Informasi">                        <label class="form-check-label" for="inlineRadio1">Sistem Informasi</label>                    </div>                    <div class="form-check form-check-inline">                        <input class="form-check-input" type="radio" name="nama_program_studi" id="inlineRadio2"                            value="Teknik Informatika">                        <label class="form-check-label" for="inlineRadio2">Teknik Informatika</label>                    </div>                    <div class="form-check form-check-inline">                        <input class="form-check-input" type="radio" name="nama_program_studi" id="inlineRadio3"                            value="Pendidikan Teknologi Informasi">                        <label class="form-check-label" for="inlineRadio3">Pendidikan Teknologi Informasi</label>                    </div>';
            }
        }
    </script>
@endsection

@section('script')
@endsection