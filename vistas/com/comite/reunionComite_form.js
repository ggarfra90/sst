/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var dataTable1 = '1';
var dataTable2 = '2';
var dataTable3 = '3';
var dataTable4 = '4';
$("#cancelar").click(function () {
    limpiarCamposAgenda();
});


var c = $('#btnEnviar i').attr('class');
var g = $('#btnEnviarGrid i').attr('class');
var a = $('#btnEnviarGridA i').attr('class');
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    limpiaEspacio();
    altura();
});


$(document).ready(function () {
    //loaderShow(null);
    limpiaEspacio();
    ax.setSuccess("exitoReunionComite");
    ax.setAccion("obtenerMiembrosComite");
    ax.consumir();

    $('#divAsistentes').hide();
    $('#liAcuerdos').hide();
    $('#liAcuerdosP').hide();
    var idEdit = document.getElementById("idEdit").value;
     var idDet = document.getElementById("idDet").value;
    
    if (!isEmpty(idEdit)) {
        var comiteId=document.getElementById("comiteId").value;
        var comiteReuId = document.getElementById("comiteReuId").value;
         loaderShow(null);
        $('#liAcuerdos').show();
        $('#liAcuerdosP').show();
        $('#divAsistentes').show();
       
        cargarDataEdit(comiteReuId);
        cargarReunionTemaXId(comiteReuId);
        onResponseListarAcuerdo(null);
        cargarAsistenciaMiembros(comiteId);
        onResponseVacio(dataTable3);
     
    }
    if (!isEmpty(idDet)){
       var comiteId=document.getElementById("comiteId").value;
        var comiteReuId = document.getElementById("comiteReuId").value;
         loaderShow(null);
        $('#liAcuerdos').show();
        $('#liAcuerdosP').show();
        $('#divAsistentes').show();
       
        cargarDataEdit(comiteReuId);
        cargarReunionTemaXId(comiteReuId);
        onResponseListarAcuerdo(null);
        cargarAsistenciaMiembros(comiteId);
        onResponseVacio(dataTable3);
         $("#btnEnviar").hide();
         $("#btnAgenda").hide();
         $("#btnAcuerdo").hide();
          $('#txtFecReunion').prop('disabled',true);
         $('#txtReuHora').prop('disabled',true);
         $('#txtLugar').prop('disabled',true);
        
         
    }

  
    onResponseListarAgenda(null);
    onResponseVacio(dataTable2);
    limpiarMensajes();
    cargarComponentes();
    altura();
});

function exitoReunionComite(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {

            case 'obtenerMiembrosComite':
                onResponseObtenerReunionComiteColaborador(response.data);
                break;
                case 'obtenerMiembroXidAsistencia':
                onResponseListarMiembrosReunionComite(response.data);
                break;
            case 'crearGridAgenda':
                habilitarBotonesGrid(g);
                onResponseCrearGrid(response.data);
                onResponseVacio(dataTable2);
                altura();
                loaderClose();
                break;
            case 'editarGridAgenda':
                habilitarBotonesGrid(g);
                onResponseEditar(response.data);
                onResponseVacio(dataTable2);
                altura();
                loaderClose();
                break;
                case 'crearGridAcuerdo':
                habilitarBotonesGridA(a);
                onResponseCrearGridAcuerdo(response.data);
                altura();
                loaderClose();
                break;
            case 'editarGridAcuerdo':
                habilitarBotonesGridA(a);
                onResponseEditarAcuerdo(response.data);
                altura();
                loaderClose();
                break;
            case 'insertarReunion':
                onResponseCrearReunion(response.data);    
                loaderClose();
                    
               break;
            case 'eliminarGridAgenda':
                onResponseEliminarGrid(response.data);
                break;
                case 'eliminarGridAcuerdo':
                onResponseEliminarGridAcuerdo(response.data);
                break;
            case 'obtenerXIdGrid':

                onResponseEditarGrid(response.data);
                break;
                case 'obtenerXIdGridAcuerdo':

                onResponseEditarGridAcuerdo(response.data);
                break;
                case 'obtenerReunionXId':

                onResponseObtenerReunionXId(response.data);
                break;
                case 'obtenerReunionAgendaXId':
                onResponseObtenerReunionAgendaXId(response.data);
                break;
                case 'obtenerReunionAcuerdoXId':
                onResponseObtenerReunionAcuerdoXId(response.data);
                break;
                case 'obtenerReunionTemaXId':
                cargarReunionTema(response.data);
                break;
            case 'obtenerReunionPendienteXId':
                onResponseObtenerReunionAcuerdoPendienteXId(response.data);
                  onResponseVacio(dataTable4);
                  altura();
                        break;
                    case 'crearCierreAcuerdo':
                        habilitarBotonesGridA(a);
                onResponseCrearCierre(response.data);
                altura();
                loaderClose();
                break;
                break;
                case 'actualizarReunion':
                    
                    onResponseEditarReunion(response.data);
                    break;
                case 'asistenciaComiteSstReunion':
                    onResponseCrearAsistencia(response.data);
                break;

        }
    }
}

