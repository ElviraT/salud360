<script>
    $(document).on('show.bs.modal', '#visor_imagen', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        if (data.bsRecordImg != undefined) {
            var modalHeight = $(this).find(".modal-content").height();
            $(this).find(".modal-dialog").height(modalHeight);
            var image = data.bsRecordImg;
            if (data.bsRecordExtension == 'jpg' || data.bsRecordExtension == 'png' || data.bsRecordExtension ==
                'jpeg') {
                $('#img').attr('hidden', false);
                $('#iframe-container').attr('hidden', true);
                $('#descargar').attr('hidden', true);
                $('#img_descarga').attr('hidden', true);
                $('#img').attr("src", image);
            } else if (data.bsRecordExtension == 'pdf') {
                $('#img').attr('hidden', true);
                $('#iframe-container').attr('hidden', false);
                $('#descargar').attr('hidden', true);
                $('#img_descarga').attr('hidden', true);
                $("#iframe-container").append('<iframe id="myIframe" src="' + image +
                    '" width="600" height="400"></iframe>');

            } else if (data.bsRecordExtension == 'docx' || data.bsRecordExtension == 'xlsx' || data
                .bsRecordExtension == 'pptx') {
                $('#img').attr('hidden', true);
                $('#iframe-container').attr('hidden', true);
                $('#descargar').attr('hidden', false);
                $('#img_descarga').attr('hidden', false);
                $('#btn-descargar').attr('href', image);

            }

            $('.title').text(data.bsRecordTitle);
        }
    });
    $(document).on('hidden.bs.modal', '#visor_imagen', function(e) {
        $('#img').attr("src", "{{ asset('assets/img/images.png') }}");
        $('#img').attr('hidden', true);
        $('#iframe-container').attr('hidden', true);
        $('#descargar').attr('hidden', true);
        $('#img_descarga').attr('hidden', true);
        $("#myIframe").remove();
    });
    $(document).ready(function() {
        "use strict";
        $("#file").DataTable({
            paging: !1,
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No hay registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "No hay registros",
                "infoFiltered": "",
                "search": "Buscar",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "emptyTable": "No hay datos disponibles en la tabla",
                "infoFiltered": "",
                "zeroRecords": "No hay registros",
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass(
                    "pagination-rounded"
                );
            },
        })
    })
</script>
