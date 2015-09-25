<?php

require_once __DIR__ . '/../../modelo/sst/Iper.php';
require_once __DIR__ . '/../../modelo/sst/IperValorRiesgo.php';
require_once __DIR__ . '/../../modelo/sst/Parametro.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class IperNegocio extends ModeloNegocioBase {

    public function listarIperProcedimiento() {
        return Iper::create()->listarIperProcedimiento();
    }

    public function crearIperProcedimiento($codigo, $version, $comentario, $docEncode, 
            $docNombre, $estado, $usuCreacion) {
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_IPERPROCEDIMIENTO, $docEncode,
                $docNombre, ConstantesNegocio::FILE_IPER, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
        return Iper::create()->insertarIperProcedimiento($doc[0]["id"], $codigo, $version, $comentario, 
                $estado, $usuCreacion);
    }

    public function actualizarIperProcedimiento($id, $codigo, $version, $comentario, $docEncode, 
                $docNombre, $docId, $estado, $usuCreacion) {
        if($docId == "" || $docId == null){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_IPERPROCEDIMIENTO, $docEncode,
                $docNombre, ConstantesNegocio::FILE_IPER, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
            $docId = $doc[0]["id"];
        }
        return Iper::create()->actualizarIperProcedimiento($id, $docId, $codigo, $version, 
                $comentario, ConstantesNegocio::FLUDOC_ENVIADO, $estado);
    }

    function cambiarEstado($id, $estado){
        $tabla = ConstantesNegocio::TBL_IPERPROCEDIMIENTO;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    function obtenerIperProcedimientoXid($id){
        return Iper::create()->obtenerIperProcedimientoXid($id);
    }
    
    function cambiarPublicacion($documentoId, $estadoPublicacion){
        $publicado = ConstantesNegocio::FLUDOC_APROBADO;
        if($estadoPublicacion == ConstantesNegocio::PARAM_ACTIVO){
            $publicado = ConstantesNegocio::FLUDOC_PUBLICADO;
        }
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, $publicado);
    }
    public function configuracionesIniciales() {
        $response=new ObjectUtil();
        $response->situacionTemporal= $this->obtenerSituacionTemporal();
        $response->tipoActividad= $this->obtenerTipoActividad();
        $response->probabilidad= $this->obtenerProbabilidad();
        $response->exposicion= $this->obtenerExposicion();
        $response->severidad= $this->obtenerSeveridad();
        $response->listarReqLegales=  $this->listarIperReqLegales();
        $response->listarMedControl=  $this->listarIperMedControl();
        $response->listarPeligro= $this->listarIperPeligro();
        $response->listarPelConsecuencias=  $this->listarIperPelConsecuencias();
        return $response;
    }
    function obtenerSituacionTemporal(){
        return Iper::create()->obtenerXIdIperPelCaracter(ConstantesNegocio::PAR_TIPESITE);
    }
    function obtenerTipoActividad(){
        return Iper::create()->obtenerXIdIperPelCaracter(ConstantesNegocio::PAR_TIPETIAC);
    }
    function obtenerProbabilidad(){
        return Iper::create()->obtenerXIdIperFacEvaluacion(ConstantesNegocio::PAR_TIPEPROB);
    }
    function obtenerExposicion(){
        return Iper::create()->obtenerXIdIperFacEvaluacion(ConstantesNegocio::PAR_TIPEEXPO);
    }
    function obtenerSeveridad(){
        return Iper::create()->obtenerXIdIperFacEvaluacion(ConstantesNegocio::PAR_TIPESEVE);
    }
    public function listarIperReqLegales() {
        return Iper::create()->listarIperReqLegales();
    }
     public function listarIperMedControl() {
        return Iper::create()->listarIperMedControl();
    }
     public function listarIperPeligro() {
        return Iper::create()->listarIperPeligro();
    }
     public function listarIperPelConsecuencias() {
        return Iper::create()->listarIperPelConsecuencias();
    }
    
    public function insertarIperValorRiesgo($limInf,$limSup,$significancia,$usuCreacion) {
        
        
        for ($i = 0; $i < count($significancia); $i++) {
            $inf=$limInf[$i];
            $sup=$limSup[$i];
          
            if($i==0){
            $codigo=  ConstantesNegocio::PAR_VR_BAJO;
        }
        if($i==1){
            $codigo=  ConstantesNegocio::PAR_VR_MEDIO;
        }
        if($i==2){
            $codigo=  ConstantesNegocio::PAR_VR_ALTO;
        }
        if($i==3){
            $codigo=  ConstantesNegocio::PAR_VR_CRITICO;
        }
            $response=  IperValorRiesgo::create()->insertarIperValorRiesgo($codigo, $inf, $sup, $significancia[$i],$usuCreacion);
            if($response[0]['vout_exito']==ConstantesNegocio::VOUT_ERROR){
                  $respuesta[0]['vout_exito']=0;
                $respuesta[0]['vout_mensaje']=$response[0]['vout_mensaje'];
                return $respuesta;
            }else{
                $respuesta[0]['vout_exito']=1;
                $respuesta[0]['vout_mensaje']=$response[0]['vout_mensaje'];
            }
        }
        return $respuesta;
    }
}
