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
    <div class="h-100" id="leftside-menu-container" data-simplebar>
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
            <a href="{{ route('permissions.index') }}" class="side-nav-link">
                <i class="uil-lock"></i>
                <span> {{ __('Role & Permission') }} </span>
            </a>
            <a href="{{ route('plans.index') }}" class="side-nav-link">
                <i class="uil-file-check-alt"></i>
                <span> {{ __('Plans') }} </span>
            </a>
            <li class="side-nav-title">{{ __('Consultation') }}</li>

            <li class="side-nav-item">
                <a href="{{ route('meeting') }}" class="side-nav-link">
                    <i class="uil-webcam"></i>
                    <span> {{ __('Meeting') }} </span>
                </a>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
