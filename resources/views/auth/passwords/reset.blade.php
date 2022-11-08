@extends('layouts.frontend.auth.frontend_auth_app')
@section('frontend_auth_content')
<div class="auth-content my-auto">
    <div class="mt-3 mb-3 text-center">
        <h5 class="mb-0">User Panel</h5>
        <p class="text-muted mb-0">Update Your Password</p>
    </div>
     @if (Session::has('reset_link_send_success'))
        <div class="alert alert-success">
            {{ Session::get('reset_link_send_success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="form-floating form-floating-custom mb-2">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email"  class="form-control @error('password') is-invalid @enderror " id="input-username"  name="email" value="{{ $email ?? old('email') }}" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <label for="input-username">Email</label>
            <div class="form-floating-icon">
            <i data-feather="mail"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-2">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-new-password" name="password" placeholder="Enter new password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <label for="input-new-password">New Password</label>
            <div class="form-floating-icon">
                <i data-feather="lock"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-2">
            <input type="password" class="form-control" id="input-new-password_confirm" name="password_confirmation" placeholder="Enter confirm password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <label for="input-new-password_confirm">Confrim Password</label>
            <div class="form-floating-icon">
             <i data-feather="lock"></i>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Update Password</button>
        </div>
    </form>
    <div class="text-center">
        <p class="text-muted mb-0">Remember Password? <a href="{{ route('login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>
</div>
@endsection