<script>
    $(document).on('show.bs.modal', '#modal_plan', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#beneficios").select2({
            dropdownParent: "#modal_plan"
        });
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Plan')");
            modal.addClass('loading');
            $('.modal_registro_plan_id', modal).val(data.bsRecordId);
            $.getJSON('plans/' + data.bsRecordId + '/edit', function(data) {
                var obj = data[0];
                console.log(obj);
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#price', modal).val(obj.price);
                $('#description', modal).val(obj.description);
                $('#duration', modal).val(obj.duration);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Plan')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_plan', function(e) {
        $('#name').val('');
    });
</script>
