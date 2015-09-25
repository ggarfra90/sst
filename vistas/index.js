var ax = new Ajaxp(URL_EXECUTECONTROLLER, 'POST', 'JSON');
var varCommons = {
    evaluacionId: 0,
    accion: 'editar'
};

function ocultarMenu(){
    $("ul").removeAttr("style");
}
function altura() {
    $("#espacio").height("0px");
    var h2 = 0;
    var h4 = 0;

    h2 = $(window).height();
    h4 = $("#cuerpo").outerHeight();

    var es = "<div id='espacio'></div>";
    $("#window").after(es);

    var vacio = h2 - (h4);
    $("#espacio").height(vacio);
}
function cargarDiv(div, url) {
    $('div').remove('.sweet-overlay');
    $('div').remove('.sweet-alert');
    $('.select2-hidden-accessible').remove();
    $('#espacio').remove();
    limpiaEspacio();
    altura();
    $("#window").html("");
    $(div).load(url);
}
function limpiaEspacio()
{
     $("#espacio").remove();
}
function active(j) {
    $("ul li ul li").removeClass("active");
    $("ul li ul #m" + j).addClass("active");
}
function cargarContenido(id, url) {
    cargarDiv("#window", URL_BASE + "vistas/com/" + url);
    active(id);
    // Seteamos la opción que me va a determinar el controlador
    ax.setOpcion(id);
}
function cargarDivGetPerfil(id) {
    $("#window").empty();
    cargarDiv("#window", "vistas/com/perfil/perfil_form.php?id=" + id + "&" + "tipo=" + 1);
}
//GCLV sería bueno utilizar este método
function obtenerPantallaPrincipal(id) {
    acciones.iniciaAjaxTest(COMPONENTES.PERFIL, "successPerfil");
    ax.setAccion("obtenerPantallaPrincipal");
    ax.addParamTmp("id_per", id);
    ax.consumir();
}
//Fin GCLV
function successPerfil(response) {
    if (response['status'] === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerPantallaPrincipal':
                cargarDiv("#window", response.data[0].url);
                break;
        }
    }
}