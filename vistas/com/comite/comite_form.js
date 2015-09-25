/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var c = $('#btnEnviar i').attr('class');
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
 limpiaEspacio();
    altura();
});
  

    $("#cboColaborador").change(function (){
        $("#msjColaborador").hide();
    });
    $("#cboCargo").change(function (){
        $("#msjCargo").hide();
       
    });


$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoComite");
    ax.setAccion("obtenerComiteColaborador");
    ax.consumir();
    ax.setAccion("obtenerComiteCargo");
    ax.consumir();

    $('#divDocDescarga').hide();
    $('#divOpeDetalle').hide();
    var id = document.getElementById("id").value;
    var idDet = document.getElementById("idDet").value;
    if (!isEmpty(id)){
       
        loaderShow(null);
        ax.setAccion("obtenerComiteXid");
        ax.addParam("id", id);
        ax.consumir();
    }
    if (!isEmpty(idDet)){
        $('#divOpeDetalle').show();
        loaderShow(null);
        ax.setAccion("obtenerMiembroXid");
        ax.addParam("idDet", id);
        ax.consumir();
    }
    
    onResponseListarComite(null);
    onResponseListarMiembro(null);
    onResponseVacio();
    limpiarMensajes();
    $('#divDocDescargaEleccion').hide();
    //fin demo
    cargarComponentes();
    altura();
});

function exitoComite(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerComiteColaborador':
                onResponseObtenerComiteColaborador(response.data);
                
                break;
            case 'obtenerComiteCargo':
                onResponseObtenerComiteCargo(response.data);
                
                
                break;
            case 'obtenerComiteXid':
                onResponseObtenerComiteXid(response.data);
                
                altura();
                break;
                case 'obtenerMiembroXid':
                onResponseListarMiembroDB(response.data);
                onResponseVacio();
                altura();
                loaderClose();
                break;
            case 'crearComite':
                exitoCrear(response.data);
                loaderClose();
                break;
            case 'crearGridMiembro':
                onResponseCrearGrid(response.data);
                break;
                case 'eliminarGridMiembro':
                 onResponseEliminarGrid(response.data);
                break;
            case 'actualizarComite':
                exitoCrear(response.data);
                loaderClose();
                break;
        }
    }
}

function onResponseObtenerComiteColaborador(data) {
    if (!isEmpty(data)) {
       $('#cboColaborador').append(' <option value="#">&nbsp;</option>');
        $.each(data, function (index, item) {
            $('#cboColaborador').append('<option value="' + item.per_cod_ad + '">' + item.per_nom_completo + '</option>');
        });
    }
}

function onResponseObtenerComiteCargo(data) {
    if (!isEmpty(data)) {
        $('#cboCargo').append('<option value="#">&nbsp;</option>');
        $.each(data, function (index, item) {
            $('#cboCargo').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
        });
    }
}

function onResponseObtenerComiteXid(data) {

    var idDet = document.getElementById("idDet").value;
    if(!isEmpty(idDet)){
   //aumentar parametro para la hora de editar
    $("#txtFecConvocatoria").prop('disabled',true);
    $("#txtFecEleccion").prop('disabled',true);
    $("#txtFecInicio").prop('disabled',true);
    $("#txtFecFin").prop('disabled',true);
    $("#txtComentario").prop('disabled',true);
    $("#agregar").hide();
    $("#divDocCargaEleccion").hide();
    $("#divDocCarga").hide();
    $("#divOpeEdita").hide();
    
    }
  var fec_con='';
    if( data[0].fec_convocatoria!==null){
     fec_con=data[0].fec_convocatoria;   
}
document.getElementById('txtFecConvocatoria').value =fec_con;
    $("#txtFecConvocatoria").append("<input type='hidden' id='idConv' value='"+data[0].cv_id+"' ></input>");//recuperar valor
        $("#txtFecConvocatoria").append("<input type='hidden' id='idDocCom' value='' ></input>");//recuperar valor
    document.getElementById('txtComentario').value = data[0].comentario;
   
    document.getElementById('txtFecEleccion').value = data[0].fec_eleccion;
    
    document.getElementById('txtFecInicio').value = data[0].fec_inicio;
    document.getElementById('txtFecFin').value = data[0].fec_fin;
    $('#docInfo').html(data[0].nom_doc_conv);
    $("#btnDescarga").attr("href", data[0].url_conv);
    document.getElementById('convocatoriaDocId').value = data[0].id_doc_conv;
        $('#txtFecConvocatoria').append('<inpunt type="hidden" value="'+data[0].nom_doc_comite+'" id="txtInfoEle">');
        
    $('#divDocDescarga').show();
    if( isNaN(data[0].nom_doc_comite) ){
         document.getElementById('eleccionDocId').value = data[0].doc_id_comite;
         document.getElementById('idDocCom').value=data[0].doc_id_comite;
    $('#docInfoEleccion').html(data[0].nom_doc_comite);
    $("#btnDescargaEleccion").attr("href", data[0].url_comite);
    $('#divDocDescargaEleccion').show();
    }
    loaderClose();
}

