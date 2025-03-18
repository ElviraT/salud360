<script>
    $(document).on('show.bs.modal', '#modal_user', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        $('#blah').attr("src", "{{ asset('assets/images/avatar.png') }}");
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#role_id, #created_by").select2({
            dropdownParent: "#modal_user"
        });
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit User')");
            $('.modal_registro_user_id', modal).val(data.bsRecordId);
            $.getJSON('../users/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                var url = "{{ asset(Storage::url(':img')) }}";
                var avatar = url.replace(':img', obj.avatar);
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#email', modal).val(obj.email);
                $('#role_id', modal).val(obj.role_id).trigger('change');
                $('#created_by').val(obj.created_by).trigger('change');
                if (obj.avatar != null) {
                    $('#blah').attr("src", avatar);
                }
            });
        } else {
            $('.title').text("@lang('Add User')");
        }
    });
    $(document).on('hidden.bs.modal', '#modal_user', function(e) {
        $('#name').val('');
        $("#method").val('post');
        $('#email').val('');
        $('#blah').attr("src", "{{ asset('assets/images/avatar.png') }}");
    });
</script>