function onResponseObtenerReunionComiteColaborador(data) {
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            $('#cboColaboradorAge').append('<option value="' + item.usu_ad + '">' + item.usuario + "(" + item.cargoN + ")" + '</option>');
            $('#cboColaboradorAcu').append('<option value="' + item.usu_ad + '">' + item.usuario + "(" + item.cargoN + ")" + '</option>');
        });
    }


}
function cargarReunionTema(data) {
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            $('#cboTemaAcu').append('<option value="' + item.comite_sst_reu_agenda_id + '">' + item.tema + '</option>');
        });
    }

    
}
function cargarAsistenciaMiembros(idComite){
    loaderShow(null);
    var reuId = document.getElementById("comiteReuId").value;
    ax.setAccion("obtenerMiembroXidAsistencia");
        ax.addParamTmp("idComite", idComite);
         ax.addParamTmp("idReu", reuId);
        ax.consumir();
}
function crearAsistencia(mieId){
    var reuId = document.getElementById("comiteReuId").value;
    loaderShow();
    ax.setAccion("asistenciaComiteSstReunion");
        ax.addParamTmp("reuId", reuId);
        ax.addParamTmp("mieId", mieId);
        ax.consumir();
}
function enviarReunion(titulo) {
    
    var fecha = document.getElementById('txtFecReunion').value;
    var hora = document.getElementById('txtReuHora').value;
    var ubicacion = document.getElementById('txtLugar').value;


    if(titulo!=='Editar'){
    crearRuenion(fecha, hora, ubicacion);
}else{
    
    var idComite=document.getElementById('comiteId').value;
    var idComiteReu=document.getElementById('comiteReuId').value;
    actualizarRuenion(idComite,idComiteReu,fecha, hora, ubicacion);
}
}
function crearRuenion(fecha, hora, ubicacion) {
    if (validarFormulario(fecha, hora, ubicacion)) {

        ax.setAccion("insertarReunion");
        ax.addParamTmp("fecha", fecha);
        ax.addParamTmp("hora", hora);
        ax.addParamTmp("ubicacion", ubicacion);
        ax.consumir();
    } else {
        loaderClose();
    }
}
function actualizarRuenion(idComite,idComiteReu,fecha, hora, ubicacion) {
    if (validarFormulario(fecha, hora, ubicacion)) {
     
        ax.setAccion("actualizarReunion");
        ax.addParamTmp("idComite", idComite);
        ax.addParamTmp("idComiteReu", idComiteReu);
        ax.addParamTmp("fecha", fecha);
        ax.addParamTmp("hora", hora);
        ax.addParamTmp("ubicacion", ubicacion);
        ax.consumir();
    } else {
        loaderClose();
    }
}
function asignarValorSelect2(id, valor) {
    $("#" + id).select2().select2("val", valor);
    $("#" + id).select2({width: '100%'});
}

function cargarComponentes() {
    cargarSelect2();
    cargarCalendarios();
    cargarHora();
}
function cargarCalendarios() {
    $("#txtFecReunion").datepicker({
        format: "yyyy-mm-dd",
        //startDate: "",
        language: "es",
        autoclose: "true"

    });
    $("#txtFecVenAcu").datepicker({
        format: "yyyy-mm-dd",
        //startDate: "",
        language: "es",
        autoclose: "true"

    });

}
function cargarHora() {
    $("#txtReuHora").timepicker({defaultTIme: false});
}
function cargarSelect2() {

    $("#cboColaboradorAge").select2({
        width: '100%'
    });
    $("#cboColaboradorAcu").select2({
        width: '100%'
    });
    $("#cboTemaAcu").select2({
        width: '100%'
    });
}

