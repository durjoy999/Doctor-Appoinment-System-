
@extends('layouts.admin.admin_app')
@section('whichHospital_active')
    mm-active
@endsection
@section('title')
    Admin | Which Hospital
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
                    <h4 class="mb-sm-0 font-size-18">All Which Hospital</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Which Hospitals</li>
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
                             <div class="col-md-6">
                                 <div class="mb-3">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                    <div>
                                        <a href="{{ route('admin.WhichHospitals.create') }}" class="btn btn-primary btn-sm"><i class="bx bx-plus me-1"></i> Add New</a>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <!-- end row -->
                         @if (Session::has('admin_delete_success'))
                             <div class="alert alert-success">
                                 {{ Session::get('admin_delete_success') }}WhichHospitals
                             </div>
                         @endif
                         <div class="table-responsive mb-4">
                             <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                 <thead>
                                 <tr>
                                     <th>S\N</th>
                                     <th>Image</th>
                                     <th>Hospital Name</th>
                                     <th>Hospital Location</th>
                                     <th>Days</th>
                                     <th>Time</th>
                                     <th>Total Seats</th>
                                     <th>Doctor fee</th>
                                     <th>Status</th>
                                     <th>Created By</th>
                                     <th>Edited By</th>
                                     <th>Actions</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($WhichHospitals as $WhichHospital )
                                        <tr>
                                            <input class="blog_val_id" type="hidden" name="id" value="{{ $WhichHospital->id }}">
                                            <th>{{ $loop->iteration }}</th>
                                             <th>
                                                 <img src="{{ asset('photo') }}/{{ $WhichHospital->image }}" alt="{{ $WhichHospital->image}}" style="width: 40px; height: 40px;">
                                             </th>
                                            <th>
                                                {{ $WhichHospital->hospital_Location }}
                                            </th>
                                            <th>
                                                {{$WhichHospital->location}}
                                            </th>
                                            <th>
                                                @forelse ($WhichHospital->hospitalSchedule as $hospitalSchedule)
                                                {{$hospitalSchedule->day}}
                                                <br>
                                                @empty
                                                  no data
                                                @endforelse
                                            </th>
                                            <th>
                                                @forelse ($WhichHospital->hospitalSchedule as $hospitalSchedule)
                                                {{$hospitalSchedule->time}}
                                                <br>
                                                @empty
                                                  no data
                                                @endforelse
                                            </th>
                                            <th>
                                                {{ $WhichHospital->seat }}
                                            </th>
                                            <th>
                                                {{ $WhichHospital->fee }}
                                            </th>
                                            <td>
                                                @if ($WhichHospital->status == 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Deactive</span>
                                                @endif
                                            <td>
                                                <span class="badge bg-success">{{ $WhichHospital->adminCreatedBy->name }}</span>
                                            </td>
                                            <td>
                                            @if ($WhichHospital->edited_by==Auth::guard('admin')->User()->id)
                                                <span class="badge bg-success">{{ $WhichHospital->adminEditedBy->name }}</span>\
                                             @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.scheduleHospitals.show',$WhichHospital->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye" ></i></a>
                                                <a href="{{ route('admin.WhichHospitals.edit',$WhichHospital->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                <a href="javascript:void(0)"class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></a>
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
                         url:'/admin/which-hospitals/delete/'+delete_id,
                         data: data,
                         success: function (response){
                         Swal.fire(
                               'Deleted!',
                               'Which Hospital & Schedual Data Delete.',
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
