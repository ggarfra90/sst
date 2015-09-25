<html lang="es">
    <head>
        <link href="vistas/libs/imagina/assets/sweetalert2/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <script>
            altura();
        </script>   
    </head>

    <body >
        <div class="page-title">
            <h3 class="title">Mantenimiento de usuarios</h3>
        </div>
        <div class="row">

            <!--<div class="col-md-12 col-md-12 col-xs-12">-->
            <div class="panel panel-default">
                <a href="#" style="border-radius: 0px;" class="btn btn-info w-md" onclick="nuevo()"><i class=" fa fa-pencil" style="font-size: 18px;"></i>&nbsp;&nbsp;<i> </i><i> </i>Nuevo</a>
                
                
                <br><br>
                <div class="panel panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style='text-align:center;'>Usuario</th>
                                    <th style='text-align:center;'>Jefe</th>
                                    <th style='text-align:center;'>Gerente</th>
                                    <th style='text-align:center;'>Perfiles</th>
                                    <th style='text-align:center;'>Estado</th>
                                    <th style='text-align:center;'>Acciones</th>
                                </tr>
                            </thead>  
                        </table>
                    </div>
                </div>
                
                <div style="clear:left">
                    <p><b>Leyenda:&nbsp;&nbsp;</b>
                        <a class="accionEditar" title="Editar"><i class="fa fa-pencil-square-o"></i></a> Editar &nbsp;&nbsp;&nbsp;
                        <a class="accionEliminar" title="Eliminar"><i class="fa fa-trash"></i></a> Eliminar &nbsp;&nbsp;&nbsp;
                    </p>
                </div>

                <div id="modalUsuario" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div  class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label>Usuario</label>
                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="cboUsuario" id="cboUsuario" class="select2">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label>Jefe</label>
                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="cboJefe" id="cboJefe" class="select2">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label>Gerente</label>
                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="cboGerente" id="cboGerente" class="select2">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label>Perfiles</label>
                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="cboPerfil" id="cboPerfil" class="select2" multiple="true">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label>Estado</label>
                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select name="cboEstado" id="cboEstado" class="select2">
                                                <option value="1" selected="true">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!--<a href="#" style="border-radius: 0px;" class="btn btn-info w-md" onclick="cargarModal()"><i class=" fa fa-plus-square-o" style="font-size: 18px;"></i>&nbsp;&nbsp;<i> </i><i> </i>Nuevo</a>-->
                                <button type="button" class="btn btn-info" onclick="guardar()" data-toggle="reload"><i class="fa fa-save"></i> Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-android-close"></i> Cancelar</button>
                            </div>
                        </div>
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
        <script src="vistas/com/usuario/usuario.js"></script>
    </body>
    <!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 May 2015 23:15:09 GMT -->
</html>

