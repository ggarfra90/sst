<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <script>
            altura();
        </script>   
    </head>

    <body >
        <div class="page-title">
            <h3 class="title">Gráfico RRHH</h3>
        </div>
        <div class="row">

            <!--<div class="col-md-12 col-md-12 col-xs-12">-->
            <div class="panel panel-default">
                <div class="panel panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style='text-align:center;'>Usuario</th>
                                    <th style='text-align:center;'>Jefe</th>
                                    <th style='text-align:center;'>Gerente</th>
                                    <th style='text-align:center;'>Perfiles</th>
                                    <th style='text-align:center;'>Estado</th>
                                    <th style='text-align:center;'>Reportar</th>
                                </tr>
                            </thead>  
                        </table>
                    </div>
                </div>
                
                <div style="clear:left">
                    <p><b>Leyenda:&nbsp;&nbsp;</b>
                        <a class="accionVisualizar" title="Reportar"><i class="ion-arrow-graph-up-right"></i></a> Reportar &nbsp;&nbsp;&nbsp;
                    </p>
                </div>
            </div>
        </div>
        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
        
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>
      

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/reporte/graficoRRHH.js"></script>
    </body>
    <!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 May 2015 23:15:09 GMT -->
</html>

