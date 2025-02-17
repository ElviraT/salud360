<script>
    $(document).ready(function() {
        $('#miTabla').DataTable({
            // ... opciones de DataTables
            drawCallback: function() {
                // Inicializa Select2 en los elementos de la tabla
                $('#combo_status').select2({
                    dropdownParent: $('#card_table') // O un contenedor fuera de la tabla
                });
            }
        });
    });
</script>
