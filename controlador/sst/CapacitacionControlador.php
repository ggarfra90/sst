<?php

require_once __DIR__ . '/../../modeloNegocio/sst/CapacitacionNegocio.php';
require_once __DIR__ . '/../../util/Configuraciones.php';
require_once __DIR__ . '/../core/ControladorBase.php';

class CapacitacionControlador extends ControladorBase {

    public function listarCapacitacion() {
        $tipo = $this->getParametro("tipo_avance");
        return CapacitacionNegocio::create()->listarCapacitacion($tipo);
    }

    public function listarVerCapacitacion() {
        $tipo = $this->getParametro("tipo_avance");
        $usuCreacion = $this->getUsuarioId();
        return CapacitacionNegocio::create()->listarVerCapacitacion($tipo, $usuCreacion);
    }

    public function obtenerCapacitacion() {
        $id = $this->getParametro("cap_id");
        return CapacitacionNegocio::create()->obtenerCapacitacion($id);
    }

    public function obtenerCapacitacionAlumno() {
        $id = $this->getParametro("cap_id");
        return CapacitacionNegocio::create()->obtenerCapacitacionAlumno($id);
    }

    public function obtenerEvidenciaCapacitacion() {
        $id = $this->getParametro("cap_id");
        return CapacitacionNegocio::create()->obtenerEvidencia($id);
    }

    public function eliminarEvidencia() {
        $idDoc = $this->getParametro("idDoc");
        $idCap = $this->getParametro("idCap");
        return CapacitacionNegocio::create()->eliminarEvidencia($idDoc, $idCap);
    }

    public function cambiarEstado() {
        $id = $this->getParametro("id");
        $estado = $this->getParametro("estado");
        return CapacitacionNegocio::create()->cambiarEstado($id, $estado);
    }

    public function inscribirseCapa() {
        $id = $this->getParametro("id");
        $usuInscri = $this->getUsuarioId();
        $usuCreacion = $this->getUsuarioId();
        return CapacitacionNegocio::create()->inscribirseCapa($id, $usuInscri, $usuCreacion);
    }

    public function crearCapacitacion() {
        $this->setTransaction();
        $tema = $this->getParametro("tema");
        $fconvocatoria = $this->getParametro("fconvocatoria");
        $finicio = $this->getParametro("finicio");
        $ffin = $this->getParametro("ffin");
        $tipo = $this->getParametro("tipo");
        $estado = $this->getParametro("estado");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docnombre");
        $comentario = $this->getParametro("comentario");
        $usuCreacion = $this->getUsuarioId();
        return CapacitacionNegocio::create()->crearCapacitacion($tema, $fconvocatoria, 
                $finicio, $ffin, $tipo, $estado, $comentario, $documento, $docNombre, $usuCreacion);
    }

    public function actualizarCapacitacion() {
        $this->setTransaction();
        $id = $this->getParametro("id");
        $tema = $this->getParametro("tema");
        $fconvocatoria = $this->getParametro("fconvocatoria");
        $finicio = $this->getParametro("finicio");
        $ffin = $this->getParametro("ffin");
        $tipo = $this->getParametro("tipo");
        $estado = $this->getParametro("estado");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docnombre");
        $comentario = $this->getParametro("comentario");
        $docId = $this->getParametro("docId");
        $docIdA = $this->getParametro("docIdA");
        $idCap = $this->getParametro("idCap");
        $usuCreacion = $this->getUsuarioId();
        return CapacitacionNegocio::create()->actualizarCapacitacion($id, $tema, 
                $fconvocatoria, $finicio, $ffin, $tipo, $estado, $comentario, $documento,
                $docNombre, $docId, $docIdA, $idCap, $usuCreacion);
    }

    public function crearEvidencia() {
        $this->setTransaction();
        $id = $this->getParametro("idCap");
        $documento = $this->getParametro("documento");
        $docNombre = $this->getParametro("docnombre");
        $comentario = $this->getParametro("comentario");
        $nDocumento = $this->getParametro("nDocumento");
        $usuCreacion = $this->getUsuarioId();
        return CapacitacionNegocio::create()->crearEvidencia($id, $comentario, 
                $documento, $docNombre, $nDocumento, $usuCreacion);
    }
     public function obtenerTipoCapacitacion() {
        return CapacitacionNegocio::create()->obtenerTipoCapacitacion();
    
    }
}