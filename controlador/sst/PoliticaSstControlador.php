<?php

require_once __DIR__ . '/../../modeloNegocio/sst/PoliticaSstNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class PoliticaSstControlador extends ControladorBase {

    public function listarPoliticaSst() {
        return PoliticaSstNegocio::create()->listarPoliticaSst();
    }
    
    public function crearPoliticaSst() {
        $this->setTransaction();
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return PoliticaSstNegocio::create()->crearPoliticaSst($codigo, $version, $comentario,
                $documento, $docNombre, $estado, $usuCreacion);
    }
    
    public function actualizarPoliticaSst() {
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
        return PoliticaSstNegocio::create()->actualizarPoliticaSst($id, $codigo, $version, $comentario,
                $documento, $docNombre, $docId, $estado, $usuCreacion);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return PoliticaSstNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerPoliticaSstXid(){
        $id = $this->getParametro("id");
        return PoliticaSstNegocio::create()->obtenerPoliticaSstXid($id);
    }

    public function cambiarPublicacion() {
        $documentoId = $this->getParametro("documentoId");
        $estadoPublicacion = $this->getParametro("estadoPublicacion");
        return PoliticaSstNegocio::create()->cambiarPublicacion($documentoId, $estadoPublicacion);
    }
}
