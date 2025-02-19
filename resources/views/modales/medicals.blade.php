<div class="modal custom-modal modal-lg fade" id="modal_medical" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
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
                        class="modal_registro_medical_id" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-groups-item">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <label>@lang('User')</label>
                                            <select name="user_id" id="user_id" class="select2 form-control"
                                                data-toggle="select2">
                                                <option>@lang('Select User')</option>
                                                @foreach ($users as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <label>@lang('Speciality')</label>
                                            <select name="speciality_id" id="speciality_id" class="select2 form-control"
                                                data-toggle="select2">
                                                <option>@lang('Select Speciality')</option>
                                                @foreach ($specialities as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <label>@lang('Clinic')</label>
                                            <select name="clinic_id" id="clinic_id" class="select2 form-control"
                                                data-toggle="select2">
                                                <option>@lang('Select Clinic')</option>
                                                @foreach ($clinics as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if (Auth::user()->hasRole('SuperAdmin'))
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                                <div class="input-block ">
                                                    <label>@lang('Cliente')</label>
                                                    <select class="select2 form-control" data-toggle="select2"
                                                        name="created_by" id="created_by">
                                                        <option>Select</option>
                                                        @foreach ($users as $st)
                                                            <option value="{{ $st->id }}">{{ $st->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="created_by" id="created_by"
                                                value="{{ auth()->user()->id }}">
                                        @endif
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <label>@lang('Name')</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Enter Name">
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <label>@lang('Registration')</label>
                                            <input type="text" name="professional_license" id="professional_license"
                                                class="form-control" placeholder="Enter Register">
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <label>{{ __('Biographic') }}</label>
                                            <textarea name="bio" id="bio" rows="3" class="form-control"></textarea>
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
