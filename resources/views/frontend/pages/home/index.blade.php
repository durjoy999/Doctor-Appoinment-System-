@extends('layouts.frontend.frontend_app')
@section('title')
    Home | Doctor Appointment
@endsection
@section('frontend_content')

         {{-- make an appointment start --}}
          @include('frontend.pages.include.appointment')
         {{-- make an appointment end --}}

        {{-- make an doctor-single start --}}
        <section class="section doctor-single" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    @if ($DoctorMyselfs !==  null)
                    <div class="col-lg-4 col-md-6">

                        <div class="doctor-img-block">

                            <img src="{{ asset('photo') }}/{{ $DoctorMyselfs->image }}" alt="" class="img-fluid w-100">

                            <div class="info-block mt-4">
                                <h4 class="mb-0">{{ $DoctorMyselfs->name }}</h4>
                                <p>{{ $DoctorMyselfs->position }}</p>
                            </div>
                        </div>

                     @endif
                    </div>

                    <div class="col-lg-8 col-md-6">
                        <div class="doctor-details mt-4 mt-lg-0">
                            <h2 class="text-md">Introducing to myself</h2>
                            @if ($DoctorMyselfs !==  null)
                            <div class="divider my-4"></div>
                            <p>{!! \Illuminate\Support\Str::limit($DoctorMyselfs->description, 450,'...') !!}</p>
                            <p>{!! \Illuminate\Support\Str::limit($DoctorMyselfs->Sdescription, 300,'...') !!}</p>

                            <a href="{{ route('frontend.Appointment') }}" class="btn btn-main-2 btn-round-full mt-3 mb-3">Make an Appoinment<i class="icofont-simple-right ml-2  "></i></a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- make an doctor-single start --}}

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
                            <p>{!! \Illuminate\Support\Str::limit($EducationalQualification->description, 350,'...') !!}</p>
                        </div>
                    </div>
                   @empty
                     no data found
                   @endforelse
                </div>
            </div>
        </section>
         {{-- make an doctor-qualification end --}}

         {{-- make Which Hospital start --}}
           @include('frontend.pages.include.whichHospital')
         {{-- make an Which Hospital start --}}

         {{-- make Awards Record start --}}
        <div class="untree_co-section">
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="">Awards Record</h2>
                            <div class="divider mb-4"></div>
                        </div>
                    </div>

                    <div class="row">
                    @forelse ($AwardsRecords as $AwardsRecords)
                    <div class="col-lg-4">
                        <div class="item">
                            <a class="media-thumb" href="images/hero-slider-1.jpg" data-fancybox="gallery">
                                <div class="media-text">
                                    <h3>{{ $AwardsRecords->name }}</h3>
                                    <span class="location">{{ $AwardsRecords->title }}</span>
                                </div>
                                <img src="{{ asset('photo') }}/{{ $AwardsRecords->image }}" alt={{ $AwardsRecords->image }} class="img-fluid">
                            </a>
                        </div>
                    </div>
                    @empty
                        No Data Found
                    @endforelse

                </div>
        </div>
        {{-- make Awards Record  end --}}





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
