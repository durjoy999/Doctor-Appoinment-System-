@extends('layouts.frontend.auth.frontend_auth_app')
@section('frontend_auth_content')
    <div class="auth-content my-auto">
        <div class="mt-3 mb-3 text-center">
            <h5 class="mb-0">User Panel</h5>
            <p class="text-muted mb-0">Register To Create New Account</p>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-custom mb-2">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="input-username" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <label for="input-username">Name</label>
                <div class="form-floating-icon">
                <i data-feather="user"></i>
                </div>
            </div>
            <div class="form-floating form-floating-custom mb-2">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="input-email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <label for="input-email">Email</label>
                <div class="form-floating-icon">
                <i data-feather="mail"></i>
                </div>
            </div>
            <div class="form-floating form-floating-custom mb-2 auth-pass-inputgroup">
                <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" id="password-input" name="password" placeholder="Enter Password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                </button>
                <label for="input-password">Password</label>
                <div class="form-floating-icon">
                    <i data-feather="lock"></i>
                </div>
            </div>
            <div class="form-floating form-floating-custom mb-2 auth-pass-inputgroup">
                <input type="password" class="form-control pe-5" name="password_confirmation" placeholder="Confrim Password">
                <label for="input-password">Confirm Password</label>
                <div class="form-floating-icon">
                    <i data-feather="lock"></i>
                </div>
            </div>
            <div class="mb-2">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register</button>
            </div>
        </form>
        <div class="text-center">
            <p class="text-muted mb-0">Do you remember your account ? <a href="{{ route('login') }}"
                    class="text-primary fw-semibold"> Login </a> </p>
        </div>

    </div>
@endsection