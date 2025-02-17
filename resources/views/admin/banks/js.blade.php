<!-- <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script> -->
<script>
    $(document).on('show.bs.modal', '#bank_details', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#currency_id").select2({
            dropdownParent: "#bank_details"
        });
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Bank')");
            $('.modal_registro_bank_id', modal).val(data.bsRecordId);
            $.getJSON('./banks/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                console.log(obj);
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#Account', modal).val(obj.Account);
                $('#codigo', modal).val(obj.codigo);
                $('#extra', modal).val(obj.extra);
                $('#titular', modal).val(obj.titular);
                $('#amount', modal).val(obj.amount);
                $('#currency_id', modal).val(obj.currency_id).trigger('change');

            });
        } else {
            $('.title').text("@lang('Add Bank')");
        }
    });

    $(document).on('hidden.bs.modal', '#bank_details', function(e) {
        $("#method").val('post');
        $('#name').val('');
        $('#account').val('');
        $('#titular').val('');
        $('#monto').val('');
    });
</script>
