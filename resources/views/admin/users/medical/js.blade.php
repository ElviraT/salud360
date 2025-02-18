<script>
    $(document).on('show.bs.modal', '#add_medical', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Medical')");
            modal.addClass('loading');
            $('.modal_registro_medical_id', modal).val(data.bsRecordId);
            $.getJSON('../medicals/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#id_user').val(obj.id_user).trigger('change.select2');
                $('#id_status').val(obj.id_status).trigger('change.select2');
                $('#id_speciality').val(obj.id_speciality).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#register', modal).val(obj.register);
                $('#ncolegio', modal).val(obj.ncolegio);

                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Medical')");
        }
    });
    $(document).on('hidden.bs.modal', '#add_medical', function(e) {
        $('#id_user').val('').trigger('change.select2');
        $('#id_status').val('').trigger('change.select2');
        $('#id_speciality').val('').trigger('change.select2');
        $("#method").val('post');
        $('#register').val('');
        $('#ncolegio').val('');
    });

    // MODAL DE HORARIO
    $(document).on('show.bs.modal', '#add_schedule', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Schedule')");
            modal.addClass('loading');
            $('.modal_registro_schedule_id', modal).val(data.bsRecordId);
            $.getJSON('../schedules/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#id_day').val(obj.id_day).trigger('change.select2');
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
    $(document).on('hidden.bs.modal', '#add_schedule', function(e) {
        $('#id_day').val('').trigger('change.select2');
        $("#method").val('post');
        $('#start_hour').val('');
        $('#end_hour').val('');
    });
</script>
