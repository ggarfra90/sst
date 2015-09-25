<?php

require_once __DIR__ . '/../../modeloNegocio/sst/MapaRiesgoNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class MapaRiesgoControlador extends ControladorBase {

    public function obtenerSucursalXempresa() {
        return MapaRiesgoNegocio::create()->obtenerSucursalXempresa();
    }

    public function obtenerSucursalLegado() {
        return MapaRiesgoNegocio::create()->obtenerSucursalLegado();
    }
    
    public function listarMapaRiesgo() {
        $sucursalId = $this->getParametro("sucursalId");
        return MapaRiesgoNegocio::create()->listarMapaRiesgo($sucursalId);
    }
    
    public function crearMapaRiesgo() {
        $this->setTransaction();
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $sucCodLegado = $this->getParametro("sucCodLegado");
        $sucDescripcion = $this->getParametro("sucDescripcion");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return MapaRiesgoNegocio::create()->crearMapaRiesgo($codigo, $version, $comentario, 
            $sucCodLegado, $sucDescripcion, $documento, $docNombre, $estado, $usuCreacion);
    }
    
    public function actualizarMapaRiesgo() {
        $this->setTransaction();
        $id = $this->getParametro("id");
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $comentario = $this->getParametro("comentario");
        $sucCodLegado = $this->getParametro("sucCodLegado");
        $sucDescripcion = $this->getParametro("sucDescripcion");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $docId = $this->getParametro("docId");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return MapaRiesgoNegocio::create()->actualizarMapaRiesgo($id, $codigo, $version, $comentario,
                $sucCodLegado, $sucDescripcion, $documento, $docNombre, $docId, $estado, $usuCreacion);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return MapaRiesgoNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerMapaRiesgoXid(){
        $id = $this->getParametro("id");
        return MapaRiesgoNegocio::create()->obtenerMapaRiesgoXid($id);
    }

    public function cambiarPublicacion() {
        $documentoId = $this->getParametro("documentoId");
        $estadoPublicacion = $this->getParametro("estadoPublicacion");
        return MapaRiesgoNegocio::create()->cambiarPublicacion($documentoId, $estadoPublicacion);
    }
}
