@extends('layouts.admin.admin_app')
@section('settings_active')
    mm-active
@endsection
@section('settings_general_active')
    active
@endsection
@section('title')
    Admin | General
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">General Settings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">General Settings</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                           <div class="col-12">
                            @if (Session::has('general_settinigs_update_success'))
                                <div class="alert alert-success">
                                    {{ Session::get('general_settinigs_update_success') }}
                                </div>

                            @endif
                           </div>
                       </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('admin.settings.general.post',$generalSettings->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h3>Logo Section</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 mb-4 border">
                                        <div class="form-group">
                                            <label>Favicon<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="favicon">
                                            <br>
                                            <img class="rounded avatar-lg" style="width:100px; height:100px;" src="{{ asset('photo/settings/general') }}/{{ $generalSettings->favicon }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4 border-bottom ">
                                        <div class="form-group">
                                            <label>Logo sm-light<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="logo_sm_light">
                                            <br>
                                            <img class="rounded avatar-lg" style="width:100px; height:100px;" src="{{ asset('photo/settings/general') }}/{{ $generalSettings->logo_sm_light }}" alt="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4 border-bottom ">
                                        <div class="form-group">
                                            <label>Logo sm-dark<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="logo_sm_dark">
                                            <br>
                                            <img class="rounded avatar-lg" style="width:100px; height:100px;" src="{{ asset('photo/settings/general') }}/{{ $generalSettings->logo_sm_dark }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4 border-bottom ">
                                        <div class="form-group">
                                            <label>Logo lg-light<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="logo_lg_light">
                                            <br>
                                            <img class="rounded avatar-lg" style="width:100px; height:100px;" src="{{ asset('photo/settings/general') }}/{{ $generalSettings->logo_lg_light }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4 border-bottom ">
                                        <div class="form-group">
                                            <label>Logo lg-dark<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="logo_lg_dark">
                                            <br>
                                            <img class="rounded avatar-lg" style="width:100px; height:100px;" src="{{ asset('photo/settings/general') }}/{{ $generalSettings->logo_lg_dark }}" alt="">
                                        </div>
                                    </div>
                                    <h3>Information Section</h3>
                                    <hr>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ $generalSettings->name }}" name="name">
                                            @error('name')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Phone<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $generalSettings->phone }}" name="phone">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $generalSettings->email }}" name="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Address<span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" cols="30" rows="1" name="address">{{ $generalSettings->address }}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h3>Social Media Section</h3>
                                    <hr>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" name="facebook" value="{{ $generalSettings->facebook }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <input type="text" class="form-control" name="instagram" value="{{ $generalSettings->instagram }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control" name="twitter" value="{{ $generalSettings->twitter }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label>Linkedien</label>
                                            <input type="text" class="form-control" name="linkedin" value="{{ $generalSettings->linkedin }}">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-md btn-primary" type="submit">Update</button>
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
    @if (Session::has('general_settinigs_update_success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'General Settings Update Successfully'
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
