<div class="modal fade" id="modal_plan" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="id" name="id" value="" class="modal_registro_plan_id" />
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="input-block mb-3">
                                <label>{{ __('Plan Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control mt-1"
                                    placeholder="{{ __('Enter Plan Name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="beneficios">Beneficios del plan:</label>
                            <select name="beneficios[]" id="beneficios" class="select2 form-control select2-multiple"
                                data-toggle="select2" multiple="multiple">
                                @foreach ($beneficios as $beneficio)
                                    <option value="{{ $beneficio->id }}">{{ $beneficio->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="input-block mb-3">
                                <label>{{ __('Price') }} <span class="text-danger">*</span></label>
                                <input type="text" name="price" id="price" class="form-control mt-1"
                                    placeholder="{{ __('Enter Price') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="input-block mb-3">
                                <label>{{ __('Duration') }} <span class="text-danger">*</span></label>
                                <input type="number" name="duration" id="duration" class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label>{{ __('Description') }} <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control mt-1" rows="3"></textarea>
                            </div>
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
