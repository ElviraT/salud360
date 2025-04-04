<div class="modal fade" id="detail_appointment" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">{{ __('Add Appointment') }}</h4>
                </div>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('appointments.store') }}" method="post">
                    @csrf
                    <div class="col-12 p-2">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-2">
                                <div class="input-block mb-3">
                                    <label>{{ __('Patient') }}</label>
                                    <select name="patient_id" id="patient_id" class="select2 form-control"
                                        data-toggle="select2">
                                        <option>{{ __('Select') }}</option>
                                        @foreach ($allPatients as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($patient) && $item['id'] == $patient->id ? 'selected' : '' }}>
                                                {{ $item['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-2">
                                <div class="input-block mb-3">
                                    <label>{{ __('Medicals') }}</label>
                                    <select name="doctor_id" id="medical_id" class="select2 form-control"
                                        data-toggle="select2">
                                        <option>{{ __('Select') }}</option>
                                        @foreach ($medicals as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <h4> {{ __('Appointment Details') }}</h4>
                            <hr>
                            <div class="col-lg-4 col-sm-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Modality')</label>
                                    <select class="form-control form-small select" name="type" id="type">
                                        <option>@lang('Select')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Schedules')</label>
                                    <select class="form-control form-small select" name="time" id="time"
                                        disabled>
                                        <option>@lang('Select')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-2">
                                <div class="input-block mb-3">
                                    <label>@lang('Date')</label>
                                    <div class="input-group">
                                        <input type="text" name="date" id="date" class="form-control date"
                                            data-toggle="date-picker" data-date-autoclose="true"
                                            data-single-date-picker="true" disabled>
                                        <span class="input-group-text bg-primary border-primary text-white">
                                            <i class="mdi mdi-calendar-range font-13"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Hours')</label>
                                    <select name="hour" id="hour" class="form-control form-small select"
                                        disabled></select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-block mb-3">
                                    <label>@lang('Status')</label>
                                    <select class="form-control form-small select" name="appointment_statuses_id"
                                        id="appointment_statuses_id">
                                        <option>@lang('Select')</option>
                                        @foreach ($appointmentstatus as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <h3>{{ __('Details Payment') }}</h3>
                        <hr>
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="col-lg-3 col-md-12 mb-3">
                                <label>{{ __('Tipo de Paciente') }}</label>
                                <select name="patient_type" class="select2 form-control" required>
                                    <option value="patient" selected>{{ __('Paciente Principal') }}</option>
                                    <option value="family">{{ __('Paciente Familiar') }}</option>
                                </select>
                            </div>

                            <div class="col-lg-3 col-md-12 mb-3">
                                <label>{{ __('Payment Status') }}</label>
                                <select name="payment_status_id" id="payment_status_id" class="select2 form-control"
                                    data-toggle="select2" required>
                                    <option>{{ __('Select') }}</option>
                                    @foreach ($paymentStatus as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3">
                                <label>{{ __('Payment Method') }}</label>
                                <select name="payment_method_id" id="payment_method_id" class="select2 form-control"
                                    data-toggle="select2" required>
                                    <option>{{ __('Select') }}</option>
                                    @foreach ($methodPay as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-3">
                                <label>{{ __('Currency') }}</label>
                                <select name="currency" id="currency" class="select2 form-control"
                                    data-toggle="select2">
                                    <option>{{ __('Select') }}</option>
                                    @foreach ($currency as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-3">
                                <label>@lang('Monto')</label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                    placeholder="@lang('Enter Monto')">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-secondary cancel-btn me-2">{{ __('Close') }}</button>
                        <button type="submit" data-bs-dismiss="modal"
                            class="btn btn-primary paid-continue-btn">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
