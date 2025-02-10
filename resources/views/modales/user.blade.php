<div class="modal custom-modal modal-lg fade" id="add_user" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 500px!important; overflow-y: scroll">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="#" id="form-enviar" method="post" enctype="multipart/form-data">

                <input type="hidden" id="method" name="_method" value="" />
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="" class="modal_registro_user_id" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-groups-item">
                                    <h5 class="form-title">@lang('Profile Picture')</h5>
                                    <div class="profile-picture">
                                        <div class="upload-profile">
                                            <div class="profile-img">
                                                <img id="blah" class="avatar" src alt="profile-img">
                                            </div>
                                            <div class="add-profile">
                                                <h5>@lang('Upload a New Photo')</h5>
                                            </div>
                                        </div>
                                        <div class="img-upload">
                                            <input type="file" name="avatar" id="avatar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('First Name')</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Enter First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Last Name')</label>
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control" placeholder="Enter Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('DNI')</label>
                                                <input type="text" name="dni" id="dni" class="form-control"
                                                    placeholder="Enter DNI">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Gender')</label>
                                                <select class="form-control form-small select" name="gender_id"
                                                    id="gender_id">
                                                    <option>@lang('Select Gender')</option>
                                                    @foreach ($genders as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Email')</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Phone Number')</label>
                                                <input type="text" name="movil" id="movil" class="form-control"
                                                    placeholder="Enter Phone Number" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Role')</label>
                                                <select class="form-control form-small select" name="roles"
                                                    id="role_id">
                                                    <option>Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"> {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="pass-group" id="3">
                                                <div class="input-block">
                                                    <label>@lang('Password')</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control pass-input">
                                                    <span class="toggle-password feather-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Date of Birth')</label>
                                                <div class="cal-icon cal-icon-info">
                                                    <input type="text" name="brithday" id="brithday"
                                                        class="datetimepicker form-control" placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block ">
                                                <label>@lang('Status')</label>
                                                <select class="form-control form-small select" name="status"
                                                    id="status">
                                                    <option>Select Status</option>
                                                    @foreach ($status as $st)
                                                        <option value="{{ $st->id }}">{{ $st->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg- mt-3">
                                            <div class="form-title">
                                                <h5 class="form-title">@lang('Address Information')</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Address')</label>
                                                <input type="text" name="address" value="" id="address"
                                                    class="form-control" placeholder="Enter your Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Country')</label>
                                                <input type="hidden" name="country" value="" id="country">
                                                <input type="hidden" name="state" value="" id="state">
                                                <input type="hidden" name="city" value="" id="city">
                                                <select class="form-control form-small" name="country_id"
                                                    id="country_id">
                                                    <option>@lang('Select')</option>
                                                    @foreach ($countries as $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('State')</label>
                                                <select class="form-control form-small select" name="state_id"
                                                    id="state_id">
                                                    <option>@lang('Select')</option>
                                                    @foreach ($states as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('City')</label>
                                                <select class="form-control form-small select" name="city_id"
                                                    id="city_id">
                                                    <option>@lang('Select')</option>
                                                    @foreach ($cities as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-back cancel-btn me-2">@lang('Close')</button>

                    <button type="submit" data-bs-dismiss="modal"
                        class="btn btn-primary paid-continue-btn">@lang('Submit')</button>

                </div>
            </form>
        </div>
    </div>
</div>
