<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
    </head>

    <body>
        <div class="page-title">
            <h3 class="title">Matriz de identificaci&oacute;n de peligros y evaluaci&oacute;n de riesgos (IPER)</h3>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="row">
                    <div class="form-group col-md-12" id="g1">
                        <a href="#" style="border-radius: 0px;" class="btn btn-info w-sm" onclick="nuevo()"><i class=" fa fa-pencil" style="font-size: 18px;"></i>&nbsp;&nbsp;Nuevo
                        </a>			<a href="#" style="border-radius: 0px;" class="btn btn-info w-md" onclick="nuevoValoracionRiesgos();"><i class="fa fa-plus-square-o" style="font-size: 18px;"></i>&nbsp;&nbsp;Valoración de riesgos</a>
                        <a href="#" style="border-radius: 0px;" class="btn btn-info w-md"><i class="fa fa-search" style="font-size: 18px;" onclick="buscar();"></i>&nbsp;&nbsp;Buscar</a>
                    </div>
                </div>

                <div class="panel panel-body" id="muestrascroll">
                    <div class="row" id="scroll">
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                            <div class="table">
                                <div id="dataList">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="clear:left">
                    <p><b>Leyenda:</b>&nbsp;&nbsp;
                        <i class='ion-android-send' style="color:#E8BA2F;"></i>Revisión: pendiente&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-close" style="color:#cb2a2a;"></i>Revisión: rechazado (click para ver motivo de rechazo)&nbsp;&nbsp;&nbsp;
                        <i class='ion-checkmark-circled' style="color:#1ca8dd;"></i>Revisión: aprobado&nbsp;&nbsp;&nbsp;
                        <i class='ion-android-send' style="color:#5cb85c;"></i>Revisión: publicado&nbsp;&nbsp;&nbsp;
                        <i class="ion-flash-off" style="color:#cb2a2a;"></i>Estado: inactivo (versión anterior)&nbsp;&nbsp;&nbsp;
                        <i class='ion-checkmark-circled' style="color:#5cb85c;"></i>Estado: activo&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-edit" style="color:#E8BA2F;"></i>Editar&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-list-alt" style="color:#DB94B8;"></i>Ver detalle&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-cloud-download" style="color:#1ca8dd;"></i>Descargar documento&nbsp;&nbsp;&nbsp;
                    </p>
                </div>
            </div>
        </div>



        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/iper/iper.js"></script>
    </body>
</html>

