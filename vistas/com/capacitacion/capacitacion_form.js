/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var c = $('#btnGuardar i').attr('class');

$(document).ready(function () {
       loaderShow(null);
    $('#divDocDescarga').hide();
    ax.setSuccess("exitoCapacitacion");
    ax.setAccion("obtenerTipoCapacitacion");
     ax.consumir();
     var id = document.getElementById("id").value;
    if (!isEmpty(id)) {
        loaderShow(null);
        
        ax.setAccion("obtenerCapacitacion");
        ax.addParam("cap_id", id);
        ax.consumir();
    }
    cargarCalendarios();
    cargarComponentesCapacitacion();
    altura();
});

function exitoCapacitacion(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerTipoCapacitacion':
            cargarTipoCapacitacion(response.data);
                break;
            case 'obtenerCapacitacion':
                onResponseObtenerCapacitacionXid(response.data);
                loaderClose();
                break;
            case 'crearCapacitacion':
                exitoCrear(response.data);
                loaderClose();
                break;
                case 'actualizarCapacitacion':
                exitoActualiazar(response.data);
                loaderClose();
                break;
            
        }
    }
}
function cargarTipoCapacitacion(data){
    
     $.each(data, function (index, item) {
        
        $('#tipo').append('<option value="' + item.id + '" selected="true">' + item.descripcion + '</option>');
           
         });
     $("#tipo").select2().select2("val","10");
     $("#tipo").select2({width: '100%'});
     loaderClose();
}
function cargarCalendarios() {
    $( "#fecha_convocatoria" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             }).on('changeDate',function(ev){
                var f=new Date(ev.date);
                var f2=f.getFullYear() + "-" +(f.getMonth() + 1) + "-" + (f.getDate()+1)  ;
                
                $( "#fecha_inicio" ).datepicker('setStartDate',f2);
                 $( "#fecha_inicio" ).datepicker('setStartDate',f2);
                 $( "#fecha_inicio" ).datepicker('setDate',f2);
        });
    $( "#fecha_inicio" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             }).on('changeDate',function(ev){
                 var f=new Date(ev.date);
                 var f2=f.getFullYear() + "-" +(f.getMonth() + 1) + "-" + (f.getDate()+1)  ;
                $( "#fecha_fin" ).datepicker('setStartDate',f2);
                 $( "#fecha_fin" ).datepicker('setDate',f2);
             
        });
    $( "#fecha_fin" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             });
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
function onResponseObtenerCapacitacionXid(data) {
    document.getElementById('txtTema').value = data[0].tema;
     $("#fecha_convocatoria").datepicker('setDate',data[0].fec_convocatoria);
     $("#fecha_inicio").datepicker('setDate',data[0].fec_inicio);
     $("#fecha_fin").datepicker('setDate',data[0].fec_fin);
     asignarValorSelect2('tipo', data[0].par_cap_tipo_id);
     asignarValorSelect2('estado', data[0].estado);
     document.getElementById('txtComentario').value = data[0].comentario;
     $("#docId").append("<input type='hidden' id='idCap' value='"+data[0].doc_cap_id+"'>")
     $("#docId").append("<input type='hidden' id='docIdA' value='"+data[0].doc_id+"'>")
     document.getElementById('docId').value = data[0].doc_id;
$('#docInfo').html(data[0].doc_nombre);
    $("#btnDescarga").attr("href", data[0].url);
    $('#divDocDescarga').show();
}
function asignarValorSelect2(id,valor)
{
    $("#"+id).select2().select2("val",valor);
    $("#"+id).select2({width: '100%'});
}
function fileIsLoaded(e) {
    $('#secretFile').attr('value', e.target.result);
    document.getElementById('docId').value = '';
}


function enviar(tipoAccion) {
    loaderShow(null);
    var tema = document.getElementById('txtTema').value;
    var fConvocatoria = document.getElementById('fecha_convocatoria').value;
    var fInicio = document.getElementById('fecha_inicio').value;
    var fFin = document.getElementById('fecha_fin').value;
    var tipo = document.getElementById('tipo').value;
    var estado = document.getElementById('estado').value;
    var documento = document.getElementById('secretFile').value;
    var docNombre = document.getElementById('file').value.slice(12);
   var docId = document.getElementById('docId').value;
    var comentario = document.getElementById('txtComentario').value;
    
    if (documento === '') {
        documento = null;
        docNombre = null;
    }

    if (tipoAccion === 'Nueva') {
       
        crearCapacitacion(tema,fConvocatoria,fInicio,fFin,tipo,estado,documento,docNombre,docId,comentario);
    } else {
        var idCap=document.getElementById('idCap').value;
        var docIdA=document.getElementById('docIdA').value;
        var id = document.getElementById('id').value;
        actualizarCapacitacion(id, tema,fConvocatoria,fInicio,fFin,tipo,estado,documento,docNombre,docId,docIdA,idCap,comentario);
    }
}

