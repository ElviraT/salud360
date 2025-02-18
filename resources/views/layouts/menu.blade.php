<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('home') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="small logo" class="image-fluid" width="50%">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('home') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="small logo" width="50%">
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

            <li class="side-nav-item">
                <a href="{{ route('inicio') }}" class="side-nav-link">
                    <i class="uil-heartbeat"></i>
                    <span> {{ __('Dashboard') }} </span>
                </a>
            </li>

            <li class="side-nav-title">{{ __('Setting') }}</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> {{ __('User Settings') }} </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('permissions.index') }}"> {{ __('Roles & Permission') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('medicals.index') }}">{{ __('Medicals') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ __('Patients') }}</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('currencies.index') }}" class="side-nav-link">
                    <i class="uil-money-bill"></i>
                    <span> {{ __('Currency') }} </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('banks.index') }}" class="side-nav-link">
                    <i class="uil-money-withdrawal"></i>
                    <span> {{ __('Banks') }} </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('plans.index') }}" class="side-nav-link">
                    <i class="uil-file-check-alt"></i>
                    <span> {{ __('Plans') }} </span>
                </a>
            </li>
            <li class="side-nav-title">{{ __('Consultation') }}</li>

            <li class="side-nav-item">
                <a href="{{ route('meeting') }}" class="side-nav-link">
                    <i class="uil-webcam"></i>
                    <span> {{ __('Meeting') }} </span>
                </a>
            </li>
            <li class="side-nav-title">{{ __('Reports') }}</li>
            <li class="side-nav-item">
                <a href="{{ route('report.pagos') }}" class="side-nav-link">
                    <i class="uil-file"></i>
                    <span> {{ __('Payment Report') }} </span>
                </a>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
