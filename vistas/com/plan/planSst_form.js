/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var c = $('#btnGuardar i').attr('class');

$(document).ready(function () {
    $('#divDocDescarga').hide();
    $('#divOpeDetalle').hide();
    var id = document.getElementById("id").value;
    if (!isEmpty(id)) {
        loaderShow(null);
        ax.setSuccess("exitoPlanSst");
        ax.setAccion("obtenerPlanSstXid");
        ax.addParam("id", id);
        ax.consumir();
    }

    cargarComponentes();
    altura();
});

function exitoPlanSst(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerPlanSstXid':
                onResponseObtenerPlanSstXid(response.data);
                loaderClose();
                break;
            case 'crearPlanSst':
                exitoCrear(response.data);
                loaderClose();
                break;
            case 'actualizarPlanSst':
                exitoCrear(response.data);
                loaderClose();
                break;
        }
    }
}

function onResponseObtenerPlanSstXid(data) {
    document.getElementById('txtCodigo').value = data[0].codigo;
    document.getElementById('txtVersion').value = data[0].version;
    document.getElementById('txtComentario').value = data[0].comentario;
    document.getElementById('docId').value = data[0].doc_id;
    asignarValorSelect2('cboEstado', data[0].estado);
    $("#cboEstado").select2("readonly", true);
    $('#docInfo').html(data[0].doc_nombre);
    $("#btnDescarga").attr("href", data[0].doc_url);
    $('#divDocDescarga').show();

    var op = document.getElementById("op").value;
    if (op === 'Editar') {
        $("#cboEstado").select2("readonly", false);
        $('#divDocCarga').show();
        $('#divOpeEdita').show();
    } else {
        $("#txtCodigo").prop('readonly', true);
        $("#txtVersion").prop('readonly', true);
        $("#txtComentario").prop('readonly', true);
        $('#divOpeDetalle').show();
        $('#divDocCarga').hide();
        $('#divOpeEdita').hide();
    }
}

function asignarValorSelect2(id, valor) {
    $("#" + id).select2().select2("val", valor);
    $("#" + id).select2({width: '100%'});
}

function cargarComponentes() {
    cargarSelect2();
}

function cargarSelect2() {
    $(".select2").select2({
        width: '100%'
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

function fileIsLoaded(e) {
    $('#secretFile').attr('value', e.target.result);
    document.getElementById('docId').value = '';
}

function cargarPantallaListar() {
    var url = URL_BASE + "vistas/com/plan/planSst.php";
    cargarDiv("#window", url);
}

function enviar(tipoAccion) {
    loaderShow(null);
    var codigo = document.getElementById('txtCodigo').value;
    var version = document.getElementById('txtVersion').value;
    var comentario = document.getElementById('txtComentario').value;
    var estado = document.getElementById('cboEstado').value;
    var documento = document.getElementById('secretFile').value;
    var docNombre = document.getElementById('file').value.slice(12);
    var docId = document.getElementById('docId').value;
    if (documento === '') {
        documento = null;
        docNombre = null;
    }

    if (tipoAccion === 'Nuevo') {
        crearPlanSst(codigo, version, comentario, documento, docNombre, docId, estado);
    } else {
        var id = document.getElementById('id').value;
        actualizarPlanSst(id, codigo, version, comentario, documento, docNombre, docId, estado);
    }
}

function crearPlanSst(codigo, version, comentario, documento, docNombre, docId, estado) {
    if (validarFormulario(codigo, version, documento, docId)) {
        deshabilitarBotones();
        ax.setAccion("crearPlanSst");
        ax.addParamTmp("codigo", codigo);
        ax.addParamTmp("version", version);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("documento", documento);
        ax.addParamTmp("docNombre", docNombre);
        ax.addParamTmp("estado", estado);
        ax.consumir();
    } else {
        loaderClose();
    }
}

function actualizarPlanSst(id, codigo, version, comentario, documento, docNombre, docId, estado) {
    if (validarFormulario(codigo, version, documento, docId)) {
        deshabilitarBotones();
        ax.setAccion("actualizarPlanSst");
        ax.addParamTmp("id", id);
        ax.addParamTmp("codigo", codigo);
        ax.addParamTmp("version", version);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("documento", documento);
        ax.addParamTmp("docNombre", docNombre);
        ax.addParamTmp("docId", docId);
        ax.addParamTmp("estado", estado);
        ax.consumir();
    } else {
        loaderClose();
    }
}

function validarFormulario(codigo, version, documento, docId) {
    var bandera = true;
    var espacio = /^\s+$/;
    limpiarMensajes();

    if (codigo === "" || codigo === null || espacio.test(codigo) || codigo.length === 0) {
        $("msjCodigo").removeProp(".hidden");
        $("#msjCodigo").text("El código es obligatorio").show();
        bandera = false;
    }
    if (isNaN(version)) {
        $("msjVersion").removeProp(".hidden");
        $("#msjVersion").text("La versión debe ser un número").show();
        bandera = false;
    }
    if ((documento === "" || documento === null || espacio.test(documento) || documento.length === 0)
            && docId === "") {
        $("msjDocumento").removeProp(".hidden");
        $("#msjDocumento").text("El documento es obligatorio").show();
        bandera = false;
    }
    return bandera;
}

function limpiarMensajes() {
    $("#msjCodigo").hide();
    $("#msjVersion").hide();
    $("#msjDocumento").hide();
}

function exitoCrear(data) {
    if (data[0]["vout_exito"] === 0) {
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        cargarPantallaListar();
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