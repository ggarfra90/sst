/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var txtCodigoIper ='txtCodigoIper';
var msjTxtCodigoIper ='#msjTxtCodigoIper';
var cboGerencia='cboGerencia';
var msjCboGerencia='#msjCboGerencia';
var cboPuesto='cboPuesto';
var msjCboPuesto='#msjCboPuesto';
var cboActividad='cboActividad';
var txtActividad='txtActividad';
var msjCboActividad='#msjCboActividad';
var cboDescripcionPel='cboDescripcionPel';
var txtDescripcionPel='txtDescripcionPel';
var msjCboDescripcionPel='#msjCboDescripcionPel';
var cboConsecuenciaPel='cboConsecuenciaPel';
var txtConsecuenciaPel='txtConsecuenciaPel';
var msjCboConsecuenciaPel='#msjCboConsecuenciaPel';

var cboSituacionTem='cboSituacionTem';
var msjCboSituacionTem='#msjCboSituacionTem';
var cboSituacionTipAct='cboSituacionTipAct';
var msjCboSituacionTipAct='#msjCboSituacionTipAct';
var cboSituacionReqLeg='cboSituacionReqLeg';
var msjCboSituacionReqLeg='#msjCboSituacionReqLeg';
var txtSituacionReqLeg='txtSituacionReqLeg';
var cboSituacionMedExi='cboSituacionMedExi';
var msjCboSituacionMedExi='#msjCboSituacionMedExi';
var txtSituacionMedExi='txtSituacionMedExi';
var cboSituacionPro='cboSituacionPro';
var msjCboSituacionPro='#msjCboSituacionPro';
var cboSituacionExp='cboSituacionExp';
var msjCboSituacionExp='#msjCboSituacionExp';
var cboSituacionSev='cboSituacionSev';
var msjCboSituacionSev='#msjCboSituacionSev';
var txtSituacionAct='txtSituacionAct';

