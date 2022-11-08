@extends('layouts.admin.admin_app')
@section('settings_active')
    mm-active
@endsection
@section('settings_config_active')
    active
@endsection
@section('title')
    Admin | Config
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Config Settings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Config Settings</li>
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
                    <div class="row mb-4">
                        <h3>Terminal</h3>

                        <hr>
                        <div class="col-12">

                            @if (Auth::guard('admin')->user()->can('configSettings.optimizeClear'))

                            <a href="{{ route('admin.settings.config.optimize.clear') }}" class="btn btn-md btn-primary">optimize:clear</a>
                            @endif

                        </div>
                        <div class="col-12 mt-4">
                            @if (Auth::guard('admin')->user()->can('configSettings.optimize'))

                            <a href="{{ route('admin.settings.config.optimize') }}" class="btn btn-md btn-primary">optimize</a>
                            @endif

                        </div>

                    </div>
                 {{-- <div class="row">
                     <div class="col-12">
                         <form action="{{ route('admin.settings.config.post') }}" method="POST">
                             @csrf
                             <h3>App Info Section</h3>
                             <hr>
                             <div class="row">

                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                     <div class="form-group">
                                         <label>App Name<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control @error('app_name') is-invalid @enderror" name="app_name" value="{{ $data['app_name'] }}">
                                        @error('app_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>

                                 </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                     <div class="form-group">
                                         <label>App Env<span class="text-danger">*</span></label>
                                         <select class="form-select  @error('app_env') is-invalid @enderror" name="app_env">
                                             <option value="">select app env</option>
                                             <option @if ($data['app_env'] == 'local')
                                                selected
                                             @endif value="local">Local</option>
                                             <option @if ($data['app_env'] == 'production')
                                                selected
                                             @endif value="production">Production</option>
                                         </select>
                                         @error('app_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                 </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                     <div class="form-group">
                                         <label>App Debug<span class="text-danger">*</span></label>
                                         <select class="form-select @error('app_debug') is-invalid @enderror" name="app_debug">
                                             <option value="">select debug mood</option>
                                             <option @if ($data['app_debug'] == 'true')
                                                 selected
                                             @endif value="true">True</option>
                                             <option @if ($data['app_debug'] == 'false')
                                                 selected
                                             @endif value="false">False</option>
                                         </select>
                                         @error('app_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                 </div>

                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">

                                     <div class="form-group">
                                         <label>App url<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control @error('app_url') is-invalid @enderror" name="app_url" value="{{ $data['app_url'] }}" placeholder="http://localhost or https://birit.xyz">
                                         @error('app_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                 </div>

                                 <h3>Database Section</h3>
                                 <hr>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                     <div class="form-group">
                                         <label>Database Name<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control @error('db_database') is-invalid @enderror" name="db_database" value="{{ $data['db_database'] }}">
                                         @error('db_database')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                 </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                     <div class="form-group">
                                         <label>Database UserName<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control @error('db_username') is-invalid @enderror" name="db_username" value="{{ $data['db_username'] }}">
                                         @error('db_username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                 </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                     <div class="form-group">
                                         <label>Database Password</label>
                                         <input type="password" class="form-control" name="db_password" value="{{ $data['db_password'] }}">
                                     </div>
                                 </div>
                                 <h3>Email Configuration Section</h3>
                                 <hr>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_MAILER<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_mailer') is-invalid @enderror" name="mail_mailer" value="{{ $data['mail_mailer'] }}">
                                        @error('mail_mailer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_HOST<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_host') is-invalid @enderror" name="mail_host" value="{{ $data['mail_host'] }}" placeholder="ex:smtp.gmail.com">
                                        @error('mail_host')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_PORT<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_port') is-invalid @enderror" name="mail_port" value="{{ $data['mail_port'] }}" placeholder="ex:587 or 2525">
                                        @error('mail_port')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_USERNAME<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_username') is-invalid @enderror" name="mail_username" value="{{ $data['mail_username'] }}">
                                        @error('mail_username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_PASSWORD<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_password') is-invalid @enderror" name="mail_password" value="{{ $data['mail_password'] }}">
                                        @error('mail_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_ENCRYPTION<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_encription') is-invalid @enderror" name="mail_encription" value="{{ $data['mail_encription'] }}" placeholder="ex:tls">
                                        @error('mail_encription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>MAIL_FROM_ADDRESS<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('mail_from_adress') is-invalid @enderror" name="mail_from_adress" value="{{ $data['mail_from_address'] }}" placeholder="ex:no-replay@example.com">
                                        @error('mail_from_adress')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                             <button class="btn btn-md btn-primary" type="submit">Update</button>
                         </form>

                     </div>
                 </div>
                  --}}
                </div>
            </div>
          </div>
      </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('optimize_clear'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'Optimize Clear Successfully Done'
            })
        </script>
    @endif
    @if (Session::has('optimize'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'Optimize  Successfully Done'
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
