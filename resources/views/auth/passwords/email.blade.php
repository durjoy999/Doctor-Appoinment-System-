@extends('layouts.frontend.auth.frontend_auth_app')
@section('frontend_auth_content')
<div class="auth-content my-auto">
    <div class="mt-3 mb-3 text-center">
        <h5 class="mb-0">User Panel</h5>
        <p class="text-muted mb-0">We will send all reset instruction in your email!!!</p>
    </div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-floating form-floating-custom mb-2">
            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="input-username" name="email" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <label for="input-username">Email</label>
            <div class="form-floating-icon">
            <i data-feather="mail"></i>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Send Password Reset Link</button>
        </div>
    </form>
    <div class="text-center">
        <p class="text-muted mb-0">Do Nothing? <a href="{{ route('login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>
</div>
@endsection