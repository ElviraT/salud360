<div class="modal fade" id="bank_details" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="id" name="id" value="" class="modal_registro_bank_id" />
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Name') <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="@lang('Enter Name')">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Titular') <span class="text-danger">*</span></label>
                                <input type="text" name="titular" id="titular" class="form-control"
                                    placeholder="@lang('Enter Titular')">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Código') <span class="text-danger">*</span></label>
                                <input type="text" name="codigo" id="codigo" class="form-control"
                                    placeholder="@lang('Enter codigo')">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Account') <span class="text-danger">*</span></label>
                                <input type="text" name="Account" id="Account" class="form-control"
                                    placeholder="@lang('Enter Account')">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label for="currency">{{ __('Currency') }}:</label>
                            <select name="currency_id" id="currency_id" class="select2 form-control"
                                data-toggle="select2">
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Initial Balance') <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                    placeholder="@lang('Enter Initial Balance')">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="input-block mb-0">
                                <label>{{ __('Extra information') }}</label>
                                <textarea name="extra" id="extra" rows="3" class="form-control"></textarea>
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
