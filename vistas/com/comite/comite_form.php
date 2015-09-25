<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" ></link>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
        <link href="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <style>
            .sweet-alert button.cancel {
                background-color: rgba(224, 70, 70, 0.8);
            }
            .sweet-alert button.cancel:hover {
                background-color:#E04646;
            }
            .sweet-alert {
                border-radius: 0px; 
            }
            .sweet-alert button {
                -webkit-border-radius: 0px; 
                border-radius: 0px; 
            }
        </style>
    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $_GET['winTitulo']; ?> comit&eacute; SST</h3>
                </div>
                <div class="panel-body">
                    <form  id="frmComiteSst" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <span id="msjTabErrores" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tabConvocatoria"   data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Convocatoria</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabVigencia" data-toggle="tab"  iaria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Vigencia</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabIntegrante" data-toggle="tab"   aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Integrantes</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabConvocatoria"> 
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Fecha de convocatoria</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFecConvocatoria">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                            <span id="msjFecConvocatoria" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 m-t-20" id="divDocDescarga">
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="#" target="_blank" class="btn btn-info w-sm m-b-5" id="btnDescarga" style="border-radius: 0px;">
                                        <i class="fa fa-cloud-download"></i>&ensp;Descargar documento
                                    </a>
                                    &nbsp;&nbsp;<b class="" id="docInfo"></b>
                                </div>
                            </div>
                        </div>
                                        <div class="form-group col-md-6 m-t-20" id="divDocCarga">
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="fileUpload btn btn-purple">
                                                    <span><i class="ion-upload m-r-5"></i>Cargar evidencia de convocatoria *</span>
                                                    <input type="file" id="fileConvocatoria" name="fileConvocatoria" class="upload"
                                                           onchange="$('#fileInfoConvocatoria').html($(this).val().slice(12));"/>
                                                </div>
                                                &nbsp;&nbsp;<b class="" id="fileInfoConvocatoria">Ning&uacute;n documento seleccionado</b>
                                                <input type="hidden" id="secretFileConvocatoria" value="" />
                                            </div>
                                            <span id="msjDocConvocatoria" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Comentario</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <textarea type="text" id="txtComentario" name="txtComentario" class="form-control" value=""
                                                          maxlength="1000" style="min-height:115px"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabVigencia"> 
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Fecha de elecci&oacute;n</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFecEleccion">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <span id="msjFecEleccion" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Fecha de inicio de actividades</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFecInicio">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                                <span id="msjFecInicio" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha de fin de actividades</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFecFin">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                                <span id="msjFecFin" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabIntegrante"> 
                                    <div class="row">
                                        <div class="form-group col-md-6" id="divDocCargaEleccion">
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="fileUpload btn btn-purple">
                                                    <span><i class="ion-upload m-r-5"></i>Cargar evidencia de elecci&oacute;n *</span>
                                                    <input type="file" id="fileEleccion" name="fileEleccion" class="upload"
                                                           onchange="$('#fileInfoEleccion').html($(this).val().slice(12));"/>
                                                </div>
                                                &nbsp;&nbsp;<b class="" id="fileInfoEleccion">Ning&uacute;n documento seleccionado</b>
                                                <input type="hidden" id="secretFileEleccion" value="" />
                                            </div>
                                            <span id="msjDocEleccion" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        
                            <div class="form-group col-md-6" id="divDocDescargaEleccion">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="#" target="_blank" class="btn btn-info w-sm m-b-5" id="btnDescargaEleccion" style="border-radius: 0px;">
                                        <i class="fa fa-cloud-download"></i>&ensp;Descargar documento
                                    </a>
                                    &nbsp;&nbsp;<b class="" id="docInfoEleccion"></b>
                                </div>
                            </div>
                        
                                    </div>
                                    <div class="row"  id="agregar">
                                        <div class="form-group col-md-5">
                                            <label>Colaborador *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select id="cboColaborador" name="cboColaborador" class="select2">
                                                </select>
                                            </div>
                                            <span id="msjColaborador" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <input type="hidden" id="idDet" value="<?php echo $_GET['idDet']; ?>" />
                                        <input type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
                                        <input type="hidden" id="op" value="<?php echo $_GET['winTitulo']; ?>" />
                                        <input type="hidden" id="convocatoriaDocId" value="" />
                                        <input type="hidden" id="eleccionDocId" value="" />
                                        <div class="form-group col-md-5">
                                            <label>Cargo *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select id="cboCargo" name="cboCargo" class="select2" >
                                                </select>
                                            </div>
                                            <span id="msjCargo" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>&nbsp;</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-info w-sm m-b-5" 
                                                        style="border-radius: 0px;" onclick="enviarGrid()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12" >
                                            <div class="table">
                                                <div id="dataList2">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>


                        <div class="row" id="divOpeEdita">
                            <div class="form-group col-md-12">
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="cargarPantallaListar()" 
                                   style="border-radius: 0px;">
                                    <i class="fa fa-close"></i>&ensp;Cancelar
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnEnviar" name="btnEnviar" class="btn btn-info w-sm m-b-5" 
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
        <script src="vistas/com/comite/comite_form.js"></script>
    </body>
</html>

