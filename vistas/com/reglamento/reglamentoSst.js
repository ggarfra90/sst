/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoReglamentoSst");
    listarReglamentoSst();

    cargarComponentes();
    altura();
});

function listarReglamentoSst(){
    ax.setAccion("listarReglamentoSst");
    ax.consumir();
}

function exitoReglamentoSst(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarReglamentoSst':
                onResponseListarReglamentoSst(response.data);
                onResponseVacio();
                break;
            case 'cambiarEstado':
                cambiarIconoEstado();
                break;
            case 'cambiarPublicacion':
                listarReglamentoSst();
                break;
        }
    }
}

function cargarComponentes() {
    cargarSelect2();
}

function cargarSelect2() {
    $(".select2").select2({
        width: '100%'
    });
}

function nuevo() {
    var titulo = "Nuevo";
    var url = URL_BASE + "vistas/com/reglamento/reglamentoSst_form.php?winTitulo=" + titulo;
    cargarDiv("#window", url);
}

function onResponseListarReglamentoSst(data) {
    $("#dataList").empty();
    var cuerpo_total = "";
    var cuerpo = "";
    var cuerpo_acc = "";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Fecha de creación</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Código</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Versión</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Documento</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Revisión / Publicación</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Estado</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            cuerpo_acc = "<a href='#' onclick='verDetalle(" + item.id + ")'><i class='fa fa-list-alt' style='color:#DB94B8;'></i></a>&nbsp;\n";

            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.fec_creacion + "</td>"
                    + "<td style='text-align:center;'>" + item.codigo + "</td>"
                    + "<td style='text-align:center;'>" + item.version + "</td>"
                    + "<td style='text-align:center;'>" + item.doc_nombre + "</td>";

            if (item.flu_documento === "1") {
                cuerpo = cuerpo + "<td style='text-align:center;'><i id='f" + item.id
                        + "' class='ion-android-send' style='color:#E8BA2F;'></i></td>";
            } else if (item.flu_documento === "2") {
                cuerpo = cuerpo + "<td style='text-align:center;'><a onclick='cambiarPublicacion(" + item.doc_id + ", 1)'>"
                        + "<i id='f" + item.id + "' class='ion-checkmark-circled' style='color:#1ca8dd;'></i>"
                        + "</a></td>";
            } else if (item.flu_documento === "3") {
                cuerpo = cuerpo + "<td style='text-align:center;'><a onclick='abrirModal(\"" + item.doc_comentario + "\")'>"
                        + "<i id='f" + item.id + "' class='fa fa-close' style='color:#cb2a2a;'></i>"
                        + "</a></td>";

                cuerpo_acc = "<a href='#' onclick='editar(" + item.id + ")'><i class='fa fa-edit' style='color:#E8BA2F;'></i></a>&nbsp;\n";
            } else {
                cuerpo = cuerpo + "<td style='text-align:center;'><a onclick='cambiarPublicacion(" + item.doc_id + ", 0)'>"
                        + "<i id='f" + item.id + "' class='ion-android-send' style='color:#5cb85c;'></i>"
                        + "</a></td>";
            }

            if (item.estado === "1") {
                cuerpo = cuerpo + "<td style='text-align:center;'><a href='#' onclick = 'cambiarEstado("
                        + item.id + ")' ><i id='e" + item.id
                        + "' class='ion-checkmark-circled' style='color:#5cb85c;'></i></a>"
                        + "<input type='hidden' value='0' id='h" + item.id + "'/></td>";
            } else {
                cuerpo = cuerpo + "<td style='text-align:center;'><a href='#' onclick = 'cambiarEstado("
                        + item.id + ")' ><i id='e" + item.id
                        + "' class='ion-flash-off' style='color:#cb2a2a;'></i></a>"
                        + "<input type='hidden' value='1' id='h" + item.id + "'/></td>";
            }

            cuerpo = cuerpo + "<td style='text-align:center;'>"
                    + cuerpo_acc
                    + "<a href='" + item.url + "' target='_blank'><i class='fa fa-cloud-download' style='color:#1ca8dd;'></i></a>"
                    + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList").append(html);
    loaderClose();
}

function onResponseVacio() {
    $('#datatable').dataTable({
        "order": [[ 2, 'desc' ]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning\xfAn dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

function cambiarEstado(id) {
    loaderShow(null);
    var estado = document.getElementById('h' + id).value;
    ax.setAccion("cambiarEstado");
    ax.addParamTmp("id", id);
    ax.addParamTmp("estado", estado);
    ax.consumir();
}

function cambiarIconoEstado() {
    $.Notification.autoHideNotify('success', 'top-right', '&Eacute;xito', 'Estado actualizado');
    listarReglamentoSst();
}

function verDetalle(id) {
    var titulo = "Detalle%20de";
    var url = URL_BASE + "vistas/com/reglamento/reglamentoSst_form.php?winTitulo=" + titulo + "&id=" + id + "&readonly=true";
    cargarDiv("#window", url);
}

function editar(id) {
    var titulo = "Editar";
    var url = URL_BASE + "vistas/com/reglamento/reglamentoSst_form.php?winTitulo=" + titulo + "&id=" + id + "&readonly=false";
    cargarDiv("#window", url);
}

function abrirModal(comentario){
    $('#modalComentario').modal('show');
    document.getElementById("txtComentario").value = comentario;
}

function cambiarPublicacion(doc_id, estadoPublicacion) {
    loaderShow(null);
    ax.setAccion("cambiarPublicacion");
    ax.addParamTmp("documentoId", doc_id);
    ax.addParamTmp("estadoPublicacion", estadoPublicacion);
    ax.consumir();
}