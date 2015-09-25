<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <style>
            .cuadrante{
                width: 30px;
                height: 50px;
                text-align: center;
            }
            .cuadrante-seleccionado{
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
        </style>
    </head>

    <body >
        <div class="page-title">
            <h3 class="title">Reporte total</h3>
        </div>
        <div class="row">

            <!--<div class="col-md-12 col-md-12 col-xs-12">-->
            <div class="panel panel-default">
                <div class="panel panel-body">
                    <div class="col-md-12 col-sm-12 col-    xs-12" >

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style='text-align:center;'>Año</th>
                                    <th style='text-align:center;'>Usuario</th>
                                    <th style='text-align:center;'>Evaluacion (%)</th>
                                    <th style='text-align:center;'>PRP</th>
                                    <th style='text-align:center;'>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                
                <div style="clear:left">
                    <p><b>Leyenda:&nbsp;&nbsp;</b>
                        <a class="accionVisualizar" title="Visualizar"><i class="fa fa fa-search"></i></a> Visualizar &nbsp;&nbsp;&nbsp;
                        <a class="accionEliminar" title="Ver PDF"><i class="fa fa-file-pdf-o"></i></a> Ver PDF &nbsp;&nbsp;&nbsp;
                    </p>
                </div>

                <div id="modal" class="modal fade" role="dialog" data-backdrop="static">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div  class="modal-body">
                                <div style="width: 100%;">
                                    <table>
                                        <tr>
                                            <td>Potencial alto (>80)</td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB3" class="btn btn-cuadrante btn-info">B3</button></td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB6" class="btn btn-cuadrante btn-warning">B6</button></td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB9" class="btn btn-cuadrante btn-warning">B9</button></td>
                                        </tr>
                                        <tr>
                                            <td>Potencial promedio (51-79)</td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB2" class="btn btn-cuadrante btn-success">B2</button></td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB5" class="btn btn-cuadrante btn-success">B5</button></td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB8" class="btn btn-cuadrante btn-warning">B8</button></td>
                                        </tr>
                                        <tr>
                                            <td>Potencial bajo (<50)</td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB1" class="btn btn-cuadrante btn-danger">B1</button></td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB4" class="btn btn-cuadrante btn-success">B4</button></td>
                                            <td class="cuadrante"><button type="button" id="cuadranteB7" class="btn btn-cuadrante btn-info">B7</button></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="text-align: center">Bajo (1-2)</td>
                                            <td style="text-align: center">Promedio (3)</td>
                                            <td style="text-align: center">Alto (4-5)</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="text-align: center" colspan="3">Desempeño</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="info">
                                    <h4><span id="tituloNineBox"></span></h4>
                                    <p class="text-muted"><span id="descNineBox"></span></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
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
        <script src="vistas/com/reporte/reporteTotal.js"></script>
    </body>
    <!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 May 2015 23:15:09 GMT -->
</html>

