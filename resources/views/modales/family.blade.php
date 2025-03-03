<div class="modal fade" id="modal_family" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                        class="modal_registro_family_id" />
                    <div class="row">
                        <input type="hidden" name="patient_id" value="{{ $patient_id }}">
                        <div class="col-lg-4 col-md-6 mb-2">
                            <div class="input-block">
                                <label>@lang('Relationship')</label>
                                <select name="relationship_id" id="relationship_id" class="select2 form-control"
                                    data-toggle="select2">
                                    <option>{{ __('Select') }}</option>
                                    @foreach ($relation as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-2">
                            <div class="input-block">
                                <label>@lang('Sex')</label>
                                <select name="sexes_id" id="sexes_id" class="select2 form-control"
                                    data-toggle="select2">
                                    <option>{{ __('Select') }}</option>
                                    @foreach ($sexes as $item)
                                        <option value="{{ $item->id }}">
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
                                    <input type="text" name="Date_of_birth" id="Date_of_birth"
                                        class="form-control date" data-toggle="date-picker" data-date-autoclose="true"
                                        data-single-date-picker="true">
                                    <span class="input-group-text bg-primary border-primary text-white">
                                        <i class="mdi mdi-calendar-range font-13"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-2">
                            <div class="input-block">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-2">
                            <label for="dni" class="col-form-label">{{ __('dni') }}</label>
                            <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror"
                                name="dni" value="{{ old('dni') }}">

                            @error('dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 mb-2">
                            <label for="phone_number" class="col-form-label">{{ __('Phone') }}</label>
                            <input id="phone_number" type="text"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ old('phone_number') }}">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 mb-2">
                            <label for="email" class="col-form-label">{{ __('Email') }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
