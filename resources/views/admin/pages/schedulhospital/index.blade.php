@extends('layouts.admin.admin_app')
@section('SchedulHospital_active')
    mm-active
@endsection
@section('title')
    Admin | Schedule Hospital
@endsection
@section('admin_css_link')
       <!-- DataTables -->
       <link href="{{ asset('admin_assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
       <!-- Responsive datatable examples -->
       <link href="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" href="{{ asset('admin_assets') }}/css/sweetalert2.min.css">
@endsection
@section('admin_js_link')
    <!-- Required datatable js -->
    <script src="{{ asset('admin_assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin_assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- init js -->
    <script src="{{ asset('admin_assets') }}/js/pages/datatable-pages.init.js"></script>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                       <h4 class="mb-sm-0 font-size-18">All Schedule Hospitals </h4>


                       <a href="{{ route('admin.WhichHospitals.index') }}" style="font-size: 19px;">All Which Hospital</a>


                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Schedule Hospital</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-md-6">
                                 <div class="mb-3">
                                     <h5 class="card-title">Total Doctor Myselfs <span class="text-muted fw-normal ms-2">({{ $scheduleHospitals->count() }})</span></h5>
                                 </div>
                             </div>
                         </div>
                         <!-- end row -->
                         <div class="table-responsive mb-4">
                             <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                 <thead>
                                 <tr>
                                     <th>Day</th>
                                     <th>Time</th>
                                     <th>Status</th>
                                     <th>Created By</th>
                                     <th>Actions</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($scheduleHospitals as $scheduleHospital)
                                        <tr>
                                            <input class="blog_val_id" type="hidden" name="id" value="{{ $scheduleHospital->id }}">
                                            <td>
                                                {{ $scheduleHospital->day }}
                                            </td>
                                            <td>
                                                {{ $scheduleHospital->time }}
                                            </td>
                                            <td>
                                                @if ($scheduleHospital->status == 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $scheduleHospital->adminCreatedBy->name }}</span>
                                            </td>
                                            <td>
                                                <div class="col-6">
                                                      <a href="{{ route('admin.scheduleHospitals.edit',$scheduleHospital->id)  }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                </div>
                                                <div class="col-6 mt-1">
                                                      <a href="javascript:void(0)"class="btn btn-sm btn-danger sweet_delete" id=""> <i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                             <!-- end table -->
                         </div>
                         <!-- end table responsive -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                         @if (Session::has('WhichHospital_create_success'))
                             <div class="alert alert-success">
                                 {{ Session::get('WhichHospital_create_success') }}
                             </div>
                         @endif
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                          <form action="{{ route('admin.scheduleHospitals.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                         <label class="form-label">Which Hospital Name<span class="text-danger">*</span></label>
                                         <select name="hospitals_schedule_id" id="" class="form-control">
                                            @foreach ($active_whichHospital_name as $active_whichHospital_name)
                                                <option value="{{$active_whichHospital_name->id }}" class="form-control">{{ $active_whichHospital_name->location }}</option>
                                            @endforeach

                                         </select>
                                        @error('hospitals_schedule_id')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Day<span class="text-danger">*</span></label>
                                        <select name="day" id="" class="form-control">
                                            <option value="">-Select One Day-</option>
                                            <option {{ old('day') == 'Saturday' ?'selected':'' }} value="Saturday">Saturday</option>
                                            <option {{ old('day') == 'Sunday' ?'selected':'' }} value="Sunday">Sunday</option>
                                            <option {{ old('day') == 'Monday' ?'selected':'' }} value="Monday">Monday</option>
                                            <option {{ old('day') == 'Tuesday' ?'selected':'' }} value="Tuesday">Tuesday</option>
                                            <option {{ old('day') == 'Wednesday' ?'selected':'' }} value="Wednesday">Wednesday</option>
                                            <option {{ old('day') == 'Thursday' ?'selected':'' }} value="Thursday">Thursday</option>
                                            <option {{ old('day') == 'Friday' ?'selected':'' }} value="Friday">Friday</option>
                                        </select>
                                        @error('day')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Time (Ex. 10.00AM-1.00PM)<span class="text-danger">*</span></label>
                                        <input type="text" name="time" class="form-control" value="{{ old('time') }}" placeholder="Enter Time(10.00AM-1.00PM)" />
                                        @error('time')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">Select Status</option>
                                            <option {{ old('status') == 'Active' ?'selected':'' }} value="Active">Active</option>
                                            <option {{ old('status') == 'Deactive' ?'selected':'' }} value="Deactive">Deactive</option>
                                        </select>
                                        @error('status')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
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
    <script>
       $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                        $('.sweet_delete').click(function(){
                var delete_id = $(this).closest("tr").find('.blog_val_id').val();
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                      var data = {
                          "_token": $('input[name=_token]').val(),
                          "id": delete_id,
                      };
                      $.ajax({
                         type:"GET",
                         url:'/admin/schedule-hospitals/delete/'+delete_id,
                         data: data,
                         success: function (response){
                         Swal.fire(
                               'Deleted!',
                               'Schedule Hospital Data Delete.',
                               'success'
                             )
                             .then((result) =>{
                                location.reload();
                             });
                         }
                      });
                  }
                })
            });
        } );
    </script>
@endsection
@endsection
