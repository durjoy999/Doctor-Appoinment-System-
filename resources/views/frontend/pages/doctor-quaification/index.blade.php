@extends('layouts.frontend.frontend_app')
@section('frontend_content')
@section('title')
    All | Doctor Quaification
@endsection
         {{-- make an doctor-qualification start --}}
        <section class="section doctor-qualification gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title">
                            <h3>My Educational Qualifications</h3>
                            <div class="divider my-4"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                   @forelse ($EducationalQualifications as $EducationalQualification)

                    <div class="col-lg-6">
                        <div class="edu-block mb-5">
                            <span class="h6 text-muted">Year({{ $EducationalQualification->year }})</span>
                            <h4 class="mb-3 title-color">{{ $EducationalQualification->univarsity }}</h4>
                            <p>{!! \Illuminate\Support\Str::limit($EducationalQualification->description, 380,'...') !!}</p>
                        </div>
                    </div>
                   @empty
                     no data found
                   @endforelse
                </div>
            </div>
        </section>
         {{-- make an doctor-qualification end --}}

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
