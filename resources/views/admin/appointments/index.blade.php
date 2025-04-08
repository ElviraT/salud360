@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Appointments') }}</h2>
                <div class="col-12" align="right">
                    @can('appointments.store')
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                            data-bs-action="{{ route('appointments.store') }}" data-bs-target="#detail_appointment"><i
                                class="uil-plus-circle"></i>&nbsp;{{ __('Add Appointment') }}</a>
                    @endcan

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Patient') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Time') }}</th>
                                        <th>{{ __('Doctor') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Invoice') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Payment Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>
                                                {{ $appointment->patient_name }}

                                                @if ($appointment->patient_family_id != '')
                                                    <span class="badge bg-info">Familiar</span>
                                                @else
                                                    <span class="badge bg-primary">Principal</span>
                                                @endif
                                            </td>
                                            <td>{{ $appointment->date->format('d/m/Y') }}</td>
                                            <td>{{ $appointment->time }}</td>
                                            <td>
                                                {{ $appointment->doctor_name ?? '<span class="text-muted">N/A</span>' }}
                                            </td>
                                            <td>{{ ucfirst($appointment->type) }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $appointment->appointmentStatus->color ?? 'primary' }}">
                                                    {{ $appointment->status_name }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($appointment->invoice_number)
                                                    {{ $appointment->invoice_number }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($appointment->currency_symbol)
                                                    {{ $appointment->currency_symbol ?? '$' }}{{ number_format($appointment->subtotal, 2) }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($appointment->payment_status)
                                                    <span
                                                        class="badge bg-{{ $appointment->invoice->paymentStatus->color ?? 'primary' }}">
                                                        {{ $appointment->payment_status }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('appointments.edit')
                                                    <a href="#" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#detail_appointment" class="btn btn-success me-2"
                                                        data-bs-record-id="{{ $appointment->id }}"
                                                        data-bs-action="{{ route('appointments.update', $appointment) }}">
                                                        <i class="uil-edit-alt"></i>&nbsp;
                                                        {{ __('Edit Appointment') }}
                                                    </a>
                                                @endcan

                                                @can('appointments.destroy')
                                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"
                                                        data-bs-record-id="{{ $appointment->id }}"
                                                        data-bs-record-title="{{ ' la cita ' }}"
                                                        data-bs-action="{{ route('appointments.destroy', $appointment) }}"
                                                        title="{{ __('Delete Appointment') }}"><i
                                                            class="uil-trash-alt me-2"></i>@lang('Delete')</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('modales.eliminar')
    @include('modales.appointment')
@endsection
@section('script')
    @include('admin.appointments.js')
@endsection