var cboMedidasSisBlo='cboMedidasSisBlo';
var txtMedidasSisBlo='txtMedidasSisBlo';
var cboMedidasEquiTec='cboMedidasEquiTec';
var txtMedidasEquiTec='txtMedidasEquiTec';
var cboMedidasMonMan='cboMedidasMonMan';
var txtMedidasMonMan='txtMedidasMonMan';
var cboMedidasEntPer='cboMedidasEntPer';
var txtMedidasEntPer='txtMedidasEntPer';
var cboMedidasElaPro='cboMedidasElaPro';
var cboMedidasPro='cboMedidasPro';
var cboMedidasExp='cboMedidasExp';
var cboMedidasSev='cboMedidasSev';
var txtMedidasSig='txtMedidasSig';
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    limpiaEspacio();
    altura();
});
$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoIper");
    ax.setAccion("configuracionesIniciales");
    ax.consumir();
    cargarComponentes();
    altura();
});
function cargarElementosData(data) {
     loaderClose(); 
    var myObj=[cboSituacionTem,cboSituacionTipAct,cboSituacionPro,cboSituacionExp,
                cboSituacionSev,cboMedidasPro,cboMedidasExp,
                cboMedidasSev];
    var myData=[data.situacionTemporal,data.tipoActividad,data.probabilidad,data.exposicion,
                data.severidad,data.probabilidad,data.exposicion,
                data.severidad];
                 obtenerGerenciaLegado();
                obtenerPuestoLegado();
                cargarCombosOjetos(myData,myObj);
                cargarComboId(data.listarReqLegales,cboSituacionReqLeg);
                cargarMedControl(data.istarMedControl);
                cargarComboId(data.listarPeligro,cboDescripcionPel);
                cargarComboId(data.listarPelConsecuencias,cboConsecuenciaPel);
                 
}
function cargarCamposFormulario(){
    var codigoIper=document.getElementById(txtCodigoIper).value;
    var gerencia=document.getElementById(cboGerencia).value;
    var puesto=document.getElementById(cboPuesto).value;
    var actividad=document.getElementById(cboActividad).value;
    var txtActi=document.getElementById(txtActividad).value;
    var descripcionPel=document.getElementById(cboDescripcionPel).value;
    var txtDescriPel=document.getElementById(txtDescripcionPel).value;
    var consecuenciaPel=document.getElementById(cboConsecuenciaPel).value;
    var txtConPel=document.getElementById(txtConsecuenciaPel).value;
    //tab situacion
    var sTipoActividad=document.getElementById(cboSituacionTipAct).value;
    var sTemporal=document.getElementById(cboSituacionTem).value;
    var sReqLegales=document.getElementById(cboSituacionReqLeg).value;
    var sTxtReqLegales=document.getElementById(txtSituacionReqLeg).value;
    var sMedControlExi=document.getElementById(cboSituacionMedExi).value;
    var sTxtMedControlExi=document.getElementById(txtSituacionMedExi).value;
    var sProbalidad=document.getElementById(cboSituacionPro).value;
    var sExposicion=document.getElementById(cboSituacionExp).value;
    var sSeveridad=document.getElementById(cboSituacionSev).value;
   // tab medidas
    var mSisBloqueo=document.getElementById(cboMedidasSisBlo).value;
     var mTxtSisBloqueo=document.getElementById(txtMedidasSisBlo).value;
    var mEquiTecno=document.getElementById(cboMedidasEquiTec).value;
     var mTxtEquiTecno=document.getElementById(txtMedidasEquiTec).value;
    var mMonitoreo=document.getElementById(cboMedidasMonMan).value;
     var mTxtMonitoreo=document.getElementById(txtMedidasMonMan).value;
    var mEntrePersonal=document.getElementById(cboMedidasEntPer).value;
     var mTxtEntrePersonal=document.getElementById(txtMedidasEntPer).value;
    var mElaPro=document.getElementById(cboMedidasElaPro).value;
    var mProbalidad=document.getElementById(cboMedidasPro).value;
    var mExposicion=document.getElementById(cboMedidasExp).value;
    var mSeveridad=document.getElementById(cboMedidasSev).value;
    validarFormularioIper(codigoIper,gerencia,puesto,actividad,txtActi,descripcionPel,txtDescriPel,consecuenciaPel,
            txtConPel,sTipoActividad,sTemporal,sReqLegales,sTxtReqLegales,sMedControlExi,sTxtMedControlExi,sProbalidad,sExposicion,sSeveridad);
}
function cargarCombosOjetos(myData,myObj){
    for (i=0;i<myObj.length;i++){
                cargarComboCodigo(myData[i],myObj[i]);
            }
}
function probAct() {
    var probActual = 1;
probActual=1;
    var problVal = $('#cboSituacionPro option:selected').text();
    var valPro=$('#cboSituacionPro').val(); 
    if (!isEmpty(valPro)) {
        probActual = problVal;
    }
    return probActual;
}
function expAct() {
    var expActual = 1;
    expActual=1;
    var expVal = $('#cboSituacionExp option:selected').text();
    var valExp=$('#cboSituacionExp').val();
    if (!isEmpty(valExp)) {
        expActual = expVal;
    }
    return expActual;
}
function sevAct() {
    var sevActual;
    sevActual= 1;

    var sevVal = $('#cboSituacionSev option:selected').text();
    var valSev = $('#cboSituacionSev').val();
    if (!isEmpty(valSev)) {
        sevActual = sevVal;
    }
    return sevActual;
}
function probMedAct() {
    var probActual = 1;
probActual=1;
    var problVal = $('#cboMedidasPro option:selected').text();
    var valPro=$('#cboMedidasPro').val(); 
    if (!isEmpty(valPro)) {
        probActual = problVal;
    }
    return probActual;
}
function expMedAct() {
    var expActual = 1;
    expActual=1;
    var expVal = $('#cboMedidasExp option:selected').text();
    var valExp=$('#cboMedidasExp').val();
    if (!isEmpty(valExp)) {
        expActual = expVal;
    }
    return expActual;
}
function sevMedAct() {
    var sevActual;
    sevActual= 1;

    var sevVal = $('#cboMedidasSev option:selected').text();
    var valSev = $('#cboMedidasSev').val();
    if (!isEmpty(valSev)) {
        sevActual = sevVal;
    }
    return sevActual;
}
$("#cboSituacionPro").change(function () {
   var resultado = 1;
   resultado=obtenerSignificancia();
    $("#txtSituacionSig").val(resultado.toFixed(2));

});
$("#cboSituacionExp").change(function () {
   var resultado = 1;
   resultado=obtenerSignificancia();
    $("#txtSituacionSig").val(resultado.toFixed(2));
});
$("#cboSituacionSev").change(function () {
   
    var resultado = 1;
   resultado=obtenerSignificancia();
    $("#txtSituacionSig").val(resultado.toFixed(2));
});
$("#cboMedidasPro").change(function () {
   var resultado = 1;
   resultado=obtenerSignificanciaMed();
    $("#txtMedidasSig").val(resultado.toFixed(2));

});
$("#cboMedidasExp").change(function () {
   var resultado = 1;
   resultado=obtenerSignificanciaMed();
    $("#txtMedidasSig").val(resultado.toFixed(2));
});
$("#cboMedidasSev").change(function () {
   
    var resultado = 1;
   resultado=obtenerSignificanciaMed();
    $("#txtMedidasSig").val(resultado.toFixed(2));
});
function obtenerSignificancia(){
     var pro = 1;
    var exp = 1;
    var sev = 1;
    var resultado = 1;
    pro = probAct();
    exp = expAct();
    sev = sevAct();
    resultado = parseFloat(pro) * parseFloat(exp) * parseFloat(sev);
    return resultado;
}
function obtenerSignificanciaMed(){
     var pro = 1;
    var exp = 1;
    var sev = 1;
    var resultado = 1;
    pro = probMedAct();
    exp = expMedAct();
    sev = sevMedAct();
    resultado = parseFloat(pro) * parseFloat(exp) * parseFloat(sev);
    return resultado;
}
function exitoIper(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'configuracionesIniciales':
                cargarElementosData(response.data);
                break;
            case 'obtenerPuesto':
                 cargarPuestoLegado(response.data);
              
                break;
                 case 'obtenerGerenciaLegado':
                 cargarGerenciaLegado(response.data);
                
                break;

            case 'cambiarEstado':
                cambiarIconoEstado();
                break;
            
        }
    }
}
function obtenerGerenciaLegado() {
    ax.setAccion("obtenerGerenciaLegado");
    ax.consumir();
}
function obtenerPuestoLegado() {
    ax.setAccion("obtenerPuesto");
    ax.consumir();
}
function cargarComponentes() {
    cargarSelect2();
}