function crearCapacitacion(tema,fConvocatoria,fInicio,fFin,tipo,estado,documento,docNombre,docId,comentario) {
    if (validarFormulario(tema,fConvocatoria,fInicio,fFin,docNombre,documento,docId)) {
        deshabilitarBotones();
        ax.setAccion("crearCapacitacion");
        ax.addParamTmp("tema",tema);
        ax.addParamTmp("fconvocatoria",fConvocatoria);
        ax.addParamTmp("finicio", fInicio);
        ax.addParamTmp("ffin",fFin);
        ax.addParamTmp("tipo",tipo);
        ax.addParamTmp("estado", estado);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("documento", documento);
        ax.addParamTmp("docnombre", docNombre);
        ax.consumir();
    } else {
        loaderClose();
    }
}

function actualizarCapacitacion(id,tema,fConvocatoria,fInicio,fFin,tipo,estado,documento,docNombre,docId,docIdA,idCap,comentario) {
    if (validarFormulario(tema,fConvocatoria,fInicio,fFin,docNombre,documento,docId)) {
        deshabilitarBotones();
        ax.setAccion("actualizarCapacitacion");
        ax.addParamTmp("id", id);
        ax.addParamTmp("tema",tema);
        ax.addParamTmp("fconvocatoria",fConvocatoria);
        ax.addParamTmp("finicio", fInicio);
        ax.addParamTmp("ffin",fFin);
        ax.addParamTmp("tipo",tipo);
        ax.addParamTmp("estado", estado);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("documento", documento);
        ax.addParamTmp("docnombre", docNombre);
        ax.addParam("docId",docId);
        ax.addParam("docIdA",docIdA);
        ax.addParam("idCap",idCap);
        ax.consumir();
    } else {
        loaderClose();
    }
}

function validarFormulario(tema,fconvocatoria,fInicio,fFin,docNombre,documento, docId) {
    var bandera = true;
    var espacio = /^\s+$/;
    limpiarMensajes();

    if (tema === "" || tema === null || espacio.test(tema) || tema.length === 0) {
        $("msjTema").removeProp(".hidden");
        $("#msjTema").text("El tema es obligatorio").show();
        bandera = false;
    }
    if (fconvocatoria=== "" || fconvocatoria === null || espacio.test(fconvocatoria) || fconvocatoria.length === 0) {
        $("msjConvocatoria").removeProp(".hidden");
        $("#msjConvocatoria").text("La fecha de convocatoria es obligatoria.").show();
        bandera = false;
    }
    if (fInicio=== "" || fInicio === null || espacio.test(fInicio) || fInicio.length === 0) {
        $("msjFinicio").removeProp(".hidden");
        $("#msjFinicio").text("La fecha de inicio es obligatoria.").show();
        bandera = false;
    }
    if (fFin=== "" || fFin === null || espacio.test(fFin) || fFin.length === 0) {
        $("msjFfin").removeProp(".hidden");
        $("#msjFfin").text("La fecha de fin es obligatoria.").show();
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
function cargarPantallaListarCapacitacion() {
    var url = URL_BASE + "vistas/com/capacitacion/capacitacion.php";
    cargarDiv("#window", url);
}
function limpiarMensajes() {
    $("#txtTema").change(function (){
        $("#msjTema").hide();
    });
    $("#fecha_convocatoria").change(function (){
        $("#msjConvocatoria").hide();
    });
    $("#fecha_inicio").change(function (){
        $("#msjFinicio").hide();
    });
    $("#fecha_fin").change(function (){
        $("#msjFfin").hide();
    });
   $("#file").change(function (){
        $("#msjDocumento").hide();
    });
   
}
function cargarComponentesCapacitacion() {
    cargarSelect2();
}

function cargarSelect2() {
    $("#tipo").select2({
        width: '100%'
    });
    $("#estado").select2({
        width: '100%'
    });
}
function exitoCrear(data) {
    if (data[0]["vout_exito"] === 0) {
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        cargarPantallaListarCapacitacion();
    }
}
function exitoActualiazar(data) {
    if (data[0]["vout_exito"] === 0) {
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        cargarPantallaListarCapacitacion();
    }
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