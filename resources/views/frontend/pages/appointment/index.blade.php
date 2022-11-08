@extends('layouts.frontend.frontend_app')
@section('frontend_content')
@section('title')
    Home | Doctor Appointment
@endsection
         {{-- make an appointment start --}}
          @include('frontend.pages.include.appointment')
         {{-- make an appointment end --}}

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
