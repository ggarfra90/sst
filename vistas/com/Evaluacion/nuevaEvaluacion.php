<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <script>
            altura();
        </script>   
    </head>

    <body >
        <div class="page-title">
            <h3 class="title">Evaluación</h3>
        </div>
        <div class="row">

            <!--<div class="col-md-12 col-md-12 col-xs-12">-->
            <div id="evaluacionContenedor" class="panel panel-default">
                <div class="panel panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12" >

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style='text-align:center;vertical-align: middle;'>Pregunta</th>
                                    <th style='text-align:center;vertical-align: middle;'>Totalmente en desacuerdo</th>
                                    <th style='text-align:center;vertical-align: middle;'>En desacuerdo</th>
                                    <th style='text-align:center;vertical-align: middle;'>Deacuerdo</th>
                                    <th style='text-align:center;vertical-align: middle;'>Totalmente deacuerdo</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTabla">
                            </tbody>    
                        </table>

                    </div>
                </div>
                <a id="btnCancelar" style="border-radius: 0px;" class="btn btn-danger w-md" onclick="cancelar()"><i class="fa ion-android-close"></i> Cancelar</a>
                <a id="btnGuardar" style="border-radius: 0px;" class="btn btn-info w-md" onclick="guardar(false);"><i class=" fa fa-save"></i> Guardar</a>
                <a id="btnEnviar" style="border-radius: 0px;" class="btn btn-success w-md" onclick="enviar();"><i class=" fa fa-send"></i> Finalizar</a>

            </div>
        </div>

        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>     

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/evaluacion/nuevaEvaluacion.js"></script>
    </body>
    <!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 May 2015 23:15:09 GMT -->
</html>

