<div class="modal fade" id="change_status" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('payments.change') }}" id="form-enviar" method="post">

                {{-- <input type="hidden" id="method" name="_method" value="" /> --}}
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_status" name="id" value=""
                        class="modal_registro_change_id" />
                    <div class="row">
                        @can('payments.change')
                            <div class="col-lg-12 mb-3">
                                <div class="input-block mb-0">
                                    <select class="form-control form-small select" name="id_status" id="id_status2">
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
