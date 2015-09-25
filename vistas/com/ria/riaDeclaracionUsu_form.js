/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var c = $('#btnGuardar i').attr('class');

$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoRiaDeclaracionUsu");
    ax.setAccion("obtenerTipoEvento");
    ax.consumir();
    ax.setAccion("obtenerTipoParticipacion");
    ax.consumir();

    cargarComponentes();
    altura();
});

function exitoRiaDeclaracionUsu(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerTipoEvento':
                onResponseObtenerTipoEvento(response.data);
                break;
            case 'obtenerTipoParticipacion':
                onResponseObtenerTipoParticipacion(response.data);
                loaderClose();
                break;
            case 'crearRiaDeclaracion':
                exitoCrear(response.data);
                loaderClose();
                break;
        }
    }
}

function onResponseObtenerTipoEvento(data) {
    if (!isEmpty(data)) {
        $('#cboEveTipo').append('<option></option>');
        $.each(data, function (index, item) {
            $('#cboEveTipo').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
        });
    }
}

function onResponseObtenerTipoParticipacion(data) {
    if (!isEmpty(data)) {
        $('#cboEveParticipacion').append('<option></option>');
        $.each(data, function (index, item) {
            $('#cboEveParticipacion').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
        });
    }
}

function cargarComponentes() {
    cargarSelect2();
    cargarCalendarios();
    cargarHorarios();
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
}

function limpiarPantalla() {
    var url = URL_BASE + "vistas/com/ria/riaDeclaracionUsu_form.php";
    cargarDiv("#window", url);
}

function enviar() {
    loaderShow(null);
    var eveFecha = document.getElementById('txtEveFecha').value;
    var eveHora = document.getElementById('txtEveHora').value;
    var eveTipoId = document.getElementById('cboEveTipo').value;
    var eveParticipacionId = document.getElementById('cboEveParticipacion').value;
    var reuLugar = document.getElementById('txtReuLugar').value;
    var reuFecha = document.getElementById('txtReuFecha').value;
    var reuHoraIni = document.getElementById('txtReuHoraIni').value;
    var reuHoraFin = document.getElementById('txtReuHoraFin').value;
    var decPregunta1 = document.getElementById('txtDecPregunta1').value;
    var decPregunta2 = document.getElementById('txtDecPregunta2').value;
    var decPregunta3 = document.getElementById('txtDecPregunta3').value;
    var decPregunta4 = document.getElementById('txtDecPregunta4').value;
    var decPregunta5 = document.getElementById('txtDecPregunta5').value;
    var decPregunta6 = document.getElementById('txtDecPregunta6').value;
    var decPregunta7 = document.getElementById('txtDecPregunta7').value;
    var decPregunta8 = document.getElementById('txtDecPregunta8').value;
    var regDescripcion = document.getElementById('txtRegDescripcion').value;
    var documento = document.getElementById('secretFile').value;
    var docNombre = document.getElementById('file').value.slice(12);
    if (documento === '') {
        documento = null;
        docNombre = null;
    }

    crearRiaDeclaracion(eveFecha, eveHora, eveTipoId, eveParticipacionId, reuLugar, reuFecha,
            reuHoraIni, reuHoraFin, decPregunta1, decPregunta2, decPregunta3, decPregunta4,
            decPregunta5, decPregunta6, decPregunta7, decPregunta8, regDescripcion, documento, docNombre);
}

