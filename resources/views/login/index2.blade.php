@extends('layouts.main')
@section('container')
    <div class="wrapper">
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
        <div class="logo">
            {{-- <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt=""> --}}
            {{-- <img src="/img/komputer.png" alt=""> --}}
            <img src="/img/logo-final.png" alt="">
        </div>
        <div class="text-center mt-3 mb-3 name">
            SIGN IN <br>
            Reservasi
        </div>
        <form action="{{ route('login') }}" method="POST" class="p-3 mt-3">
            @csrf
            <div class="form-field d-flex align-items-center">
                <i class="fa-solid fa-user"></i>
                <input type="text" class="@error('nim') is-invalid @enderror" name="nim" id="nim"
                    placeholder="USERNAME" autofocus required value="{{ old('nim') }}" autocomplete="off">
                {{-- <label for="nim">nim</label> --}}
                @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-field d-flex align-items-center">
                {{-- <span class="fas fa-key"></span> --}}
                {{-- <span class="bi bi-key-fill"></span> --}}
                <i class="fa-sharp fa-solid fa-key"></i>
                <input type="password" name="password" id="password" placeholder="PASSWORD" required>
            </div>
            <button class="btn mt-3" type="submit">Login</button>
        </form>
        <div class="text-center fs-6">
            {{-- <small class="d-block text-center mt-3">Not Registered? <a href="{{ route('register') }}">Sign up</a> --}}
            {{-- <small class="d-block text-center mt-3"><a href="{{ route('recoverpw') }}" style="color:black">Forgot Password?</a> --}}
            
            {{-- membuat lupa password luar login --}}
            {{-- <form action="{{ route('recoverpw') }}" method="POST">
                @csrf
                    <button type="submit" class="dropdown-item text-black" style="text-align:center;"><i
                        class="bx bx-power-off font-size-16 align-middle me-1 "></i><span>Forgot Password?</span></button>
            </form> --}}
        </div>
    </div>
@endsection