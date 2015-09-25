<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
    </head>

    <body>
        <div class="page-title">
            <h3 class="title">Comit&eacute; SST</h3>
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
<!--                            <i class="fa fa-file-text" style="color:#088A68;"></i> Detalle de  la informaci&oacute;n &nbsp;&nbsp;&nbsp;-->
                        <i class="ion-checkmark-circled" style="color:#5cb85c;"></i> Estado activo &nbsp;&nbsp;&nbsp;
                        <i class="ion-flash-off" style="color:#cb2a2a;"></i> Estado inactivo &nbsp;&nbsp;&nbsp;
                        <i class="fa fa-edit" style="color:#E8BA2F;"></i> Editar la información &nbsp;&nbsp;&nbsp;
                        <i class="fa fa-calendar" style="color:#1ca8dd;"></i> Ver calendario de reuniones&nbsp;&nbsp;&nbsp;
                    </p>
                </div>
            </div>
        </div>

        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/comite/comite.js"></script>
    </body>
</html>

