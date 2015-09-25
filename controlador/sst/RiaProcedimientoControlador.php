<?php

require_once __DIR__ . '/../../modeloNegocio/sst/RiaNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class RiaProcedimientoControlador extends ControladorBase {

    public function listarRiaProcedimiento() {
        return RiaNegocio::create()->listarRiaProcedimiento();
    }
    
    public function crearRiaProcedimiento() {
        $this->setTransaction();
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return RiaNegocio::create()->crearRiaProcedimiento($codigo, $version, $comentario,
                $documento, $docNombre, $estado, $usuCreacion);
    }
    
    public function actualizarRiaProcedimiento() {
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
        return RiaNegocio::create()->actualizarRiaProcedimiento($id, $codigo, $version, $comentario,
                $documento, $docNombre, $docId, $estado, $usuCreacion);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return RiaNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerRiaProcedimientoXid(){
        $id = $this->getParametro("id");
        return RiaNegocio::create()->obtenerRiaProcedimientoXid($id);
    }

    public function cambiarPublicacion() {
        $documentoId = $this->getParametro("documentoId");
        $estadoPublicacion = $this->getParametro("estadoPublicacion");
        return RiaNegocio::create()->cambiarPublicacion($documentoId, $estadoPublicacion);
    }
}
