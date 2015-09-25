<html lang="es">
    <head>
           <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <link href="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
       <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" ></link>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <script src="vistas/com/capacitacion/evidencia_form.js"></script>

    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Evidencias de capacitación: <?php echo str_replace('_', '&nbsp;', $_GET['winTitulo']); ?></h3>
                </div>
                <div class="panel-body">
                    <form  id="frmEvidencia" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label>Documento*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="txtDocumento" name="txtDocumento" class="form-control" value="">
                                </div>
                                <span id="msjTema" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-5">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t-20">
                                    <div class="fileUpload btn btn-purple">
                                        <span><i class="ion-upload m-r-5"></i>Cargar evidencia *</span>
                                        <input type="file" id="file" name="file" class="upload"
                                               onchange="$('#fileInfo').html($(this).val().slice(12));"/>
                                    </div>
                                    &nbsp;&nbsp;<b  id="fileInfo">Ning&uacute;n documento seleccionado</b>
                                    <input type="hidden" id="secretFile" value="" />
                                </div>
                                <span id="msjDocumento" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-1">
                                <label>&nbsp;</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" name="btnGuardar" onclick="enviarEvidencia();" id="btnGuardar" class="btn btn-info m-b-4" style="border-radius: 0px;"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <input type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
                            <input type="hidden" id="op" value="<?php echo $_GET['winTitulo']; ?>" />
                            <input type="hidden" id="docId" value="" />
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Comentario:</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea type="text" id="txtComentario" name="txtComentario" class="form-control" value="" style="min-height:115px"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
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
                            <i class="fa fa-cloud-download" style="color:#1ca8dd;"></i> Descargar evidencia&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-trash-o" style="color:#cb2a2a;"></i> Eliminar evidencia &nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="form-group col-md-12">
                        <a href="#" class="btn btn-danger w-sm m-b-5" id="btnCancelar" onclick="cargarPantallaListarCapacitacion();" 
                           style="border-radius: 0px;">
                            <i class="ion-arrow-left-c"></i>&ensp;Regresar
                        </a>&nbsp;&nbsp;&nbsp;

                    </div>
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

