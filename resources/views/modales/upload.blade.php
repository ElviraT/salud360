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
                <form action="{{ route('files.upload') }}" id="upload_id" class="dropzone" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id_file" name="id" value="{{ $folders->id }}" />
                    <input type="hidden" id="folder" name="folder" value="{{ $folders->name }}" />

                    <div class="fallback">
                        <input type="file" name="file" multiple required>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
