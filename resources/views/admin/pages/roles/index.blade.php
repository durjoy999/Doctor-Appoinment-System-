@extends('layouts.admin.admin_app')
@section('admin_active')
    mm-active
@endsection
@section('admin_roles_active')
    active
@endsection
@section('title')
    Admin | Roles
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
                    <h4 class="mb-sm-0 font-size-18">All Roles</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All roles</li>
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
                                     <h5 class="card-title">Total Role <span class="text-muted fw-normal ms-2">({{ $data['roles']->count() }})</span></h5>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">

                                    <div>
                                        @if (Auth::guard('admin')->user()->can('role.create'))

                                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm"><i class="bx bx-plus me-1"></i> Add New</a>
                                        @endif
                                    </div>
                                </div>

                            </div>

                         </div>
                         <!-- end row -->
                         @if (Session::has('role_and_permission_delete_success'))
                             <div class="alert alert-success">
                                 {{ Session::get('role_and_permission_delete_success') }}
                             </div>
                         @endif

                         <div class="table-responsive mb-4">
                             <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                 <thead>
                                 <tr>


                                     <th style="width:10%">S\N</th>
                                     <th style="width:20%">Role Name</th>
                                     <th style="width:60%">Permissions</th>
                                     <th style="5%">Status</th>
                                     <th style="width:10%">Actions</th>

                                 </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($data['roles'] as $role)
                                        <tr>
                                            <input class="role_val_id" type="hidden" name="id" value="{{ $role->id }}">

                                            <th style="width: 10%;">{{ $loop->iteration }}</th>
                                            <td style="width: 20%;">
                                                {{ $role->name }}
                                            </td>
                                            <td style="width: 60%;">
                                                @foreach ($role->permissions as $permission )
                                                    @if (($loop->index % 3) == 0)
                                                        <br>
                                                    @endif
                                                    <span class="badge bg-primary">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($role->status == 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Deactive</span>
                                                @endif
                                            </td>

                                            <td style="width: 10%;">
                                                @if (Auth::guard('admin')->user()->can('role.edit'))

                                                <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                @endif
                                                @if (Auth::guard('admin')->user()->can('role.destroy'))

                                                <a href="#"   class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></a>
                                                @endif


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
                var delete_id = $(this).closest("tr").find('.role_val_id').val();
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
                         url:'/admin/roles/destroy/'+delete_id,
                         data: data,
                         success: function (response){
                         Swal.fire(
                               'Deleted!',
                               'Role & Permissions deleted.',
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