function asignarValorSelect2(id, valor) {
    $("#" + id).select2().select2("val", valor);
    $("#" + id).select2({width: '100%'});
}

function cargarComponentes() {
    cargarSelect2();
    cargarCalendarios();
}
function cargarCalendarios(){
     $( "#txtFecConvocatoria" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             }).on('changeDate',function(ev){
                var f=new Date(ev.date);
                var f2=f.getFullYear() + "-" +(f.getMonth() + 1) + "-" + (f.getDate()+1)  ;
                
                $( "#txtFecEleccion" ).datepicker('setStartDate',f2);
//                 $( "#txtFecEleccion" ).datepicker('setDate',f2);
        });
             $( "#txtFecEleccion" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             }).on('changeDate',function(ev){
                var f=new Date(ev.date);
                var f2=f.getFullYear() + "-" +(f.getMonth() + 1) + "-" + (f.getDate()+1)  ;
                
                $( "#txtFecInicio" ).datepicker('setStartDate',f2);
        });
             $( "#txtFecInicio" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             }).on('changeDate',function(ev){
                var f=new Date(ev.date);
                var f2=f.getFullYear() + "-" +(f.getMonth() + 1) + "-" + (f.getDate()+1)  ;
                $( "#txtFecFin" ).datepicker('setStartDate',f2);
                //$( "#txtFecFin" ).datepicker('setDate',f2);
        });
             $( "#txtFecFin" ).datepicker({
              format: "yyyy-mm-dd",
               //startDate: "",
               language: "es",
               autoclose:"true"

             });
}
function cargarSelect2() {
     
    $("#cboColaborador").select2({
        width: '100%'
    });
    $("#cboCargo").select2({
        width: '100%'
    });
    }

