/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var banderaAgregar = 0;
$(document).ready(function () {
    // seteamos la función del ajax en caso de éxito
    ax.setSuccess("successPRP");
    getAll();

    ax.setAccion("getAllUsuarios");
    ax.consumir();

    ax.setAccion("getAllAnios");
    ax.consumir();
    
    cargarComponentes();
//    altura();
});

function getAll() {

    ax.setAccion("getAll");
    ax.consumir();
}

function successPRP(response) {
    if (response.status == 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
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
                $("#modalPRP").modal('hide');
                loaderClose();
                getAll();
                break;
            case 'delete':
                getAll();
                break;
            case 'importPRP':
                getAll();
                break;

        }
    }else{
        switch (response[PARAM_ACCION_NAME]) {
            case 'importPRP':
                getAll();
                break;
            case 'save':
                loaderClose();
                break;
        }
    }
        
}

function onResponseGetAll(data) {

    $.each(data, function (index, item) {
//        data[index]["estado"] = (data[index]["estado"] == 1)? "Activo" : "Inactivo";
        data[index]["opciones"] = '<a onClick="prepareEditPRP(' + item['anio_id'] + ',' + item['usuario_id'] + ',' + item['valor'] + ')" class="accionEditar" title="Editar"><i class="fa fa-pencil-square-o"></i></a>\n\
                                    <a onClick="eliminarPRP(' + item['id'] + ')" class="accionEliminar" title="Eliminar"><i class="fa  fa-trash"></i></button>';
    });

    $('#datatable').dataTable({
        order: [[0, "desc"]],
        "data": data,
        "columns": [
            {"data": "anio"},
            {"data": "cod_ad"},
            {"data": "valor"},
            {"data": "opciones"}
        ],
        "destroy": true
    });
}

function onResponseGetAllUsuarios(data) {
    $.each(data, function (index, value) {
        $('#cboUsuario').append('<option value="' + value.id + '">' + value.cod_ad + '</option>');
    });
}

function onResponseGetAllAnios(data) {
    $.each(data, function (index, value) {
        $('#cboAnio').append('<option value="' + value.id + '">' + value.nombre + '</option>');
    });
}

function cargarDateTable()
{
//    $('#datatable').dataTable();
}

function cargarModal()
{
    $('#modalPRP').modal('show');
}

function cargarComponentes()
{
    cargarDatePicker();
    cargarSelect2();
    cargarDateTable();
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
//    $(".select2").select2({
//        width: '100%'
//
//    });
}

function guardar()
{
    var anio_id, usuario, valor;
    anio_id = $('#cboAnio').val();
    usuario = $('#cboUsuario').val();
    valor = $('#cboValor').val();
    breakFunction();
    if (isEmpty(anio_id) || isEmpty(usuario) || isEmpty(valor)) {
        mostrarAdvertencia("Debe seleccionar año, usuario y valor");
        return;
    }
    
    loaderShow(".modal-content");
    ax.setAccion("save");
    ax.addParamTmp("anio_id", anio_id);
    ax.addParamTmp("usuario", usuario);
    ax.addParamTmp("valor", valor);
    ax.consumir();

}

function nuevo()
{
    asignarValorSelect2("cboAnio", "");
    asignarValorSelect2("cboUsuario", "");
    asignarValorSelect2("cboValor", "");
    tituloModal("Nuevo");
    cargarModal();
}

function prepareEditPRP(anio, cod_ad, valor)
{
    asignarValorSelect2("cboAnio", anio);
    asignarValorSelect2("cboUsuario", cod_ad);
    asignarValorSelect2("cboValor", valor);
    $("#cboAnio").select2("readonly", true);
    $("#cboUsuario").select2("readonly", true);
    tituloModal("Editar");
    cargarModal();
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
}

function eliminar()
{
//    alert("PRP eliminado");
    confirmarEliminacion();
}

function confirmarEliminacion() {
    swal({
        title: "Est\xe1s seguro?",
        text: "Eliminaras el PRP !",
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

            swal("Eliminado!", "", "success");

        } else {
            swal("Cancelado", "La eliminaci\xf3n fue cancelada", "error");
        }
    });
}

function eliminarPRP(id)
{
    ax.setAccion("delete");
    ax.addParamTmp("id", id);
    ax.consumir();
}

function importPRP() {

    var file = document.getElementById('secret').value;
    ax.setAccion("importPRP");
    ax.addParam("file", file);
    ax.consumir();
}

