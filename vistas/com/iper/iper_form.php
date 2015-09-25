<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $_GET['winTitulo']; ?>  IPER</h3>
                </div>
                <div class="panel-body">
                    <form  id="frmIper" method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label>Código*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="txtCodigoIper" placeholder="Codigo" name="txtCodigoIper" class="form-control" value="">
                                </div>
                                <span id="msjTxtCodigoIper" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Gerencia*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="" data-placeholder="Gerencia" tabindex="-1" id="cboGerencia" title="">
                                        <option value="">&nbsp;</option>
                                    </select>
                                </div>
                         <span id="msjCboGerencia" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Puesto*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="" data-placeholder="Puesto" id="cboPuesto" tabindex="-1" title="">
                                    <option value="">&nbsp;</option>
                                    </select>
                                </div>
                                <span id="msjCboPuesto" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <label>Actividad (es)*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="" multiple=""  data-placeholder="Actividad"  id="cboActividad" tabindex="-1">
                                    
                                    </select>
                                   
                                </div>
                                
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input  id="txtActividad" class="form-control" value="">
                                </div>
                                <span id="msjCboActividad" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label>Descripción del peligro*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="" id="cboDescripcionPel" multiple="" data-placeholder="Descripción del peligro" tabindex="-1" title="">
                                        
                                    </select>
                                </div>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="txtDescripcionPel" class="form-control" value="">
                                </div>
                                <span id="msjCboDescripcionPel" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label>Consecuencia del peligro*</label>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class=""id="cboConsecuenciaPel" multiple="multiple" data-placeholder="Consecuencia del peligro" tabindex="-1" title="">
                                    </select>
                                </div>
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="txtConsecuenciaPel" class="form-control" value="">
                                </div>
                                <span id="msjCboConsecuenciaPel" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            </div>
                        </div>

                        <div class="row">
                            <span id="msjTabErrores" class="control-label" style="color:red;font-style: normal;" hidden></span>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tabSituacionActual"   data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Situaci&oacute;n actual</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#tabMedidasControl" data-toggle="tab"  iaria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Medidad de control a implementar</span>
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabSituacionActual"> 
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Situación temporal*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionTem" data-placeholder="Situación temporal" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                            <span id="msjCboSituacionTem" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Tipo de actividad*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionTipAct" data-placeholder="Tipo de actividad" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                            <span id="msjCboSituacionTipAct" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Requisito legal*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionReqLeg" multiple="multiple" data-placeholder="Requisitos legales" tabindex="-1" title="">
                                                </select>
                                            </div>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtSituacionReqLeg" name="txtSituacionReqLeg" class="form-control" value="">
                                            </div>
                                            <span id="msjCboSituacionReqLeg" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Medidas de control existentes*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionMedExi" multiple="multiple" data-placeholder="Medidas de control existentes" tabindex="-1" title="">
                                                </select>
                                            </div>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtSituacionMedExi" name="" class="form-control" value="">
                                            </div>
                                            <span id="msjCboSituacionMedExi" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Probabilidad*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionPro" data-placeholder="Probabilidad" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                            <span id="msjCboSituacionPro" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Exposición*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionExp" data-placeholder="Exposición" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                            <span id="msjCboSituacionExp" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Severidad*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboSituacionSev" data-placeholder="Severidad" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                            <span id="msjCboSituacionSev" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Significancia*</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" readonly="true" id="txtSituacionSig" class="form-control" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabMedidasControl"> 
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Sistemas de bloqueo:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasSisBlo" multiple="multiple" data-placeholder="Sistemas de bloqueo" tabindex="-1">
                                                </select>
                                            </div>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtMedidasSisBlo" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Equipos / tecnología:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" multiple="multiple" id="cboMedidasEquiTec" data-placeholder="Equipos / tecnología" tabindex="-1">
                                                </select>
                                            </div>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtMedidasEquiTec"  class="form-control" value="">
                                            </div>
                                            <span id="msjCboMedidasEquiTec" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Monitoreo / mantenimiento / inspección:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasMonMan" multiple="multiple" data-placeholder="Monitoreo / mantenimiento / inspección" tabindex="-1">
                                                  
                                                </select>
                                            </div>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtMedidasMonMan" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Entrenamiento de personal:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasEntPer" multiple="multiple" data-placeholder="Entrenamiento de personal" tabindex="-1">
                                                    </select>
                                            </div>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txtMedidasEntPer" class="form-control" value="">
                                            </div>
                                            <span id="msjCboMedidasEntPer" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Elaboración de procedimientos administrativos:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasElaPro" multiple="multiple" data-placeholder="Elaboración de procedimientos" tabindex="-1">
                                                  </select>
                                            </div>
                                            <span id="msjCboSituacionElaPro" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Probabilidad:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasPro" data-placeholder="Probabilidad" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                   
                                                </select>
                                            </div>
                                            <span id="msjCboMedidasPro" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Exposición:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasExp" data-placeholder="Exposición" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                            <span id="msjCboMedidasExp" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Severidad:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="" id="cboMedidasSev" data-placeholder="Severidad" tabindex="-1" title="">
                                                    <option value="">&nbsp;</option>
                                                    
                                                </select>
                                            </div>
                                            <span id="msjCboMedidasSev" class="control-label" style="color:red;font-style: normal;" hidden></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Significancia:</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" readonly="true" id="txtMedidasSig" class="form-control" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> 
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="button" name="btnAgregar" id="btnAgregar" onclick="cargarCamposFormulario();" class="btn btn-info w-sm m-b-5" style="border-radius: 0px;"><i class="fa fa-plus-square-o"></i> Agregar</button>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div id="dataList">

                                </div>

                            </div> 
                        </div>
                        <div class="row" id="divOpeEdita">
                            <div class="form-group col-md-12">
                                <a href="#" class="btn btn-danger m-b-5" id="btnCancelar" onclick="cargarPantallaListarIper()" 
                                   style="border-radius: 0px;">
                                    <i class="fa fa-close"></i>&ensp;Cancelar
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnEnviar" name="btnEnviar" class="btn btn-info w-sm m-b-5" 
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
        <script src="vistas/libs/imagina/assets/select2/select2.full.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/assets/tagsinput/jquery.tagsinput.min.js" type="text/javascript"></script>
        <script src="vistas/libs/imagina/js/jquery.tool.js"></script>
        <script src="vistas/com/iper/iper_form.js"></script>
    </body>
</html>

