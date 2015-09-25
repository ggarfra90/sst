/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoComite");
    listarComite();
    
    cargarComponentes();
    altura();
});

function listarComite() {
    ax.setAccion("listarComite");
    ax.consumir();
}

function exitoComite(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarComite':
                onResponseListarComite(response.data);
                onResponseVacio();
                altura();
                break;
            case 'cambiarEstado':
                cambiarIconoEstado();
                break;
            case 'cambiarPublicacion':
                listarComite();
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
    var url = URL_BASE + "vistas/com/comite/comite_form.php?winTitulo=" + titulo;
    cargarDiv("#window", url);
}

function onResponseListarComite(data) {
    $("#dataList").empty();
    var cuerpo_total = "";
    var cuerpo = "";
    var cuerpo_acc = "";
    var nombrec="";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Fecha de elección</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Inicio de actividades</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Fin de actividades</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Miembros</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Estado</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
                cuerpo_acc = "<a href='#' onclick='verDetalle(" + item.id + ")'><i class='fa fa-list-alt' style='color:#DB94B8;'></i></a>&nbsp;\n";
                if(item.nom_completo===null  || item.nom_completo===''){
            cuerpo_acc = "<a href='#' onclick='agregarMiembros(" + item.id + ")'><i class='fa fa-edit' style='color:#E8BA2F;'></i></a>&nbsp;\n";
            
            }
                cuerpo = "<tr>"
                    + "<td style='text-align:center;vertical-align:middle;'>" + item.fec_eleccion + "</td>"
                    + "<td style='text-align:center;vertical-align:middle;'>" + item.fec_inicio + "</td>"
                    + "<td style='text-align:center;vertical-align:middle;'>" + item.fec_fin + "</td>";
            if (item.miembros) {
                cuerpo = cuerpo + "<td style='text-align:center;vertical-align:middle;'>" + item.miembros + "</td>";
            } 
            if(item.nom_completo==null && !item.miembros){
                cuerpo = cuerpo + "<td style='text-align:center;vertical-align:middle;'>" + nombrec + "</td>";
            }
            if(item.nom_completo!==null && !item.miembros ) {
                cuerpo = cuerpo + "<td style='text-align:center;vertical-align:middle;'>" + item.nom_completo + "</td>";
            }

            if (item.estado === "1") {
                cuerpo = cuerpo + "<td style='text-align:center;vertical-align:middle;'><a href='#' onclick = 'cambiarEstado("
                        + item.id + ",\"" + "0\")' ><i id='e" + item.id
                        + "' class='ion-checkmark-circled' style='color:#5cb85c;'></i></a></td>";
            } else {
                cuerpo = cuerpo + "<td style='text-align:center;vertical-align:middle;'><a href='#' onclick = 'cambiarEstado("
                        + item.id + ",\"" + "1\")' ><i id='e" + item.id
                        + "' class='ion-flash-off' style='color:#cb2a2a;'></i></a></td>";
            }

            cuerpo = cuerpo + "<td style='text-align:center;vertical-align:middle;'>"
                    + cuerpo_acc
                    + "<a href='#' onclick='cargarPantallaListarReunion()' ><i class='fa fa-calendar' style='color:#1ca8dd;'></i></a>"
                    + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList").append(html);
    limpiaEspacio();

    loaderClose();
}
function cargarPantallaListarReunion() {
    $('.select2-hidden-accessible').remove();
    var url = URL_BASE + "vistas/com/comite/reunion.php?param=1";

    cargarDiv("#window", url);
}
function onResponseVacio() {
    $('#datatable').dataTable({
        "order": [[2, 'desc']],
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

function cambiarEstado(id, estado) {
    loaderShow(null);
    ax.setAccion("cambiarEstado");
    ax.addParamTmp("id", id);
    ax.addParamTmp("estado", estado);
    ax.consumir();
}

function cambiarIconoEstado() {
    $.Notification.autoHideNotify('success', 'top-right', '&Eacute;xito', 'Estado actualizado');
    listarComite();
}

function agregarMiembros(id) {
    var titulo = "Edición%20de";
    var url = URL_BASE + "vistas/com/comite/comite_form.php?winTitulo=" + titulo + "&id=" + id + "&readonly=true";
    cargarDiv("#window", url);
}
function verDetalle(id) {
    var titulo = "Información%20de";
    var url = URL_BASE + "vistas/com/comite/comite_form.php?winTitulo=" + titulo + "&id=" + id + "&idDet=" + id + "&readonly=true";
    cargarDiv("#window", url);
}
function editar(id) {
    var titulo = "Editar";
    var url = URL_BASE + "vistas/com/comite/comite_form.php?winTitulo=" + titulo + "&id=" + id + "&readonly=false";
    cargarDiv("#window", url);
}

function abrirModal(comentario) {
    $('#modalComentario').modal('show');
    document.getElementById("txtComentario").value = comentario;
}

function cambiarPublicacion(doc_id, estadoPublicacion) {
    loaderShow(null);
    ax.setAccion("cambiarPublicacion");
    ax.addParamTmp("documentoId", doc_id);
    ax.addParamTmp("estadoPublicacion", estadoPublicacion);
    ax.consumir();
}