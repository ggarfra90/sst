/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoCapacitacion");
    listarCapacitacion(0);
    cargarComponentes();
    altura();
});
function buscarXAvance(){
    listarCapacitacion(1);
}
function listarCapacitacion(t){
    if(t===1){
       var tipo_avance=document.getElementById("tipo_avance").value;
    }
    ax.setAccion("listarVerCapacitacion");
    ax.addParam("tipo_avance",tipo_avance);
    ax.consumir();
}

function exitoCapacitacion(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarVerCapacitacion':
                onResponseListarVerCapacitacion(response.data);
                onResponseVacio();
                altura();
                break;
                case 'inscribirseCapa':
                    cambiarIconoEstado();
                    break;
                   
            
        }
    }
}

function cargarComponentes() {
    cargarSelect2();
}

function cargarSelect2() {
    $("#tipo_avance").select2({
        width: '100%'
    });
}

function onResponseListarVerCapacitacion(data){
    $("#dataList").empty();
    var fecha=new Date();
    var fecha_actual=fecha.getFullYear() + "-" +(fecha.getMonth() + 1) + "-" + fecha.getDate(); 
    
    var cuerpo_total = "";
    var cuerpo = "";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Avance</th>"
            + "<th style='text-align:center;vertical-align: middle;'>Convocatoria desde</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Fecha de inicio</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Fecha de fin</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Tema</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Tipo</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Estado</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            cuerpo = "<tr>";
            
            if(new Date(fecha_actual)<new Date(item.fec_inicio)) {
                cuerpo = cuerpo + "<td style='text-align:center;'><i class='ion-arrow-shrink' style='color:#1ca8dd;'></i></td>";
            }
            if (new Date(fecha_actual)>new Date(item.fec_inicio) && new Date(fecha_actual)<new Date(item.fec_fin)) {
                cuerpo = cuerpo + "<td style='text-align:center;'><span>"
                        + "<i  class='ion-arrow-right-b' style='color:#5cb85c;'></i>"
                        + "</span></td>";
            }
            if (new Date(fecha_actual)>new Date(item.fec_fin)) {
                cuerpo = cuerpo + "<td style='text-align:center;'><span >"
                        + "<i  class='ion-flag' style='color:#cb2a2a;'></i>"
                        + "</span></td>";
            }
                    cuerpo=cuerpo+ "<td style='text-align:center;'>" + item.fec_convocatoria + "</td>"
                    + "<td style='text-align:center;'>" + item.fec_inicio + "</td>"
                    + "<td style='text-align:center;'>" + item.fec_fin + "</td>"
                    + "<td style='text-align:center;'>" + item.tema + "</td>"
                    + "<td style='text-align:center;'>" + item.descripcion + "</td>";
            if (item.matriculado !=="0") {
                
                cuerpo = cuerpo + "<td style='text-align:center;'><i id='e" + item.id+ "' class='ion-checkmark-circled' style='color:#5cb85c;'></i></a></td>";
            } else {
                cuerpo = cuerpo + "<td style='text-align:center;'><a href='#' onclick = 'inscribirse(\"" + item.id + "\")' ><i id='e" + item.id
                        + "' class='ion-flash-off' style='color:#cb2a2a;'></i></a></td>";
            }
                    cuerpo=cuerpo+"<td style='text-align:center;'>"
                        + "<a href='" + item.url + "' target='_blank'><i class='fa fa-cloud-download' style='color:#1ca8dd;'></i></a>&nbsp;&nbsp;"
             
                    cuerpo=cuerpo+ "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList").append(html);
    loaderClose();
}
function inscribirse(id) {
    loaderShow(null);
    
    ax.setAccion("inscribirseCapa");
    ax.addParamTmp("id", id);
    ax.consumir();
}

function cambiarIconoEstado() {
    listarCapacitacion();
    $.Notification.autoHideNotify('success', 'top-right', '&Eacute;xito', 'Estado actualizado');
    
}


function onResponseVacio() {
    $('#datatable').dataTable({
        "order": [[ 1, 'asc' ], [ 2, 'asc' ]],
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

function limpiarMensajes() {
    $("#msjComentario").hide();
}


