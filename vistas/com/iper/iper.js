/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
   // loaderShow(null);
   // ax.setSuccess("exitoIperProcedimiento");

    cargarComponentes();
    altura();
});



function exitoIperProcedimiento(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarIperProcedimiento':
                onResponseListarIperProcedimiento(response.data);
                estructuraDataTable();
                break;
            case 'cambiarEstado':
                cambiarIconoEstado();
                break;
            case 'cambiarPublicacion':
                listarIperProcedimiento();
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
    var url = URL_BASE + "vistas/com/iper/iper_form.php?winTitulo=" + titulo;
    cargarDiv("#window", url);
}
function nuevoValoracionRiesgos() {
    
    var url = URL_BASE + "vistas/com/iper/iperValoracion_form.php";
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