function cargarSelect2() {

    $("#cboGerencia").select2({
        width: '100%'
    });
    $("#cboPuesto").select2({
        width: '100%'
    });
    $("#cboActividad").select2({
        width: '100%'
    });
    $('#txtActividad').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboDescripcionPel").select2({
        width: '100%'

    });
    $('#txtDescripcionPel').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboConsecuenciaPel").select2({
        width: '100%'

    });
    $('#txtConsecuenciaPel').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });

    $("#cboSituacionTem").select2({
        width: '100%'
    });
    $("#cboSituacionTipAct").select2({
        width: '100%'
    });
    $("#cboSituacionReqLeg").select2({
        width: '100%'
    });
    $('#txtSituacionReqLeg').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboSituacionMedExi").select2({
        width: '100%'
    });
    $('#txtSituacionMedExi').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboSituacionPro").select2({
        width: '100%'
    });
    $("#cboSituacionExp").select2({
        width: '100%'
    });
    $("#cboSituacionSev").select2({
        width: '100%'
    });
    $("#cboSituacionAct").select2({
        width: '100%'
    });




    $("#cboMedidasSisBlo").select2({
        width: '100%'
    });
    $('#txtMedidasSisBlo').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboMedidasEquiTec").select2({
        width: '100%'
    });
    $('#txtMedidasEquiTec').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboMedidasMonMan").select2({
        width: '100%'
    });
    $('#txtMedidasMonMan').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboMedidasEntPer").select2({
        width: '100%'
    });
    $('#txtMedidasEntPer').tagsInput({
        width: 'auto',
        height: 'auto',
        defaultText: 'Otras...'

    });
    $("#cboMedidasElaPro").select2({
        width: '100%'
    });
    $("#cboMedidasPro").select2({
        width: '100%'
    });
    $("#cboMedidasExp").select2({
        width: '100%'
    });
    $("#cboMedidasSev").select2({
        width: '100%'
    });


}
function cargarGerenciaLegado(data) {
    $.each(data, function (index, item) {
        $('#cboGerencia').append('<option value="' + item.idgerencia + '">' + item.descripcion + '</option>');
    });
}
function cargarPuestoLegado(data) {
    $.each(data, function (index, item) {
        $('#cboPuesto').append('<option value="' + item.idcargo + '">' + item.descripcion + '</option>');
    });
}
function cargarSituacionTemporal(data) {
    $.each(data, function (index, item) {
        $('#cboSituacionTem').append('<option value="' + item.codigo + '">' + item.descripcion + '</option>');
    });
}
function cargarComboCodigo(data,id,value){
   
   $.each(data, function (index, item) {
        $('#'+id).append('<option value="' + item.codigo + '">' + item.descripcion + '</option>');
    });
}
function cargarComboId(data,id){
   
   $.each(data, function (index, item) {
        $('#'+id).append('<option value="' + item.id + '">' + item.descripcion + '</option>');
    });
}



