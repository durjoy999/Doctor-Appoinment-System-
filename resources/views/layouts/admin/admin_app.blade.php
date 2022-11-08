<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BIR it" name="description" />
    <meta content="BIR it" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">

    @include('layouts.admin.includes.css')
</head>
    <body data-topbar="dark">
    <!-- <body data-layout="horizontal"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">
           @include('layouts.admin.includes.header')
            <!-- Left Sidebar Start -->
          @include('layouts.admin.includes.left_sidebar')
            <!-- Left Sidebar End -->
            <div class="main-content">
                @yield('admin_content')
                <!-- End Page-content -->
                @include('layouts.admin.includes.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        <!-- Right Sidebar -->
       @include('layouts.admin.includes.right_sidebar')
        <!-- /Right-bar -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
       @include('layouts.admin.includes.js')
    </body>
</html>
