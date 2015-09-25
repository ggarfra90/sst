<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" ></link>

    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $_GET['winTitulo']; ?> reuni&oacute;n comit&eacute; SST</h3>
                </div>
                <div class="panel-body">
                    <form  id="frmComiteSst" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <span id="msjTabErrores" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tabDatosReunion"   data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Datos de reuni&oacute;n</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabAgenda" data-toggle="tab"  iaria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Agenda</span>
                                    </a>
                                </li>
                                <li id="liAcuerdos" >
                                    <a href="#tabAcuerdos" data-toggle="tab"   aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Acuerdos</span>
                                    </a>
                                </li>
                                <li id="liAcuerdosP" >
                                    <a href="#tabAcuerdosPendientes" data-toggle="tab"   aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Acuerdos pendientes</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabDatosReunion"> 
                                    <div class="row">
                                        <div class="form-group col-md-4 ">
                                            <label>Fecha de reunión:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFecReunion">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                            <span id="msjTxtFecReunion" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                                        </div>
                                        <div class="form-group col-md-4 ">
                                            <label>Hora de reunión:</label>
                                            <div class="input-group col-md-12">
                                                <div class="bootstrap-timepicker">
                                                    <input id="txtReuHora" type="text" class="form-control"/>
                                                </div>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                            <span id="msjTxtReuHora" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                                        </div>
                                        <div class="form-group col-md-4 ">
                                            <label>Lugar de reunión:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtLugar" name="txtLugar" class="form-control" value="">
                                            </div>
                                            <span id="msjTxtLugar" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                                        </div>
                                    </div>
                                    <div class="row" id="divAsistentes">
                                        <div class="form-group col-md-12">
                                            <label>Asistentes:</label>
                                            <div class="table">
                                                <div id="dataList1">

                                                </div>
                                                <div style="clear:left">
                                                    <p><b>Leyenda:</b>&nbsp;&nbsp;
                                                        <i class="ion-checkmark-circled" style="color:#5cb85c;"></i> Miembro asistente a la reuni&oacute;n &nbsp;&nbsp;&nbsp;
                                                        <i class="ion-flash-off" style="color:#cb2a2a;"></i> Miembro no asistente a la reuni&oacute;n&nbsp;&nbsp;&nbsp;
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabAgenda"> 
                                    <div class="row" >
                                        <div class="form-group col-md-12">
                                            <button  type="button" id="btnAgenda" class="btn btn-info w-md m-b-15" style="border-radius: 0px;" onclick="agregarAgenda();" ><i class="fa fa-pencil" style="font-size: 16px;"></i>&nbsp;&nbsp;<i> </i><i> </i>Nuevo</button>
                                            <div class="table">
                                                <div id="dataList2">

                                                </div>
                                                <div style="clear:left">
                                                    <p><b>Leyenda:</b>&nbsp;&nbsp;
                                                        <i class="fa fa-edit" style="color:#E8BA2F;"></i> Editar la información (visible hasta el d&iacute; de la reuni&oacute;n)&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-trash-o" style="color:#cb2a2a;"></i> Eliminar tema de reunión (visible hasta el d&iacute;a de la reuni&oacute;n)&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-list-alt" style="color:#DB94B8;"></i> Ver detalle (visible luego del d&iacute;a de la reunión)&nbsp;&nbsp;&nbsp;
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="comiteId" value="<?php echo $_GET['comiteId']; ?>" />
                                <input type="hidden" id="comiteReuId" value="<?php echo $_GET['comiteReuId']; ?>" />
                                <input type="hidden" id="idDet" value="<?php echo $_GET['idDet']; ?>" />
                                <input type="hidden" id="idEdit" value="<?php echo $_GET['idEdit']; ?>" />
                                <div class="tab-pane" id="tabAcuerdos"> 
                                    <div class="row" >
                                        <div class="form-group col-md-12">
                                            <button  type="button" id="btnAcuerdo" class="btn btn-info w-md m-b-15" style="border-radius: 0px;" onclick="agregarAcuerdo();" ><i class="fa fa-pencil" style="font-size: 16px;"></i>&nbsp;&nbsp;<i> </i><i> </i>Nuevo</button>
                                            <div class="table">
                                                <div id="dataList3">

                                                </div>
                                                <div style="clear:left">
                                                    <p><b>Leyenda:</b>&nbsp;&nbsp;
                                                        <i class="fa fa-edit" style="color:#E8BA2F;"></i> Editar la información (visible hasta el fdd de la reunión)&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-trash-o" style="color:#cb2a2a;"></i> Eliminar acuerdo (visible hasta el fdd de la reunión)&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-list-alt" style="color:#DB94B8;"></i> Ver detalle (visible luego del día de la reunión)&nbsp;&nbsp;&nbsp;
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabAcuerdosPendientes"> 
                                    <div class="row" >
                                        <div class="form-group col-md-12">
                                            <div class="table">
                                                <div id="dataList4">

                                                </div>
                                                <div style="clear:left">
                                                    <p><b>Leyenda:</b>&nbsp;&nbsp;
                                                        <i class="fa fa-edit" style="color:#E8BA2F;"></i> Editar la informaci&oacute;n &nbsp;&nbsp;&nbsp;
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>


                        <div class="row" id="divOpeEdita">
                            <input type='hidden' id='txtPendiente' value='#'>
                            <div class="form-group col-md-12">
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="cargarPantallaListar()" 
                                   style="border-radius: 0px;">
                                    <i class="fa fa-close"></i>&ensp;Cancelar
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnEnviar" name="btnEnviar" class="btn btn-info w-sm m-b-5" 
                                        style="border-radius: 0px;" onclick="enviarReunion('<?php echo $_GET['winTitulo']; ?>')">
                                    <i class="fa fa-send-o"></i>&ensp;Enviar
                                </button>
                            </div>
                        </div>
                       

                    </form>
                </div>
            </div>
        </div>


        <!-- start Modal agregar nueva agenda      -->
        <div id="modalAgregarAgenda" class="modal fade" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title">Nuevo tema de agenda</h4> 
                    </div> 
                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-1" class="control-label">Tema:</label> 
                                    <input type="text" class="form-control" id="txtTemaAge"> 
                                </div> 
                                <span id="msjTxtTema" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="control-label">Propuesto por:</label>
                                    <select id="cboColaboradorAge" data-placeholder="Seleccione Colaborador" tabindex="-1" title="">
                                        <option value="">&nbsp;</option>
                                    </select>
                                </div> 
                                <span id="msjCboColaboradorAge" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="field-7" class="control-label">Detalle:</label> 
                                    <textarea class="form-control autogrow" id="txtDetalleAge" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea> 
                                </div> 
                                <span id="msjTxtDetalleAge" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div>
                            <input type='hidden' id='TxtGrid' value='#'>
                        </div>

                    </div> 
                    <div class="modal-footer"> 
                        <button type="button" id="cancelar" class="btn btn-danger"  style="border-radius: 0px;" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                        <button type="button" id="btnEnviarGrid" class="btn btn-info" onclick="enviarGrid();" style="border-radius: 0px;"><i class="fa fa-send-o"></i> Enviar</button>
                    </div> 
                </div>
            </div>
        </div>
        <!--  End Agregar nueva agenda -->

        <!-- start Modal agregar nuevo acuerdo      -->
        <div id="modalAgregarAcuerdo" class="modal fade" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                        <h4 class="modal-title" id="modalTitulo"></h4> 
                    </div> 
                    <div class="modal-body"> 
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="control-label">Tema:</label>
                                    <select id="cboTemaAcu" data-placeholder="Seleccione Tema" tabindex="-1" title="">
                                        <option value="">&nbsp;</option>
                                    </select>
                                </div>
                                <span id="msjCboTemaAcu" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label for="field-2" class="control-label">Propuesto por:</label>
                                    <select id="cboColaboradorAcu" data-placeholder="Colaborador" tabindex="-1" title="">
                                        <option value="">&nbsp;</option>
                                    </select>
                                </div>
                                <span id="msjCboColaboradorAcu" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div> 
                        </div>
                        <input type='hidden' id='TxtGridAcuerdo' value='#'/>
                        <div class="row">
                            <div class="col-md-6 ">
                                <label>Fecha de vencimiento:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFecVenAcu">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                                <span id="msjTxtFecVenAcu" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="field-7" class="control-label">Detalle:</label> 
                                    <textarea class="form-control autogrow"  id="txtDetalleAcu" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea> 
                                </div>
                                <span id="msjTxtDetalleAcu" class="control-label" style="color:red;font-style: normal;" hidden=""></span>
                            </div> 
                        </div>
                        <div class="row" id="divEvidencia"> 
                            <div class="col-md-12"> 
                                <div class="form-group no-margin"> 
                                    <label for="field-7" class="control-label">Evidencia de atención:</label> 
                                    <textarea class="form-control autogrow" id="txtEvidenciaAcu" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea> 
                                </div> 
                            </div>
                            <div class="form-group col-md-12 m-t-20" id="divDocCarga">
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="fileUpload btn btn-purple">
                                                    <span><i class="ion-upload m-r-5"></i>Cargar documento*</span>
                                                    <input type="file" id="fileCierre" name="fileCierre" class="upload"
                                                           onchange="$('#fileInfoCierre').html($(this).val().slice(12));"/>
                                                </div>
                                                &nbsp;&nbsp;<b class="" id="fileInfoCierre">Ning&uacute;n documento seleccionado</b>
                                                <input type="hidden" id="secretFileCierre" value="" />
                                            </div>
                                            <span id="msjDocCierre" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                        </div>
                        
                    </div> 
                    <div class="modal-footer"> 
                        <button type="button"  class="btn btn-danger" id="cancelarAcuerdo" style="border-radius: 0px;" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                        <button type="button" id="btnEnviarGridA" class="btn btn-info" onclick="enviarGridAcuerdo();" style="border-radius: 0px;"><i class="fa fa-send-o"></i> Enviar</button>
                    </div> 
                </div>
            </div>
        </div>
        <!--  End Agregar nuevo acuerdo -->
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/sweetalert2/sweetalert.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/util/Utils.js"></script>
        <script src="vistas/com/comite/reunionComite_form.js"></script>
    </body>
</html>

