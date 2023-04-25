@extends('dashboard.layout.main')

@section('style')
@endsection

@section('breadcrumbs')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Halaman Ganti Password</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard / <a href="{{ route('dashboard.verification.index') }}">Verification</a><a href="#"> / Ganti Password</a> </li>
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
                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to
                    each
                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
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
                    <label for="nip" class="form-label fs-5">Nomor Induk Mahasiswa</label>
                    <div>
                        <input type="text" class="form-control  @error('nip') is-invalid @enderror" name="nip"
                            id="nip" placeholder="NIM" autofocus required value="{{ old('nip') }}"
                            autocomplete="off">
                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="nama" class="form-label mt-3 fs-5">New Password</label>
                    <div class="form-field d-flex align-items-center">
                        <input class="form-control "type="password" name="password" id="password" placeholder="Password"
                            required>
                    </div>
                    <label for="email" class="form-label fs-5 mt-3">Confirm Password</label>
                    {{-- <div class="form-field d-flex align-items-center"> --}}
                    <div class="form-field d-flex align-items-center">
                        <input class="form-control "type="password" name="password" id="password" placeholder="Password"
                            required>
                    </div>

                    <div class="d-grid gap-2 justify-content-center">
                        <div class="row ">
                            <div class="col=md-8 mt-3">
                                <button class="btn btn-primary" type="submit">Ubah Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
