///* 
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
 var param=document.getElementById("comiteCale").value;
$(document).ready(function () {
   
    if(!isEmpty(param)){
        $("#nuevaReunion").hide();
    }
    limpiaEspacio();
    $('.select2-hidden-accessible').remove();
   loaderShow(null);
    ax.setSuccess("exitoReunion");
    listarReunion();
       altura();
});
//
function listarReunion() {
    ax.setAccion("listarReunion");
    ax.consumir();
}

function exitoReunion(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'listarReunion':
                iniciarCalendario();
                onResponseListarReunion(response.data);
                loaderClose();
                break;
           
        }
    }
}

function onResponseListarReunion(data){
                var f=new Date();
                var fechaActual=f.getFullYear() + "-" +(f.getMonth() + 1) + "-" + f.getDate(); 
    if (!isEmpty(data)) {
                    $.each(data, function (index, item) {
                     var fn= new Date(item.fecha+" "+item.hora)
                     var a=fn.getFullYear();
                     var m=fn.getMonth(); 
                     var d=fn.getDate();
                     var h=fn.getHours();
                     var mm=fn.getMinutes();
                     
            var newEvent = new Object();

            newEvent.title = item.tema ;
            newEvent.start = new Date(a,m,d,h,mm);
            if(new Date(item.fecha)>=new Date(fechaActual) && isEmpty(param)){
                newEvent.url='javascript:editarReunion('+item.comite_sst_id+','+item.comite_sst_reu_id+');';
            }else{
                newEvent.url='javascript:verDetalleReunion('+item.comite_sst_id+','+item.comite_sst_reu_id+');';
            }
            
            newEvent.allDay = false;
            $('#calendar').fullCalendar( 'renderEvent', newEvent,'stick' );
        });                
    } 
                           
        altura();
        loaderClose();
}


function nuevaReunionComite(){
   
    var titulo = "Nueva";
    var url = URL_BASE + "vistas/com/comite/reunionComite_form.php?winTitulo=" + titulo;
    cargarDiv("#window", url);
}
function editarReunion(comiteId,comiteReuId){
    var titulo = "Editar";
 var url = URL_BASE + "vistas/com/comite/reunionComite_form.php?winTitulo=" + titulo+"&comiteId="+comiteId
    +"&comiteReuId="+comiteReuId+"&idEdit=1";
        cargarDiv("#window", url);
}
function verDetalleReunion(comiteId,comiteReuId){
    var titulo = "Detalle";
    var url = URL_BASE + "vistas/com/comite/reunionComite_form.php?winTitulo=" + titulo+"&comiteId="+comiteId
    +"&comiteReuId="+comiteReuId+"&idDet=1";
    cargarDiv("#window", url);
}
function iniciarCalendario(){
    $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                
                    lang: 'es',
                editable:false,
                eventLimit: true

            });
}