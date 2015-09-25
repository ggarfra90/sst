<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <style>
            .cuadrante{
                width: 100px;
                height: 100px;
                text-align: center;
            }
            .cuadrante-seleccionado{
                width: 90px;
                height: 90px;
                font-size: 21px;
            }
            .btn-cuadrante{
                width: 80px;
                height: 80px;
                font-size: 18px;
            }
            .info-seleccionado{
                font-size: 15px;
                font-weight: bold;
                color: black;
            }
        </style>
    </head>

    <body >
        <div class="page-title">
            <h3 class="title"><span id="tituloPrincipal">Gráfico total</span></h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Selecciona el año</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" target="_blank" action="vistas/com/reporte/graficoTotalPDF.php" method="post">
                            <div class="form-group col-md-10">
                                <select name="anio" id="cboAnio" class="select2"></select>
                            </div>
                            <input type="hidden" id="usuarioId" name="id" value="<?php echo $_GET['usuarioId']; ?>"/>
                            <input type="hidden" id="usuarioCodAd" name="codAd" value="<?php echo $_GET['usuarioCodAd']; ?>"/>
                            <a onclick="parentNode.submit();" class="btn btn-danger" title="Ver PDF"><i class="fa fa-file-pdf-o"></i> Ver PDF</a>
                        </form>
                        
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->
        </div> <!-- End row -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Gráfico</h3>
                    </div>
                    <table>
                       <tr>
                           <td>Potencial alto (>80)</td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B3')" id="cuadranteB3" class="btn btn-cuadrante disabled btn-info">B3<br><span id="porcentajeB3" class="cuadrante-porcentaje"></span></button></td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B6')" id="cuadranteB6" class="btn btn-cuadrante disabled btn-warning">B6<br><span id="porcentajeB6" class="cuadrante-porcentaje"></span></button></td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B9')" id="cuadranteB9" class="btn btn-cuadrante disabled btn-warning">B9<br><span id="porcentajeB9" class="cuadrante-porcentaje"></span></button></td>
                       </tr>
                       <tr>
                           <td>Potencial promedio (51-79)</td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B2')" id="cuadranteB2" class="btn btn-cuadrante disabled btn-success">B2<br><span id="porcentajeB2" class="cuadrante-porcentaje"></span></button></td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B5')" id="cuadranteB5" class="btn btn-cuadrante disabled btn-success">B5<br><span id="porcentajeB5" class="cuadrante-porcentaje"></span></button></td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B8')" id="cuadranteB8" class="btn btn-cuadrante disabled btn-warning">B8<br><span id="porcentajeB8" class="cuadrante-porcentaje"></span></button></td>
                       </tr>
                       <tr>
                           <td>Potencial bajo (<50)</td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B1')" id="cuadranteB1" class="btn btn-cuadrante disabled btn-danger">B1<br><span id="porcentajeB1" class="cuadrante-porcentaje"></span></button></td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B4')" id="cuadranteB4" class="btn btn-cuadrante disabled btn-success">B4<br><span id="porcentajeB4" class="cuadrante-porcentaje"></span></button></td>
                           <td class="cuadrante"><button type="button" onclick="infoSeleccionado('B7')" id="cuadranteB7" class="btn btn-cuadrante disabled btn-info">B7<br><span id="porcentajeB7" class="cuadrante-porcentaje"></span></button></td>
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
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Resumen</h3>
                    </div>
                    <div id="contenedorResumen" class="panel-body">
                        
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
        <script src="vistas/com/reporte/graficoTotal.js"></script>
    </body>
    <!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 May 2015 23:15:09 GMT -->
</html>

