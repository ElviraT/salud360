<script>
    $(document).on('show.bs.modal', '#service_details', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#clinic_id").select2({
            dropdownParent: "#service_details"
        });
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Service')");
            modal.addClass('loading');
            $('.modal_registro_service_id', modal).val(data.bsRecordId);
            $.getJSON('services/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                // Supongamos que recibes los datos JSON en la variable 'data'
                const durationMinutes = obj.duration;
                const hours = Math.floor(durationMinutes / 60);
                const minutes = durationMinutes % 60;

                // Ahora puedes establecer los valores en tus campos de entrada
                document.getElementById('duration_hours').value = hours;
                document.getElementById('duration_minutes').value = minutes;

                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#clinic_id', modal).val(obj.clinic_id).trigger('change');
                $('#price', modal).val(obj.price);
                $('#description', modal).val(obj.description);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Service')");
        }
    });
    $(document).on('hidden.bs.modal', '#service_details', function(e) {
        $('#name').val('');
    });
</script>
