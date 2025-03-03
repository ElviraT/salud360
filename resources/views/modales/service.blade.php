<div class="modal custom-modal modal-lg fade" id="service_details" role="dialog">
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
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_service_id" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-groups-item">
                                    <div class="row">
                                        @if (Auth::user()->hasRole('SuperAdmin'))
                                            <div class="col-lg-4 col-md-6 mb-2">
                                                <div class="input-block ">
                                                    <label>@lang('Clinic')</label>
                                                    <select class="select2 form-control" data-toggle="select2"
                                                        name="clinic_id" id="clinic_id">
                                                        <option>Select</option>
                                                        @foreach ($clinics as $st)
                                                            <option value="{{ $st->id }}">
                                                                {{ $st->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="clinic_id" id="clinic_id"
                                                value="{{ $clinics->id }}">
                                        @endif

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Name')</label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Description')</label>
                                                <input type="text" name="description" id="description"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Price')</label>
                                                <input type="number" step="0.01" name="price" id="price"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-8">
                                            <div class="input-block mb-3">
                                                <label>@lang('Duration')</label>
                                                <div class="input-group">
                                                    <label class="me-2" for="duration_hours">Horas:</label>
                                                    <input type="number" name="duration_hours" id="duration_hours"
                                                        min="0" class="me-2 form-control" value="0">

                                                    <label class="me-2" for="duration_minutes">Minutos:</label>
                                                    <input type="number" name="duration_minutes" id="duration_minutes"
                                                        min="0" max="59" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
