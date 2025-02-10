@extends('layouts.base_register')

@section('content')
    <div class="card-header text-center">
        <h2> {{ __('Register of Users') }}</h2>
    </div>

    <div class="card-body">
        {{-- <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="col-4">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="password-confirm"
                            class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form> --}}

        <form method="POST" action="{{ route('registro') }}" enctype="multipart/form-data">
            @csrf
            <div id="progressbarwizard">

                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                    <li class="nav-item">
                        <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                            <i class="mdi mdi-account-circle font-18 align-middle me-1"></i>
                            <span class="d-none d-sm-inline">{{ __('User') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-tab-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                            <i class="mdi mdi-medical-bag font-18 align-middle me-1"></i>
                            <span class="d-none d-sm-inline">{{ __('Profile') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                            <i class="mdi mdi-checkbox-marked-circle-outline font-18 align-middle me-1"></i>
                            <span class="d-none d-sm-inline">Finish</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content b-0 mb-0">

                    <div id="bar" class="progress mb-3" style="height: 7px;">
                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-progress"></div>
                    </div>

                    <div class="tab-pane" id="account-2">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="col-4">
                                        <label for="email"
                                            class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="password"
                                            class="col-form-label text-md-end">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="password-confirm"
                                            class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <input type="hidden" value="1" name="plan_id">
                                    <div class="col-4">
                                        <label for="role"
                                            class="col-form-label text-md-end">{{ __('Type User') }}</label>

                                        <select class="form-select" name="roles" id="role_id" required>
                                            <option>{{ __('Select Type User') }}</option>
                                            <option value="{{ 'Clinica' }}"> {{ 'Clinica' }}</option>
                                            <option value="{{ 'Medico' }}"> {{ 'Medico' }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <ul class="list-inline wizard mb-0">
                            <li class="next list-inline-item float-end">
                                <a href="javascript:void(0);" class="btn btn-primary"
                                    onclick="return verificar()">{{ __('Add More Info') }} <i
                                        class="mdi mdi-arrow-right ms-1"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-pane" id="profile-tab-2">
                        <div class="row">
                            <div id="mensaje" align="center">
                                <h1>{{ __('Debe llenar el formulario anterior') }}</h1>
                            </div>
                            <div class="col-12" id="clinic" hidden>
                                <div class="row">
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label" for="name1">{{ __('Name') }}</label>
                                        <input type="text" id="name1" name="name1" class="form-control"
                                            value="{{ old('name1') }}">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label" for="phone">{{ __('Phone') }}</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label" for="emailc">{{ __('Email') }}</label>
                                        <input type="email" id="emailc" name="emailc" class="form-control"
                                            value="{{ old('emailc') }}">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="col-form-label" for="logo">{{ __('Logo') }}</label>
                                        <input type="file" id="logo" name="logo" class="form-control"
                                            value="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label" for="address">{{ __('Address') }}</label>
                                        <textarea name="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label" for="description">{{ __('Description') }}</label>
                                        <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                            </div> <!-- end col -->
                            <div class="col-12" id="medico" hidden>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <label class="col-form-label" for="first_name">{{ __('First Name') }}</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                            value="">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="col-form-label" for="last_name">{{ __('Last Name') }}</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                            value="">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="col-form-label"
                                            for="professional_license">{{ __('Professional License') }}</label>
                                        <input type="professional_license" id="professional_license"
                                            name="professional_licensec" class="form-control" value="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label" for="photo">{{ __('Photo') }}</label>
                                        <input type="file" id="photo" name="photo" class="form-control"
                                            value="">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="speciality"
                                            class="col-form-label text-md-end">{{ __('Speciality') }}</label>
                                        <select class="form-select" name="speciality_id" id="speciality_id" required>
                                            <option>{{ __('Select speciality') }}</option>
                                            @foreach ($specialities as $speciality)
                                                <option value="{{ $speciality->name }}"> {{ $speciality->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label" for="bio">{{ __('Biographia') }}</label>
                                        <textarea name="bio" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <ul class="pager wizard mb-0 list-inline">
                            <li class="previous list-inline-item">
                                <button type="button" class="btn btn-info"><i class="mdi mdi-arrow-left me-1"></i> Back
                                    to Account</button>
                            </li>
                            <li class="next list-inline-item float-end">
                                <button type="button" class="btn btn-primary">Add More Info <i
                                        class="mdi mdi-arrow-right ms-1"></i></button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-pane" id="finish-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                    <h3 class="mt-0">¡Gracias!</h3>

                                    <p class="w-75 mb-2 mx-auto">¡Bienvenido a TeleDoctor's! Nos complace que hayas elegido
                                        nuestra plataforma para optimizar la gestión de tu consultorio y brindar una
                                        atención de excelencia a tus pacientes.</p>

                                    <p class="w-75 mb-2 mx-auto">Al finalizar tu período de prueba, te invitamos a unirte a
                                        nuestra comunidad de profesionales de la salud y seguir disfrutando de todas estas
                                        ventajas. ¡Estamos seguros de que encontrarás el plan perfecto para tu consultorio!
                                    </p>

                                    {{-- <div class="mb-3">
                                        <div class="form-check d-inline-block">
                                            <input type="checkbox" class="form-check-input" id="customCheck3">
                                            <label class="form-check-label" for="customCheck3">I agree with the Terms and
                                                Conditions</label>
                                        </div>
                                    </div> --}}
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <ul class="pager wizard mb-0 list-inline mt-1">
                            <li class="previous list-inline-item">
                                <button type="button" class="btn btn-info"><i class="mdi mdi-arrow-left me-1"></i>
                                    {{ __('Back to Profile') }}</button>
                            </li>
                            <li class="next list-inline-item float-end">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </li>
                        </ul>
                    </div>

                </div> <!-- tab-content -->
            </div> <!-- end #progressbarwizard-->
        </form>
    </div>
@endsection
@section('script')
    <script src="assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

    <!-- Wizard Form Demo js -->
    <script src="assets/js/pages/demo.form-wizard.js"></script>
    <script>
        $(function() {
            "use strict";
            $("#basicwizard").bootstrapWizard(),
                $("#progressbarwizard").bootstrapWizard({
                    onTabShow: function(t, r, a) {
                        a = ((a + 1) / r.find("li").length) * 100;
                        $("#progressbarwizard")
                            .find(".bar")
                            .css({
                                width: a + "%"
                            });
                    },
                }),
                $("#btnwizard").bootstrapWizard({
                    nextSelector: ".button-next",
                    previousSelector: ".button-previous",
                    firstSelector: ".button-first",
                    lastSelector: ".button-last",
                }),
                $("#rootwizard").bootstrapWizard({
                    onNext: function(t, r, a) {
                        t = $($(t).data("targetForm"));
                        if (t && (t.addClass("was-validated"), !1 === t[0].checkValidity()))
                            return event.preventDefault(), event.stopPropagation(), !1;
                    },
                });
        });

        function verificar() {
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var password2 = $('#password-confirm').val();
            var role_id = $('#role_id').val();
            console.log(role_id);

            if (name == '' || email == '' || password == '' || password2 == '' || role_id == '') {
                // Mostrar una notificación de advertencia
                toastr.warning('¡Debe llenar todos los campos!');
            } else {
                if (role_id === 'Clinica') {
                    console.log('estoy aqui');
                    $('#mensaje').attr("hidden", "hidden");
                    $('#clinic').removeAttr("hidden");
                    $('#medico').attr("hidden", "hidden");
                }
                if (role_id === 'Medico') {
                    $('#mensaje').attr("hidden", "hidden");
                    $('#medico').removeAttr("hidden");
                    $('#clinic').attr("hidden", "hidden");
                }
                if (role_id === 'Select Role') {
                    console.log('estoy en Select Role');
                    $('#mensaje').removeAttr("hidden");
                    $('#medico').attr("hidden", "hidden");
                    $('#clinic').attr("hidden", "hidden");
                }
            }
        }
    </script>
@endsection
