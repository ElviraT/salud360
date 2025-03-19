<div class="col-12">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <form action="{{ route('patients.update', $patient->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $patient->id }}">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-2">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control" name="name"
                            value="{{ $patient->user->name }}" required autocomplete="name">
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <div class="input-block mb-3">
                            <label>@lang('Marital Status')</label>
                            <select name="marital_id" id="marital_id" class="select2 form-control"
                                data-toggle="select2">
                                <option>{{ __('Select') }}</option>
                                @foreach ($marital as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $patient->marital_id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <div class="input-block mb-3">
                            <label>@lang('Sex')</label>
                            <select name="sexes_id" id="sexes_id" class="select2 form-control" data-toggle="select2">
                                <option>{{ __('Select') }}</option>
                                @foreach ($sexes as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $patient->sexes_id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <div class="input-block mb-3">
                            <label>@lang('Date of birth')</label>
                            <div class="input-group" id="datepicker4">
                                <input type="text" name="Date_of_birth" id="birth" class="form-control"
                                    data-provide="datepicker" data-date-autoclose="true"
                                    data-date-container="#datepicker4" value="{{ $patient->Date_of_birth }}">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <label for="dni">{{ __('DNI') }}</label>
                        <input type="text" id="dni" name="dni" class="form-control"
                            value="{{ $patient->dni }}">
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <label for="ocupation">{{ __('Ocupation') }}</label>
                        <input type="text" id="ocupation" name="ocupation" class="form-control"
                            value="{{ $patient->ocupation }}">
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" id="phone" name="phone" class="form-control"
                            value="{{ $patient->phone }}">
                    </div>
                    <div class="col-lg-8 col-md-12 mb-3">
                        <label for="address">{{ __('Address') }}</label>
                        <textarea name="address" id="address" rows="3" class="form-control">{{ $patient->address }}</textarea>
                    </div>
                    <hr>
                </div>
                <h4>{{ __('Details Contact') }}</h4>
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-2">
                        <label class="col-form-label" for="namec">{{ __('Name') }}</label>
                        <input type="text" id="namec" name="namec" class="form-control"
                            value="{{ $patient->contact->name }}">
                    </div>
                    <div class="col-lg-4 col-md-12 mb-2">
                        <label class="col-form-label" for="emailc">{{ __('Email') }}</label>
                        <input type="email" id="emailc" name="emailc" class="form-control"
                            value="{{ $patient->contact->email }}">
                    </div>
                    <div class="col-lg-4 col-md-12 mb-2">
                        <label class="col-form-label" for="phonec">{{ __('Phone') }}</label>
                        <input type="text" id="phonec" name="phonec" class="form-control"
                            value="{{ $patient->contact->phone }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="col-form-label" for="addressc">{{ __('Address') }}</label>
                        <textarea name="addressc" id="addressc" rows="3" class="form-control">{{ $patient->contact->address }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <h4>{{ __('Health Information') }}</h4>
                    <hr>
                    <div class="col-md-6 mb-2">
                        <label class="col-form-label" for="blood_group">{{ __('Blood Group') }}</label>
                        <input type="text" id="blood_group" name="blood_group" class="form-control"
                            value="{{ $patient->healthInformation->blood_group }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="col-form-label" for="allergies">{{ __('Allergies') }}</label>
                        <input type="text" id="allergies" name="allergies" class="form-control"
                            value="{{ $patient->healthInformation->allergies }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="col-form-label" for="medical_condition">{{ __('Medical Condition') }}</label>
                        <input type="text" id="medical_condition" name="medical_condition" class="form-control"
                            value="{{ $patient->healthInformation->medical_condition }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="col-form-label" for="medication">{{ __('Medication') }}</label>
                        <input type="text" id="medication" name="medication" class="form-control"
                            value="{{ $patient->healthInformation->medication }}">
                    </div>
                </div>
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
                                src={{ $patient->user->avatar ? asset('storage/' . $patient->user->avatar) : asset('assets/images/avatar.png') }}
                                alt="profile-img">
                        </div>
                    </div>
                    <form action="{{ route('users.update_foto', $patient->user->id) }}" method="post"
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
