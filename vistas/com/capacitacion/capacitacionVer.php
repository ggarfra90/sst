<html lang="es">
    <head>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <link href="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
    </head>

    <body>
        <div class="page-title"> 
            <h3 class="title">Ver Capacitaciones</h3> 
        </div>
        <div class="row">
                <div class="panel panel-default">
                    <div class="row">
                        <form method="post" id="frm_buscar" class="form">
                            <div class="form-group col-md-12" id="g1">
                                <label>Avance</label>
                                <select id="tipo_avance" name="tipo_avance">
                                    <option value="4" selected>Todas</option>
                                    <option value="1">En convocatoria</option>
                                    <option value="2">En clases</option>
                                    <option value="3">Cerrada</option>

                                </select>
                            </div>
                        </form>
                        <div class="form-group col-md-12">
                            <div class="input-group col-md-8" style="  display: inline;">
                                <a  style="border-radius: 0px;" class="btn btn-info w-md m-b-5" onclick="buscarXAvance();"><i class="fa fa-search" style="font-size: 18px;"></i>&nbsp;&nbsp;Buscar</a>
                            </div>
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
                            <i class="ion-arrow-shrink" style="color:#1ca8dd;"></i> En convocatoria &nbsp;&nbsp;&nbsp;
                            <i class="ion-arrow-right-b" style="color:#5cb85c;"></i> En clases &nbsp;&nbsp;&nbsp;
                            <i class="ion-flag" style="color:#cb2a2a;"></i> Capacitación cerrada &nbsp;&nbsp;&nbsp;
                            <i class="ion-checkmark-circled" style="color:#5cb85c;"></i> Registrado en capacitación &nbsp;&nbsp;&nbsp;
                            <i class="ion-flash-off" style="color:#cb2a2a;"></i> No registrado en capacitación &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-cloud-download" style="color:#1ca8dd;"></i> Descargar currícula&nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                </div>
        </div>      
    </body>
    <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
    <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
    <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

    <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
    <script src="vistas/com/capacitacion/capacitacionVer.js"></script>
</html>

