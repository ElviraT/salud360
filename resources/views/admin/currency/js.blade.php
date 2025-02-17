<script>
    $(document).on('show.bs.modal', '#modal_currency', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Currency')");
            modal.addClass('loading');
            $('.modal_registro_currency_id', modal).val(data.bsRecordId);
            $.getJSON('currencies/' + data.bsRecordId + '/edit', function(data) {
                var obj = data[0];
                console.log(obj);
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#simbol', modal).val(obj.simbol);
                if (obj.is_principal == 1) {
                    $('#is_principal', modal).attr('checked', true);
                }
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Currency')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_currency', function(e) {
        $('#name').val('');
        $('#simbol').val('');
        $('#is_principal').attr('checked', false);
        $("#method").val('post');
    });
</script>
