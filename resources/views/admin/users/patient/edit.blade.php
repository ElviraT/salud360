@extends('layouts.base_admin')

@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Patient') . ': ' . $patient->user->name }}</h2>
                <div class="col-12" align="right">
                    @can('patients.index')
                        <a href="{{ route('patients') }}" class="btn btn-info"><i
                                class=" uil-history-alt"></i>&nbsp;{{ __('Back') }}</a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Patient Details') }}</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="bordered-justified-tabs-preview">
                                <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="#detail_basic-b2" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link active">
                                            <span class="d-none d-md-block">{{ __('Detail Basic') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#file-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                            <span class="d-none d-md-block">{{ __('Files & Docs') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#settings-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            <span class="d-none d-md-block">Settings</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="detail_basic-b2">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <form action="{{ route('patients.update', $patient->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $patient->id }}">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 mb-2">
                                                                <label for="name">{{ __('Name') }}</label>
                                                                <input id="name" type="text" class="form-control"
                                                                    name="name" value="{{ $patient->user->name }}"
                                                                    required autocomplete="name">
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 mb-2">
                                                                <div class="input-block mb-3">
                                                                    <label>@lang('Marital Status')</label>
                                                                    <select name="marital_id" id="marital_id"
                                                                        class="select2 form-control" data-toggle="select2">
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
                                                                    <select name="sexes_id" id="sexes_id"
                                                                        class="select2 form-control" data-toggle="select2">
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
                                                                        <input type="text" name="Date_of_birth"
                                                                            id="birth" class="form-control"
                                                                            data-provide="datepicker"
                                                                            data-date-autoclose="true"
                                                                            data-date-container="#datepicker4"
                                                                            value="{{ $patient->Date_of_birth }}">
                                                                        <span
                                                                            class="input-group-text bg-primary border-primary text-white">
                                                                            <i class="mdi mdi-calendar-range font-13"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 mb-2">
                                                                <label for="dni">{{ __('DNI') }}</label>
                                                                <input type="text" id="dni" name="dni"
                                                                    class="form-control" value="{{ $patient->dni }}">
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 mb-2">
                                                                <label for="ocupation">{{ __('Ocupation') }}</label>
                                                                <input type="text" id="ocupation" name="ocupation"
                                                                    class="form-control" value="{{ $patient->ocupation }}">
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 mb-2">
                                                                <label for="phone">{{ __('Phone') }}</label>
                                                                <input type="text" id="phone" name="phone"
                                                                    class="form-control" value="{{ $patient->phone }}">
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
                                                                <label class="col-form-label"
                                                                    for="namec">{{ __('Name') }}</label>
                                                                <input type="text" id="namec" name="namec"
                                                                    class="form-control"
                                                                    value="{{ $patient->contact->name }}">
                                                            </div>
                                                            <div class="col-lg-4 col-md-12 mb-2">
                                                                <label class="col-form-label"
                                                                    for="emailc">{{ __('Email') }}</label>
                                                                <input type="email" id="emailc" name="emailc"
                                                                    class="form-control"
                                                                    value="{{ $patient->contact->email }}">
                                                            </div>
                                                            <div class="col-lg-4 col-md-12 mb-2">
                                                                <label class="col-form-label"
                                                                    for="phonec">{{ __('Phone') }}</label>
                                                                <input type="text" id="phonec" name="phonec"
                                                                    class="form-control"
                                                                    value="{{ $patient->contact->phone }}">
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="col-form-label"
                                                                    for="addressc">{{ __('Address') }}</label>
                                                                <textarea name="addressc" id="addressc" rows="3" class="form-control">{{ $patient->contact->address }}</textarea>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <h4>{{ __('Health Information') }}</h4>
                                                            <hr>
                                                            <div class="col-md-6 mb-2">
                                                                <label class="col-form-label"
                                                                    for="blood_group">{{ __('Blood Group') }}</label>
                                                                <input type="text" id="blood_group" name="blood_group"
                                                                    class="form-control"
                                                                    value="{{ $patient->healthInformation->blood_group }}">
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label class="col-form-label"
                                                                    for="allergies">{{ __('Allergies') }}</label>
                                                                <input type="text" id="allergies" name="allergies"
                                                                    class="form-control"
                                                                    value="{{ $patient->healthInformation->allergies }}">
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label class="col-form-label"
                                                                    for="medical_condition">{{ __('Medical Condition') }}</label>
                                                                <input type="text" id="medical_condition"
                                                                    name="medical_condition" class="form-control"
                                                                    value="{{ $patient->healthInformation->medical_condition }}">
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label class="col-form-label"
                                                                    for="medication">{{ __('Medication') }}</label>
                                                                <input type="text" id="medication" name="medication"
                                                                    class="form-control"
                                                                    value="{{ $patient->healthInformation->medication }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2 text-center">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-lg">{{ __('Update') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-4 col-md-12">
                                                    <h5 class="form-title">@lang('Profile Picture')</h5>
                                                    <div class="col-12">
                                                        <div class="profile-picture row mb-3" align="center">
                                                            <div class="upload-profile">
                                                                <div class="profile-img">
                                                                    <img id="blah" class="img-fluid rounded-circle"
                                                                        width="220"
                                                                        src={{ $patient->user->avatar ? asset('storage/' . $patient->user->avatar) : asset('assets/images/avatar.png') }}
                                                                        alt="profile-img">
                                                                </div>
                                                            </div>
                                                            <form
                                                                action="{{ route('users.update_foto', $patient->user->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="img-upload mt-4">
                                                                    <input type="file" name="avatar" id="avatar"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="add-profile mt-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">{{ __('Upload a New Photo') }}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane " id="file-b2">
                                        <div class="col-12 mb-2" align="right">
                                            {{-- @can('files.upload') --}}
                                            <a class="btn btn-info" href="#" data-bs-toggle="modal"
                                                data-bs-record-id="{{ $patient->id }}" data-bs-target="#folder_file"><i
                                                    class="uil-plus-circle"></i>&nbsp;@lang('Upload File')</a>
                                            {{-- @endcan --}}
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead align="center">
                                                    <tr>
                                                        <th>{{ 'Nro' }}</th>
                                                        <th colspan="2">@lang('Name')</th>
                                                        <th>@lang('Created on')</th>
                                                        <th>@lang('Actions')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($files as $key => $file)
                                                        @php
                                                            $extension = pathinfo($file->name);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                @if ($extension['extension'] == 'jpg' || $extension['extension'] == 'png' || $extension['extension'] == 'jpeg')
                                                                    <img src="{{ asset('assets/images/icons/icono_imagen.png') }}"
                                                                        alt="" width="20px">
                                                                @elseif($extension['extension'] == 'pdf')
                                                                    <img src="{{ asset('assets/images/icons/icono_pdf.jpg') }}"
                                                                        alt="" width="20px">
                                                                @elseif($extension['extension'] == 'docx')
                                                                    <img src="{{ asset('assets/images/icons/icono_word.png') }}"
                                                                        alt="" width="20px">
                                                                @elseif($extension['extension'] == 'pptx')
                                                                    <img src="{{ asset('assets/images/icons/icono_pp.png') }}"
                                                                        alt="" width="20px">
                                                                @elseif($extension['extension'] == 'xlsx')
                                                                    <img src="{{ asset('assets/images/icons/icono_xls.png') }}"
                                                                        alt="" width="20px">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#visor_imagen"
                                                                    data-bs-record-title="{{ $file->name }}"
                                                                    data-bs-record-extension="{{ $extension['extension'] }}"
                                                                    data-bs-record-img="{{ asset('storage/' . $file->name) }}"
                                                                    style="color: black">
                                                                    {{ $file->name }}
                                                                </a>
                                                            </td>
                                                            <td>{{ $file->created_at->format('j F, Y, g:i A') }}</td>
                                                            <td>
                                                                {{-- @can('files.destroy') --}}
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#confirm-delete"
                                                                    data-bs-record-id="{{ $file->id }}"
                                                                    data-bs-record-title="{{ 'el archivo ' }}{{ $file->name }}"
                                                                    data-bs-action="{{ route('files.destroy', $file) }}"
                                                                    title="{{ __('Delete File') }}"><i
                                                                        class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
                                                                {{-- @endcan --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="settings-b2">
                                        <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                            ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
                                            parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,
                                            pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                                            dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                            elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                            porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                    </div>
                                </div>
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('modales.eliminar')
    @include('modales.visor_img')
    @include('modales.upload')
@endsection
@section('script')
    @include('admin.users.patient.folders.js')
    <script>
        $("#birth").datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>
@endsection
