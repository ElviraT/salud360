<script>
    $(document).on('show.bs.modal', '#modal_role', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Role')");
            modal.addClass('loading');
            $('.modal_registro_role_id', modal).val(data.bsRecordId);
            $.getJSON('roles/' + data.bsRecordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Role')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_role', function(e) {
        $('#name').val('');
    });
</script>
