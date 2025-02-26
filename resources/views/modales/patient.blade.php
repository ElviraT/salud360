<div class="modal fade" id="modal_patient" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="#" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_patient_id" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-groups-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="progressbarwizard">
                                                <div class="col-12 p-2">
                                                    <ul class="nav nav-pills nav-justified form-wizard-header">
                                                        <li class="nav-item">
                                                            <a href="#account-2" data-bs-toggle="tab" data-toggle="tab"
                                                                class="nav-link rounded-0">
                                                                <i
                                                                    class="mdi mdi-account-circle font-18 align-middle me-1"></i>
                                                                <span
                                                                    class="d-none d-sm-inline">{{ __('User') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#profile-tab" data-bs-toggle="tab"
                                                                data-toggle="tab" class="nav-link rounded-0"
                                                                id="tab_2" disabled>
                                                                <i
                                                                    class="mdi mdi-account-check font-18 align-middle me-1"></i>
                                                                <span
                                                                    class="d-none d-sm-inline">{{ __('General Information') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#contact-information" data-bs-toggle="tab"
                                                                data-toggle="tab" class="nav-link rounded-0"
                                                                id="tab_3" disabled>
                                                                <i
                                                                    class="mdi mdi-card-account-details-outline font-18 align-middle me-1"></i>
                                                                <span
                                                                    class="d-none d-sm-inline">{{ __('Contact Information') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#health_information" data-bs-toggle="tab"
                                                                data-toggle="tab" class="nav-link rounded-0"
                                                                id="tab_3" disabled>
                                                                <i
                                                                    class="mdi mdi-medical-bag font-18 align-middle me-1"></i>
                                                                <span
                                                                    class="d-none d-sm-inline">{{ __('Health Information') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#informed_consents" data-bs-toggle="tab"
                                                                data-toggle="tab" class="nav-link rounded-0"
                                                                id="tab_4" disabled>
                                                                <i
                                                                    class="mdi mdi-checkbox-marked-circle-outline font-18 align-middle me-1"></i>
                                                                <span
                                                                    class="d-none d-sm-inline">{{ __('Informed Consents') }}</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-content">

                                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                                        <div
                                                            class="bar progress-bar progress-bar-striped progress-bar-animated bg-progress">
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane p-2" id="account-2">
                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label for="name"
                                                                            class="col-form-label text-md-end">{{ __('Name') }}</label>
                                                                        <input id="name" type="text"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            name="name" value="{{ old('name') }}"
                                                                            required autocomplete="name" autofocus>

                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror

                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="email"
                                                                            class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                                                                        <input id="email" type="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            name="email" value="{{ old('email') }}"
                                                                            required autocomplete="email">

                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="password"
                                                                            class="col-form-label text-md-end">{{ __('Password') }}</label>
                                                                        <input id="password" type="password"
                                                                            class="form-control @error('password') is-invalid @enderror"
                                                                            name="password"
                                                                            autocomplete="new-password">

                                                                        @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="password-confirm"
                                                                            class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                                                        <input id="password-confirm" type="password"
                                                                            class="form-control"
                                                                            name="password_confirmation"
                                                                            autocomplete="new-password">
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->

                                                        <ul class="list-inline wizard mb-0">
                                                            <li class="next list-inline-item float-end">
                                                                <a href="javascript:void(0);" class="btn btn-primary"
                                                                    onclick="return verificar(2)">{{ __('Add More Info') }}
                                                                    <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-pane p-2" id="profile-tab">
                                                        <div class="row">
                                                            <div class="col-12" id="div_2" hidden>
                                                                <div class="row">
                                                                    @if (Auth::user()->hasRole('SuperAdmin'))
                                                                        <div class="col-lg-4 col-md-6 mb-2">
                                                                            <div class="input-block ">
                                                                                <label>@lang('Cliente')</label>
                                                                                <select class="select2 form-control"
                                                                                    data-toggle="select2"
                                                                                    name="created_by" id="created_by">
                                                                                    <option>Select</option>
                                                                                    @foreach ($users as $st)
                                                                                        <option
                                                                                            value="{{ $st->id }}">
                                                                                            {{ $st->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <input type="hidden" name="created_by"
                                                                            id="created_by"
                                                                            value="{{ auth()->user()->id }}">
                                                                    @endif
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <div class="input-block mb-3">
                                                                            <label>@lang('Marital Status')</label>
                                                                            <select name="marital_id" id="marital_id"
                                                                                class="select2 form-control"
                                                                                data-toggle="select2">
                                                                                <option>{{ __('Select') }}</option>
                                                                                @foreach ($marital as $item)
                                                                                    <option
                                                                                        value="{{ $item->id }}">
                                                                                        {{ $item->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <div class="input-block mb-3">
                                                                            <label>@lang('Sex')</label>
                                                                            <select name="sexes_id" id="sexes_id"
                                                                                class="select2 form-control"
                                                                                data-toggle="select2">
                                                                                <option>{{ __('Select') }}</option>
                                                                                @foreach ($sexes as $item)
                                                                                    <option
                                                                                        value="{{ $item->id }}">
                                                                                        {{ $item->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <div class="input-block mb-3">
                                                                            <label>@lang('Date of birth')</label>
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    name="Date_of_birth"
                                                                                    id="Date_of_birth"
                                                                                    class="form-control date"
                                                                                    data-toggle="date-picker"
                                                                                    data-date-autoclose="true"
                                                                                    data-single-date-picker="true">
                                                                                <span
                                                                                    class="input-group-text bg-primary border-primary text-white">
                                                                                    <i
                                                                                        class="mdi mdi-calendar-range font-13"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <label class="col-form-label"
                                                                            for="dni">{{ __('DNI') }}</label>
                                                                        <input type="text" id="dni"
                                                                            name="dni" class="form-control"
                                                                            value="{{ old('dni') }}">
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <label class="col-form-label"
                                                                            for="ocupation">{{ __('Ocupation') }}</label>
                                                                        <input type="text" id="ocupation"
                                                                            name="ocupation" class="form-control"
                                                                            value="{{ old('ocupation') }}">
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <label class="col-form-label"
                                                                            for="phone">{{ __('Phone') }}</label>
                                                                        <input type="text" id="phone"
                                                                            name="phone" class="form-control"
                                                                            value="{{ old('phone') }}">
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label class="col-form-label"
                                                                            for="address">{{ __('Address') }}</label>
                                                                        <textarea name="address" id="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                                                                    </div>
                                                                </div>

                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                        <ul class="pager wizard mb-0 list-inline">
                                                            <li class="previous list-inline-item">
                                                                <button type="button" class="btn btn-info"><i
                                                                        class="mdi mdi-arrow-left me-1"></i> Back
                                                                    to users</button>
                                                            </li>
                                                            <li class="next list-inline-item float-end">
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="return verificar(3)">Add
                                                                    More
                                                                    Info <i
                                                                        class="mdi mdi-arrow-right ms-1"></i></button>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-pane p-2" id="contact-information">
                                                        <div class="row">
                                                            <div class="col-12" id="div_3" hidden>
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <label class="col-form-label"
                                                                            for="namec">{{ __('Name') }}</label>
                                                                        <input type="text" id="namec"
                                                                            name="namec" class="form-control"
                                                                            value="{{ old('namec') }}">
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <label class="col-form-label"
                                                                            for="emailc">{{ __('Email') }}</label>
                                                                        <input type="email" id="emailc"
                                                                            name="emailc" class="form-control"
                                                                            value="{{ old('emailc') }}">
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 mb-2">
                                                                        <label class="col-form-label"
                                                                            for="phonec">{{ __('Phone') }}</label>
                                                                        <input type="text" id="phonec"
                                                                            name="phonec" class="form-control"
                                                                            value="{{ old('phonec') }}">
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label class="col-form-label"
                                                                            for="addressc">{{ __('Address') }}</label>
                                                                        <textarea name="addressc" id="addressc" rows="3" class="form-control">{{ old('address') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                        <ul class="pager wizard mb-0 list-inline">
                                                            <li class="previous list-inline-item">
                                                                <button type="button" class="btn btn-info"><i
                                                                        class="mdi mdi-arrow-left me-1"></i> Back
                                                                    to general information</button>
                                                            </li>
                                                            <li class="next list-inline-item float-end">
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="return verificar(4)">Add
                                                                    More
                                                                    Info <i
                                                                        class="mdi mdi-arrow-right ms-1"></i></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-pane p-2" id="health_information">
                                                        <div class="col-12" id="div_4" hidden>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    <label class="col-form-label"
                                                                        for="blood_group">{{ __('Blood Group') }}</label>
                                                                    <input type="text" id="blood_group"
                                                                        name="blood_group" class="form-control"
                                                                        value="{{ old('blood_group') }}">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label class="col-form-label"
                                                                        for="allergies">{{ __('Allergies') }}</label>
                                                                    <input type="text" id="allergies"
                                                                        name="allergies" class="form-control"
                                                                        value="{{ old('allergies') }}">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label class="col-form-label"
                                                                        for="medical_condition">{{ __('Medical Condition') }}</label>
                                                                    <input type="text" id="medical_condition"
                                                                        name="medical_condition" class="form-control"
                                                                        value="{{ old('medical_condition') }}">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label class="col-form-label"
                                                                        for="medication">{{ __('Medication') }}</label>
                                                                    <input type="text" id="medication"
                                                                        name="medication" class="form-control"
                                                                        value="{{ old('medication') }}">
                                                                </div>
                                                            </div>
                                                            <ul class="pager wizard mb-0 list-inline">
                                                                <li class="previous list-inline-item">
                                                                    <button type="button" class="btn btn-info"><i
                                                                            class="mdi mdi-arrow-left me-1"></i> Back
                                                                        to Account</button>
                                                                </li>
                                                                <li class="next list-inline-item float-end">
                                                                    <button type="button" class="btn btn-primary"
                                                                        onclick="return verificar(5)">Add
                                                                        More
                                                                        Info <i
                                                                            class="mdi mdi-arrow-right ms-1"></i></button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-2" id="informed_consents">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-6 mb-3">
                                                                    <!-- Primary Switch-->
                                                                    <label>{{ __('Telemedicine') }}</label>
                                                                    <input type="checkbox" id="telemedicine" checked
                                                                        data-switch="primary" name="telemedicine" />
                                                                    <label for="telemedicine"
                                                                        data-on-label="{{ _('Yes') }}"
                                                                        data-off-label="{{ __('No') }}"></label>
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <!-- Primary Switch-->
                                                                    <label>{{ __('Data Collection') }}</label>
                                                                    <input type="checkbox" id="data_collection"
                                                                        checked data-switch="primary"
                                                                        name="data_collection" />
                                                                    <label for="data_collection"
                                                                        data-on-label="{{ _('Yes') }}"
                                                                        data-off-label="{{ __('No') }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="pager wizard mb-0 list-inline mt-1">
                                                            <li class="previous list-inline-item">
                                                                <button type="button" class="btn btn-info"><i
                                                                        class="mdi mdi-arrow-left me-1"></i>
                                                                    {{ __('Back to Profile') }}</button>
                                                            </li>
                                                            <li class="next list-inline-item float-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ __('Submit') }}</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> <!-- tab-content -->
                                            </div> <!-- end #progressbarwizard-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
