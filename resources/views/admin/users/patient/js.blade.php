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

    function verificar() {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password2 = $('#password-confirm').val();

        if (name == '' || email == '' || password == '' || password2 == '') {
            // Mostrar una notificación de advertencia
            toastr.warning('¡Debe llenar todos los campos!');
        } else {
            $('#mensaje').attr("hidden", "hidden");
            $('#div_patient').removeAttr("hidden");
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
            $.getJSON('../medicals/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#user_id').val(obj.user_id).trigger('change.select2');
                $('#clinic_id').val(obj.clinic_id).trigger('change.select2');
                $('#speciality_id').val(obj.speciality_id).trigger('change.select2');
                $('#created_by').val(obj.created_by).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#professional_license', modal).val(obj.professional_license);
                $('#bio', modal).val(obj.bio);

                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Patient')");
        }
    });
</script>
