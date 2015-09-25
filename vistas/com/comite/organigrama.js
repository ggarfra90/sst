/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    loaderShow(null);
    ax.setSuccess("exitoOrganigrama");
    obtenerOrganigrama();
       altura();
});

function obtenerOrganigrama() {
    ax.setAccion("obtenerOrganigrama");
    ax.consumir();
}

function exitoOrganigrama(response) {
    if (response.status === 'ok') {
        switch (response[PARAM_ACCION_NAME]) {
            case 'obtenerOrganigrama':
                onResponseListarOrganigrama(response.data);
                cargar();
                break;
           
        }
    }
}

function onResponseListarOrganigrama(data){
   var detalle='Presidente';
    var cuerpo="";
    var cuerpo_c="";
    var cuerpo_cc="";
    var cuerpo_f="";
    var cuerpo_ff="";
    $("#divOculto").empty();
    if(!isEmpty(data)){
    var cuerpo_total="";
            cuerpo_c='<ul id="organisation">';
            if(data[0].descripcion===detalle){
                cuerpo_cc='<li class="company"><a style="cursor:default;hover:none;color:#fff;"><span class="title">'+
                        data[0].usuario+'</span><br/>Presidente</a>';
            }
                    
                    cuerpo_ff='<ul>';
             $.each(data, function (index, item) {
                 if(item.descripcion!==detalle){
                           cuerpo='<li>'+item.usuario+'<br/><span class="title">'+
                        item.cargoN+'</span></li>';
            }
                           cuerpo_total = cuerpo_total + cuerpo; 
                           
        });                
            
                      cuerpo_f=cuerpo_c+cuerpo_cc+cuerpo_ff+cuerpo_total+'</ul>'+   
                '</li>'+'</ul>';
         $("#divOculto").append(cuerpo_f);
    }else{
        $("#divOrganigrama").append("<p class='text-danger'>No existe comité vigente</p>");
    }
       
        loaderClose();
}
function cargar(){
     $("#organisation").orgChart({container: $("#divOrganigrama")});
}
