<?php

require_once __DIR__ . '/../../modeloNegocio/sst/IperNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/GerenciaNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/PuestoNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class IperControlador extends ControladorBase {

    public function listarIperProcedimiento() {
        return IperNegocio::create()->listarIperProcedimiento();
    }
    
    public function crearIperProcedimiento() {
        $this->setTransaction();
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return IperNegocio::create()->crearIperProcedimiento($codigo, $version, $comentario,
                $documento, $docNombre, $estado, $usuCreacion);
    }
 

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return IperNegocio::create()->cambiarEstado($id, $estado);
    }
    
   
    public function obtenerGerenciaLegado() {
        return GerenciaNegocio::create()->obtenerGerenciaLegado();
    }
    public function obtenerPuesto() {
        return PuestoNegocio::create()->obtenerPuestoLegado();
    }
    public function obtenerSituacionTemporal(){
        return IperNegocio::create()->obtenerSituacionTemporal();
    }
    public function obtenerTipoActividad(){
        return IperNegocio::create()->obtenerTipoActividad();
    }
    public function obtenerProbabilidad(){
        return IperNegocio::create()->obtenerProbabilidad();
    }
    public function obtenerExposicion(){
        return IperNegocio::create()->obtenerExposicion();
    }
    public function obtenerSeveridad(){
        return IperNegocio::create()->obtenerSeveridad();
    }
    public function listarIperReqLegales(){
        return IperNegocio::create()->listarIperReqLegales();
    }
     public function listarIperMedControl(){
        return IperNegocio::create()->listarIperMedcontrol();
    }
     public function listarIperPeligro(){
        return IperNegocio::create()->listarIperPeligro();
    }
     public function listarIperPelConsecuencias(){
        return IperNegocio::create()->listarIperPelConsecuencias();
    }
    
    public function configuracionesIniciales() {
        return IperNegocio::create()->configuracionesIniciales();
    }
    public function insetarIperValorRiesgo() {
       
        $limInf=  $this->getParametro("limInf");
        $limSup=  $this->getParametro("limSup");
        $significancia=  $this->getParametro("significancia");
        $usuCreacion = $this->getUsuarioId();
       return IperNegocio::create()->insertarIperValorRiesgo($limInf,$limSup,$significancia,$usuCreacion); 
    }
}
