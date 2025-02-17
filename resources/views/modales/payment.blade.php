<div class="modal fade" id="payment_details" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('payment.store') }}" id="form-enviar" method="post">

                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_payment_id" />
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>{{ __('User') }}</label>
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="text" value="{{ auth()->user()->name }}" class="form-control" readonly>
                                {{-- <select class="form-control form-small select" name="id_representative"
                                    id="id_representative">
                                    <option>Select Representative</option>
                                    @foreach ($representatives as $st)
                                        <option value="{{ $st->id }}">{{ $st->name }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Plans')</label>
                                <select class="form-select" name="plan_id" id="plan_id">
                                    <option>Select plan</option>
                                    @foreach ($plans as $st)
                                        <option value="{{ $st->id }}">{{ $st->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Monto')</label>
                                <input type="number" step="0.01" name="monto" id="monto" class="form-control"
                                    placeholder="@lang('Enter Monto')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Banks')</label>
                                <select class="form-select" name="bank_id" id="bank_id">
                                    <option>Select bank</option>
                                    @foreach ($banks as $st)
                                        <option value="{{ $st->id }}">
                                            {{ $st->name }}&nbsp;-&nbsp;{{ $st->currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label>@lang('Currency')</label>
                            <input type="text" name="currency" id="currency" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Reference')</label>
                                <input type="text" name="reference" id="reference" class="form-control"
                                    placeholder="@lang('Enter Reference')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-3">
                                <label>@lang('Payment Date')</label>
                                <div class="input-group">
                                    <input type="text" name="payment_date" id="payment_date"
                                        class="form-control date" data-toggle="date-picker"
                                        data-single-date-picker="true">
                                    <span class="input-group-text bg-primary border-primary text-white">
                                        <i class="mdi mdi-calendar-range font-13"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Method Payment')</label>
                                <select class="form-select form-small select" name="id_method" id="id_method">
                                    <option>Select method</option>
                                    @foreach ($methods as $method)
                                        <option value="{{ $method->id }}">{{ $method->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Description')</label>
                                <input type="text" name="description" id="description" class="form-control"
                                    placeholder="@lang('Enter Description')">
                            </div>
                        </div>
                        @can('payments.change')
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <div class="input-block mb-0">
                                    <label>@lang('Status')</label>
                                    <select class="form-control form-small select" name="id_status" id="status">
                                        <option>Select status</option>
                                        @foreach ($status as $st)
                                            <option value="{{ $st->id }}">{{ $st->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endcan
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
