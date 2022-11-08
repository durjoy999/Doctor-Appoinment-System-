@extends('layouts.admin.admin_app')
@section('whichHospital_active')
    mm-active
@endsection
@section('title')
    Admin | Which Hospital
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Create Which Hospital</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.WhichHospitals.index') }}">All Which Hospitals</a></li>
                            <li class="breadcrumb-item active">Create Which Hospital</li>
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
                          <form method="post" action="{{ route('admin.WhichHospitals.update',$Whichhospital->id) }}" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Hospital Name<span class="text-danger">*</span></label>
                                        <input type="text" name="location" class="form-control" value="{{$Whichhospital->location ?? old('location') }}" placeholder="Enter Location" />
                                        @error('location')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Hopital Location<span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_Location" class="form-control" value="{{$Whichhospital->hospital_Location ?? old('hospital_Location') }}" placeholder="Enter Hospital Location" />
                                        @error('hospital_Location')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Total Seats<span class="text-danger">*</span></label>
                                        <input type="text" name="seat" class="form-control" value="{{$Whichhospital->seat ?? old('seat') }}" placeholder="Enter Total Seats" />
                                        @error('seat')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Doctor Fee<span class="text-danger">*</span></label>
                                        <input type="text" name="fee" class="form-control" value="{{$Whichhospital->fee ?? old('fee') }}" placeholder="Enter Doctor Fee" />
                                        @error('fee')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="">select status</option>
                                            <option  value="Active" {{ ($Whichhospital->status == 'Active' ? "selected":"") }}>Active</option>
                                            <option  value="Deactive" {{ ($Whichhospital->status == 'Deactive' ? "selected":"") }}>Deactive</option>
                                        </select>
                                        @error('status')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mb-4">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" value="{{ $Whichhospital->image }}" />
                                  </div>
                              </div>
                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                          </form>
                         </div>
                         <!-- end row --
                         <!-- end table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('Whichhospital_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Which Hospital Edit Successfully'
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
