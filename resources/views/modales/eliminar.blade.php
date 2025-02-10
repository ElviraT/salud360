<div class="modal custom-modal fade" id="confirm-delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <form action="#" id="form-eliminar" method="post">
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-header">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <p>{{ __("You're deleting") }} <b><i class="title"></i></b>,
                            {{ __('This process is irreversible') }}</p>
                        <p>{{ __('Do you want to continue') }}</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" data-bs-dismiss="modal"
                                    class="w-100 btn btn-back cancel-btn me-2">@lang('Cancel')</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" data-bs-dismiss="modal"
                                    class="w-100 btn btn-primary paid-continue-btn">@lang('Delete')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
