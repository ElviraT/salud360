<div class="modal custom-modal fade" id="visor_imagen" tabindex='-1' role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="#" alt="imagen-ticket" id="img" hidden>
                        <div class="table-responsive" id="iframe-container" hidden>
                        </div>
                        <div id="descargar" hidden>
                            <img src="{{ asset('assets/img/icons/descarga.png') }}" alt="imagen-ticket"
                                id="img_descarga" hidden>
                            <hr>
                            <a href="#" id="btn-descargar" class="btn btn-success">@lang('Download')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
