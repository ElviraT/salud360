<div class="col-12">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <form action="{{ route('medicals.update', $medical->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $medical->id }}">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mb-3">
                        <label>@lang('Name')</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $medical->name }}">
                    </div>

                    <div class="col-lg-6 col-sm-12 mb-3">
                        <label>@lang('Registration')</label>
                        <input type="text" name="professional_license" id="professional_license" class="form-control"
                            value="{{ $medical->professional_license }}">
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-3">
                        <label>@lang('Speciality')</label>
                        <select name="speciality_id" id="speciality_id" class="select2 form-control"
                            data-toggle="select2">
                            <option>@lang('Select Speciality')</option>
                            @foreach ($specialities as $value)
                                <option value="{{ $value->id }}"
                                    {{ $value->id == $medical->speciality_id ? 'selected' : '' }}>
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-3">
                        <label>@lang('Clinic')</label>
                        <select name="clinic_id" id="clinic_id" class="select2 form-control" data-toggle="select2">
                            <option>@lang('Select Clinic')</option>
                            @foreach ($clinics as $value)
                                <option value="{{ $value->id }}"
                                    {{ $value->id == $medical->clinic_id ? 'selected' : '' }}>
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label>{{ __('Biographic') }}</label>
                        <textarea name="bio" id="bio" rows="3" class="form-control">{{ $medical->bio }}</textarea>
                    </div>
                    <hr>
                </div>
                <h4>{{ __('Detail of Fees') }}</h4>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-2">
                        <label class="col-form-label" for="video">{{ __('Video') }}</label>
                        <input data-toggle="touchspin" data-step="0.1" data-decimals="2" type="text"
                            data-bts-max="10000" data-bts-min="0" id="video" name="video" class="form-control"
                            value="{{ $medical->video }}">
                    </div>
                    <div class="col-lg-6 col-md-12 mb-2">
                        <label class="col-form-label" for="domicile">{{ __('Domicile') }}</label>
                        <input data-toggle="touchspin" data-step="0.1" data-decimals="2" type="text"
                            data-bts-max="10000" data-bts-min="0" id="domicile" name="domicile" class="form-control"
                            value="{{ $medical->domicile }}">
                    </div>
                    <div class="col-lg-6 col-md-12 mb-2">
                        <label class="col-form-label" for="emergency">{{ __('Emergency') }}</label>
                        <input data-toggle="touchspin" data-step="0.1" data-decimals="2" type="text"
                            data-bts-max="10000" data-bts-min="0" id="emergency" name="emergency" class="form-control"
                            value="{{ $medical->emergency }}">
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label class="col-form-label" for="Face">{{ __('Face') }}</label>
                        <input data-toggle="touchspin" data-step="0.1" data-decimals="2" type="text"
                            data-bts-max="10000" data-bts-min="0" id="Face" name="Face" class="form-control"
                            value="{{ $medical->Face }}">
                    </div>
                </div>
                <hr>

                <div class="col-12 mt-2 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-md-12">
            <h5 class="form-title">@lang('Profile Picture')</h5>
            <div class="col-12">
                <div class="profile-picture row mb-3" align="center">
                    <div class="upload-profile">
                        <div class="profile-img">
                            <img id="blah" class="img-fluid rounded-circle" width="220"
                                src={{ $medical->user->avatar ? asset('storage/' . $medical->user->avatar) : asset('assets/images/avatar.png') }}
                                alt="profile-img">
                        </div>
                    </div>
                    <form action="{{ route('users.update_foto', $medical->user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="img-upload mt-4">
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>
                        <div class="add-profile mt-2">
                            <button type="submit" class="btn btn-primary">{{ __('Upload a New Photo') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
