<?php

require_once __DIR__ . '/../../modeloNegocio/sst/ComiteNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/ComiteSstReunionNegocio.php';

require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class ComiteSstControlador extends ControladorBase {

    public function listarComite() {
        return ComiteNegocio::create()->listarComite();
    }

    public function obtenerComiteColaborador() {
        return ComiteNegocio::create()->obtenerComiteColaborador();
    }

    public function obtenerComiteCargo() {
        return ComiteNegocio::create()->obtenerComiteCargo();
    }
    
    public function crearComite() {
        $this->setTransaction();
        $fecConvocatoria = $this->getParametro("fecConvocatoria");
        $comentario = $this->getParametro("comentario");
        $fecEleccion = $this->getParametro("fecEleccion");
        $fecInicio = $this->getParametro("fecInicio");
        $fecFin = $this->getParametro("fecFin");
        $docConvocatoria = $this->getParametro("docConvocatoria");
        $docConvocatoriaNombre = $this->getParametro("docConvocatoriaNombre");
        $usuCreacion = $this->getUsuarioId();
        $docEleccion = $this->getParametro("docEleccion");
        $docEleccionNombre = $this->getParametro("docEleccionNombre");
        return ComiteNegocio::create()->crearComite($fecEleccion,$fecInicio,$fecFin,$docConvocatoria,
            $docConvocatoriaNombre,$fecConvocatoria,$comentario,$usuCreacion,$docEleccion,$docEleccionNombre);
    }
    
    public function actualizarComite() {
        $this->setTransaction();
        $id = $this->getParametro("id");
        $idConv = $this->getParametro("idConv");
        $fecConvocatoria = $this->getParametro("fecConvocatoria");
        $comentario = $this->getParametro("comentario");
        $fecEleccion = $this->getParametro("fecEleccion");
        $fecInicio = $this->getParametro("fecInicio");
        $fecFin = $this->getParametro("fecFin");
        $docConvocatoria = $this->getParametro("docConvocatoria");
        $docConvocatoriaNombre = $this->getParametro("docConvocatoriaNombre");
        $docConvocatoriaId = $this->getParametro("docConvocatoriaId");
        $docEleccion = $this->getParametro("docEleccion");
        $docEleccionNombre = $this->getParametro("docEleccionNombre");
        $docEleccionId = $this->getParametro("docEleccionId");
        $bandera = $this->getParametro("bandera_doc");
        $usuCreacion = $this->getUsuarioId();
        return ComiteNegocio::create()->actualizarComite($id,$idConv, $fecEleccion, $fecInicio, $fecFin,$docConvocatoriaId,$docConvocatoria, $docConvocatoriaNombre, 
        $fecConvocatoria, $comentario, $usuCreacion,$docEleccionId, $docEleccion, $docEleccionNombre,$bandera);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return ComiteNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerComiteXid(){
        $id = $this->getParametro("id");
        return ComiteNegocio::create()->obtenerComiteXid($id);
    }
    public function obtenerMiembroXid(){
        $id = $this->getParametro("idDet");
        return ComiteNegocio::create()->obtenerMiembroXid($id);
    }
    public function crearGridMiembro() {
         $usuarioId = $this->getParametro("cboUsuarioId");
        $cargoId = $this->getParametro("cboCargo");
        return ComiteNegocio::create()->crearGrid($usuarioId,$cargoId);
    }
    public function eliminarGridMiembro() {
         $Id = $this->getParametro("idGrid");
        return ComiteNegocio::create()->eliminarGrid($Id);
        
    }
    public function obtenerOrganigrama(){
        
        return ComiteNegocio::create()->obtenerOrganigrama($id);
    }
    
    
    // comite_sst_reunion
    
      public function listarReunion() {
        return ComiteSstReunionNegocio::create()->listarReunion();
    }
    public function listarAgenda() {
        return ComiteSstReunionNegocio::create()->listarAgenda();
    }
    public function obtenerMiembrosComite() {
        return ComiteSstReunionNegocio::create()->obtenerMiembroXid();
    }
    public function crearGridAgenda() {
         $this->setTransaction();
        $tema=  $this->getParametro("tema");
        $detalle=  $this->getParametro("detalle");
        $colaborador=  $this->getParametro("cboUsuarioId");
        return ComiteSstReunionNegocio::create()->crearGrid($tema, $detalle,$colaborador);
    }
    public function crearGridAcuerdo() {
         $this->setTransaction();
        $tema=  $this->getParametro("tema");
        $temaId=  $this->getParametro("temaId");
        $colaborador=  $this->getParametro("cboUsuarioId");
        $fechaVen=  $this->getParametro("fechaVen");
        $detalle=  $this->getParametro("detalle");
        return ComiteSstReunionNegocio::create()->crearGridAcuerdo($tema, $temaId, $colaborador, $fechaVen, $detalle);
    }
    public function editarGridAcuerdo() {
         $this->setTransaction();
          $id=  $this->getParametro("id_gridA");
        $tema=  $this->getParametro("tema");
        $temaId=  $this->getParametro("temaId");
        $colaborador=  $this->getParametro("cboUsuarioId");
        $fechaVen=  $this->getParametro("fechaVen");
        $detalle=  $this->getParametro("detalle");
        return ComiteSstReunionNegocio::create()->editarGridAcuerdo($id,$tema, $temaId, $colaborador, $fechaVen, $detalle);
    }
     public function editarGridAgenda() {
         $this->setTransaction();
         $id=  $this->getParametro("id_grid");
        $tema=  $this->getParametro("tema");
        $detalle=  $this->getParametro("detalle");
        $colaborador=  $this->getParametro("cboUsuarioId");
        return ComiteSstReunionNegocio::create()->editarGrid($id,$tema, $detalle,$colaborador);
    }
     public function eliminarGridAgenda() {
         $Id = $this->getParametro("id_grid");
        return ComiteSstReunionNegocio::create()->eliminarGrid($Id);
        
    }
    public function eliminarGridAcuerdo() {
         $Id = $this->getParametro("id_gridA");
        return ComiteSstReunionNegocio::create()->eliminarGridAcuerdo($Id);
        
    }
    public function obtenerXIdGrid() {
        $id=  $this->getParametro("id_grid");
        return ComiteSstReunionNegocio::obtenerXIdGrid($id);
    }
    public function obtenerXIdGridAcuerdo() {
        $id=  $this->getParametro("id_gridA");
        return ComiteSstReunionNegocio::obtenerXIdGridAcuerdo($id);
    }
    public function insertarReunion() {
         $this->setTransaction();
        $fecha=  $this->getParametro("fecha");
        $hora=  $this->getParametro("hora");
        $ubicacion=  $this->getParametro("ubicacion");
         $usuCreacion = $this->getUsuarioId();
        return ComiteSstReunionNegocio::create()->insertarReunion($fecha, $hora,$ubicacion,$usuCreacion);
        
    }
    public function actualizarReunion() {
         $this->setTransaction();
         $idComite=  $this->getParametro("idComite");
         $idComiteReu=  $this->getParametro("idComiteReu");
        $fecha=  $this->getParametro("fecha");
        $hora=  $this->getParametro("hora");
        $ubicacion=  $this->getParametro("ubicacion");
         $usuCreacion = $this->getUsuarioId();
        return ComiteSstReunionNegocio::create()->actualizarReunion($idComiteReu,$idComite,$fecha, $hora,$ubicacion,$usuCreacion);
        
    }
    public function obtenerReunionXId() {
        $comiteSstReuId=  $this->getParametro("comiteReuId");
        return ComiteSstReunionNegocio::create()->obtenerReunionXId($comiteSstReuId);
    }
    public function obtenerReunionAgendaXId() {
        $comiteSstReuId=  $this->getParametro("comiteReuId");
        return ComiteSstReunionNegocio::create()->obtenerReunionAgendaXId($comiteSstReuId);
    }
    public function obtenerReunionAcuerdoXId() {
        $comiteSstReuId=  $this->getParametro("comiteReuId");
        return ComiteSstReunionNegocio::create()->obtenerReunionAcuerdoXId($comiteSstReuId);
    }
    public function obtenerReunionTemaXId() {
        $comiteSstReuId=  $this->getParametro("comiteReuId");
        return ComiteSstReunionNegocio::create()->obtenerReunionTemaXId($comiteSstReuId);
    }
    public function obtenerReunionPendienteXId() {
        $comiteSstReuId=  $this->getParametro("comiteReuId");
        return ComiteSstReunionNegocio::create()->obtenerReunionPendienteXId($comiteSstReuId);
    }
    public function crearCierreAcuerdo() {
       $idP= $this->getParametro("id_P");
      $documento= $this->getParametro("documento"); 
        $docNombre=$this->getParametro("docNombre");
        $detalle=$this->getParametro("detalle");
        
        return ComiteSstReunionNegocio::create()->crearGridAcuerdoPendiente($idP,$documento,$docNombre,$detalle);
    }
     public function obtenerMiembroXidAsistencia(){
        $id = $this->getParametro("idComite");
        $idReu = $this->getParametro("idReu");
        return ComiteSstReunionNegocio::create()->obtenerMiembroXidAsistencia($id,$idReu);
    }
    public function asistenciaComiteSstReunion() {
              $comiteSstReuId= $this->getParametro("reuId"); 
        $miembroId=$this->getParametro("mieId");
         $usuCreacion = $this->getUsuarioId();
        return ComiteSstReunionNegocio::create()->asistenciaComiteSstReunion($comiteSstReuId,$miembroId,$usuCreacion);
    }
}