function crearRiaDeclaracion(eveFecha, eveHora, eveTipoId, eveParticipacionId, reuLugar, reuFecha,
        reuHoraIni, reuHoraFin, decPregunta1, decPregunta2, decPregunta3, decPregunta4,
        decPregunta5, decPregunta6, decPregunta7, decPregunta8, regDescripcion, documento, docNombre) {
    if (validarFormulario(eveFecha, eveHora, eveTipoId, eveParticipacionId, reuLugar, reuFecha,
            reuHoraIni, reuHoraFin, decPregunta1, decPregunta4, decPregunta6, decPregunta7,
            decPregunta8, regDescripcion, documento)) {
        deshabilitarBotones();
        ax.setAccion("crearRiaDeclaracion");
        ax.addParamTmp("eveFecha", eveFecha);
        ax.addParamTmp("eveHora", eveHora);
        ax.addParamTmp("eveTipoId", eveTipoId);
        ax.addParamTmp("eveParticipacionId", eveParticipacionId);
        ax.addParamTmp("reuLugar", reuLugar);
        ax.addParamTmp("reuFecha", reuFecha);
        ax.addParamTmp("reuHoraIni", reuHoraIni);
        ax.addParamTmp("reuHoraFin", reuHoraFin);
        ax.addParamTmp("decPregunta1", decPregunta1);
        ax.addParamTmp("decPregunta2", decPregunta2);
        ax.addParamTmp("decPregunta3", decPregunta3);
        ax.addParamTmp("decPregunta4", decPregunta4);
        ax.addParamTmp("decPregunta5", decPregunta5);
        ax.addParamTmp("decPregunta6", decPregunta6);
        ax.addParamTmp("decPregunta7", decPregunta7);
        ax.addParamTmp("decPregunta8", decPregunta8);
        ax.addParamTmp("regDescripcion", regDescripcion);
        ax.addParamTmp("documento", documento);
        ax.addParamTmp("docNombre", docNombre);
        ax.consumir();
    } else {
        $("msjTabErrores").removeProp(".hidden");
        loaderClose();
    }
}

function validarFormulario(eveFecha, eveHora, eveTipoId, eveParticipacionId, reuLugar, reuFecha,
        reuHoraIni, reuHoraFin, decPregunta1, decPregunta4, decPregunta6, decPregunta7,
        decPregunta8, regDescripcion, documento) {
    var bandera = true;
    var espacio = /^\s+$/;
    var msjTab = "Por favor revise la(s) pestaña(s): ";
    var msjTabEvento = "";
    var msjTabReunion = "";
    var msjTabDeclaracion = "";
    var msjTabRegistro = "";
    limpiarMensajes();

    if (eveFecha === "" || eveFecha === null || espacio.test(eveFecha) || eveFecha.length === 0) {
        $("msjEveFecha").removeProp(".hidden");
        $("#msjEveFecha").text("La fecha de evento es obligatoria").show();
        msjTabEvento = "Evento";
        bandera = false;
    }
    if (eveHora === "" || eveHora === null || espacio.test(eveHora) || eveHora.length === 0) {
        $("msjEveHora").removeProp(".hidden");
        $("#msjEveHora").text("La hora de evento es obligatoria").show();
        msjTabEvento = "Evento";
        bandera = false;
    }
    if (eveTipoId === "" || eveFecha === null || espacio.test(eveFecha) || eveFecha.length === 0) {
        $("msjEveTipo").removeProp(".hidden");
        $("#msjEveTipo").text("El tipo de evento es obligatorio").show();
        msjTabEvento = "Evento";
        bandera = false;
    }
    if (eveParticipacionId === "" || eveParticipacionId === null || espacio.test(eveParticipacionId) || eveParticipacionId.length === 0) {
        $("msjEveParticipacion").removeProp(".hidden");
        $("#msjEveParticipacion").text("El tipo de participación es obligatorio").show();
        msjTabEvento = "Evento";
        bandera = false;
    }
    if (reuLugar === "" || reuLugar === null || espacio.test(reuLugar) || reuLugar.length === 0) {
        $("msjReuLugar").removeProp(".hidden");
        $("#msjReuLugar").text("El lugar de reunión es obligatorio").show();
        msjTabReunion = "Reunión";
        bandera = false;
    }
    if (reuFecha === "" || reuFecha === null || espacio.test(reuFecha) || reuFecha.length === 0) {
        $("msjReuFecha").removeProp(".hidden");
        $("#msjReuFecha").text("La fecha de reunión es obligatoria").show();
        msjTabReunion = "Reunión";
        bandera = false;
    }
    if (reuHoraIni === "" || reuHoraIni === null || espacio.test(reuHoraIni) || reuHoraIni.length === 0) {
        $("msjReuHoraIni").removeProp(".hidden");
        $("#msjReuHoraIni").text("La hora de inicio de la reunión es obligatoria").show();
        msjTabReunion = "Reunión";
        bandera = false;
    }
    if (reuHoraFin === "" || reuHoraFin === null || espacio.test(reuHoraFin) || reuHoraFin.length === 0) {
        $("msjReuHoraFin").removeProp(".hidden");
        $("#msjReuHoraFin").text("La hora de fin de la reunión es obligatoria").show();
        msjTabReunion = "Reunión";
        bandera = false;
    }
    if (decPregunta1 === "" || decPregunta1 === null || espacio.test(decPregunta1) || decPregunta1.length === 0) {
        $("msjDecPregunta1").removeProp(".hidden");
        $("#msjDecPregunta1").text("La respuesta a esta pregunta es obligatoria").show();
        msjTabDeclaracion = "Declaración";
        bandera = false;
    }
    if (decPregunta4 === "" || decPregunta4 === null || espacio.test(decPregunta4) || decPregunta4.length === 0) {
        $("msjDecPregunta4").removeProp(".hidden");
        $("#msjDecPregunta4").text("La respuesta a esta pregunta es obligatoria").show();
        msjTabDeclaracion = "Declaración";
        bandera = false;
    }
    if (decPregunta6 === "" || decPregunta6 === null || espacio.test(decPregunta6) || decPregunta6.length === 0) {
        $("msjDecPregunta6").removeProp(".hidden");
        $("#msjDecPregunta6").text("La respuesta a esta pregunta es obligatoria").show();
        msjTabDeclaracion = "Declaración";
        bandera = false;
    }
    if (decPregunta7 === "" || decPregunta7 === null || espacio.test(decPregunta7) || decPregunta7.length === 0) {
        $("msjDecPregunta7").removeProp(".hidden");
        $("#msjDecPregunta7").text("La respuesta a esta pregunta es obligatoria").show();
        msjTabDeclaracion = "Declaración";
        bandera = false;
    }
    if (decPregunta8 === "" || decPregunta8 === null || espacio.test(decPregunta8) || decPregunta8.length === 0) {
        $("msjDecPregunta8").removeProp(".hidden");
        $("#msjDecPregunta8").text("La respuesta a esta pregunta es obligatoria").show();
        msjTabDeclaracion = "Declaración";
        bandera = false;
    }
    if (regDescripcion === "" || regDescripcion === null || espacio.test(regDescripcion) || regDescripcion.length === 0) {
        $("msjRegDescripcion").removeProp(".hidden");
        $("#msjRegDescripcion").text("La descripción del registro es obligatorio").show();
        msjTabRegistro = "Registro";
        bandera = false;
    }
    if (documento === "" || documento === null || espacio.test(documento) || documento.length === 0) {
        $("msjRegEvidencia").removeProp(".hidden");
        $("#msjRegEvidencia").text("El registro fotográfico es obligatorio").show();
        msjTabRegistro = "Registro";
        bandera = false;
    }
    msjTab = msjTab + msjTabEvento + " - " + msjTabReunion + " - " + msjTabDeclaracion + " - " + msjTabRegistro;
    $("#msjTabErrores").text(msjTab).show();
    return bandera;
}

