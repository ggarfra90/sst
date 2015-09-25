<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
    </head>

    <body>
        <div class="page-title">
            <h3 class="title">Pol&iacute;tica SST</h3>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="row">
                    <div class="form-group col-md-12">
                        <a href="#" style="border-radius: 0px;" class="btn btn-info w-sm m-b-5" onclick="nuevo()">
                            <i class=" fa fa-pencil" style="font-size: 18px;"></i>&nbsp;&nbsp;Nuevo
                        </a>
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

        <div id="modalComentario" class="modal fade" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Motivo de rechazo del documento</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea type="text" id="txtComentario" name="txtComentario" class="form-control" 
                                              style="min-height:115px" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger m-b-5" data-dismiss="modal">
                            <i class="ion-arrow-left-c"></i>&ensp;Regresar
                        </button>
                    </div> 
                </div> 
            </div>
        </div>
        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/politica/politicaSst.js"></script>
    </body>
</html>

