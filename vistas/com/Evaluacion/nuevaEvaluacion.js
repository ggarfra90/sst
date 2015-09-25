/* 
 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var banderaAgregar = 0;
var preguntas = null;
$(document).ready(function(){
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successNuevaEvaluacion");
    ocultaBotones();
    // obtenemos todas las preguntas
    ax.setAccion("getAllPreguntas");
    ax.addParamTmp("evaluacionId", varCommons.evaluacionId);
    ax.consumir();
});
function ocultaBotones(){
    if (varCommons.accion == 'visualizar'){
        $("#btnGuardar").hide();
        $("#btnEnviar").hide();
    }else{
        $("#btnGuardar").show();
        $("#btnEnviar").show();
    }
}
function successNuevaEvaluacion(response){
    if (response.status == 'ok'){
        switch(response[PARAM_ACCION_NAME]){
            case 'getAllPreguntas':
                preguntas = response.data;
                onResponseGetAllPreguntas();
                break;
            case 'savePreguntas':
                if (response[PARAM_TAG] == 1){
                    swal("Finalizada!", "La evaluación fue finalizada satisfactoriamente.", "success"); 
                }
                cargarDiv('#window', 'vistas/com/evaluacion/evaluacion.php');
                break;
        }
    }else{
        switch(response[PARAM_ACCION_NAME]){
            case 'savePreguntas':
                console.log(response[PARAM_TAG]);
                if (response[PARAM_TAG] == 1){
                    swal("Error!", "La evaluación no se pudo finalizar correctamente.", "error"); 
                }
                loaderClose();
                break;
        }
    }
}
function onResponseGetAllPreguntas()
{
    $.each(preguntas, function(index, value){
        var value0, value1, value2, value3;
        value0 = (value.valor == 0)? "checked='checked'": "";
        value1 = (value.valor == 1)? "checked='checked'": "";
        value2 = (value.valor == 2)? "checked='checked'": "";
        value3 = (value.valor == 3)? "checked='checked'": "";
        $("#bodyTabla").append("<tr class='marcadoF" + index + "'>" +
            "<td style='text-align:left;'>" + value.descripcion + "</td>" +
            "<td style='text-align:center;'> <label><input type='radio' name='radio_" + value.formato_id + "' value='0' " + value0 + "></label> </td>" +
            "<td style='text-align:center;'> <label><input type='radio' name='radio_" + value.formato_id + "' value='1' " + value1 + "></label> </td>" +
            "<td style='text-align:center;'> <label><input type='radio' name='radio_" + value.formato_id + "' value='2' " + value2 + "></label> </td>" +
            "<td style='text-align:center;'> <label><input type='radio' name='radio_" + value.formato_id + "' value='3' " + value3 + "></label> </td>" +
            "</tr>");
    });
}

function enviar(){
    swal({   
        title: "¿Está seguro que desea finalizar la evaluación?",   
        text: "Tener en cuenta que una vez finalizada la evaluación ya no podrá editarla.",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Si, Finalizar!",   
        closeOnConfirm: false 
    }, function(){   
        guardar(true);
    });
}

function guardar(enviar){
    var isOk = true;
    $.each(preguntas, function(index, value){
        preguntas[index].valor = $('input[name="radio_'+value.formato_id+'"]:checked').val();
        if (isEmpty(preguntas[index].valor)){
            if (enviar){
//                mostrarAdvertencia("Debe llenar todas las preguntas.");
                swal("Error!", "Debe llenar todas las preguntas.", "error"); 
                isOk = false;
                return isOk;
            }
        }
    });
    if (isOk){
        enviar = (enviar)? 1:0;
        loaderShow("#evaluacionContenedor");
        ax.setAccion("savePreguntas");
        ax.addParamTmp("enviar", enviar);
        ax.addParamTmp("preguntas", preguntas);
        ax.addParamTmp("evaluacionId", varCommons.evaluacionId);
        ax.setTag(enviar);
        ax.consumir();
    }
}
function cancelar()
{
    cargarDiv('#window', 'vistas/com/evaluacion/evaluacion.php');
}