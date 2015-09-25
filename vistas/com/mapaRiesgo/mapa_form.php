<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $_GET['winTitulo']; ?> mapa de riesgo</h3>
                </div>
                <div class="panel-body">
                    <form  id="frmMapaRiesgo" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Sucursal</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="select2" id="cboSucursal" name="cboSucursal">
                                    </select>
                                </div>
                                <span id="msjSucursal" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label>C&oacute;digo *</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="txtCodigo" name="txtCodigo" class="form-control" 
                                           value="" maxlength="15" />
                                </div>
                                <span id="msjCodigo" class="control-label" style="color:red;font-style: normal;" hidden></span>
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
                            <div class="form-group col-md-6">
                                <label>Estado</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select id="cboEstado" name="cboEstado" class="select2">
                                        <option value="1" selected>Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="divDocCarga">
                            <div class="form-group col-md-12">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="fileUpload btn btn-purple">
                                        <span><i class="ion-upload m-r-5"></i>Cargar documento *</span>
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
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="cargarPantallaListar()" 
                                   style="border-radius: 0px;">
                                    <i class="fa fa-close"></i>&ensp;Cancelar
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-info w-sm m-b-5" 
                                        style="border-radius: 0px;" onclick="enviar('<?php echo $_GET['winTitulo']; ?>')">
                                    <i class="fa fa-send-o"></i>&ensp;Enviar
                                </button>
                            </div>
                        </div>
                        <div class="row" id="divOpeDetalle">
                            <div class="form-group col-md-12">
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="cargarPantallaListar()" 
                                   style="border-radius: 0px;">
                                    <i class="ion-arrow-left-c"></i>&ensp;Regresar
                                </a>
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
        <script src="vistas/com/mapaRiesgo/mapa_form.js"></script>
    </body>
</html>

