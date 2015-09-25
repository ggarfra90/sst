<html lang="es">
    <head>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <link href="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
    </head>

    <body>
        <div class="page-title"> 
            <h3 class="title">Capacitaciones</h3> 
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
                                <a style="border-radius: 0px;" class="btn btn-info w-sm m-b-5" onclick="nuevaCapacitacion();">
                                    <i class="fa fa-pencil" style="font-size: 18px;"></i>&nbsp;&nbsp;Nuevo
                                </a>&nbsp;&nbsp;&nbsp;
                                <a style="border-radius: 0px;" class="btn btn-info w-sm m-b-5" onclick="buscarXAvance();">
                                    <i class="fa fa-search" style="font-size: 18px;"></i>&nbsp;&nbsp;Buscar
                                </a>
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
                            <i class="ion-flag" style="color:#cb2a2a;"></i> Cerrada &nbsp;&nbsp;&nbsp;
                            <i class="ion-checkmark-circled" style="color:#5cb85c;"></i> Estado activo &nbsp;&nbsp;&nbsp;
                            <i class="ion-flash-off" style="color:#cb2a2a;"></i> Estado inactivo &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-edit" style="color:#E8BA2F;"></i> Editar la información &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-cloud-download" style="color:#1ca8dd;"></i> Descargar currícula&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-list-alt" style="color:#DB94B8;"></i> Registrados&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-camera" style="color:#999966;"></i> Evidencias&nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                </div>
        </div>  
        <div id="modalListadoAlumnos" class="modal fade" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title">Lista de registrados</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="control-label">Tema:</label> 
                                    <input type="text" class="form-control" id="tema" disabled=""> 
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="control-label">Total de registrados:</label> 
                                    <input type="text" class="form-control" id="total" disabled=""> 
                                </div> 
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; vertical-align:middle;">Lista de colaboradores registrados</th>
                                            </tr>
                                        </thead>

                                        <tbody id="colaboradores">
                                            
                                        </tbody>
                                    </table>
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ion-arrow-left-c"></i> Regresar</button> 
                    </div> 
                </div>
            </div>
        </div>
    </body>
    <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
    <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
    <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

    <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
    <script src="vistas/com/capacitacion/capacitacion.js"></script>
</html>

