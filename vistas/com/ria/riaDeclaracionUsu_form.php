<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" ></link>
    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Registrar declaración de trabajador</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                    <span id="msjTabErrores" class="control-label" style="color:red;font-style: normal;" hidden></span>
                    </div>
                    <form  id="frmRiaDeclaracionUsu" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tabEvento" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Evento</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabReunion" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Reuni&oacute;n</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabDeclaracion" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Declaraci&oacute;n</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabRegistro" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Registro</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabEvento"> 
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Fecha de evento *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="yyyy-dd-mm" id="txtEveFecha">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <span id="msjEveFecha" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Hora de evento *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="bootstrap-timepicker">
                                                    <input id="txtEveHora" type="text" class="form-control"/>
                                                </div>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                            <span id="msjEveHora" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Tipo de evento *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select id="cboEveTipo" name="cboEveTipo" class="select2">
                                                </select>
                                            </div>
                                            <span id="msjEveTipo" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Tipo de participaci&oacute;n *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select id="cboEveParticipacion" name="cboEveParticipacion" class="select2">
                                                </select>
                                            </div>
                                            <span id="msjEveParticipacion" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabReunion"> 
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Lugar de reuni&oacute;n *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtReuLugar" name="txtReuLugar" class="form-control" 
                                                       value="" maxlength="100" />
                                            </div>
                                            <span id="msjReuLugar" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha de reuni&oacute;n *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="yyyy-dd-mm" id="txtReuFecha">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <span id="msjReuFecha" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Hora de inicio *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="bootstrap-timepicker">
                                                    <input id="txtReuHoraIni" type="text" class="form-control"/>
                                                </div>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                            <span id="msjReuHoraIni" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Hora de fin *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="bootstrap-timepicker">
                                                    <input id="txtReuHoraFin" type="text" class="form-control"/>
                                                </div>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                            <span id="msjReuHoraFin" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabDeclaracion">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>1. ¿Cuál es su ocupación actual y tiempo de experiencia? *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtDecPregunta1" name="txtDecPregunta1" class="form-control" 
                                                       value="" maxlength="1000" />
                                            </div>
                                            <span id="msjDecPregunta1" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>2. ¿Qué tiempo conoce al que sufrió el accidente y que grado de confianza tiene? (Sólo si es testigo)</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtDecPregunta2" name="txtDecPregunta2" class="form-control" 
                                                       value="" maxlength="1000" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>3. ¿Conoce Ud. el estándar o procedimiento? (Si el evento está asociado a un estándar o procedimiento)</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtDecPregunta3" name="txtDecPregunta3" class="form-control" 
                                                       value="" maxlength="1000" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>4. ¿Qué se encontraba haciendo en el momento del incidente? Narre los hechos *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <textarea type="text" id="txtDecPregunta4" name="txtDecPregunta4" class="form-control" value=""
                                                          maxlength="1000" style="min-height:115px"></textarea>
                                            </div>
                                            <span id="msjDecPregunta4" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>5. ¿Cómo se percata del incidente? Narre los hechos (Sólo si es testigo)</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <textarea type="text" id="txtDecPregunta5" name="txtDecPregunta5" class="form-control" value=""
                                                          maxlength="1000" style="min-height:115px"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>6. ¿Cuál cree usted, que fue la causa del incidente? *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtDecPregunta6" name="txtDecPregunta6" class="form-control" 
                                                       value="" maxlength="1000" />
                                            </div>
                                            <span id="msjDecPregunta6" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>7. ¿Cómo se puede evitar un incidente similar? *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtDecPregunta7" name="txtDecPregunta7" class="form-control" 
                                                       value="" maxlength="1000" />
                                            </div>
                                            <span id="msjDecPregunta7" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>8. ¿Tiene algo más que agregar? *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtDecPregunta8" name="txtDecPregunta8" class="form-control" 
                                                       value="" maxlength="1000" />
                                            </div>
                                            <span id="msjDecPregunta8" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabRegistro"> 
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="fileUpload btn btn-purple">
                                                    <span><i class="ion-upload m-r-5"></i>Cargar registro fotogr&aacute;fico *</span>
                                                    <input type="file" id="file" name="file" class="upload"
                                                           onchange="$('#fileInfo').html($(this).val().slice(12));"/>
                                                </div>
                                                &nbsp;&nbsp;<b class="" id="fileInfo">Ning&uacute;n documento seleccionado</b>
                                                <input type="hidden" id="secretFile" value="" />
                                            </div>
                                            <span id="msjRegEvidencia" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Descripci&oacute;n del registro *</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <textarea type="text" id="txtRegDescripcion" name="txtRegDescripcion" class="form-control" value=""
                                                          maxlength="1000" style="min-height:115px"></textarea>
                                            </div>
                                            <span id="msjRegDescripcion" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="limpiarPantalla()" 
                                   style="border-radius: 0px;">
                                    <i class="fa fa-close"></i>&ensp;Cancelar
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-info w-sm m-b-5" 
                                        style="border-radius: 0px;" onclick="enviar()">
                                    <i class="fa fa-send-o"></i>&ensp;Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/libs/imagina/assets/datatables/dataTables.bootstrap.js"></script>  
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>

        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/ria/riaDeclaracionUsu_form.js"></script>
    </body>
</html>