$(function () {
    $("#fileConvocatoria").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = fileIsLoadedConvocatoria;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function fileIsLoadedConvocatoria(e) {
    $('#secretFileCierre').attr('value', e.target.result);
    document.getElementById('convocatoriaDocId').value = '';
}

$(function () {
    $("#fileCierre").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = fileIsLoadedEleccion;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function fileIsLoadedEleccion(e) {
    $('#secretFileCierre').attr('value', e.target.result);
   

}

function cargarPantallaListar() {
    $('.select2-hidden-accessible').remove();
    var url = URL_BASE + "vistas/com/comite/reunion.php";

    cargarDiv("#window", url);
}
function enviarGrid() {
    loaderShow(null);
    var cboUsuarioId = document.getElementById('cboColaboradorAge').value;
    var tema = document.getElementById('txtTemaAge').value;
    var detalle = document.getElementById('txtDetalleAge').value;
    var id = document.getElementById('TxtGrid').value;

    if (id === '#') {
        crearGrid(tema, detalle, cboUsuarioId);
    } else {
        editarEnviarGrid(id, tema, detalle, cboUsuarioId);
        document.getElementById('TxtGrid').value = '#';
    }
}
function enviarGridAcuerdo() {
    loaderShow(null);
    var tema="";
    var cboTemaId = document.getElementById('cboTemaAcu').value;
   
            tema= $("#cboTemaAcu option:selected").text();
         var cboUsuarioId = document.getElementById('cboColaboradorAcu').value;
    var detalle = document.getElementById('txtDetalleAcu').value;
    var fecha=document.getElementById('txtFecVenAcu').value;
    var id = document.getElementById('TxtGridAcuerdo').value;
    var idP = document.getElementById('txtPendiente').value;
   
    if (id === '#') {
        crearGridAcuerdo(tema,cboTemaId,cboUsuarioId,fecha,detalle);
    } else {
       
        if(idP!=='#'){
               var documento = document.getElementById('secretFileCierre').value;
                var docNombre = document.getElementById('fileCierre').value.slice(12);
                var detalle=document.getElementById('txtEvidenciaAcu').value;
            
            crearCierreAcuerdo(idP,documento,docNombre,detalle);
        }
            editarEnviarGridAcuerdo(id,tema,cboTemaId,cboUsuarioId,fecha,detalle);
        document.getElementById('TxtGridAcuerdo').value = '#';
        
        
    }
}
function onResponseEditarGrid(data) {

    asignarValorSelect2('cboColaboradorAge', data.colaborador);
    document.getElementById('txtTemaAge').value = data.tema;
    document.getElementById('txtDetalleAge').value = data.detalle;
    document.getElementById('TxtGrid').value = data.id;
    $('#modalAgregarAgenda').modal('show');
    loaderClose();
}
function onResponseEditarGridAcuerdo(data) {
   
    $('#divEvidencia').hide();
       $('#cboTemaAcu').prop('disabled',false);
         $('#cboColaboradorAcu').prop('disabled',false);
         $('#txtFecVenAcu').prop('disabled',false);
         $('#txtDetalleAcu').prop('disabled',false);
    asignarValorSelect2('cboTemaAcu', data.temaId);
    asignarValorSelect2('cboColaboradorAcu', data.colaborador);
    document.getElementById('txtFecVenAcu').value = data.fechaVen;
    document.getElementById('txtDetalleAcu').value = data.detalle;
    document.getElementById('TxtGridAcuerdo').value = data.id;
    var p=document.getElementById('txtPendiente').value;
    if(p!=='#'){
        $('#divEvidencia').show();
         $('#cboTemaAcu').prop('disabled',true);
         $('#cboColaboradorAcu').prop('disabled',true);
         $('#txtFecVenAcu').prop('disabled',true);
         $('#txtDetalleAcu').prop('disabled',true);
            
    }
   
    $('#modalAgregarAcuerdo').modal('show');
    loaderClose();
}
function crearCierreAcuerdo(idP,documento,docNombre,detalle){
    if (validarCierreAcuerdo(docNombre)) {
        deshabilitarBotonesGridA();
        ax.setAccion("crearCierreAcuerdo");
        ax.addParamTmp("id_P", idP);
        ax.addParamTmp("documento", documento); 
        ax.addParamTmp("docNombre", docNombre);
        ax.addParamTmp("detalle", detalle);
       
        ax.consumir();
    } else {
        loaderClose();
        habilitarBotones(a);
    }
}
function crearGrid(tema, detalle, cboUsuarioId) {
    if (validarFormGrid(tema, detalle, cboUsuarioId)) {
        deshabilitarBotonesGrid();
        ax.setAccion("crearGridAgenda");
        ax.addParamTmp("tema", tema);
        ax.addParamTmp("detalle", detalle);
        ax.addParamTmp("cboUsuarioId", cboUsuarioId);
        ax.consumir();
    } else {
        loaderClose();
        habilitarBotones(g);
    }
}

function editarEnviarGrid(id, tema, detalle, cboUsuarioId) {
    if (validarFormGrid(tema, detalle, cboUsuarioId)) {
        deshabilitarBotonesGrid();
        ax.setAccion("editarGridAgenda");
        ax.addParamTmp("id_grid", id);
        ax.addParamTmp("tema", tema);
        ax.addParamTmp("detalle", detalle);
        ax.addParamTmp("cboUsuarioId", cboUsuarioId);
        ax.consumir();
    } else {
        loaderClose();
        habilitarBotones(g);
    }
}
function eliminarGrid(idGrid) {
    loaderShow(null);
    ax.setAccion("eliminarGridAgenda");
    ax.addParamTmp("id_grid", idGrid);
    ax.consumir();
}
function crearGridAcuerdo(tema,temaId, cboUsuarioId,fecVen,detalle) {
    if (validarFormGridAcuerdo(temaId, cboUsuarioId,fecVen, detalle)) {
        deshabilitarBotonesGridA();
        ax.setAccion("crearGridAcuerdo");
        ax.addParamTmp("tema", tema);
        ax.addParamTmp("temaId", temaId);
        ax.addParamTmp("cboUsuarioId", cboUsuarioId);
        ax.addParamTmp("fechaVen", fecVen);
        ax.addParamTmp("detalle", detalle);
        ax.consumir();
    } else {
        loaderClose();
        habilitarBotones(a);
    }
}
function editarEnviarGridAcuerdo(id,tema,temaId, cboUsuarioId,fecVen,detalle) {
    if (validarFormGrid(tema, detalle, cboUsuarioId)) {
        deshabilitarBotonesGridA();
        ax.setAccion("editarGridAcuerdo");
        ax.addParamTmp("id_gridA",id);
        ax.addParamTmp("tema", tema);
        ax.addParamTmp("temaId", temaId);
        ax.addParamTmp("cboUsuarioId", cboUsuarioId);
        ax.addParamTmp("fechaVen", fecVen);
        ax.addParamTmp("detalle", detalle);
        ax.consumir();
    } else {
        loaderClose();
        habilitarBotones(a);
    }
}
function eliminarGridAcuerdo(idGridA) {
    loaderShow(null);
    ax.setAccion("eliminarGridAcuerdo");
    ax.addParamTmp("id_gridA", idGridA);
    ax.consumir();
}
function cargarDataEdit(comiteReuId){
    
   cargarReunionXId(comiteReuId);
   cargarReunionAgendaXId(comiteReuId);
   cargarReunionAcuerdoXId(comiteReuId);
   cargarReunionAcuerdoPendienteXId(comiteReuId);
  
    
}
function cargarReunionXId(comiteReuId){
    
    ax.setAccion("obtenerReunionXId");
    ax.addParamTmp("comiteReuId",comiteReuId);
    ax.consumir();
}
function cargarReunionTemaXId(comiteReuId){
    
    ax.setAccion("obtenerReunionTemaXId");
    ax.addParamTmp("comiteReuId",comiteReuId);
    ax.consumir();
}
function cargarReunionAgendaXId(comiteReuId){
    
    ax.setAccion("obtenerReunionAgendaXId");
    ax.addParamTmp("comiteReuId",comiteReuId);
    ax.consumir();
}
function cargarReunionAcuerdoXId(comiteReuId){
    
    ax.setAccion("obtenerReunionAcuerdoXId");
    ax.addParamTmp("comiteReuId",comiteReuId);
    ax.consumir();
}
function cargarReunionAcuerdoPendienteXId(comiteReuId){
    
    ax.setAccion("obtenerReunionPendienteXId");
    ax.addParamTmp("comiteReuId",comiteReuId);
    ax.consumir();
}
function validarFormGrid(tema, detalle, cboColaborador) {
    var bandera = true;
    var espacio = /^\s+$/;


    if (cboColaborador === "" || cboColaborador === null || cboColaborador === "#" || espacio.test(cboColaborador)) {
        $("msjCboColaboradorAge").removeProp(".hidden");
        $("#msjCboColaboradorAge").text("El colaborador es obligatoria").show();
        bandera = false;
    }
    if (tema === "" || tema === null || tema === "#" || espacio.test(tema)) {
        $("msjTxtTema").removeProp(".hidden");
        $("#msjTxtTema").text("El tema es obligatoria").show();
        bandera = false;
    }
    if (detalle === "" || detalle === null || detalle === "#" || espacio.test(detalle)) {
        $("msjTxtDetalleAge").removeProp(".hidden");
        $("#msjTxtDetalleAge").text("El detalle es obligatoria").show();
        bandera = false;
    }
    return bandera;
}
function validarCierreAcuerdo(documento) {
    var bandera = true;
    var espacio = /^\s+$/;


   
    if (documento === "" || documento === null || documento === "#" || espacio.test(documento)) {
        $("msjDocCierre").removeProp(".hidden");
        $("msjDocCierre").text("El documento es obligatoria").show();
        bandera = false;
    }
   
    return bandera;
}
function validarFormGridAcuerdo(CboTemaAcu,  cboColaboradorAcu,txtFecVenAcu,detalleAcu) {
    var bandera = true;
    var espacio = /^\s+$/;


    if (cboColaboradorAcu === "" || cboColaboradorAcu === null || cboColaboradorAcu === "#" || espacio.test(cboColaboradorAcu)) {
        $("msjCboColaboradorAcu").removeProp(".hidden");
        $("#msjCboColaboradorAcu").text("El colaborador es obligatoria").show();
        bandera = false;
    }
    if (CboTemaAcu === "" || CboTemaAcu === null || CboTemaAcu === "#" || espacio.test(CboTemaAcu)) {
        $("msjCboTemaAcu").removeProp(".hidden");
        $("#msjCboTemaAcu").text("El tema es obligatoria").show();
        bandera = false;
    }
    if (txtFecVenAcu === "" || txtFecVenAcu === null || txtFecVenAcu === "#" || espacio.test(txtFecVenAcu)) {
        $("msjTxtFecVenAcu").removeProp(".hidden");
        $("#msjTxtFecVenAcu").text("La fecha es obligatoria").show();
        bandera = false;
    }
    if (detalleAcu === "" || detalleAcu === null || detalleAcu === "#" || espacio.test(detalleAcu)) {
        $("msjTxtDetalleAcu").removeProp(".hidden");
        $("#msjTxtDetalleAcu").text("El detalle es obligatoria").show();
        bandera = false;
    }
    return bandera;
}
function validarFormulario(fecha, hora, ubicacion) {
    var bandera = true;
    var espacio = /^\s+$/;
    var msjTab = "Por favor revise la(s) pestaña(s): ";
    var msjTabDatosReunion = "";
    var msjTabAgenda = "";
    var msjTabIntegrantes = "";
    limpiarMensajes();
    var dt = $('#datatable2').DataTable().data().length;

    if (fecha === "" || fecha === null || espacio.test(fecha) || fecha.length === 0) {
        $("msjTxtFecReunion").removeProp(".hidden");
        $("#msjTxtFecReunion").text("La fecha de reunión es obligatoria").show();
        msjTabDatosReunion = "Datos de reunión" + " - ";
        bandera = false;
    }

    if (hora === "" || hora === null || espacio.test(hora) || hora.length === 0) {
        $("msjTxtReuHora").removeProp(".hidden");
        $("#msjTxtReuHora").text("La Hora de reunión es obligatoria").show();
        msjTabDatosReunion = "Datos de reunión" + " - ";
        bandera = false;
    }
    if (ubicacion === "" || ubicacion === null || espacio.test(ubicacion) ) {
        $("msjTxtLugar").removeProp(".hidden");
        $("#msjTxtLugar").text("La fecha de Inicio es obligatoria").show();
        msjTabDatosReunion = "Datos de reunión" + " - ";
        bandera = false;
    }


    if (dt === 0) {

        msjTabAgenda = "Agenda";
        bandera = false;
    }
    msjTab = msjTab + msjTabDatosReunion + msjTabAgenda;
    $("#msjTabErrores").text(msjTab).show();
    return bandera;
}

function limpiarMensajes() {
    $("#msjTxtFecReunion").hide();
    $("#msjTxtReuHora").hide();
    $("#msjTxtLugar").hide();
    $("#msjTabErrores").hide();
}

function exitoCrear(data) {
    if (data[0]["vout_exito"] === '0') {
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        cargarPantallaListar();
    }
}

function deshabilitarBotones() {
    $("#btnEnviar").addClass('disabled');
    $("#btnEnviar i").removeClass(c);
    $("#btnEnviar i").addClass('fa fa-spinner fa-spin');
}
function deshabilitarBotonesGrid() {
    $("#btnEnviarGrid").addClass('disabled');
    $("#btnEnviarGrid i").removeClass(c);
    $("#btnEnviarGrid i").addClass('fa fa-spinner fa-spin');
}
function habilitarBotonesGrid() {
    $("#btnEnviarGrid").removeClass('disabled');
    $("#btnEnviarGrid i").removeClass('fa fa-spinner fa-spin');
    $("#btnEnviarGrid i").addClass(c);
}
function deshabilitarBotonesGridA() {
    $("#btnEnviarGridA").addClass('disabled');
    $("#btnEnviarGridA i").removeClass(c);
    $("#btnEnviarGridA i").addClass('fa fa-spinner fa-spin');
}
function habilitarBotonesGridA() {
    $("#btnEnviarGridA").removeClass('disabled');
    $("#btnEnviarGridA i").removeClass('fa fa-spinner fa-spin');
    $("#btnEnviarGridA i").addClass(c);
}
function habilitarBotones(id) {
    $(id).removeClass('disabled');
    $(id+" i").removeClass('fa fa-spinner fa-spin');
    $("#btnEnviar i").addClass(id);
}
function onResponseCrearReunion(data){
    
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
               cargarPantallaListar();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Reunión creada satisfactoriamente.");
        loaderClose();
    }
}
function onResponseEditarReunion(data){
    
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
               cargarPantallaListar();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Reunión creada satisfactoriamente.");
        loaderClose();
    }
}
function onResponseCrearAsistencia(data){
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
              var comiteId=document.getElementById("comiteId").value;
             cargarAsistenciaMiembros(comiteId);
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Asistió.");
        loaderClose();
    }
}
function onResponseObtenerReunionXId(data){
    $('#txtFecReunion').datepicker('setDate',data[0].fecha);
    var horaF=formatTime(new Date(data[0].fecha+" "+data[0].hora),'HH:MM AM');
   $('#txtReuHora').timepicker('setTime',horaF);
   $('#txtLugar').val(data[0].ubicacion);
}
function onResponseObtenerReunionAgendaXId(data){
    onResponseListarAgenda(data);
    onResponseVacio(dataTable2);
    loaderClose();
}
function onResponseObtenerReunionAcuerdoXId(data){
    onResponseListarAcuerdo(data);
    onResponseVacio(dataTable3);
    loaderClose();
}

function onResponseCrearGrid(data) {
    limpiarCamposAgenda();
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
        $("#modalAgregarAgenda").modal('hide');
        onResponseListarAgenda(data);
        onResponseVacio();
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Colaborador agregado satisfactoriamente.");
        loaderClose();
    }

}
function onResponseCrearCierre(data) {
    limpiarCamposCierre();
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
        $("#modalAgregarAcuerdo").modal('hide');
        onResponseObtenerReunionAcuerdoPendienteXId(data);
        onResponseVacio(dataTable4);
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Acuerdo cerrado satisfactoriamente.");
        loaderClose();
    }

}
function onResponseCrearGridAcuerdo(data) {
    limpiarCamposAcuerdo();
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
        $("#modalAgregarAcuerdo").modal('hide');
        onResponseListarAcuerdo(data);
        onResponseVacio(dataTable3);
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Acuerdo agregado satisfactoriamente.");
        loaderClose();
    }

}
function onResponseEditar(data) {
    limpiarCamposAgenda();
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
        $("#modalAgregarAgenda").modal('hide');
        onResponseListarAgenda(data);
        onResponseVacio(dataTable2);
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Agenda editada satisfactoriamente.");
        loaderClose();
    }

}
function onResponseEditarAcuerdo(data) {
    limpiarCamposAcuerdo();
    if (data[0]['vout_exito'] === '0') {

        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
        loaderClose();
    } else {
        $("#modalAgregarAcuerdo").modal('hide');
        onResponseListarAcuerdo(data);
        onResponseVacio(dataTable3);
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Acuerdo editado satisfactoriamente.");
        loaderClose();
    }

}
function editarGrid(id) {
    loaderShow(null);
    ax.setAccion("obtenerXIdGrid");
    ax.addParamTmp("id_grid", id);
    ax.consumir();

}

