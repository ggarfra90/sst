<?php

require_once __DIR__ . '/../../modeloNegocio/sst/PlanSstNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class PlanSstControlador extends ControladorBase {

    public function listarPlanSst() {
        return PlanSstNegocio::create()->listarPlanSst();
    }
    
    public function crearPlanSst() {
        $this->setTransaction();
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return PlanSstNegocio::create()->crearPlanSst($codigo, $version, $comentario,
                $documento, $docNombre, $estado, $usuCreacion);
    }
    
    public function actualizarPlanSst() {
        $this->setTransaction();
        $id = $this->getParametro("id");
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $docId = $this->getParametro("docId");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return PlanSstNegocio::create()->actualizarPlanSst($id, $codigo, $version, $comentario,
                $documento, $docNombre, $docId, $estado, $usuCreacion);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return PlanSstNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerPlanSstXid(){
        $id = $this->getParametro("id");
        return PlanSstNegocio::create()->obtenerPlanSstXid($id);
    }

    public function cambiarPublicacion() {
        $documentoId = $this->getParametro("documentoId");
        $estadoPublicacion = $this->getParametro("estadoPublicacion");
        return PlanSstNegocio::create()->cambiarPublicacion($documentoId, $estadoPublicacion);
    }
}
