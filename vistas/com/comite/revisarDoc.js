/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoComite");
    listarDocsXrevisar();

    cargarComponentes();
    altura();
});

function listarDocsXrevisar(){
    ax.setAccion("listarDocsXrevisar");
    ax.consumir();
}

function exitoComite(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarDocsXrevisar':
                onResponseListarDocsXrevisar(response.data);
                onResponseVacio();
                break;
            case 'aprobarDocumento':
                listarDocsXrevisar();
                break;
            case 'rechazarDocumento':
                listarDocsXrevisar();
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

function onResponseListarDocsXrevisar(data) {
    $("#dataList").empty();
    var cuerpo_total = "";
    var cuerpo = "";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Tipo de documento</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Fecha de creación</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Código</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Versión</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Documento</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.tipo_doc + "</td>"
                    + "<td style='text-align:center;'>" + item.fec_creacion + "</td>"
                    + "<td style='text-align:center;'>" + item.codigo + "</td>"
                    + "<td style='text-align:center;'>" + item.version + "</td>"
                    + "<td style='text-align:center;'>" + item.doc_nombre + "</td>"

                    + "<td style='text-align:center;'>"
                        + "<a onclick='abrirModal(" + item.id + ")'><i id='r" + item.id + "' class='fa fa-close' style='color:#cb2a2a;'></i></a>&nbsp;&nbsp;"
                        + "<a onclick='aprobar(" + item.id + ")'><i id='a" + item.id + "' class='fa fa-check' style='color:#5cb85c;'></i></a>&nbsp;&nbsp;"
//                        + "<input type='hidden' value='1' id='h" + item.id + "'/>"
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

function abrirModal(id){
    $('#modalComentario').modal('show');
    document.getElementById("hdnDocumentoId").value = id;
}

function onResponseVacio() {
    $('#datatable').dataTable({
        "order": [[ 0, 'asc' ], [ 1, 'asc' ]],
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

function aprobar(id) {
    loaderShow(null);
    ax.setAccion("aprobarDocumento");
    ax.addParamTmp("documentoId", id);
    ax.consumir();
}

function rechazar() {
    var id = document.getElementById('hdnDocumentoId').value;
    var motivoRechazo = document.getElementById('txtComentario').value;
    if (validarFormulario(motivoRechazo)) {
        loaderShow(null);
        $('#modalComentario').modal('hide');
        document.getElementById('hdnDocumentoId').value = "";
        document.getElementById('txtComentario').value = "";
        ax.setAccion("rechazarDocumento");
        ax.addParamTmp("documentoId", id);
        ax.addParamTmp("motivoRechazo", motivoRechazo);
        ax.consumir();
    }
}

function validarFormulario(motivoRechazo) {
    var bandera = true;
    var espacio = /^\s+$/;
    limpiarMensajes();

    if (motivoRechazo === "" || motivoRechazo === null || espacio.test(motivoRechazo) || motivoRechazo.length === 0) {
        $("msjComentario").removeProp(".hidden");
        $("#msjComentario").text("El motivo de rechazo es obligatorio").show();
        bandera = false;
    }
    return bandera;
}

function limpiarMensajes() {
    $("#msjComentario").hide();
}

function cambiarIconoEstado(data) {
    if (data[0].estado === "1") {
        document.getElementById('e' + data[0].id).className = 'ion-checkmark-circled';
        document.getElementById('e' + data[0].id).style.color = '#5cb85c';
        document.getElementById('h' + data[0].id).value = '0';
    } else {
        document.getElementById('e' + data[0].id).className = 'ion-flash-off';
        document.getElementById('e' + data[0].id).style.color = '#cb2a2a';
        document.getElementById('h' + data[0].id).value = '1';
    }
    loaderClose();
    $.Notification.autoHideNotify('success', 'top-right', '&Eacute;xito', 'Estado actualizado');
}