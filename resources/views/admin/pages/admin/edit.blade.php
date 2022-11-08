@extends('layouts.admin.admin_app')
@section('admin_active')
    mm-active
@endsection
@section('admin_admin_active')
    active
@endsection
@section('title')
    Admin
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Admin</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">All Admins</a></li>
                            <li class="breadcrumb-item active">Edit Admin</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                             {{-- @if(Session::has('role_and_permission_assign_success'))
                                 <div class="alert alert-success">
                                    {{ Session::get('role_and_permission_assign_success') }}
                                 </div>
                             @endif --}}
                          <form action="{{ route('admin.admin.update',$data['admin']->id) }}" method="POST">
                              @csrf
                              <div class="row">




                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="form-select  @error('role') is-invalid @enderror"">
                                            <option value="">select role</option>
                                            @foreach ($data['roles'] as $role )
                                                <option value="{{ $role->id }}" {{ ($data['admin']->hasRole($role->name) ? "selected":"") }}>{{ $role->name }}</option>
                                            @endforeach


                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select @error('name') is-invalid @enderror"">
                                            <option value="">select status</option>
                                            <option  value="Active" {{ ($data['admin']->status == 'Active' ? "selected":"") }}>Active</option>
                                            <option  value="Deactive" {{ ($data['admin']->status == 'Deactive' ? "selected":"") }}>Deactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  {{-- <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label for="status">Photo</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                        <img style="height: 100px; width:100px;" src="{{ asset('photo/profile') }}/{{ $data['admin']->photo }}" alt="profile">
                                    </div>
                                  </div> --}}
                              </div>







                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>

                          </form>

                         </div>
                         <!-- end row -->


                         <!-- end table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('admin_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Admin Update Successfully'
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
