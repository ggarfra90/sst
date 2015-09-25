/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successEvaluacion");
    // obtenemos todos los usuarios
    getAll();
    // obtenemos los usuarios
    ax.setAccion("getAllUsuarios");
    ax.consumir();
    
    // obtenemos los años
    ax.setAccion("getAllAnios");
    ax.consumir();
    
    cargarComponentes();
    altura();
});

function getAll(){
    ax.setAccion("getAll");
    ax.consumir();
}

function successEvaluacion(response){
    if (response.status == 'ok'){
        switch(response[PARAM_ACCION_NAME]){
            case 'getAll':
                onResponseGetAll(response.data);
                break;
            case 'getAllUsuarios':
                onResponseGetAllUsuarios(response.data);
                break;
            case 'getAllAnios':
                onResponseGetAllAnios(response.data);
                break;
            case 'save':
                // guardamos el id que me trae en data
                if (response.data <= 0){
                    mostrarAdvertencia("No se pudo guardar, intentelo más tarde")
                    loaderClose();
                    return;
                }
                varCommons.evaluacionId = response.data;
                varCommons.accion = 'editar';
                $("div").removeClass("modal-backdrop fade in");

                cargarDiv('#window', 'vistas/com/evaluacion/nuevaEvaluacion.php');
                break;
            case 'delete':
                getAll();
                break;
        }
    }else{
        switch(response[PARAM_ACCION_NAME]){
            case 'save':
                loaderClose();
                break;
        }
    }
}

function onResponseGetAll(data){
    var opciones = "";
    $.each(data, function(index, item){
        var editar = '<a onClick="prepareEdit(\''+item['anio_id']+'\', \''+item['usuario_id']+'\','+item['estado']+')" class="accionEditar" title="Editar"><i class="fa fa-pencil-square-o"></i></a>\n';
        var eliminar = '<a onClick="deleteEvaluacion('+item['id']+')" class="accionEliminar" title="Eliminar"><i class="fa fa-trash"></i></a>';
        var visualizar = '<a onClick="visualizar('+item['id']+')" class="accionVisualizar" title="Visualizar"><i class="fa fa-search"></i></a>\n';
        switch (item.estado){
            case '1':
                data[index]["estado_desc"] = "Activo";
                opciones = editar + eliminar;
                break;
            case '0':
                data[index]["estado_desc"] = "Inactivo";
                opciones = editar + eliminar;
                break;
            case '3':
                data[index]["estado_desc"] = "Finalizado";
                opciones = visualizar;
                break;
        }
        data[index]["opciones"] = opciones;
    });
    
    $('#datatable').dataTable( {
        "order": [[0, "desc"]],
        "data": data,
        "columns": [
            { "data": "anio" },
            { "data": "cod_ad" },
            { "data": "estado_desc", "class": "center" },
            { "data": "opciones", "class": "center" }
         ],
        "destroy": true
    });
}
function prepareEdit(anioId, usuarioId, estado)
{
    asignarValorSelect2("cboUsuario", usuarioId);
    asignarValorSelect2("cboAnio", anioId);
    asignarValorSelect2("cboEstado", estado);
    $("#cboUsuario").select2("readonly", true);
    $("#cboAnio").select2("readonly", true);
    tituloModal("Editar");
    cargarModal();
}
function deleteEvaluacion(id)
{
    ax.setAccion("delete");
    ax.addParamTmp("id", id);
    ax.consumir();
}
function nuevo()
{
    banderaAgregar = 0;
    asignarValorSelect2("cboUsuario","");
    asignarValorSelect2("cboAnio","");
    asignarValorSelect2("cboEstado",1);
    tituloModal("Nuevo");
    cargarModal();
    $("#cboUsuario").select2("readonly", false);
    $("#cboAnio").select2("readonly", false);
}

function onResponseGetAllUsuarios(data){
    $.each(data,function(index,value){
        $('#cboUsuario').append('<option value="' + value.id+ '">'+value.cod_ad+'</option>');
    });
}

function onResponseGetAllAnios(data){
    $.each(data,function(index,value){
        $('#cboAnio').append('<option value="' + value.id+ '">'+value.nombre+'</option>');
    });
}

function cargarModal()
{
    $('#modal').modal('show');
}
function cargarComponentes()
{
    cargarSelect2();
}
function cargarSelect2()
{
    $(".select2").select2({
        width: '100%'
    });
}

function tituloModal(titulo)
{
    $('.modal-title').empty();
    $('.modal-title').append(titulo);
}

function asignarValorSelect2(id, valor)
{
    $("#" + id).select2().select2("val", valor);
    $("#" + id).select2({width: '100%'});
//    $("#" + id).select2("readonly", true);
}

function eliminar()
{
    confirmarEliminacion();
//    $.Notification.autoHideNotify('error', 'top right', 'pregunta eliminada', '');
}

function nuevaEvaluacion()
{
    var usuarioId, anioId, estado;
    usuarioId = $('#cboUsuario').val();
    anioId = $('#cboAnio').val();
    estado = $('#cboEstado').val();
    breakFunction();
    if (isEmpty(usuarioId) || isEmpty(anioId)){
        mostrarAdvertencia("Debe ingresar año y usuario");
    }
    
    loaderShow(".modal-content");
    ax.setAccion("save");
    ax.addParamTmp("usuarioId", usuarioId);
    ax.addParamTmp("anioId", anioId);
    ax.addParamTmp("estado", estado);
    ax.consumir();    
}

function confirmarEliminacion() {
    swal({
        title: "Est\xe1s seguro?",
        text: "Eliminaras la evaluacion !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#33b86c",
        confirmButtonText: "Si, eliminar!",
        cancelButtonColor: '#d33',
        cancelButtonText: "No, cancelar !",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {

        if (isConfirm) {

           swal("Eliminada!", "", "success");

        } else {
            swal("Cancelada", "La eliminaci\xf3n fue cancelada", "error");
        }
    });
}

function visualizar(id){
    varCommons.evaluacionId = id;
    varCommons.accion = 'visualizar';
    $("div").removeClass("modal-backdrop fade in")
    cargarDiv('#window', 'vistas/com/evaluacion/nuevaEvaluacion.php');
}