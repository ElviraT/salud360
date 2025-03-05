<script src="{{ asset('assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

<!-- Wizard Form Demo js -->
<script src="{{ asset('assets/js/pages/demo.form-wizard.js') }}"></script>
<script>
    $(function() {
        "use strict";
        $("#basicwizard").bootstrapWizard(),
            $("#progressbarwizard").bootstrapWizard({
                onTabShow: function(t, r, a) {
                    a = ((a + 1) / r.find("li").length) * 100;
                    $("#progressbarwizard")
                        .find(".bar")
                        .css({
                            width: a + "%"
                        });
                },
            }),
            $("#btnwizard").bootstrapWizard({
                nextSelector: ".button-next",
                previousSelector: ".button-previous",
                firstSelector: ".button-first",
                lastSelector: ".button-last",
            }),
            $("#rootwizard").bootstrapWizard({
                onNext: function(t, r, a) {
                    t = $($(t).data("targetForm"));
                    if (t && (t.addClass("was-validated"), !1 === t[0].checkValidity()))
                        return event.preventDefault(), event.stopPropagation(), !1;
                },
            });
    });

    function verificar(tab) {
        let valido = true;
        if (tab === 2) { // Validar tab1 antes de pasar a tab2
            if ($('#name').val() === '') {
                toastr.warning('El nombre es requerido');
                valido = false;
            }
            if ($('#email').val() === '') {
                toastr.warning('El email es requerido');
                valido = false;
            }
            // if ($('#password').val() === '') {
            //     toastr.warning('El contraseña es requerido');
            //     valido = false;
            // }
            // if ($('#password-confirm').val() === '') {
            //     toastr.warning('El confirmar contraseña es requerido');
            //     valido = false;
            // }
        }
        if (tab === 3) { // Validar tab2 antes de pasar a tab3
            if (document.getElementById('marital_id').value === '') {
                toastr.warning('El estado civil es requerido');
                valido = false;
            }
            if (document.getElementById('sexes_id').value === '') {
                toastr.warning('El sexo es requerido');
                valido = false;
            }
            if (document.getElementById('Date_of_birth').value === '') {
                toastr.warning('La fecha de nacimiento es requerida');
                valido = false;
            }
            if (document.getElementById('dni').value === '') {
                toastr.warning('El DNI es requerido');
                valido = false;
            }
            if (document.getElementById('phone').value === '') {
                toastr.warning('El teléfono es requerido');
                valido = false;
            }
            if (document.getElementById('address').value === '') {
                toastr.warning('La dirección es requerida');
                valido = false;
            }
        }
        if (tab === 4) {
            if (document.getElementById('namec').value === '') {
                toastr.warning('El nombre del contacto es requerido');
                valido = false;
            }
            if (document.getElementById('emailc').value === '') {
                toastr.warning('El email del contacto es requerido');
                valido = false;
            }
            if (document.getElementById('phonec').value === '') {
                toastr.warning('El teléfono del contacto es requerido');
                valido = false;
            }
            if (document.getElementById('addressc').value === '') {
                toastr.warning('La dirección del contacto es requerido');
                valido = false;
            }
        }
        if (tab === 5) {
            if (document.getElementById('blood_group').value === '') {
                toastr.warning('El el grupo sanguineo es requerido');
                valido = false;
            }
        }
        if (tab === 6) {
            valido = true
        }
        if (valido) {
            console.log('#tab_' + tab)
            // Ocultar tab actual y mostrar siguiente
            $('#tab_' + tab).removeAttr("disabled");
            $('#div_' + tab).removeAttr("hidden");
        }
    }

    $(document).on('show.bs.modal', '#modal_patient', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#marital_id, #sexes_id, created_by").select2({
            dropdownParent: "#modal_patient"
        });
        $("#Date_of_birth").datepicker({
            format: 'yyyy-mm-dd',
            dropdownParent: "#modal_patient"

        });
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Patient')");
            modal.addClass('loading');
            $('.modal_registro_medical_id', modal).val(data.bsRecordId);
            $.getJSON('../patients/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                console.log(obj);
                $('#name').val(obj[1].name); //.trigger('change.select2');
                $('#email').val(obj[1].email);

                $('#marital_id').val(obj[0].marital_id).trigger('change.select2');
                $('#sexes_id').val(obj[0].sexes_id).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#Date_of_birth', modal).val(obj[0].Date_of_birth);
                $('#dni', modal).val(obj[0].dni);
                $('#ocupation', modal).val(obj[0].ocupation);
                $('#phone', modal).val(obj[0].phone);
                $('#address', modal).val(obj[0].address);

                $('#namec', modal).val(obj[2].name);
                $('#emailc', modal).val(obj[2].email);
                $('#phonec', modal).val(obj[2].phone);
                $('#addressc', modal).val(obj[2].address);

                $('#blood_group', modal).val(obj[3].blood_group);
                $('#medical_condition', modal).val(obj[3].medical_condition);
                $('#medication', modal).val(obj[3].medication);
                $('#allergies', modal).val(obj[3].allergies);
                if (obj[4].data_collection === 0) {
                    $('#data_collection', modal).attr('checked', false);
                }
                if (obj[4].telemedicine === 0) {
                    $('#telemedicine', modal).attr('checked', false);
                }


                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Patient')");
        }
    });

    // MODAL FAMILY
    $(document).on('show.bs.modal', '#modal_family', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#relationship_id, #sexes_id").select2({
            dropdownParent: "#modal_family"
        });
        $("#Date_of_birth").datepicker({
            format: 'yyyy-mm-dd',
            dropdownParent: "#modal_family"

        });
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Patient Family')");
            modal.addClass('loading');
            $('.modal_registro_medical_id', modal).val(data.bsRecordId);
            $.getJSON('../patients/family/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#sexes_id').val(obj.sexes_id).trigger('change.select2');
                $('#relationship_id').val(obj.relationship_id).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#dni', modal).val(obj.dni);
                $('#phone_number', modal).val(obj.phone_number);
                $('#email', modal).val(obj.email);
                $('#Date_of_birth', modal).val(obj.Date_of_birth);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Patient Family')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_family', function(e) {
        $('#sexes_id').val('').trigger('change.select2');
        $('#relationship_id').val('').trigger('change.select2');
        $("#method").val('post');
        $('#name').val('');
        $('#dni').val('');
        $('#phone_number').val('');
        $('#email').val('');
        $('#Date_of_birth').val('');
    });

    // MODAL HISTORY
    $(document).on('show.bs.modal', '#modal_history', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#type_id").select2({
            dropdownParent: "#modal_history"
        });
        $("#diagnosis_date").datepicker({
            format: 'yyyy-mm-dd',
            dropdownParent: "#modal_history"
        });
        $('#patient_type', modal).val(data.bsRecordIdtype);
        $('#patient_id', modal).val(data.bsRecordId);
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Patient History')");
            modal.addClass('loading');
            $('.modal_registro_medical_id', modal).val(data.bsRecordId);
            $.getJSON('../patients/history/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#type_id').val(obj.type_id).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#description', modal).val(obj.description);
                $('#diagnosis_date', modal).val(obj.diagnosis_date);
                $('#related_medications', modal).val(obj.related_medications);
                $('#related_allergies', modal).val(obj.related_allergies);
                $('#notes', modal).val(obj.notes);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Patient History')");
        }
    });
</script>
