<div id="add_event" class="modal custom-modal modal-lg fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form-enviar" method="post">
                    <input type="hidden" id="method" name="_method" value="" />
                    @csrf
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_event_id" />
                    <div class="row">
                        <input type="hidden" name="id_teacher" id="id_teacher">
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Matter')</label>
                                <select class="form-control form-small select" name="id_matter" id="id_matter">
                                    <option>@lang('Select Matter')</option>
                                    @foreach ($matters as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control" type="hidden" name="title" id="title">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Group')</label>
                                <select class="form-control form-small select" name="id_group" id="id_group" disabled>
                                    <option>@lang('Select Group')</option>
                                    @foreach ($groups as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Day')</label>
                                <select class="form-control form-small select" name="id_day" id="id_day" disabled>
                                    <option>@lang('Select days')</option>
                                    @foreach ($days as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <span id="horas" style="color: rgb(230, 133, 6)"></span>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Start Time')</label>
                                <input class="form-control" type="time" name="startime" id="startime" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('End Time')</label>
                                <input class="form-control" type="time" name="endtime" id="endtime" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Colors')</label>
                                <input type="color" id="color" name="color" list="coloresPrimarios"
                                    class="form-control">
                                <datalist id="coloresPrimarios">
                                    @foreach ($colores as $value)
                                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="col-12">
                            <span id="mensaje" style="color: darkred" hidden></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label>@lang('Start Recur')</label>
                                <div class="cal-icon cal-icon-info">
                                    <input type="text" name="startRecur" id="startRecur"
                                        class="datetimepicker form-control" placeholder="Select Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="input-block mb-3">
                                <label>@lang('End Recur')</label>
                                <div class="cal-icon cal-icon-info">
                                    <input type="text" name="endRecur" id="endRecur"
                                        class="datetimepicker form-control" placeholder="Select Date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary paid-continue-btn me-2">@lang('Submit')</button>
                        <button type="button" class="btn btn-danger cancel-btn" id="btnEliminar"
                            data-bs-dismiss="modal" hidden>@lang('Delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
