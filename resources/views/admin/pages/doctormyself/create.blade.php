@extends('layouts.admin.admin_app')

@section('doctorMyself_active')
    mm-active
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Create Doctor Myself</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.doctormyselfs.index') }}">All Doctor Myselfs</a></li>
                            <li class="breadcrumb-item active">Create Doctor Myself</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        @if (Session::has('error_create_success'))
                             <div class="alert alert-danger ">
                                 {{ Session::get('error_create_success') }}
                             </div>
                         @endif
                    <div class="card-body">
                         <div class="row align-items-center">
                          <form action="{{ route('admin.doctormyselfs.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name" />
                                        @error('name')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Doctor Position<span class="text-danger">*</span></label>
                                        <input type="text" name="position" class="form-control" value="{{ old('position') }}" placeholder="Enter Position" />
                                        @error('position')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>

                                <div class="col-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-select">
                                            <option value="">Select Status</option>
                                            <option {{ old('status') == 'Active' ?'selected':'' }} value="Active">Active</option>
                                            <option {{ old('status') == 'Deactive' ?'selected':'' }} value="Deactive">Deactive</option>
                                        </select>
                                        @error('status')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mb-4">
                                        <label class="form-label">Image(size 600px * 400px)<span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control" />
                                        @error('image')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                       <label class="form-label">Description<span class="text-danger">*</span></label>
                                       <textarea name="description" id="your_summernote" class="form-control">{{old('description')}}</textarea>
                                       @error('description')
                                       <span class="text text-danger">{{$message}}</span>
                                       @enderror
                                  </div>
                                 <div class="col-12 mb-4">
                                       <label class="form-label">Short description<span class="text-danger">*</span></label>
                                       <textarea name="Sdescription" id="your_summernote" class="form-control">{{old('Sdescription')}}</textarea>
                                       @error('Sdescription')
                                       <span class="text text-danger">{{$message}}</span>
                                       @enderror
                                  </div>
                              </div>
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
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
    @if (Session::has('doctormyself_create_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Doctor Myseft Added Successfully'
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
