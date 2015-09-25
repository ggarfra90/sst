/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successUsuario");
    // obtenemos todos los usuarios
    getAll();
    // obtenemos los usuarios de la bd de recursos
    ax.setAccion("getAllRecursos");
    ax.consumir();
    
    ax.setAccion("getAllPerfil");
    ax.consumir();
    
    cargarComponentes();
    altura();
});

function getAll(){
    ax.setAccion("getAll");
    ax.consumir();
}

function successUsuario(response){
    if (response.status == 'ok'){
        switch(response[PARAM_ACCION_NAME]){
            case 'getAll':
                onResponseGetAll(response.data);
                break;
            case 'getAllRecursos':
                onResponseGetAllRecursos(response.data);
                break;
            case 'save':
                $("#modalUsuario").modal('hide');
                loaderClose();
                getAll();
                break;
            case 'delete':
                getAll();
                break;
            case 'getAllPerfil':
                onResponseGetAllPerfil(response.data);
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
    $.each(data, function(index, item){
        data[index]["estado_desc"] = (data[index]["estado"] == 1)? "Activo" : "Inactivo";
        data[index]["opciones"] = '<a onClick="prepareEditUsuario(\''+item['cod_ad']+'\', \''+item['jefe_cod_ad']+'\', \''+item['gerente_cod_ad']+'\',\''+item['perfiles_id']+'\', '+item['estado']+')" class="accionEditar" title="Editar"><i class="fa fa-pencil-square-o"></i> </a>\n\
                                    <a onClick="eliminarUsuario('+item['id']+')" class="accionEliminar" title="Eliminar"><i class="fa  fa-trash"></i> </a>';
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

function onResponseGetAllRecursos(data){
    $.each(data,function(index,value){
        $('#cboUsuario').append('<option value="' + value.cod_ad+ '">'+value.cod_ad+'</option>');
    });
    $.each(data,function(index,value){
        $('#cboJefe').append('<option value="' + value.cod_ad+ '">'+value.cod_ad+'</option>');
    });
    $.each(data,function(index,value){
        $('#cboGerente').append('<option value="' + value.cod_ad+ '">'+value.cod_ad+'</option>');
    });
}

function onResponseGetAllPerfil(data){
    $.each(data,function(index,value){
        $('#cboPerfil').append('<option value="' + value.id+ '">'+value.nombre+'</option>');
    });
}


function cargarModal()
{
    $('#modalUsuario').modal('show');
}

function cargarComponentes()
{
    cargarDatePicker();
    cargarSelect2();
}

function cargarDatePicker()
{
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d',
        language: 'es',
        width: '100%'
    });
}

function cargarSelect2()
{
    $(".select2").select2({
        width: '100%'
    });
}

function guardar()
{
    var cod_ad, jefe_cod_ad, gerente_cod_ad, perfiles, estado;
    cod_ad = $('#cboUsuario').val();
    jefe_cod_ad = $('#cboJefe').val();
    gerente_cod_ad = $('#cboGerente').val();
    perfiles = $('#cboPerfil').val();
    estado = $('#cboEstado').val();
    if (isEmpty(cod_ad) || isEmpty(jefe_cod_ad) || isEmpty(gerente_cod_ad)){
        mostrarAdvertencia("Debe ingresar usuario, jefe, gerente y perfil");
        return;
    }
    loaderShow(".modal-content");
    ax.setAccion("save");
    ax.addParamTmp("cod_ad", cod_ad);
    ax.addParamTmp("jefe_cod_ad", jefe_cod_ad);
    ax.addParamTmp("gerente_cod_ad", gerente_cod_ad);
    ax.addParamTmp("perfiles", perfiles);
    ax.addParamTmp("estado", estado);
    ax.consumir();
}

function nuevo()
{
    asignarValorSelect2("cboUsuario","");
    asignarValorSelect2("cboJefe","");
    asignarValorSelect2("cboGerente","");
    asignarValorSelect2("cboPerfil","");
    asignarValorSelect2("cboEstado",1);
    tituloModal("Nuevo");
    cargarModal();
}

function prepareEditUsuario(usuario_cod_ad, jefe_cod_ad, gerente_cod_ad, perfiles_id, estado)
{
    asignarValorSelect2("cboUsuario",usuario_cod_ad);
    asignarValorSelect2("cboJefe",jefe_cod_ad);
    asignarValorSelect2("cboGerente",gerente_cod_ad);
    asignarValorSelect2("cboPerfil",perfiles_id.split(";"));
    asignarValorSelect2("cboEstado",estado);
    tituloModal("Editar");
    cargarModal();
}

function tituloModal(titulo)
{
    $('.modal-title').empty();
    $('.modal-title').append(titulo);
}

function asignarValorSelect2(id,valor)
{
    $("#"+id).select2().select2("val",valor);
    $("#"+id).select2({width: '100%'});
}

function eliminarUsuario(id)
{
    ax.setAccion("delete");
    ax.addParamTmp("id", id);
    ax.consumir();
}