function limpiarMensajes() {
    $("#msjEveFecha").hide();
    $("#msjEveHora").hide();
    $("#msjEveTipo").hide();
    $("#msjEveParticipacion").hide();
    $("#msjReuLugar").hide();
    $("#msjReuFecha").hide();
    $("#msjReuHoraIni").hide();
    $("#msjReuHoraFin").hide();
    $("#msjDecPregunta1").hide();
    $("#msjDecPregunta4").hide();
    $("#msjDecPregunta6").hide();
    $("#msjDecPregunta7").hide();
    $("#msjDecPregunta8").hide();
    $("#msjRegDescripcion").hide();
    $("#msjRegEvidencia").hide();
    $("#msjTabErrores").hide();
}

function exitoCrear(data) {
    if (data[0]["vout_exito"] === 0) {
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        limpiarPantalla();
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




function cargarCalendarios() {
    $("#txtEveFecha").datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: "true"
    }).on('changeDate', function (ev) {
        var f = new Date(ev.date);
        var f2 = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + (f.getDate() + 1);

        $("#txtReuFecha").datepicker('setStartDate', f2);
        $("#txtReuFecha").datepicker('setDate', f2);
    });
    $("#txtReuFecha").datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: "true"
    });
}

function cargarHorarios() {
    $('#txtEveHora').timepicker({defaultTIme: false});
    $('#txtReuHoraIni').timepicker({defaultTIme: false});
    $('#txtReuHoraFin').timepicker({defaultTIme: false});
}