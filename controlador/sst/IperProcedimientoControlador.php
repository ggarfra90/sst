<?php

require_once __DIR__ . '/../../modeloNegocio/sst/IperNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class IperProcedimientoControlador extends ControladorBase {

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
    
    public function actualizarIperProcedimiento() {
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
        return IperNegocio::create()->actualizarIperProcedimiento($id, $codigo, $version, $comentario,
                $documento, $docNombre, $docId, $estado, $usuCreacion);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return IperNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerIperProcedimientoXid(){
        $id = $this->getParametro("id");
        return IperNegocio::create()->obtenerIperProcedimientoXid($id);
    }

    public function cambiarPublicacion() {
        $documentoId = $this->getParametro("documentoId");
        $estadoPublicacion = $this->getParametro("estadoPublicacion");
        return IperNegocio::create()->cambiarPublicacion($documentoId, $estadoPublicacion);
    }
   
}
