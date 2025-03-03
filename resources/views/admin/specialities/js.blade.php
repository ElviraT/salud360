<script>
    let contador = 0;
    $(document).on('show.bs.modal', '#speciality_detail', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Speciality')");
            modal.addClass('loading');
            $('.modal_registro_speciality_id', modal).val(data.bsRecordId);
            $.getJSON('specialities/' + data.bsRecordId + '/edit', function(obj) {
                console.log(obj);
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);

                const fieldsContainer = $('#fields-container', modal);
                fieldsContainer.empty();

                if (obj.fields) {
                    try {
                        const fieldsArray = JSON.parse(obj.fields);
                        fieldsArray.forEach((field, index) => {
                            const fieldDiv = $('<div>');
                            fieldDiv.html(`
                        <label>${field.name}:</label>
                        ${generarCampoInput(field, index, field)}`);
                            fieldsContainer.append(fieldDiv);
                            contador = index + 1;
                        });

                    } catch (error) {
                        console.error('Error parsing fields:', error);
                        // Manejar el error (por ejemplo, mostrar un mensaje al usuario)
                    }
                }
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Speciality')");
            contador = 0;
        }
    });

    function generarCampoInput(field, index, data) {
        let inputHtml = '';
        const fieldName = `fields[${index}][name]`;
        const fieldType = `fields[${index}][type]`;
        const fieldOption = `fields[${index}][options]`;
        const fieldRequired = `fields[${index}][required]`;
        const requiredValue = field.required ? 1 : 0; // Convertir true/false a 1/0

        console.log(field.type);
        switch (field.type) {
            case 'text':
                inputHtml = `<input type="text" name="${fieldName}" class="form-control" value="${data.name}">
                <input type="hidden" name="${fieldType}" value="${data.type}">
                <input type="hidden" name="${fieldOption}" value="${data.options}">
                <input type="hidden" name="${fieldRequired}" value="${requiredValue}">`;
                break;
            case 'number':
                inputHtml = `<input type="number" name="${fieldName}" class="form-control" value="${data.name}">
                <input type="hidden" name="${fieldName}" value="${data.name}">
                <input type="hidden" name="${fieldType}" value="${data.type}">
                <input type="hidden" name="${fieldOption}" value="${data.options}">
                <input type="hidden" name="${fieldRequired}" value="${requiredValue}">`;
                break;
            case 'select':
                let optionsHtml = '';
                if (field.options) {
                    field.options.forEach(option => {
                        optionsHtml += `<option value="${option}">${option}</option>`;
                    });
                }
                inputHtml = `<select name="${fieldName}" class="form-control">${optionsHtml}</select>
                <input type="hidden" name="${fieldName}" value="${data.name}">
                <input type="hidden" name="${fieldType}" value="${data.type}">
                <input type="hidden" name="${fieldOption}" value="${data.options}">
                <input type="hidden" name="${fieldRequired}" value="${requiredValue}">`;
                break;
            case 'date':
                inputHtml = `<input type="date" name="${fieldName}" class="form-control" value="${data.name}">
                <input type="hidden" name="${fieldType}" value="${data.type}">
                <input type="hidden" name="${fieldOption}" value="${data.options}">
                <input type="hidden" name="${fieldRequired}" value="${requiredValue}">`;
                break;
        }
        return inputHtml;
    }

    $(document).ready(function() {


        $('#add-field').click(function() {
            const fieldDiv = $('<div>');
            fieldDiv.html(`
            <strong>Campos para uso en Historia medica</strong><hr>
            <label>Nombre del Campo:</label>
            <input type="text" name="fields[${contador}][name]" class="form-control mb-3">
            <label>Tipo:</label>
            <select name="fields[${contador}][type]" class="select2 form-control mb-3">
                <option value="text">Texto</option>
                <option value="number">Número</option>
                <option value="select">Selección</option>
                <option value="date">Fecha</option>
            </select>
            <label>Opciones (separadas por comas):</label>
            <input type="text" name="fields[${contador}][options]" class="form-control mb-3">
            <label>Requerido:</label>
            <input type="checkbox" name="fields[${contador}][required]" value="1" class="form-check-input">
        `);
            $('#fields-container').append(fieldDiv);
            contador++;
        });
    });
</script>
