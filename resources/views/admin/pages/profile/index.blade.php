@extends('layouts.admin.admin_app')
@section('title')
    Admin | Profile
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row" style="margin-top:50px">
           <div class="profile-content">
               <div class="row align-items-end">
                    <div class="col-sm">
                        <div class="d-flex align-items-end mt-3 mt-sm-0">
                            <div class="flex-shrink-0">
                                <div class="avatar-xxl me-3">
                                    <img src="{{ asset('photo/profile') }}/{{ $admin->photo }}" alt="" class="img-fluid rounded-circle d-block img-thumbnail">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <h5 class="font-size-16 mb-1">{{ $admin->name }}</h5>
                                    <p class="text-muted font-size-13 mb-2 pb-2">@foreach ($admin->roles  as $role )
                                        {{ $role->name }}
                                    @endforeach</p>
                                </div>
                            </div>
                        </div>
                    </div>

               </div>
               <div class="row mt-4">
                   <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                General Information
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control pe-5 @error('password_confirmation') is-invalid @enderror"  name="name" placeholder="Enter Name" value="{{ $admin->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label>Enter Name <span class="text-danger">*</span> </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control pe-5 @error('password_confirmation') is-invalid @enderror"  name="email" placeholder="Enter email" value="{{ $admin->email }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label>Enter Email <span class="text-danger">*</span> </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control pe-5 @error('phone') is-invalid @enderror"  name="phone" placeholder="Enter phone" value="{{ $admin->phone }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label>Enter Phone <span class="text-danger">*</span> </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control pe-5 @error('address') is-invalid @enderror"  name="address" placeholder="Enter address" value="{{ $admin->address }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label>Enter Address <span class="text-danger">*</span> </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control pe-5 @error('photo') is-invalid @enderror"  name="photo" placeholder="upload photo">
                                            @error('photo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label>Upload photo</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-primary">Update</button>
                                </div>



                            </form>
                        </div>

                    </div>
                   </div>
                   <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Update Password
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile.password.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 @error('old_password') is-invalid @enderror" id="password-input" name="old_password" placeholder="Enter Old Password">
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="input-password">Old Password <span class="text-danger">*</span></label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" id="password-input" name="password" placeholder="Enter Password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">

                                            </button>
                                            <label for="input-password">Password <span class="text-danger">*</span></label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 @error('password_confirmation') is-invalid @enderror" id="password-input" name="password_confirmation" placeholder="Enter Old Password">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">

                                            </button>
                                            <label for="input-password">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-primary">Update</button>

                                </div>
                            </form>
                        </div>

                    </div>
                   </div>
               </div>
           </div>
        </div>




    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('profile_updated'))
        <script>
                Toast.fire({
                    icon: 'success',
                    title: 'Profile Update Successfully'
                })
        </script>
    @endif
    @if (Session::has('password_changed'))
        <script>
                Toast.fire({
                    icon: 'success',
                    title: 'Passwords Changed Success'
                })
        </script>
    @endif
    @if (Session::has('password_not_match'))
        <script>
                Toast.fire({
                    icon: 'error',
                    title: 'Password does not match with previous Password'
                })
        </script>
    @endif
    @if ($errors->any())
        <script>
            Toast.fire({
                icon: 'error',
                title: 'Something wrong, Please try again!!'
            })
        </script>
    @endif
@endsection
@endsection
