
@extends('layouts.frontend.frontend_app')
@section('frontend_content')
@section('title')
    All | Which Hospital
@endsection

         {{-- make Which Hospital start --}}
           @include('frontend.pages.include.whichHospital')
         {{-- make an Which Hospital start --}}






@section('admin_js')
    @if (Session::has('MakeAppointment_create_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Make An Appointment Added Successfully'
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
