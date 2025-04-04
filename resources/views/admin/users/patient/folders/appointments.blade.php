<div class="col-12">
    <div class="row">
        <div class="col-12 mb-2" align="right">
            <a class="btn btn-info btn-sm" href="#" data-bs-toggle="modal" data-bs-record-id="{{ $patient->id }}"
                data-bs-target="#detail_appointment">
                <i class="uil-plus-circle"></i>&nbsp;{{ __('Add Appointment') }}
            </a>
        </div>
        <div class="table-responsive">
            <table id="file" class="table dt-responsive nowrap w-100" width="100%">
                <thead class="thead-light">
                    <tr>
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
                            <td>{{ $appointment->date->format('d/m/Y') }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>
                                {{ $appointment->doctor_name ?? '<span class="text-muted">N/A</span>' }}
                            </td>
                            <td>{{ ucfirst($appointment->type) }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->appointmentStatus->color ?? 'primary' }}">
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
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#detail_appointment"
                                            data-bs-record-id="{{ $appointment->id }}">
                                            <i class="uil-eye me-1"></i>{{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
