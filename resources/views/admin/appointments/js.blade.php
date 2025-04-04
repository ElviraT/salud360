<script>
    // MODAL APPOINTMENTS
    $(document).on('show.bs.modal', '#detail_appointment', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        // $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        $("#patient_id, #medical_id, #type, #appointment_statuses_id, #time, #hour, #currency, #payment_method, #payment_status")
            .select2({
                dropdownParent: "#detail_appointment"
            });
        modal.removeClass('loading');
        // if (data.bsRecordId != undefined) {}
    });

    $(document).ready(function() {
        // consultar horarios del doctor
        $('#medical_id').on('change', function() {
            let doctorId = $(this).val();
            $('#type').val('');
            $('#date').attr('disabled', true);
            $.ajax({
                url: '/doctor-modality/' + doctorId, // URL con el ID del doctor
                type: 'GET', // Método GET
                success: function(response) {
                    fillSelect('#type', response.modalities);
                }
            });
        });

        function fillSelect(selectId, options) {
            $(selectId).empty();
            $(selectId).append('<option value="">' + 'Seleccione' + '</option>');
            $.each(options, function(index, value) {
                $('#type').attr('disabled', false);
                $(selectId).append('<option value="' + value + '">' + value + '</option>');
            });
        }

        $('#type').on('change', function() {
            let modality = $(this).val();
            var doctorId = $('#medical_id').val();
            $.ajax({
                url: '/doctor-schedules/' + modality + '/' + doctorId, // URL con el ID del typo
                type: 'GET', // Método GET
                success: function(response) {
                    $('#time').attr('disabled', false);
                    $('#date').attr('disabled', false);
                    $('#amount').val(response.montoConsulta);
                    fillSelect('#time', response.times);

                    let availableDays = response
                        .days; // Asume que 'days' es un array [1, 2, 3]

                    // Ajustar el domingo (7) a 0 si está presente, de lo contrario, mantener los días como están
                    let availableDayNumbers = availableDays.map(function(dayNumber) {
                        if (dayNumber === 7) {
                            return 0; // Domingo (7) se convierte a 0
                        } else {
                            return dayNumber; // Mantener los demás días sin cambios
                        }
                    });

                    // Obtener los días no disponibles
                    let disabledDays = [0, 1, 2, 3, 4, 5, 6].filter(dayNumber => !
                        availableDayNumbers.includes(dayNumber));
                    $('#date').attr('disabled', false);
                    $('#date').datepicker({
                        daysOfWeekDisabled: disabledDays,
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        startDate: new Date()
                    });
                }

            });
        });
        $('#time, #date').on('change', function() {
            $('#hour').attr('disabled', false);
            fillSelect('#hour', getAvailableHours($('#time').val()));
        });
        // Función para generar las horas disponibles dentro de un rango

        function getAvailableHours(timeRange) {
            let availableHours = [];
            let [startTime, endTime] = timeRange.split(' - ');
            let startHour = parseInt(startTime.split(':')[0]);
            let endHour = parseInt(endTime.split(':')[0]);

            for (let hour = startHour; hour <= endHour; hour++) {
                availableHours.push(`${hour.toString().padStart(2, '0')}:00`);
            }

            return availableHours;
        }
    });

    // Habilitar todos los campos antes del envío del formulario
    $(document).on('submit', '#detail_appointment form', function(e) {
        // Habilitar todos los campos disabled
        $('#time, #hour, #date').prop('disabled', false);

        // Validar que los campos requeridos tengan valor
        if (!$('#time').val()) {
            alert('Por favor seleccione un horario');
            return false;
        }
        if (!$('#date').val()) {
            alert('Por favor seleccione una fecha');
            return false;
        }
        if (!$('#hour').val()) {
            alert('Por favor seleccione una hora');
            return false;
        }

        return true; // Continuar con el envío
    });
</script>
