/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successReporteRRHH");
    // obtenemos todos los usuarios
    getAll();
    
    altura();
});

function getAll(){
    ax.setAccion("reporteGetRRHH");
    ax.consumir();
}

function successReporteRRHH(response){
    if (response.status == 'ok'){
        switch(response[PARAM_ACCION_NAME]){
            case 'reporteGetRRHH':
                onResponseReporteGetInmediato(response.data);
                break;
            case 'reporteGetNineBox':
                onResponseReporteGetNineBox(response.data);
                break;
            case 'updateComentario':
                $("#modalComentario").modal('hide');
                loaderClose();
                loaderClose();
                getAll();
                break;
        }
    }else{
        switch(response[PARAM_ACCION_NAME]){
            case 'updateComentario':
                loaderClose();
                break;
        }
    }
}

function onResponseReporteGetInmediato(data){
    if (isEmpty(data)) return;
    $.each(data, function(index, item){
        item["comentario"] = isEmpty(item["comentario"])?"": item["comentario"];
        var comentario = item["comentario"];
        var title = "Ver comentario";
        if (comentario.length > 120){
            comentario = comentario.slice(0, 115) + '...';
            title = "Ver todo el comentario";
        }else if (trim(comentario).length === 0){
            comentario = '<i class="fa fa-weixin"></i>';
            title = "Comentar";
        }
        comentario = '<a class="accionComentar" onClick="prepareComentar('+item['id']+', \''+item['comentario']+'\')" title="'+title+'">'+comentario+'</a>';
        data[index]["comentario_grid"] = comentario;
//        data[index]["opciones"] = '<a href="" onClick="visualizar('+item['evaluacion_valor']+', '+item['prp_valor']+')" class="btn btn-xs btn-success btn-custom" data-toggle="modal" data-placement="top" data-toggle="tooltip" data-original-title="Visualizar"><i class="fa fa-pencil-square-o"></i> Visualizar</a>\n';
        var opciones = '<form target="_blank" action="vistas/com/reporte/reporteInmediatoPDF.php" method="post">' +
            '<a onClick="visualizar('+item['evaluacion_valor']+', '+item['prp_valor']+')" class="accionVisualizar" title="Visualizar"><i class="fa fa-search"></i> </a>'+
            '<a onclick="parentNode.submit();" class="accionEliminar" title="Ver PDF"><i class="fa fa-file-pdf-o"></i> </a>' +
            '<input type="hidden" name="anio" value="'+item['anio']+'"/>'+
            '<input type="hidden" name="cod_ad" value="'+item['cod_ad']+'"/>'+
            '<input type="hidden" name="evaluacion_valor" value="'+item['evaluacion_valor']+'"/>'+
            '<input type="hidden" name="prp_valor" value="'+item['prp_valor']+'"/>';            
            '</form>';
        data[index]["opciones"] = opciones;
    });
    
    $('#datatable').dataTable( {
        "order": [[0, "desc"]],
        "data": data,
        "columns": [
            { "data": "anio" },
            { "data": "cod_ad" },
            { "data": "evaluacion_valor" },
            { "data": "prp_valor" },
            { "data": "comentario_grid" },
            { "data": "opciones" }
         ],
        "destroy": true
    });
}
function cargarModal()
{
    $('#modal').modal('show');
}
function tituloModal(titulo)
{
    $('.modal-title').empty();
    $('.modal-title').append(titulo);
}

function visualizar(evaluacionValor, prpValor){
    if (isEmpty(evaluacionValor) || isEmpty(prpValor)){
        mostrarAdvertencia("Primero debe completar la evaluación e ingresar el valor de PRP");
        return;
    }
    
    ax.setAccion("reporteGetNineBox");
    ax.addParamTmp("evaluacionValor", evaluacionValor);
    ax.addParamTmp("prpValor", prpValor);
    ax.consumir();
 }
 function onResponseReporteGetNineBox(data){
    tituloModal("Nine Box: " + data.valor);
    $(".btn-cuadrante").addClass("disabled");
    $(".btn-cuadrante").removeClass("cuadrante-seleccionado");
    $("#cuadrante"+data.valor).removeClass("disabled");
    $("#cuadrante"+data.valor).addClass("cuadrante-seleccionado");
    $("#tituloNineBox").html(data.titulo);
    $("#descNineBox").html(data.descripcion);
    cargarModal();
}
function prepareComentar(id, comentario){
    document.getElementById("evaluacionId").value = id;
    document.getElementById("comentario").value = comentario;
    $('#modalComentario').modal('show');
}
function comentar(){
    var evaluacionId = document.getElementById("evaluacionId").value;
    var comentario = document.getElementById("comentario").value;
    if (isEmpty(evaluacionId)){
        mostrarAdvertencia("No se especificaron parámetros válidos");
        return;
    }
    loaderShow(".modal-content");
    ax.setAccion("updateComentario");
    ax.addParamTmp("evaluacionId", evaluacionId);
    ax.addParamTmp("comentario", comentario);
    ax.consumir();
}