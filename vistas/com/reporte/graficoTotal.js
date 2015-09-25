/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var usuarioId = 0;
$(document).ready(function(){
    // verificamos si tiene un usuarioId
    usuarioId = document.getElementById("usuarioId").value;
    if (!isEmpty(usuarioId)){
        var usuarioCodAd = document.getElementById("usuarioCodAd").value;
        var url = URL_BASE + "vistas/com/reporte/graficoRRHH.php";
        $("#tituloPrincipal").html('<a onclick="cargarDiv(\'#window\', \''+url+'\')" title="Click para seleccionar otro usuario">Gráfico RRHH</a> > Gráfico de '+usuarioCodAd);
    }
    
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successReporteTotal");
    // obtenemos todos los años
    ax.setAccion("getAllAnios");
    ax.consumir();
    
    altura();
});

function successReporteTotal(response){
    if (response.status == 'ok'){
        switch(response[PARAM_ACCION_NAME]){
            case 'graficoGetTotal':
                loaderClose();
                onResponseGraficoGetTotal(response.data);
                break;
            case 'getAllAnios':
                onResponseGetAllAnios(response.data);
                break;
        }
    }else{
        switch(response[PARAM_ACCION_NAME]){
            case 'graficoGetTotal':
                loaderClose();
                break;
        }
    }
}
function onResponseGetAllAnios(data){
    var id = 0;
    $.each(data,function(index,value){
        if (id === 0) id = value.id;
        $('#cboAnio').append('<option value="' + value.id+ '">'+value.nombre+'</option>');
    });
    cargarSelect2();
    $('#cboAnio').val(id);
    getGrafico(id);
}
function onResponseGraficoGetTotal(data){
    if (isEmpty(data)) return;
    var usuariosTotal = data.usuariosTotal;
    var usuariosFaltantes = data.usuariosFaltantes;
    var nineBox = data.nineBox;
    
//    $("#tituloNineBox").html(data.titulo);
//    $("#descNineBox").html(data.descripcion);
    var html = "";
    var porcentaje = 0;
    $.each(nineBox, function(indexNB, itemNB){
        // calculamos y escribimos el porcentaje en el cuadrante
        porcentaje = Math.round((itemNB.cantidad*100/usuariosTotal) * 100) / 100;
        $("#cuadrante"+itemNB.valor).removeClass("disabled");
        $("#cuadrante"+itemNB.valor).removeClass("btn-cuadrante");
        $("#cuadrante"+itemNB.valor).addClass("cuadrante-seleccionado");
        $("#porcentaje"+itemNB.valor).html(porcentaje + '%');
        
        // escribimos el resumen
        html = '<a name="a'+itemNB.valor+'"></a>'+
                '<div class="info" id="info'+itemNB.valor+'">'+
                        '<h4>Usuarios en '+itemNB.valor+' ('+porcentaje+'%):</h4>'+
                        '<p class="text-muted"><ul>'+'</ul></p>';
        $.each(itemNB.usuarios, function(indexUsuario, itemUsuario){
            html += '<li>'+itemUsuario.cod_ad+'</li>';
        });
        html += '</div><br>';
        $("#contenedorResumen").append(html);
    });
    if (!isEmpty(usuariosFaltantes)){
        porcentaje = Math.round((usuariosFaltantes.length * 100/ usuariosTotal) * 100) / 100;
        html = '<div class="info">'+
                '<h4>Usuarios pendientes de evaluacion y/o PRP ('+porcentaje+'%):</h4>'+
                '<p class="text-muted"><ul>'+'</ul></p>';
        $.each(usuariosFaltantes, function(indexUsuario, itemUsuario){
            html += '<li>'+itemUsuario+'</li>';
        });
        html += '</div>';
        $("#contenedorResumen").append(html);
    }
}
function cargarSelect2(){
    $("#cboAnio").select2({
        width: '100%'
    })
    .on("change", function(e) {
        $(".info").removeClass("info-seleccionado");
        $(".cuadrante-seleccionado").addClass("btn-cuadrante");
        $(".btn-cuadrante").addClass("disabled");
        $(".btn-cuadrante").removeClass("cuadrante-seleccionado");
        $(".cuadrante-porcentaje").html("");
        $("#contenedorResumen").html("");
        
        getGrafico(e.val);
    });
}
function getGrafico(id){
    loaderShow("#window");
    ax.setAccion("graficoGetTotal");
    ax.addParamTmp("anioId", id);
    ax.addParamTmp("usuarioId", usuarioId);
    ax.consumir();
}
function infoSeleccionado(nB){
    $(".info").removeClass("info-seleccionado");
    $("#info"+nB).addClass("info-seleccionado");
    location.href="#a"+nB;
}