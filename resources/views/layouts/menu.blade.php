<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('home') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="80%">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/small-ligth.png') }}" alt="small logo" class="image-fluid">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('home') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" width="80%">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/small-dark.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -->
    <div class="menu h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">{{ __('Menu') }}</li>
            @can('inicio')
                <li class="side-nav-item">
                    <a href="{{ route('inicio') }}" class="side-nav-link" onclick="loading_show()">
                        <i class="uil-heartbeat"></i>
                        <span> {{ __('Dashboard') }} </span>
                    </a>
                </li>
            @endcan
            <li class="side-nav-title">{{ __('Setting') }}</li>
            @canany(['permissions.index', 'users.index', 'medicals.index'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers"
                        class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        <span> {{ __('User Settings') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarUsers">
                        <ul class="side-nav-second-level">
                            @can('permissions.index')
                                <li>
                                    <a href="{{ route('permissions.index') }}" onclick="loading_show()">
                                        {{ __('Roles & Permission') }}</a>
                                </li>
                            @endcan
                            @can('users.index')
                                <li>
                                    <a href="{{ route('users.index') }}" onclick="loading_show()">{{ __('Users') }}</a>
                                </li>
                            @endcan
                            @can('medicals.index')
                                <li>
                                    <a href="{{ route('medicals.index') }}" onclick="loading_show()">{{ __('Medicals') }}</a>
                                </li>
                            @endcan
                            {{-- @can('patients') --}}
                            <li>
                                <a href="{{ route('patients') }}" onclick="loading_show()">{{ __('Patients') }}</a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </div>
                </li>
            @endcanany
            @can('currencies.index')
                <li class="side-nav-item">
                    <a href="{{ route('currencies.index') }}" class="side-nav-link" onclick="loading_show()">
                        <i class="uil-money-bill"></i>
                        <span> {{ __('Currency') }} </span>
                    </a>
                </li>
            @endcan
            @can('banks.index')
                <li class="side-nav-item">
                    <a href="{{ route('banks.index') }}" class="side-nav-link" onclick="loading_show()">
                        <i class="uil-money-withdrawal"></i>
                        <span> {{ __('Banks') }} </span>
                    </a>
                </li>
            @endcan
            @can('plans.index')
                <li class="side-nav-item">
                    <a href="{{ route('plans.index') }}" class="side-nav-link" onclick="loading_show()">
                        <i class="uil-file-check-alt"></i>
                        <span> {{ __('Plans') }} </span>
                    </a>
                </li>
            @endcan

            <li class="side-nav-title">{{ __('Consultation') }}</li>
            @canany(['meeting', 'users.index', 'medicals.index'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarMedical" aria-expanded="false" aria-controls="sidebarUsers"
                        class="side-nav-link">
                        <i class="uil-heart-rate"></i>
                        <span> {{ __('Medical Management') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMedical">
                        <ul class="side-nav-second-level">
                            @can('specialities')
                                <li>
                                    <a href="{{ route('specialities') }}" onclick=" loading_show();">
                                        @lang('Specialities')
                                    </a>
                                </li>
                            @endcan
                            @can('services')
                                <li>
                                    <a href="{{ route('services') }}" onclick=" loading_show();">
                                        @lang('Services')
                                    </a>
                                </li>
                            @endcan
                            @can('meeting')
                                <li class="side-nav-item">
                                    <a href="{{ route('meeting') }}" onclick="loading_show()">
                                        {{ __('Online Consultation') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('appointments') }}" class="side-nav-link" onclick="loading_show()">
                        <i class="uil-calendar-alt"></i>
                        <span> {{ __('Appointments') }} </span>
                    </a>
                </li>
            @endcanany
            <li class="side-nav-title">{{ __('Reports') }}</li>
            @can('report.pagos')
                <li class="side-nav-item">
                    <a href="{{ route('report.pagos') }}" class="side-nav-link" onclick="loading_show()">
                        <i class="uil-file"></i>
                        <span> {{ __('Payment Report') }} </span>
                    </a>
                </li>
            @endcan
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
