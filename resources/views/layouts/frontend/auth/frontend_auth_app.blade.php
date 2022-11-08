<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>User Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BIR it expertise in Web design development, Software development, Graphic design, and digital marketing in order to drive sales and traffic" name="description" />
    <meta content="BIR it" name="author" />
    <!-- App favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @include('layouts.frontend.auth.includes.css')
    <!-- Don't Touch This CSS Start -->
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        img{
            width: 100%
        }
    </style>
    <!-- Don't Touch This CSS End -->
</head>
    <body data-topbar="dark">
    <div class="auth-page">
        <div class="container">
            <div class="row" style="height: 100vh">
                <div class="col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                    <div class="auth-full-page-content p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a href="javascript:void(0)" class="auth-logo">
                                        <img src="{{ asset('logo.png') }}" height="57" style="width: 200px" loading="lazy">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @yield('frontend_auth_content')
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Admin Panel. Developed <i class="mdi mdi-heart text-danger"></i> by <a href="https://birit.com.bd/" target="blank">BIR it</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.frontend.auth.includes.js')
</body>
</html>
