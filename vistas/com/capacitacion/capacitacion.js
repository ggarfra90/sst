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
    ax.setAccion("listarCapacitacion");
    ax.addParam("tipo_avance",tipo_avance);
    ax.consumir();
}

function exitoCapacitacion(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarCapacitacion':
                onResponseListarCapacitacion(response.data);
                onResponseVacio();
                altura();
                break;
                case 'cambiarEstado':
                    cambiarIconoEstado();
                    break;
                case 'obtenerCapacitacionAlumno':
                    onResponseListarCapacitacionAlumno(response.data);
                break;
                   
            
        }
    }
}
function nuevaCapacitacion() {
    var titulo = "Nueva";
    var url = URL_BASE + "vistas/com/capacitacion/capacitacion_form.php?winTitulo=" + titulo;
    cargarDiv("#window", url);
}
function cargarComponentes() {
    cargarSelect2();
}

function cargarSelect2() {
    $("#tipo_avance").select2({
        width: '100%'
    });
}

function onResponseListarCapacitacion(data){
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
            
            if (new Date(fecha_actual)<new Date(item.fec_inicio)) {
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
            if (item.estado === "1") {
                cuerpo = cuerpo + "<td style='text-align:center;'><a href='#' onclick = 'cambiarEstadoC(\"" + item.id + "\",\"" + item.estado + "\")' ><i id='e" + item.id
                        + "' class='ion-checkmark-circled' style='color:#5cb85c;'></i></a></td>";
            } else {
                cuerpo = cuerpo + "<td style='text-align:center;'><a href='#' onclick = 'cambiarEstadoC(\"" + item.id + "\",\"" + item.estado + "\")' ><i id='e" + item.id
                        + "' class='ion-flash-off' style='color:#cb2a2a;'></i></a></td>";
            }
                    cuerpo=cuerpo+"<td style='text-align:center;'>"
                        + "<a onclick='editarCapacitacion(" + item.id + ")'><i id='r" + item.id + "' class='fa fa-edit' style='color:#E8BA2F;'></i></a>&nbsp;&nbsp;"
                        + "<a href='" + item.url + "' target='_blank'><i class='fa fa-cloud-download' style='color:#1ca8dd;'></i></a>&nbsp;&nbsp;"
                        + "<a onclick='abrirModal(" + item.id + ")'><i id='r" + item.id + "' class='fa fa-list-alt' style='color:#DB94B8;'></i></a>&nbsp;&nbsp;";
                    if (new Date(fecha_actual)>=new Date(item.fec_inicio)){
                                    cuerpo=cuerpo + "<a onclick='crearEvidencia(" + item.id + ",\"" + item.tema + "\")'><i id='r" + item.id + "' class='fa fa-camera' style='color:#999966;'></i></a>&nbsp;&nbsp;";

            }
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
function onResponseListarCapacitacionAlumno(data){
    $("#tema").val("");
        $("#total").val(0);
   $("#colaboradores tr").empty();
    var cuerpo_total = "";
    var cuerpo='';
    var tema='';
    var cantidad='';
    if (!isEmpty(data)) {
        
        $.each(data, function (index, item) {
            cuerpo='';
            var nombre='';
            
            tema=item.tema;
            cantidad=item.total;
            if(item.nom_completo!==null){
                           cuerpo='<tr><td style="vertical-align:middle;">'+item.nom_completo+'</td></tr>';

            }
             cuerpo_total = cuerpo_total + cuerpo;
        });
        $("#tema").val(tema);
        $("#total").val(cantidad);
        $("#colaboradores").append(cuerpo_total);
    }
    
    $('#modalListadoAlumnos').modal('show');
    loaderClose();
}
function cambiarEstadoC(id,estado) {
    loaderShow(null);
    
    ax.setAccion("cambiarEstado");
    ax.addParamTmp("id", id);
    ax.addParamTmp("estado", estado);
    ax.consumir();
}

function cambiarIconoEstado() {
    listarCapacitacion();
    $.Notification.autoHideNotify('success', 'top-right', '&Eacute;xito', 'Estado actualizado');
    
}
function abrirModal(idCapa){
    loaderShow();
    ax.setAccion("obtenerCapacitacionAlumno");
    ax.addParam("cap_id",idCapa);
    ax.consumir();
    
    //document.getElementById("hdnDocumentoId").value = id;
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

function editarCapacitacion(id) {
    var titulo = "Editar";
    var url = URL_BASE + "vistas/com/capacitacion/capacitacion_form.php?winTitulo=" + titulo + "&id=" + id;
    cargarDiv("#window", url);
}
function crearEvidencia(id,tema) {
    
    var cad = tema;
cad= cad.replace(/\s/g,"_");
    
    var url = URL_BASE + "vistas/com/capacitacion/evidencia_form.php?winTitulo=" + cad + "&id=" + id;
    cargarDiv("#window", url);
}