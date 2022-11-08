
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('frontend_assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin_assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend_assets') }}/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">
    <title>@yield('title')</title>
</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light my-dafult py-2">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="./logo.png" alt="" style="width: 120px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav d-flex m-auto">
                        <a class="nav-link mx-2 {{ Route::is('frontend.homee') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                        <a class="nav-link mx-2 {{ Route::is('frontend.WhichHospital') ? 'active' : '' }}" href="{{ route('frontend.WhichHospital') }}">Which Hospital</a>
                         <a class="nav-link mx-2 {{ Route::is('frontend.EducationalQualification') ? 'active' : '' }}" href="{{ route('frontend.EducationalQualification') }}">Educational Qualification</a>
                    </div>
                        <form class="d-flex">
                            <a class="appointment-btn btn btn-main-2 btn-round-full mt-3 mb-3" href="{{ route('frontend.Appointment') }}">Make an appointment</a>
                        </form>
                </div>
            </div>
        </nav>


        @yield('frontend_content')

        <div class="site-footer">
                <div class="inner first">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="heading">About</h3>
                                    @if (DoctorMyself() !==  null)
                                   <p> {!! \Illuminate\Support\Str::limit(DoctorMyself()->description, 200,'...') !!}</p>
                                   @endif
                                </div>
                                <div class="widget">
                                    <ul class="list-unstyle social">
                                        @foreach (GneralSettings() as $GneralSetting )
                                        <li><a href="{{ $GneralSetting->twitter }}"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="{{ $GneralSetting->instagram }}"><span class="fab fa-instagram"></span></a></li>
                                        <li><a href="{{ $GneralSetting->facebook }}"><span class="fab fa-facebook"></span></a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 pl-lg-5">
                                <div class="widget">
                                    <h3 class="heading">Pages</h3>
                                    <ul class="links list-unstyled">
                                        <li><a href="{{ route('frontend.Appointment') }}">Make an appointment</a></li>
                                        <li><a href="#">My Educational Qualifications</a></li>
                                        <li><a href="{{ route('frontend.WhichHospital') }}">Which Hospital</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="heading">Which Hospitals</h3>
                                    <ul class="links list-unstyled">

                                    @foreach (WhichHospital() as $WhichHospital)
                                     <i class="fas fa-map-marker-alt fs-6 mb-3 "><a class="px-2 color-text" href="#">{{$WhichHospital->location  }}</a></i>
                                     @endforeach

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="heading">Contact Info</h3>
                                    <ul class="list-unstyled quick-info links">
                                        @foreach (GneralSettings() as $GneralSetting)
                                       <div class="col mb-2">
                                         <i class="fas fa-envelope fs-6"><a class="px-2 color-text" href="#">{{$GneralSetting->email }}</a></i>
                                       </div>
                                       <div class="col mb-2">
                                         <i class="fas fa-phone-alt fs-6"><a class="px-2 color-text" href="#">{{ $GneralSetting->phone }}</a></i>
                                       </div>
                                       <div class="col mb-2">
                                        <i class="fas fa-map-marker-alt fs-6"><a class="px-2 color-text" href="#">{{ $GneralSetting->address }}</a></i>
                                       </div>
                                       @endforeach



                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="inner dark">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-8 mb-md-0 mx-auto">
                                <p>Copyright &copy;
                                    <script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed by <a href="#" class="link-highlight">Bir IT</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
        </div>

    <script src="{{ asset('frontend_assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/main.js"></script>

</body>
</html>
