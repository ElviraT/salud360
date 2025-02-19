<script>
    $(document).on('show.bs.modal', '#modal_medical', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#clinic_id, #user_id, #speciality_id, #created_by").select2({
            dropdownParent: "#modal_medical"
        });
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Medical')");
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
            $('.title').text("@lang('Add Medical')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_medical', function(e) {
        $('#user_id').val('').trigger('change.select2');
        $('#clinic_id').val('').trigger('change.select2');
        $('#speciality_id').val('').trigger('change.select2');
        $("#method").val('post');
        $('#name').val('');
        $('#professional_license').val('');
        $('#bio').val('');
    });
    // SHOW MEDICAL
    $(document).on('show.bs.modal', '#modal_show', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        $('#blah').attr("src", "{{ asset('assets/images/avatar.png') }}");
        if (data.bsRecordId != undefined) {
            $.getJSON('../medicals/' + data.bsRecordId + '/show', function(data) {
                console.log(data);
                var url = "{{ asset(Storage::url(':img')) }}";
                var avatar = url.replace(':img', data.user.avatar);
                // Datos personales del doctor
                $('#name1').html(data.name);
                $('#speciality').html(data.speciality.name);
                $('#license').html(data.professional_license);
                $('#biog').html(data.bio);
                if (data.user.avatar != null) {
                    $('#blah').attr("src", avatar);
                }
                // ... otros datos ...

                // Datos de los horarios del doctor
                console.log(data.schedules);
                let schedulesHtml = '';
                if (data.schedules.length > 0) {
                    schedulesHtml += '<ul>';
                    $.each(data.schedules, function(index, schedule) {
                        schedulesHtml += '<li>' + schedule.day.name + ': ' + schedule
                            .start_hour + ' - ' + schedule.end_hour + '</li>';
                    });
                    schedulesHtml += '</ul>';
                } else {
                    schedulesHtml = '<p>No hay horarios disponibles.</p>';
                }
                $('#doctor-schedules').html(
                    schedulesHtml
                ); // Asumiendo que tienes un elemento con el id "doctor-schedules" en tu modal
            });
        }
    });

    // MODAL DE HORARIO
    $(document).on('show.bs.modal', '#modal_schedule', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#day_id").select2({
            dropdownParent: "#modal_schedule"
        });
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Schedule')");
            modal.addClass('loading');
            $('.modal_registro_schedule_id', modal).val(data.bsRecordId);
            $.getJSON('../schedules/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#day_id').val(obj.day_id).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#start_hour', modal).val(obj.start_hour);
                $('#end_hour', modal).val(obj.end_hour);

                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Schedule')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_schedule', function(e) {
        $('#day_id').val('').trigger('change.select2');
        $("#method").val('post');
        $('#start_hour').val('');
        $('#end_hour').val('');
    });

    $(document).ready(function() {
        "use strict";
        $('#user_id').on('change', function() {
            var textoSeleccionado = $('#user_id option:selected').text();
            $('#name').val(textoSeleccionado.trimStart());

        });
    });
</script>
