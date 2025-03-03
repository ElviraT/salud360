  <!-- ========== Topbar Start ========== -->
  <div class="navbar-custom">
      <div class="topbar container-fluid">
          <div class="d-flex align-items-center gap-lg-2 gap-1">

              <!-- Topbar Brand Logo -->
              <div class="logo-topbar">
                  <!-- Logo light -->
                  <a href="{{ route('inicio') }}" class="logo-light">
                      <span class="logo-lg">
                          <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                      </span>
                      <span class="logo-sm">
                          <img src="{{ asset('assets/images/favicon.png') }}" alt="small logo">
                      </span>
                  </a>

                  <!-- Logo Dark -->
                  <a href="{{ route('inicio') }}" class="logo-dark">
                      <span class="logo-lg">
                          <img src="{{ asset('assets/images/logo.png') }}" alt="dark logo">
                      </span>
                      <span class="logo-sm">
                          <img src="{{ asset('assets/images/favicon.png') }}" alt="small logo">
                      </span>
                  </a>
              </div>

              <!-- Sidebar Menu Toggle Button -->
              <button class="button-toggle-menu">
                  <i class="mdi mdi-menu"></i>
              </button>

              <!-- Horizontal Menu Toggle Button -->
              <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                  <div class="lines">
                      <span></span>
                      <span></span>
                      <span></span>
                  </div>
              </button>

              <!-- Topbar Search Form -->
              <a href="{{ route('limpiar') }}" class="btn btn-primary">{{ __('Clear Cache') }}</a>
          </div>

          <ul class="topbar-menu d-flex align-items-center gap-3">
              <form id="language-form">
                  @csrf
                  <select name="locale" id="locale" class="form-select">
                      <option value="es" {{ app()->getLocale() === 'es' ? 'selected' : '' }}>{{ __('Spanish') }}
                      </option>
                      <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>{{ __('English') }}
                      </option>
                  </select>
              </form>

              <li class="d-none d-sm-inline-block">
                  <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                      <i class="ri-settings-3-line font-22"></i>
                  </a>
              </li>

              <li class="d-none d-sm-inline-block">
                  <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                      title="Theme Mode">
                      <i class="ri-moon-line font-22"></i>
                  </div>
              </li>

              <li class="d-none d-md-inline-block">
                  <a class="nav-link" href="" data-toggle="fullscreen">
                      <i class="ri-fullscreen-line font-22"></i>
                  </a>
              </li>

              <li class="dropdown">
                  <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                      role="button" aria-haspopup="false" aria-expanded="false">
                      <span class="account-user-avatar">
                          <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/avatar.png') }}"
                              alt="user-image" width="32" class="rounded-circle">
                      </span>
                      <span class="d-lg-flex flex-column gap-1 d-none">
                          <h5 class="my-0">{{ auth()->user()->name }}</h5>
                          <h6 class="my-0 fw-normal">{{ auth()->user()->getRoleNames()->first() }}</h6>
                      </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                      <!-- item-->
                      <div class=" dropdown-header noti-title">
                          <h6 class="text-overflow m-0">{{ __('Welcome!') }} </h6>
                      </div>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item">
                          <i class="mdi mdi-account-circle me-1"></i>
                          <span>{{ __('My_Account') }}</span>
                      </a>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item">
                          <i class="mdi mdi-account-edit me-1"></i>
                          <span>{{ __('Settings') }}</span>
                      </a>

                      <!-- item-->
                      {{-- <a href="javascript:void(0);" class="dropdown-item">
                          <i class="mdi mdi-lifebuoy me-1"></i>
                          <span>Support</span>
                      </a> --}}

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item">
                          <i class="mdi mdi-lock-outline me-1"></i>
                          <span>{{ __('Lock Screen') }}</span>
                      </a>

                      <!-- item-->
                      <a class="dropdown-item"
                          href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="mdi mdi-logout me-1"></i>
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          </ul>
      </div>
  </div>
  <!-- ========== Topbar End ========== -->
