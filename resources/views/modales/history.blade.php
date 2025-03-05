<div class="modal fade" id="modal_history" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                        class="modal_registro_history_id" />
                    <input type="hidden" id="patient_type" name="patient_type" value="" />
                    <input type="hidden" id="patient_id" name="patient_id" value="" />
                    <div class="row">
                        <div class="form-group mb-3">
                            <label for="type_id">Tipo de Antecedente:</label>
                            <select name="type_id" id="type_id" class="select2 form-control" data-toggle="select2">
                                @foreach ($tiposAntecedentes as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Descripción:</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="diagnosis_date">Fecha de Diagnóstico:</label>
                            <div class="input-group">
                                <input type="text" name="diagnosis_date" id="diagnosis_date"
                                    class="form-control date" data-toggle="date-picker" data-date-autoclose="true"
                                    data-single-date-picker="true">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="related_medications">Medicamentos Relacionados:</label>
                            <input type="text" name="related_medications" id="related_medications"
                                class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="related_allergies">Alergias Relacionadas:</label>
                            <input type="text" name="related_allergies" id="related_allergies" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes">Notas:</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>
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
