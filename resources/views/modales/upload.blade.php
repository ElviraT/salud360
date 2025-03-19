<div class="modal fade" id="folder_file" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">@lang('Upload File')</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body">

                <form action="{{ route('files.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->id }}" />
                    <div class="col-12 p-2">
                        <label for="file">{{ 'Seleccione el archivo' }}</label>
                        <input name="file" type="file" multiple class="form-control" />
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