$(function () {
    $("#fileConvocatoria").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = fileIsLoadedConvocatoria;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function fileIsLoadedConvocatoria(e) {
    $('#secretFileConvocatoria').attr('value', e.target.result);
    document.getElementById('convocatoriaDocId').value = '';
}

$(function () {
    $("#fileEleccion").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = fileIsLoadedEleccion;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function fileIsLoadedEleccion(e) {
    $('#secretFileEleccion').attr('value', e.target.result);
    document.getElementById('eleccionDocId').value = '';
   
}

function cargarPantallaListar() {
    var url = URL_BASE + "vistas/com/comite/comite.php";
    cargarDiv("#window", url);
}
function enviarGrid(){
    loaderShow(null);
    var cboUsuarioId = document.getElementById('cboColaborador').value;
    var cboCargoId = document.getElementById('cboCargo').value;
    
    crearGrid(cboUsuarioId,cboCargoId);
}
function enviar(tipoAccion) {
    loaderShow(null);
    var fecConvocatoria = document.getElementById('txtFecConvocatoria').value;
    var comentario = document.getElementById('txtComentario').value;
     var docConvocatoria = document.getElementById('secretFileConvocatoria').value;
    var docConvocatoriaNombre = document.getElementById('fileConvocatoria').value.slice(12);
    var docConvocatoriaId = document.getElementById('convocatoriaDocId').value;
    if (docConvocatoria === '') {
        docConvocatoria = null;
        docConvocatoriaNombre = null;
    }
    //fin convocatoria
    var fecEleccion = document.getElementById('txtFecEleccion').value;
    var fecInicio = document.getElementById('txtFecInicio').value;
    var fecFin = document.getElementById('txtFecFin').value;
   //fin vigenci
     var dt=$('#datatable').DataTable().data().length;
   
    var docEleccion = document.getElementById('secretFileEleccion').value;
    var docEleccionNombre = document.getElementById('fileEleccion').value.slice(12);
    var docEleccionId = document.getElementById('eleccionDocId').value;
    if (docEleccion === '') {
        docEleccion = null;
        docEleccionNombre = null;
    } 
   
    if (tipoAccion === 'Nuevo') {
        
        crearComite(fecConvocatoria, comentario, fecEleccion, fecInicio, fecFin, docConvocatoria, 
        docConvocatoriaNombre, docConvocatoriaId,docEleccion, docEleccionNombre, docEleccionId,dt);
    
    } else {
        var id = document.getElementById('id').value;
        var idConv = document.getElementById('idConv').value;
        var idDocElec=document.getElementById('idDocCom').value;
        
        
        actualizarComite(id,idConv, fecConvocatoria, comentario, fecEleccion, fecInicio, fecFin, docConvocatoria, 
             docConvocatoriaNombre, docConvocatoriaId,docEleccion, docEleccionNombre, docEleccionId,dt,idDocElec);

    }
}
function crearGrid(cboUsuarioId,cboCargo){
    if(validarFormGrid(cboUsuarioId,cboCargo)){
        ax.setAccion("crearGridMiembro");
        ax.addParamTmp("cboUsuarioId", cboUsuarioId);
        ax.addParamTmp("cboCargo", cboCargo);
        ax.consumir();
    }else{
        loaderClose();
    }
}
function eliminarGrid(idGrid){
    loaderShow(null);
        ax.setAccion("eliminarGridMiembro");
        ax.addParamTmp("idGrid", idGrid);
        ax.consumir();
}
function crearComite(fecConvocatoria, comentario, fecEleccion, fecInicio, fecFin, docConvocatoria, 
        docConvocatoriaNombre, docConvocatoriaId,docEleccion, docEleccionNombre, docEleccionId,td) {
    if (validarFormulario(fecConvocatoria, docConvocatoria, docConvocatoriaId,fecInicio,fecFin,docEleccion, docEleccionId)) {
       
        if(td>0){swal({
        title: "Est\xe1s seguro?",
        text: "Si acepta agregar s\xf3lo estos colaboradores, luego ya no tendra opci\xf3n de agregar mas.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#33b86c",
        confirmButtonText: "Si, continurar!",
        cancelButtonColor: '#d33',
        cancelButtonText: "No, cancelar !",
        closeOnConfirm: true,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            deshabilitarBotones();
                  ax.setAccion("crearComite");
        ax.addParamTmp("fecConvocatoria", fecConvocatoria);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("fecEleccion", fecEleccion);
        ax.addParamTmp("fecInicio", fecInicio);
        ax.addParamTmp("fecFin", fecFin);
        ax.addParamTmp("docConvocatoria", docConvocatoria);
        ax.addParamTmp("docConvocatoriaNombre", docConvocatoriaNombre);
        ax.addParamTmp("docEleccion", docEleccion);
        ax.addParamTmp("docEleccionNombre", docEleccionNombre);
        ax.consumir();
        } else {
            swal("Cancelado", "La operaci\xf3n fue cancelada", "error");
                    loaderClose();
                    
        }

    });
        }else{
            deshabilitarBotones();
            ax.setAccion("crearComite");
        ax.addParamTmp("fecConvocatoria", fecConvocatoria);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("fecEleccion", fecEleccion);
        ax.addParamTmp("fecInicio", fecInicio);
        ax.addParamTmp("fecFin", fecFin);
        ax.addParamTmp("docConvocatoria", docConvocatoria);
        ax.addParamTmp("docConvocatoriaNombre", docConvocatoriaNombre);
        ax.addParamTmp("docEleccion", docEleccion);
        ax.addParamTmp("docEleccionNombre", docEleccionNombre);
        ax.consumir();
        }
        
        
    } else {
        loaderClose();
    
    }
}

function actualizarComite(id,idConv,fecConvocatoria, comentario, fecEleccion, fecInicio, fecFin, docConvocatoria, 
        docConvocatoriaNombre, docConvocatoriaId,docEleccion, docEleccionNombre, docEleccionId,td,bandera_doc) {
    if (validarFormulario(fecConvocatoria, docConvocatoria, docConvocatoriaId,fecEleccion,fecInicio,fecFin,docEleccion, docEleccionId)) {
         deshabilitarBotones();
        ax.setAccion("actualizarComite");
        ax.addParamTmp("id", id);
        ax.addParamTmp("idConv", idConv);
        ax.addParamTmp("fecConvocatoria", fecConvocatoria);
        ax.addParamTmp("comentario", comentario);
        ax.addParamTmp("fecEleccion", fecEleccion);
        ax.addParamTmp("fecInicio", fecInicio);
        ax.addParamTmp("fecFin", fecFin);
        ax.addParamTmp("docConvocatoria", docConvocatoria);
        ax.addParamTmp("docConvocatoriaNombre", docConvocatoriaNombre);
        ax.addParamTmp("docConvocatoriaId", docConvocatoriaId);
        ax.addParamTmp("docEleccion", docEleccion);
        ax.addParamTmp("docEleccionNombre", docEleccionNombre);
        ax.addParamTmp("docEleccionId", docEleccionId);
         ax.addParamTmp("bandera_doc", bandera_doc);
        ax.consumir();
    } else {
        loaderClose();
    }
}
function validarFormGrid(cboColaborador,cboCargo){
    var bandera = true;
    var espacio = /^\s+$/;
   
  
    if (cboColaborador === "" || cboColaborador === null || cboColaborador ==="#" || espacio.test(cboColaborador) ) {
        $("msjColaborador").removeProp(".hidden");
        $("#msjColaborador").text("El colaborador es obligatoria").show();
        bandera = false;
    }
     if (cboCargo === "" || cboCargo === null || cboCargo ==="#" || espacio.test(cboCargo)) {
        $("msjCargo").removeProp(".hidden");
        $("#msjCargo").text("El cargo es obligatoria").show();
        bandera = false;
    }
    return bandera;
}
function validarFormulario(fecConvocatoria, docConvocatoria, docConvocatoriaId,fecInicio,fecFin,docEleccion, docEleccionId) {
    var bandera = true;
    var espacio = /^\s+$/;
     var msjTab = "Por favor revise la(s) pestaña(s): ";
    var msjTabConvocatoria = "";
    var msjTabVigencia = "";
    var msjTabIntegrantes= "";
    limpiarMensajes();
     var dt=$('#datatable').DataTable().data().length;

    if (fecConvocatoria === "" || fecConvocatoria === null || espacio.test(fecConvocatoria) || fecConvocatoria.length === 0) {
        $("msjFecConvocatoria").removeProp(".hidden");
        $("#msjFecConvocatoria").text("La fecha de convocatoria es obligatoria").show();
        msjTabConvocatoria = "Convocatoria"+ " - ";
        bandera = false;
    }
    if ((docConvocatoria === "" || docConvocatoria === null || espacio.test(docConvocatoria) || docConvocatoria.length === 0)
            && docConvocatoriaId === "") {
        $("msjDocConvocatoria").removeProp(".hidden");
        $("#msjDocConvocatoria").text("La evidencia de convocatoria es obligatoria").show();
        msjTabConvocatoria = "Convocatoria"+ " - ";
        bandera = false;
    }
//    if (fecEleccion === "" || fecEleccion === null || espacio.test(fecEleccion) || fecEleccion.length === 0) {
//        $("msjFecEleccion").removeProp(".hidden");
//        $("#msjFecEleccion").text("La fecha de elección es obligatoria").show();
//        msjTabVigencia = "Vigencia"+ " - ";
//        bandera = false;
//    }
    if (fecInicio === "" || fecInicio === null || espacio.test(fecInicio) || fecInicio.length === 0) {
        $("msjFecInicio").removeProp(".hidden");
        $("#msjFecInicio").text("La fecha de Inicio es obligatoria").show();
        msjTabVigencia = "Vigencia"+ " - ";
        bandera = false;
    }
    if (fecFin === "" || fecFin === null || espacio.test(fecFin) || fecFin.length === 0) {
        $("msjFecFin").removeProp(".hidden");
        $("#msjFecFin").text("La fecha de fin es obligatoria").show();
        msjTabVigencia = "Vigencia"+ " - ";
        bandera = false;
    }
  
      if(dt > 0){
         
    if ((docEleccion === "" || docEleccion === null || espacio.test(docEleccion) || docEleccion.length === 0)
            && docEleccionId === "") {
        $("msjDocEleccion").removeProp(".hidden");
        $("#msjDocEleccion").text("La evidencia de elección es obligatoria").show();
        msjTabIntegrantes = "Integrantes";
        bandera = false;
    }
      }
    msjTab = msjTab + msjTabConvocatoria  + msjTabVigencia + msjTabIntegrantes;
    $("#msjTabErrores").text(msjTab).show();
    return bandera;
}

function limpiarMensajes() {
    $("#msjFecConvocatoria").hide();
    $("#msjDocConvocatoria").hide();
    $("#msjDocEleccion").hide();
    $("#msjTabErrores").text("");
}

function exitoCrear(data) {
    if (data[0]["vout_exito"] === '0') {
        habilitarBotones();
        $.Notification.autoHideNotify('warning', 'top right', 'Validación', data[0]["vout_mensaje"]);
    } else {
        habilitarBotones();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito', data[0]["vout_mensaje"]);
        cargarPantallaListar();
    }
}

function deshabilitarBotones() {
    $("#btnEnviar").addClass('disabled');
    $("#btnEnviar i").removeClass(c);
    $("#btnEnviar i").addClass('fa fa-spinner fa-spin');
}

function habilitarBotones() {
    $("#btnEnviar").removeClass('disabled');
    $("#btnEnviar i").removeClass('fa fa-spinner fa-spin');
    $("#btnEnviar i").addClass(c);
}
function onResponseCrearGrid(data){
   $("#cboColaborador").select2('val','#');
    $("#cboCargo").select2('val','#');
    if (data[0]['vout_exito']==='0'){
        
      $.Notification.autoHideNotify('warning', 'top right', 'Validación',data[0]["vout_mensaje"]);
      loaderClose();
    }else{
        
        onResponseListarMiembro(data);
        onResponseVacio();
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito',"Colaborador agregado satisfactoriamente." );
        loaderClose();
    }
    
}
function onResponseEliminarGrid(data){
    
  onResponseListarMiembro(data);
        onResponseVacio();
        altura();
        $.Notification.autoHideNotify('success', 'top-right', 'Éxito',"Colaborador eliminado satisfactoriamente." );
        loaderClose();
}
function onResponseListarMiembro(data) {
    $("#dataList2").empty();
    var cuerpo_total = "";
    var cuerpo = "";
    var cargoNombre="";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Colaborador</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Cargo</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Acciones</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.usuario + "</td>";
                    if(item.cargo==='1'){
                        cargoNombre='Presidente(a)';
                    }
                    if(item.cargo==='2'){
                        cargoNombre='Secretario(a)';
                    }
                    if(item.cargo==='3'){
                        cargoNombre='Vocal';
                    }
                    cuerpo=cuerpo+ "<td style='text-align:center;'>" + cargoNombre + "</td>";
                    cuerpo=cuerpo+ "<td style='text-align:center;'>"
                    + "<a href='#' onclick='eliminarGrid(\"" + item.id + "\")'><i class='fa fa-trash-o' style='color:#cb2a2a;'></i></a>&nbsp;\n"
                    + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList2").append(html);
    //loaderClose();
}
function onResponseListarMiembroDB(data) {
    $("#dataList2").empty();
    var cuerpo_total = "";
    var cuerpo = "";
    var cargoNombre="";
    var cabeza = "<table id='datatable' class='table table-striped table-bordered'>"
            + "<thead>"
            + "<tr>"
            + "<th style='text-align:center; vertical-align: middle;'>Colaborador</th>"
            + "<th style='text-align:center; vertical-align: middle;'>Cargo</th>"
            + "</tr>"
            + "</thead>";
    if (!isEmpty(data)) {
        $.each(data, function (index, item) {
            cuerpo = "<tr>"
                    + "<td style='text-align:center;'>" + item.usuario + "</td>";
                    if(item.cargo==='1'){
                        cargoNombre='Presidente(a)';
                    }
                    if(item.cargo==='2'){
                        cargoNombre='Secretario(a)';
                    }
                    if(item.cargo==='3'){
                        cargoNombre='Vocal';
                    }
                    cuerpo=cuerpo+ "<td style='text-align:center;'>" + cargoNombre + "</td>"
                    + "</tr>";
            cuerpo_total = cuerpo_total + cuerpo;
        });
    }
    var pie = '</table>';
    var html = cabeza + cuerpo_total + pie;
    $("#dataList2").append(html);
    
}
function onResponseVacio() {
    $('#datatable').dataTable({
        "order": [[ 1, 'desc' ]],
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


      
    
