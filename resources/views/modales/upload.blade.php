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
                    <div class="fallback">
                        <input name="file" type="file" multiple class="form-control" />
                    </div>

                    {{-- <div class="dz-message needsclick">
                        <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                        <h3>Drop files here or click to upload.</h3>
                        <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                            <strong>not</strong> actually uploaded.)</span>
                    </div> --}}
                    <button type="submit">enviar</button>
                </form>
                <!-- Preview -->
                {{-- <div class="dropzone-previews mt-3" id="file-previews"></div> --}}

                <!-- file preview template -->
                {{-- <div class="d-none" id="uploadPreviewTemplate">
                    <div class="card mt-1 mb-0 shadow-none border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light"
                                        alt="">
                                </div>
                                <div class="col ps-0">
                                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                    <p class="mb-0" data-dz-size></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                        <i class="ri-close-line"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>
    </div>
