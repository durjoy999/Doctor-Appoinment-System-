@extends('layouts.admin.admin_app')
@section('admin_css_link')
       <!-- DataTables -->
    <link href="{{ asset('frontend_assets') }}/css/style.css" rel="stylesheet">

@endsection
@section('makeAppointment_active')
    mm-active
@endsection
@section('title')
    Admin | Make Aappointments
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Make An Appointment Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.MakeAppointments.index') }}">All Make Appointments</a></li>
                            <li class="breadcrumb-item active">Make Appointment Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
           <div class="container">
                                <div class="row">
                         @if (Session::has('Blog_delete_success'))
                             <div class="alert alert-success">
                                 {{ Session::get('Blog_delete_success') }}
                             </div>
                         @endif
                                   <div class="col-xl-12">
                                       <div class="card">
                                           <div class="card-body">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0 text-center">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 300px">Name</td>
                                                                <td>{{ $MakeAppointment->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td>{{ $MakeAppointment->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date</td>
                                                                <td>{{ date("j F Y", strtotime($MakeAppointment->date )) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Time</td>
                                                                <td>{{ date("g:i a", strtotime($MakeAppointment->date)) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Hospital Name</td>
                                                                <td>{{ $MakeAppointment->hospital }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone</td>
                                                                <td>{{ $MakeAppointment->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Massage</td>
                                                                <td>{{ $MakeAppointment->description }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-lg-12">
                                                     <form action="{{ route('admin.MakeAppointments.massage')}}"method="POST" enctype="multipart/form-data">
                                                         @csrf
                                                              <input class="blog_val_id" type="hidden" name="id" value="{{ $MakeAppointment->id }}">
                                                              <div class="col-12 mb-4">
                                                                    <div class="input-group mt-4 my-5">
                                                                      <span class="input-group-text">Massage For Patient <span class="text-danger">*</span></span>
                                                                      <textarea class="form-control" name="message" aria-label="With textarea">{{old('message')}}</textarea>
                                                                    </div>
                                                                    @error('message')
                                                                    <span class="text text-danger">{{$message}}</span>
                                                                    @enderror
                                                               </div>
                                                    </div>
                                                           <div class="col-12 text-center">
                                                              <button type="submit" class="btn btn-md btn-primary">Send Massage</button>
                                                          </div>
                                                    </form>
                                                </div>
                                           </div>
                                           <!-- end card body -->
                                       </div>
                                       <!-- end card -->
                                   </div>
                        <!-- end col -->
                    </div>
           </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('MakeAppointment_Massage_sent_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Mobile Massage Successfully'
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
