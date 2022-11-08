<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                @if (Auth::guard('admin')->user()->can('dashboard.index'))
                    <li class="@yield('home_active')">
                        <a href="{{ route('admin.home') }}">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                @endif

                </li>
                      <li class="@yield('doctorPhoto_active')">
                          <a href="{{ route('admin.doctorPhotos.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                              <span data-key="t-chat">Doctor Photo</span>
                          </a>
                     </li>
                      <li class="@yield('makeAppointment_active')">
                          <a href="{{ route('admin.MakeAppointments.index') }}">
                              <i class="fas fa-envelope"></i>
                              <span data-key="t-chat">Make an appointment</span> <span class="text text-danger"></span>
                          </a>
                      </li>
                     <li class="@yield('doctorMyself_active')">
                          <a class="" href="{{ route('admin.doctormyselfs.index') }}">
                              <i class="fas fa-id-card"></i>
                              <span data-key="t-chat">Doctor Myself </span> <span class="text text-danger"></span>
                          </a>
                      </li>
                     <li class="@yield('EducationalQualification_active')">
                          <a class="" href="{{ route('admin.educationals.index') }}">
                              <i class="fas fa-graduation-cap"></i>
                              <span data-key="t-chat">Educational Qualification</span> <span class="text text-danger"></span>
                          </a>
                      </li>
                     <li class="@yield('whichHospital_active')">
                          <a href="{{ route('admin.WhichHospitals.index') }}">
                              <i class="fas fa-hospital"></i>
                              <span data-key="t-chat">Which Hospital</span> <span class="text text-danger"></span>
                          </a>
                      </li>
                     <li class="@yield('Award_Record_active')">
                          <a href="{{ route('admin.AwardsRecords.index') }}">
                              <i class="fas fa-award"></i>
                              <span data-key="t-chat">Awards Record</span> <span class="text text-danger"></span>
                          </a>
                      </li>



                                      @if (Auth::guard('admin')->user()->can('admin.index') || Auth::guard('admin')->user()->can('role.index'))
                    <li class="">
                        <a href="javascript: void(0);" class="has-arrow" >
                            <i data-feather="users"></i>
                            <span data-key="t-ecommerce">Admin Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('admin.index'))

                            <li><a class="@yield('admin_admin_active')" href="{{ route('admin.admin.index') }}" key="t-products"><i data-feather="user"></i>Admins</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('role.index'))

                            <li><a class="@yield('admin_roles_active')" href="{{ route('admin.roles.index') }}" data-key="t-product-detail"><i data-feather="user"></i>Roles</a></li>
                            @endif

                        </ul>
                    </li>
                @endif


                @if (Auth::guard('admin')->user()->can('generalSettings.index') || Auth::guard('admin')->user()->can('configSettings.index'))
                    <li class="@yield('settings_active')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="settings"></i>
                            <span data-key="t-ecommerce">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('generalSettings.index'))

                            <li><a class="@yield('  ')" href="{{ route('admin.settings.general') }}"> <i data-feather="settings"></i>General</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('configSettings.index'))

                            <li><a class="@yield('settings_config_active')" href="{{ route('admin.settings.config') }}"> <i data-feather="settings"></i>Config</a></li>
                            @endif



                        </ul>
                    </li>
                @endif
        </div>
        <!-- Sidebar -->
    </div>
</div>
