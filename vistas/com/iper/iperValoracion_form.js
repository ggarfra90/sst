/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var c = $('#btnGuardar i').attr('class');
var param_activo='1';
var param_inactivo='0';
$(document).ready(function () {
 loaderShow(null);
 ax.setSuccess("exitoIperValoracionRiesgo");
$('#txtRiesgoBajo').off('click');
    cargarComponentes();
    altura();
});



function exitoIperValoracionRiesgo(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarIperProcedimiento':
                onResponseListarIperProcedimiento(response.data);
                estructuraDataTable();
                break;
            case 'cambiarEstado':
                cambiarIconoEstado();
                break;
            case 'insetarIperValorRiesgo':
                exitoCrear(response.data);
                break;
        }
    }
}

function cargarComponentes() {
    toggleOnOff();
    knobs();
}

function toggleOnOff() {
   $('#tgRiesgoBajo').toggles({
     width: 150, // width used if not set in css
  height: 20, // height if not set in css
  type: 'compact' // if this is set to 'select' then the select style toggle will be used
});
$('#tgRiesgoMedio').toggles({
     width: 150, // width used if not set in css
  height: 20, // height if not set in css
  type: 'compact' // if this is set to 'select' then the select style toggle will be used
});
$('#tgRiesgoAlto').toggles({
     width: 150, // width used if not set in css
  height: 20, // height if not set in css
  type: 'compact' // if this is set to 'select' then the select style toggle will be used
});
$('#tgRiesgoCritico').toggles({
     width: 150, // width used if not set in css
  height: 20, // height if not set in css
  type: 'compact' // if this is set to 'select' then the select style toggle will be used
});
}
$('#tgRiesgoBajo').on('toggle', function (e, active) {
  if (active) {
    $("#txtBajo").val(param_activo);
 
  } else {
    $("#txtBajo").val(param_inactivo);
   
  }
});
$('#tgRiesgoMedio').on('toggle', function (e, active) {
  if (active) {
    $("#txtMedio").val(param_activo);
  
  } else {
    $("#txtMedio").val(param_inactivo);
     
  }
});
$('#tgRiesgoAlto').on('toggle', function (e, active) {
  if (active) {
    $("#txtAlto").val(param_activo);
  
  } else {
    $("#txtAlto").val(param_inactivo);
    
  }
});
$('#tgRiesgoCritico').on('toggle', function (e, active) {
  if (active) {
    $("#txtCritico").val(param_activo);
  
  } else {
    $("#txtCritico").val(param_inactivo);
   
  }
});
function knobs(){
    
     $("#txtRiesgoBajo").knob();
     $("#txtRiesgoMedio").knob();
     $("#txtRiesgoAlto").knob();
     $("#txtRiesgoCritico").knob();
     $("#txtRiesgoBajo").css("border","1px solid #33b86c");
      $("#txtRiesgoMedio").css("border","1px solid #ebc142");
       $("#txtRiesgoAlto").css("border","1px solid #ff9b3f");
        $("#txtRiesgoCritico").css("border","1px solid #cb2a2a");
       
     loaderClose();
}

$("#txtRiesgoBajo").change(function (){
    var min=$("#txtRiesgoBajo").val();
    
    $('#txtRiesgoMedio').val(min);
     $("#txtRiesgoMedio").trigger('change');
   
       $('#txtRiesgoMedio').trigger('configure',
        {
            "min":min
            
        });
});
$("#txtRiesgoMedio").change(function (){
    var min=$("#txtRiesgoMedio").val();
    
    $('#txtRiesgoAlto').val(min);
     $("#txtRiesgoAlto").trigger('change');
   
       $('#txtRiesgoAlto').trigger('configure',
        {
            "min":min
            
        });
});
$("#txtRiesgoAlto").change(function (){
    var min=$("#txtRiesgoAlto").val();
    
    $('#txtRiesgoCritico').val(min);
     $("#txtRiesgoCritico").trigger('change');
   
       $('#txtRiesgoCritico').trigger('configure',
        {
            "min":min
            
        });
});
function nuevo() {
    var titulo = "Nuevo";
    var url = URL_BASE + "vistas/com/iper/iper_form.php?winTitulo=" + titulo;
    cargarDiv("#window", url);
}
function nuevoValoracionRiesgos() {
    
    var url = URL_BASE + "vistas/com/iper/iper_valoracion.php";
    cargarDiv("#window", url);
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
    listarIper();
}

function crearValorRiesgo(){
    deshabilitarBotones();
    loaderShow(null);
   var riesgob= $("#txtRiesgoBajo").val();
   var riesgom= $("#txtRiesgoMedio").val();
   var riesgoa= $("#txtRiesgoAlto").val();
   var riesgoc= $("#txtRiesgoCritico").val();
   var sigb= $("#txtBajo ").val();
   var sigm= $("#txtMedio").val();
   var siga= $("#txtAlto").val();
   var sigc= $("#txtCritico").val();
   
   var limI=['0',riesgob,riesgom,riesgoa];
   var limS=[riesgob,riesgom,riesgoa,riesgoc];
   var sig=[sigb,sigm,siga,sigc];
   enviarValorRiesgo(limI,limS,sig);
   
}
function enviarValorRiesgo(limI,limF,sig){
    ax.setAccion("insetarIperValorRiesgo");
    ax.addParamTmp("limInf", limI);
    ax.addParamTmp("limSup", limF);
    ax.addParamTmp("significancia", sig);
    ax.consumir();
}
function exitoCrear(data) {
    if (data[0]["vout_exito"] === 0) {
        loaderClose();
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        loaderClose();
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        cargarPantallaListarIper();
    }
}
function cargarPantallaListarIper() {
   
    var url = URL_BASE + "vistas/com/iper/iper.php";
    cargarDiv("#window", url);
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