<script>
    $(document).on('show.bs.modal', '#confirm-delete', function(e) {
        var data = $(e.relatedTarget).data();
        $("#form-eliminar").attr('action', data.bsAction);
        $('#id').val(data.bsRecordId);
        $('.title', this).text(data.bsRecordTitle);
        $('.btn-ok', this).data('recordId', data.bsRecordId);
    });

    $(document).ready(function() {
        // Obtener el elemento seleccionado
        var elementoSeleccionado = $('.menu li.side-nav-item'); // Reemplaza '.menu li.active' con tu selector

        // Obtener la posición del elemento seleccionado
        var posicionElemento = elementoSeleccionado.offset().top;

        // Obtener la posición del contenedor del menú
        var posicionContenedor = $('.menu').offset().top; // Reemplaza '.menu' con tu selector

        // Calcular el desplazamiento necesario
        var desplazamiento = posicionElemento - posicionContenedor;

        // Desplazar el scroll del menú (con animación)
        $('.menu').animate({
            scrollTop: desplazamiento
        }, 500); // 500 es la duración de la animación en milisegundos
    });
    // FUNCIONES LOADING
    $(document).on('ajaxStart', function() {
        loading_show();
    })

    $(document).on('ajaxStop', function(start) {
        loading_hide();
    });

    function loading_show() {
        $('body').loadingModal({
            text: 'Por favor espere...',
            animation: 'circle',
        });
        $('body').loadingModal('show');
    }

    function loading_hide() {
        $('body').loadingModal('hide');
    }

    // FIN FUNCIONES LOADING
</script>
