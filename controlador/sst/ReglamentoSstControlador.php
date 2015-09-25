<?php

require_once __DIR__ . '/../../modeloNegocio/sst/ReglamentoSstNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class ReglamentoSstControlador extends ControladorBase {

    public function listarReglamentoSst() {
        return ReglamentoSstNegocio::create()->listarReglamentoSst();
    }
    
    public function obtenerPoliticaSst(){
        return ReglamentoSstNegocio::create()->obtenerPoliticaSst();
    }
    
    public function crearReglamentoSst() {
        $this->setTransaction();
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $politicaId = $this->getParametro("politicaId");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return ReglamentoSstNegocio::create()->crearReglamentoSst($codigo, $version, $politicaId, 
                $comentario, $documento, $docNombre, $estado, $usuCreacion);
    }
    
    public function actualizarReglamentoSst() {
        $this->setTransaction();
        $id = $this->getParametro("id");
        $codigo = $this->getParametro("codigo");
        $version = $this->getParametro("version");
        $politicaId = $this->getParametro("politicaId");
        $comentario = $this->getParametro("comentario");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docNombre");
        $docId = $this->getParametro("docId");
        $estado = $this->getParametro("estado");
        $usuCreacion = $this->getUsuarioId();
        return ReglamentoSstNegocio::create()->actualizarReglamentoSst($id, $codigo, $version, $politicaId, 
                $comentario, $documento, $docNombre, $docId, $estado, $usuCreacion);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return ReglamentoSstNegocio::create()->cambiarEstado($id, $estado);
    }
    
    public function obtenerReglamentoSst(){
        $id = $this->getParametro("id");
        $res= ReglamentoSstNegocio::create()->obtenerReglamentoSst($id);
        return $res;
    }

    public function cambiarPublicacion() {
        $documentoId = $this->getParametro("documentoId");
        $estadoPublicacion = $this->getParametro("estadoPublicacion");
        return ReglamentoSstNegocio::create()->cambiarPublicacion($documentoId, $estadoPublicacion);
    }
}