function cargarMedControl(data) {
    $.each(data, function (index, item) {
        $('#cboSituacionMedExi').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
        $('#cboMedidasEquiTec').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
        $('#cboMedidasMonManp').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
       $('#cboMedidasSisBlo').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
       $('#cboMedidasEntPer').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
        $('#cboMedidasElaPro').append('<option value="' + item.id + '">' + item.descripcion + '</option>');
});
}


function validarFormularioIper(codigo,cboGerencia,cboPuesto,cboActividad,txtActividad,cboDescripcionPel,
txtDescripcionPel,cboConsecuenciaPel,txtConsecuenciasPel,cboSituacionTem,cboSituacionTipAct,cboSituacionReqLeg,
txtSituacionReqLeg,cboSituacionMedExi,txtSituacionMedExi,cboSituacionPro,cboSituacionExp,cboSituacionSev){
      var bandera = true;
    var espacio = /^\s+$/;

    if (codigo === "" || codigo === null || espacio.test(codigo)) {
        $(msjTxtCodigoIper).removeProp(".hidden");
        $(msjTxtCodigoIper).text("El codigo es obligatoria").show();
        bandera = false;
    }
     if (cboGerencia === "" || cboGerencia === null || espacio.test(cboGerencia)){
        $(msjCboGerencia).removeProp(".hidden");
        $(msjCboGerencia).text("Gerencia es obligatoria").show();
        bandera = false;
       
    }
    if (cboPuesto === "" || cboPuesto === null || espacio.test(cboPuesto)){
        $(msjCboPuesto).removeProp(".hidden");
        $(msjCboPuesto).text("Puesto es obligatoria").show();
        bandera = false;

    }
    if ((cboActividad === "" || cboActividad === null || espacio.test(cboActividad))
            &&(txtActividad === "" || txtActividad === null || espacio.test(txtActividad))){
        $(msjCboActividad).removeProp(".hidden");
        $(msjCboActividad).text("Actividad es obligatoria").show();
        bandera = false;
     
    }
    if ((cboDescripcionPel === "" || cboDescripcionPel === null || espacio.test(cboDescripcionPel))
            &&( txtDescripcionPel === "" || txtDescripcionPel === null || espacio.test(txtDescripcionPel))){
        $(msjCboDescripcionPel).removeProp(".hidden");
        $(msjCboDescripcionPel).text("La descripcion del peligro es obligatoria").show();
      
        bandera = false;
     
    }
    if ((cboConsecuenciaPel === "" || cboConsecuenciaPel === null || espacio.test(cboConsecuenciaPel))
            &&( txtConsecuenciasPel === "" || txtConsecuenciasPel === null || espacio.test(txtConsecuenciasPel))){
        $(msjCboConsecuenciaPel).removeProp(".hidden");
        $(msjCboConsecuenciaPel).text("La consecuencia del peligro es obligatoria").show();
        bandera = false;
     
    }
    // tab
   var msjTab='';
   var msj='Por favor revise la pestaña situación actual.';
    if (cboSituacionTem === "" || cboSituacionTem === null || espacio.test(cboSituacionTem)){
        $(msjCboSituacionTem ).removeProp(".hidden");
        $(msjCboSituacionTem).text("La situación temporal es obligatoria").show();
        msjTab=msj;
        bandera = false;

    }
    if (cboSituacionTipAct === "" || cboSituacionTipAct === null || espacio.test(cboSituacionTipAct)){
        $(msjCboSituacionTipAct  ).removeProp(".hidden");
        $(msjCboSituacionTipAct).text(" Tipo de actividad es obligatoria").show();
        bandera = false;
            msjTab=msj;
    }
     if ((cboSituacionReqLeg === "" || cboSituacionReqLeg === null || espacio.test(cboSituacionReqLeg)) &&(
             txtSituacionReqLeg === "" || txtSituacionReqLeg === null || espacio.test(txtSituacionReqLeg))){
        $(msjCboSituacionReqLeg  ).removeProp(".hidden");
        $(msjCboSituacionReqLeg).text("Requisitos legales es obligatoria").show();
        bandera = false;
            msjTab=msj;
    }
    if ((cboSituacionMedExi === "" || cboSituacionMedExi === null || espacio.test(cboSituacionReqLeg)) &&(
             txtSituacionMedExi === "" || txtSituacionMedExi === null || espacio.test(txtSituacionMedExi))){
        $(msjCboSituacionMedExi  ).removeProp(".hidden");
        $(msjCboSituacionMedExi).text("Medidas existentes es obligatoria").show();
        bandera = false;
            msjTab=msj;
    }
    if (cboSituacionPro === "" || cboSituacionPro === null || espacio.test(cboSituacionPro)){
        $(msjCboSituacionPro  ).removeProp(".hidden");
        $(msjCboSituacionPro).text("Probabilidad es obligatoria").show();
        bandera = false;
            msjTab=msj;
    }
    if (cboSituacionExp === "" || cboSituacionExp === null || espacio.test(cboSituacionExp)){
        $(msjCboSituacionExp  ).removeProp(".hidden");
        $(msjCboSituacionExp).text("Exposición es obligatoria").show();
        bandera = false;
            msjTab=msj;
    }
     if (cboSituacionSev === "" || cboSituacionSev === null || espacio.test(cboSituacionSev)){
        $(msjCboSituacionSev  ).removeProp(".hidden");
        $(msjCboSituacionSev).text("Severidad es obligatoria").show();
        bandera = false;
            msjTab=msj;
    }
    $("#msjTabErrores").text(msjTab).show();
    return bandera;
}
 


function cargarPantallaListarIper() {
   
    var url = URL_BASE + "vistas/com/iper/iper.php";
    cargarDiv("#window", url);
}




