<div class="modal fade" id="modal_show" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title">{{ __('General Information') }}</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body p-3">
                <div class="row">
                    <div class="col-12">
                        <div class="row p-2">
                            <h5>{{ 'Información Personal' }}</h5>
                            <hr>
                            <div class="col-12">
                                <div class="profile-picture row mb-3">
                                    <div class="upload-profile col-3">
                                        <div class="profile-img">
                                            <img id="blah" class="avatar" src alt="profile-img" width="90%">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="col-6 mb-3"><strong>{{ __('Name') }}:</strong>&nbsp;<span
                                                id="name1"></span>
                                        </div>
                                        <div class="col-6 mb-3"><strong>{{ __('Speciality') }}:</strong>&nbsp;<span
                                                id="speciality"></span>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <strong>{{ __('Professional License') }}:</strong>&nbsp;<span
                                                id="license"></span>
                                        </div>
                                        <div class="col-12 mb-3"><strong>{{ __('Biographic') }}:</strong>&nbsp;<span
                                                id="biog"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <h5>{{ 'Disponibilidad de Horario' }}</h5>
                        <hr>
                        <div id="doctor-schedules"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
