/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successGraficoRRHH");
    // obtenemos todos los usuarios
    getAll();
    altura();
});

function getAll(){
    ax.setAccion("getAllUsuarios");
    ax.consumir();
}

function successGraficoRRHH(response){
    if (response.status == 'ok'){
        switch(response[PARAM_ACCION_NAME]){
            case 'getAllUsuarios':
                onResponseGetAll(response.data);
                break;
        }
    }
}

function onResponseGetAll(data){
    $.each(data, function(index, item){
        data[index]["estado_desc"] = (data[index]["estado"] == 1)? "Activo" : "Inactivo";
        data[index]["opciones"] = '<a onClick="reportar('+item['id']+', \''+item['cod_ad']+'\')" class="accionVisualizar" title="Reportar"><i class="ion-arrow-graph-up-right"></i> </a>';
    });
    
    $('#datatable').dataTable( {
        "order": [[0, "desc"]],
        "data": data,
        "columns": [
            { "data": "cod_ad" },
            { "data": "jefe_cod_ad" },
            { "data": "gerente_cod_ad" },
            { "data": "perfiles" },
            { "data": "estado_desc" },
            { "data": "opciones" }
         ],
        "destroy": true
    });
}
function reportar(id, codAd){
    var url = URL_BASE+"vistas/com/reporte/graficoTotal.php?usuarioId="+id+"&usuarioCodAd="+codAd;
    cargarDiv("#window", url);
}
function grafRrhhPdf(id, codAd){
    var url = URL_BASE+"vistas/com/reporte/graficoTotal.php?usuarioId="+id+"&usuarioCodAd="+codAd;

    $(".left-panel").remove();
    $(".top-head").remove();
    $("#window").remove("page-title");
    cargarDiv("#window", url);
}