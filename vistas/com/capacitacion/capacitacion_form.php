<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" ></link>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
         <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
            <script src="vistas/com/capacitacion/capacitacion_form.js"></script>

    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $_GET['winTitulo']; ?> Capacitaci&oacute;n</h3>
                </div>
                <div class="panel-body">
                    <form  id="frmCapacitacion" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label>Tema*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="txtTema" name="txtTema" class="form-control" value="">
                                </div>
                              <span id="msjTema" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label>Inicio de convocatoria*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="yyyy-dd-mm" id="fecha_convocatoria">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                    <span id="msjConvocatoria" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label>Fecha de inicio</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="yyyy-dd-mm" id="fecha_inicio">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <span id="msjFinicio" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label>Fecha de fin</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="yyyy-dd-mm" id="fecha_fin">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <span id="msjFfin" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label>Tipo de capacitación</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select name="tipo" id="tipo" >
                                     
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Estado</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select name="estado" id="estado" >
                                        <option value="1" selected="">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Comentario</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea type="text" id="txtComentario" name="txtComentario" class="form-control" value=""
                                              maxlength="1000" style="min-height:115px"></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
                            <input type="hidden" id="op" value="<?php echo $_GET['winTitulo']; ?>" />
                            <input type="hidden" id="docId" value="" />
                            
                        </div>
                        <div class="row" id="divDocCarga">
                            <div class="form-group col-md-12">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="fileUpload btn btn-purple">
                                        <span><i class="ion-upload m-r-5"></i>Cargar curr&iacute;cula *</span>
                                        <input type="file" id="file" name="file" class="upload"
                                               onchange="$('#fileInfo').html($(this).val().slice(12));"/>
                                    </div>
                                    &nbsp;&nbsp;<b class="" id="fileInfo">Ning&uacute;n documento seleccionado</b>
                                    <input type="hidden" id="secretFile" value="" />
                                </div>
                                <span id="msjDocumento" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                        </div>
                        <div class="row" id="divDocDescarga">
                            <div class="form-group col-md-12">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="#" target="_blank" class="btn btn-info w-sm m-b-5" id="btnDescarga" style="border-radius: 0px;">
                                        <i class="fa fa-cloud-download"></i>&ensp;Descargar documento
                                    </a>
                                    &nbsp;&nbsp;<b class="" id="docInfo"></b>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="divOpeEdita">
                            <div class="form-group col-md-12">
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="cargarPantallaListarCapacitacion();" 
                                   style="border-radius: 0px;">
                                    <i class="fa fa-close"></i>&ensp;Cancelar
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-info w-sm m-b-5" 
                                        style="border-radius: 0px;" onclick="enviar('<?php echo $_GET['winTitulo']; ?>')">
                                    <i class="fa fa-send-o"></i>&ensp;Enviar
                                </button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
    </body>
</html>

