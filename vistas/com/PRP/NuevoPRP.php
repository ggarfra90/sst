<?php
//
//session_start();
//$id = null;
//$tipo = null;
//extract($_REQUEST, EXTR_PREFIX_ALL, "f");
//if (isset($f_id)) {
//    $id = (int) filter_var($f_id, FILTER_SANITIZE_NUMBER_INT);
//}
//if (isset($f_tipo)) {
//    //si el tipo es 1 se va a editar
//    $tipo = (int) filter_var($f_tipo, FILTER_SANITIZE_NUMBER_INT);
//}
//if ($tipo == 1)
//    $titulo = "Editar Colaborador";
//else
//    $titulo = "Nuevo Colaborador";
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Nueva Solicitud</title>
        <link href="vistas/libs/imagina/assets/modal-effect/css/component.css" rel="stylesheet">
        <link href="vistas/libs/imagina/assets/select2/select2.css" rel="stylesheet" />
        <link href="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />


        <script>
            altura();
        </script> 
        <?php
//        if ($tipo == 1) {
        ?>
        <script language="javascript">
//                getColaborador(<?php echo $id; ?>);
        </script>
        <?php
//        }
        ?>
    </head>
    <body>
<!--        <section class="content">-->
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><b>&nbsp;&nbsp;&nbsp<?php /* echo $titulo; */ ?>Nuevo PRP</b></h4>
                        
                        <div class="col-md-12 ">
                            <div class="panel-body">
                                <form  id="frm_solicitud"  method="post" class="form" enctype="multipart/form-data;charset=UTF-8">
                                    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['id_usuario']; ?>"/>
                                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Puesto</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select name="cmb_puesto" id="puesto" class="select2">
                                                    <option value="1" >Auxiliar de compras</option>
                                                    <option value="1" >Auxiliar de mantenimiento</option>
                                                    <option value="1" >Ejecutivo de agronomia</option>
                                                    <option value="1" >Ejecutivo de desarrollo</option>
                                                    <option value="1" >Ejecutivo de servicio al cliente</option>
                                                    <option value="1" >Ejecutivo de ventas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cantidad</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_cantidad" name="txt_cantidad" class="form-control" required="" aria-required="true" value=""/>
                                                <!--<input type="text" id="comentario" name="comentario" class="form-control" value=""/>-->
                                            </div>
                                            <span id='msj_txt_cantidad' class="control-label"
                                                  style='color:red;font-style: normal;' hidden></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Area</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_area" name="txt_area" class="form-control" aria-required="true" value="" readonly="true"/>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Centro de costos</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_centro_costos" name="txt_centro_costos" class="form-control" aria-required="true" value="" readonly="true"/>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Responsable</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_responsable" name="txt_responsable" class="form-control" required="" aria-required="true" value=""/>
                                                <!--<input type="text" id="comentario" name="comentario" class="form-control" value=""/>-->
                                            </div>
                                            <span id='msj_txt_responsable' class="control-label"
                                                  style='color:red;font-style: normal;' hidden></span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Causa solicitud</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select name="cmb_causa" id="cmb_causa" class="select2">
                                                    <option value="1" >Reemplazo</option>
                                                    <option value="1" >Adición</option>
                                                    <option value="1" >Reemplazo por maternidad</option>              
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Aprobacion</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_aprobacion" name="txt_aprobacion" class="form-control" required="" aria-required="true" value=""/>
                                                <!--<input type="text" id="comentario" name="comentario" class="form-control" value=""/>-->
                                            </div>
                                            <span id='msj_txt_aprobacion' class="control-label"
                                                  style='color:red;font-style: normal;' hidden></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha requerimiento</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_fecha_requemiento" name="txt_fecha_requemiento" class="form-control" aria-required="true" value="" readonly="true"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Fecha deseable de ingreso</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="datepicker" data-date-format="mm/dd/yyyy" id="txt_deseable_ingreso" name="txt_deseable_ingreso" class="form-control" required="" aria-required="true" value="" style="width:100%"/>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                            <span id='msj_txt_deseable_ingreso' class="control-label"
                                                  style='color:red;font-style: normal;' hidden></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Rango de Sueldo</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" id="txt_sueldo" name="txt_sueldo" class="form-control" required="" aria-required="true" value=""/>  
                                            </div>
                                            <span id='msj_txt_sueldo' class="control-label"
                                                  style='color:red;font-style: normal;' hidden></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Datos de aprobacion</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="select2" multiple name="cmb_dato_aprobacion" id="cmb_dato_aprobacion" data-placeholder="Seleccione...">
                                                    <option value="1">Jefe de area</option>
                                                    <option value="2">Gerente</option>
                                                    <option value="3">Jefe de RH</option>
                                                    <option value="4">Otros</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Datos de TI</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="select2" multiple name="cmb_dato_ti" id="cmb_dato_ti" data-placeholder="Seleccione...">
                                                    <option value="1">Cuenta de correo</option>
                                                    <option value="2">Acceso a intranet</option>
                                                    <option value="3">Acceso a base de datos</option>
                                                    <option value="4">Otros</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Datos de Admin</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="select2" multiple name="cmb_dato_admin" id="cmb_dato_admin" data-placeholder="Seleccione...">
                                                    <option value="1">Automovil</option>
                                                    <option value="2">Celular</option>
                                                    <option value="3">Departamento</option>
                                                    <option value="4">Uniforme</option>
                                                    <option value="5">Otros</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label>Examenes</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="select2" multiple name="cmb_examen" id="cmb_examen" data-placeholder="Seleccione...">
                                                    <option value="1">Psicotecnico | SST</option>
                                                    <option value="2">Preocupacional | BIEN</option>
                                                    <option value="3">Otros | R.H </option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label>Antecedentes</label>
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <select class="select2" multiple name="cmb_antecedentes" id="cmb_antecedentes" data-placeholder="Seleccione...">
                                                    <option value="1">Laborales | R.H 1</option>
                                                    <option value="2">Penales | R.H 2 </option>
                                                    <option value="3">Otros</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <button type="button" name="btnguardarPerfil" id="btnguardarPerfil" class="btn btn-info w-sm m-b-5" style="border-radius: 0px;"><i class="fa fa-check"></i>&ensp;Agregar perfil</button>&nbsp;&nbsp;
                                            <button type="button" name="btnguardarPerfil" id="btnguardarPerfil" class="btn btn-info w-sm m-b-5" style="border-radius: 0px;"><i class="fa fa-save"></i>&ensp;Guardar</button>&nbsp;&nbsp;
                                            <button type="button" name="btnEnviarPerfil" id="btnEnviarPerfil" class="btn btn-info w-sm m-b-5" style="border-radius: 0px;"><i class="fa fa-send-o"></i>&ensp;Enviar</button>&nbsp;&nbsp;
                                            <a href="#" class="btn btn-info w-sm m-b-5" id="id" style="border-radius: 0px;" onclick="cargarDiv('#window', 'vistas/com/solicitud/misSolicitudes.php')" ><i class="fa fa-close"></i>&ensp;Cancelar</a>&nbsp;&nbsp;&nbsp;

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
            </div>
        </div>        

        <script src="vistas/libs/imagina/assets/timepicker/bootstrap-datepicker.js"></script>
        <script src="vistas/libs/imagina/assets/timepicker/locales/bootstrap-datepicker.es.js"></script>
        <script src="vistas/libs/imagina/assets/select2/select2.min.js"></script>
        <script src="vistas/com/solicitud/nuevaSolicitud.js"></script>
        <script>
                                                cargarComponentes();
        </script>

    </body>
    <!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 May 2015 23:15:09 GMT -->
</html>
