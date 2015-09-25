/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var c = $('#btnGuardar i').attr('class');

$(document).ready(function () {
     var id = document.getElementById("id").value;
    if (!isEmpty(id)) {
        loaderShow(null);
        ax.setSuccess("exitoEvidencia");
        cargarListadoEvidencia(id);
    }
   
    
    altura();
});
function cargarListadoEvidencia(id){
    ax.setAccion("obtenerEvidenciaCapacitacion");
        ax.addParam("cap_id", id);
        ax.consumir();
}
function exitoEvidencia(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerEvidenciaCapacitacion':
                onResponseObtenerEvidenciaXid(response.data);
                onResponseVacio();
                altura();
                loaderClose();
                break;
            case 'crearEvidencia':
                exitoCrear(response.data);
                loaderClose();
                altura();
                break;
                case 'eliminarEvidencia':
                exitoCrear(response.data);
                altura();
                loaderClose();
                
                break;
            
        }
    }
}



$(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = fileIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});


function fileIsLoaded(e) {
    $('#secretFile').attr('value', e.target.result);
    document.getElementById('docId').value = '';
}


function enviarEvidencia() {
  //  loaderShow(null);
    var id = document.getElementById('id').value;
    var nDocumento = document.getElementById('txtDocumento').value;
    var documento = document.getElementById('secretFile').value;
    var docNombre = document.getElementById('file').value.slice(12);
   var docId = document.getElementById('docId').value;
    var comentario = document.getElementById('txtComentario').value;
    
    if (documento === '') {
        documento = null;
        docNombre = null;
    }

         
      crearEvidencia(id,nDocumento,documento,docNombre,docId,comentario);
    
}

function crearEvidencia(id,nDocumento,documento,docNombre,docId,comentario) {
    if (validarFormulario(nDocumento,docNombre,documento,docId)){
        deshabilitarBotones();
        ax.setAccion("crearEvidencia");
         ax.addParamTmp("idCap",id);
        ax.addParamTmp("nDocumento",nDocumento);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("documento", documento);
        ax.addParamTmp("docnombre", docNombre);
        ax.consumir();
    } else {
        loaderClose();
    }
}

function eliminarEvidencia(idDoc,idCap){
    loaderShow(null);
    ax.setAccion("eliminarEvidencia");
    ax.addParamTmp("idDoc",idDoc);    
    ax.addParamTmp("idCap",idCap);
    
    ax.consumir();
}
function validarFormulario(nDocumento,documento,docNombre,docId) {
    var bandera = true;
    var espacio = /^\s+$/;
    limpiarMensajes();

    if (nDocumento === "" || nDocumento === null || espacio.test(nDocumento) || nDocumento.length === 0) {
        $("msjTema").removeProp(".hidden");
        $("#msjTema").text("El nombre del documento obligatorio").show();
        bandera = false;
    }
    
    if ((documento === "" || documento === null || docNombre==='' || docNombre===null || espacio.test(documento) || documento.length === 0) 
            && docId === "") {
        $("msjDocumento").removeProp(".hidden");
        $("#msjDocumento").text("El documento es obligatorio").show();
        bandera = false;
    }
    return bandera;
}
function cargarPantallaListarEvidencia() {
    var url = URL_BASE + "vistas/com/capacitacion/capacitacion.php";
    cargarDiv("#window", url);
}
function limpiarMensajes() {
    $("#txtDocumento").change(function (){
        $("#msjTema").hide();
    });
          $("#file").change(function (){
        $("#msjDocumento").hide();
    });
   
}
function onResponseObtenerEvidenciaXid(data){
    $("#dataList").empty();
    
  
    var cuerpo_total = "";
    var cuerpo = "";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Documento</th>"
            + "<th style='text-align:center;vertical-align: middle;'>Comentario</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            var comentario=item.comentario;
            if(item.comentario===null){
                comentario='';
            }
            cuerpo = "<tr>";
            
              cuerpo=cuerpo+ "<td style='text-align:center;'>" + item.doc_nombre + "</td>"
                    + "<td style='text-align:center;'>" + comentario + "</td>";
            
                    cuerpo=cuerpo+"<td style='text-align:center;'>"
                        + "<a href='" + item.url + "' target='_blank'><i class='fa fa-cloud-download' style='color:#1ca8dd;'></i></a>&nbsp;&nbsp;"
                        + "<a onclick='llamaEliminarEvidencia(" + item.doc_id +","+item.doc_cap_id+")'><i id='r" + item.id + "' class='fa fa-trash-o' style='color:#cb2a2a;'></i></a>&nbsp;&nbsp;";
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
function exitoCrear(data) {
    if (data[0]["vout_exito"] === 0){
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        limpiarFormulario(); 
        cargarListadoEvidencia(data[0]["vout_id"]);
    }
}

function llamaEliminarEvidencia(idDoc,idCap){
    
    eliminarEvidencia(idDoc,idCap);
}
function deshabilitarBotones() {
    $("#btnGuardar").addClass('disabled');
    $("#btnGuardar i").removeClass(c);
    $("#btnGuardar i").addClass('fa fa-spinner fa-spin');
}

function habilitarBotones() {
    $("#btnGuardar").removeClass('disabled');
    $("#btnGuardar i").removeClass('fa-spinner fa-spin');
    $("#btnGuardar i").addClass(c);
}
function cargarPantallaListarCapacitacion() {
    var url = URL_BASE + "vistas/com/capacitacion/capacitacion.php";
    cargarDiv("#window", url);
}
function limpiarFormulario(){
    document.getElementById("frmEvidencia").reset();
    $('#fileInfo').html("Ningún documento seleccionado.");
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