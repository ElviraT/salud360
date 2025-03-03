<div class="modal fade" id="speciality_detail" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="#" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_speciality_id" />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-block mb-0">
                                <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control mt-1"
                                    placeholder="{{ __('Enter Name') }}">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3 mb-3">
                            <div id="fields-container">
                            </div>
                        </div>
                        <button type="button" class="btn btn-info" id="add-field">Agregar Campo</button>
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