function editarGridAcuerdo(id,p) {
    $('#txtPendiente').val("#");
    if(p!=='#'){
        $('#txtPendiente').val(p);
      $("#modalTitulo").html('Cerrar acuerdo de reuni&oacute;n');
    }else{
         $('#txtPendiente').val('#');
      $("#modalTitulo").html('Nuevo acuerdo de reuni&oacute;n');
    
    }
    loaderShow(null);
    ax.setAccion("obtenerXIdGridAcuerdo");
    ax.addParamTmp("id_gridA", id);
    ax.consumir();
    
}
function onResponseEliminarGrid(data) {

    onResponseListarAgenda(data);
    onResponseVacio(dataTable2);
    altura();
    $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Colaborador eliminado satisfactoriamente.");
    loaderClose();
}
function onResponseEliminarGridAcuerdo(data) {

    onResponseListarAcuerdo(data);
    onResponseVacio(dataTable3);
    altura();
    $.Notification.autoHideNotify('success', 'top-right', 'Éxito', "Acuerdo eliminado satisfactoriamente.");
    loaderClose();
}
function  onResponseListarMiembrosReunionComite(data){
    $("#dataList1").empty();
    var funcion="";
    var idDet = document.getElementById("idDet").value;
    var cursor="style=cursor:default;";
     var cuerpo_total = "";
    var cuerpo = "";
    var cabeza = "<table id='datatable1' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Colaborador</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Cargo</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Asisti&oacute;</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            if(isEmpty(idDet)){
        funcion="onclick = 'crearAsistencia(\"" + item.id + "\")'";
        cursor="style=cursor:pointer;"
    }
            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.usuario + "</td>"
                    + "<td style='text-align:center;'>" + item.descripcion + "</td>";
            cuerpo = cuerpo + "<td style='text-align:center;'>";
             if (item.asistencia === "0") {
                cuerpo = cuerpo + "<a href='#' id='asistencia' "+cursor+funcion+" ><i id='e" + item.id
                        + "' class='ion-flash-off' style='color:#cb2a2a;'></i></a>";
            } else {
                cuerpo = cuerpo + "<i id='e" + item.id
                        + "' class='ion-checkmark-circled' style='color:#5cb85c;'></i>";
            }
                    cuerpo=cuerpo+ "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
     $("#dataList1").append(html);
     onResponseVacio(dataTable1);
     loaderClose();
}
function onResponseListarAgenda(data) {
    
    $("#dataList2").empty();

    var cuerpo_total = "";
    var cuerpo = "";
    var cabeza = "<table id='datatable2' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Tema</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Detalle</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Propuesto por</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.tema + "</td>"
                    + "<td style='text-align:center;'>" + item.detalle + "</td>"
                    + "<td style='text-align:center;'>" + item.colaborador + "</td>";
            cuerpo = cuerpo + "<td style='text-align:center;'>"
                    + "<a href='#' onclick='editarGrid(\"" + item.id + "\")'><i class='fa fa-edit' style='color:#E8BA2F;'></i></a>&nbsp;\n"
                    + "<a href='#' onclick='eliminarGrid(\"" + item.id + "\")'><i class='fa fa-trash-o' style='color:#cb2a2a;'></i></a>&nbsp;\n"
                    + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
     $("#dataList2").append(html);
     
   
}
function onResponseObtenerReunionAcuerdoPendienteXId(data){
     $("#dataList4").empty();

    var cuerpo_total = "";
    var cuerpo = "";
  
    var cabeza = "<table id='datatable4' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
     + "<th style='text-align:center; vertical-align: middle;'>Fecha de reuni&oacute;n</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Tema</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acuerdo</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Responsable</th>"
    + "<th style='text-align:center; vertical-align: middle;'>Fecha de vencimiento</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            
            cuerpo = "<tr>"
            + "<td style='text-align:center;'>" + item.fecha + "</td>"
                    + "<td style='text-align:center;'>" + item.tema + "</td>"
                    + "<td style='text-align:center;'>" + item.acuerdo + "</td>"
                    + "<td style='text-align:center;'>" + item.colaborador + "</td>"
                    + "<td style='text-align:center;'>" + item.fec_propuesto + "</td>";
            cuerpo = cuerpo + "<td style='text-align:center;'>"
                    + "<a href='#' onclick='editarGridAcuerdo(" + item.id +",\""+item.acuId+ "\")'><i class='fa fa-edit' style='color:#E8BA2F;'></i></a>&nbsp;\n"
                    + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList4").append(html);
  
}
function onResponseListarAcuerdo(data) {
    
    $("#dataList3").empty();

    var cuerpo_total = "";
    var cuerpo = "";
    var cumplimiento="";
    var cabeza = "<table id='datatable3' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Tema</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acuerdo</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Responsable</th>"
    + "<th style='text-align:center; vertical-align: middle;'>Fecha de vencimiento</th>"
    + "<th style='text-align:center; vertical-align: middle;'>Fecha de cumplimimiento</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            if(item.fec_cumplido!=='#'){
                    cumplimiento=item.fec_cumplido;
            }
            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.tema + "</td>"
                    + "<td style='text-align:center;'>" + item.detalle + "</td>"
                    + "<td style='text-align:center;'>" + item.colaborador + "</td>"
                    + "<td style='text-align:center;'>" + item.fechaVen + "</td>"
                    + "<td style='text-align:center;'>" + cumplimiento + "</td>";
            cuerpo = cuerpo + "<td style='text-align:center;'>"
                    + "<a href='#' onclick='editarGridAcuerdo(" + item.id +",\""+"#"+ "\")'><i class='fa fa-edit' style='color:#E8BA2F;'></i></a>&nbsp;\n"
                    + "<a href='#' onclick='eliminarGridAcuerdo(\"" + item.id + "\")'><i class='fa fa-trash-o' style='color:#cb2a2a;'></i></a>&nbsp;\n"
                    + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList3").append(html);
   
}
function onResponseVacio(id) {
    $('#datatable' + id).dataTable({
        "order": [[0, 'desc']],
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

function agregarAgenda() {
    limpiarCamposAgenda();
    $('#modalAgregarAgenda').modal('show');

}
function agregarAcuerdo() {
    $('#divEvidencia').hide();
    limpiarCamposAcuerdo();
    $('#modalAgregarAcuerdo').modal('show');
}
function limpiarCamposAgenda() {
    $("#cboColaboradorAge").select2('val', '#');
    $("#txtTemaAge").val('');
    $("#txtDetalleAge").val('');
    $('#msjTxtDetalleAge').hide();
    $('#msjTxtTema').hide();
    $('#msjCboColaboradorAge').hide();

}
function limpiarCamposAcuerdo() {
    $("#cboColaboradorAcu").select2('val', '#');
     $("#cboTemaAcu").select2('val', '#');
     $('#txtFecVenAcu').val("");
     $("#txtDetalleAcu").val('');
    $('#msjTxtFecVenAcu').hide();
    $("#msjCboTemaAcu").hide();
    $('#msjCboColaboradorAcu').hide();
    $('#msjTxtDetalleAcu').hide();
    
}
function limpiarCamposCierre(){
    $('#txtEvidenciaAcu').val("");
     $("#fileCierre").val('');
     $("#fileInfoCierre").html('Ningun documento seleccionado');
}
$("#cboColaboradorAge").change(function () {
    $('#msjCboColaboradorAge').hide();
});
$("#txtTemaAge").change(function () {
    $('#msjTxtTema').hide();
});
$("#txtDetalleAge").change(function () {
    $('#msjTxtDetalleAge').hide();
});
$("#txtFecReunion").change(function () {
    $('#msjTxtFecReunion').hide();
});
$("#txtLugar").change(function () {
    $('#msjTxtLugar').hide();
});
$("#cboColaboradorAcu").change(function () {
    $('#msjCboColaboradorAcu').hide();
});
$("#cboTemaAcu").change(function () {
    $('#msjCboTemaAcu').hide();
});
$("#txtFecVenAcu").change(function () {
    $('#msjTxtFecVenAcu').hide();
});
$("#txtDetalleAcu").change(function () {
    $('#msjTxtDetalleAcu').hide();
});
