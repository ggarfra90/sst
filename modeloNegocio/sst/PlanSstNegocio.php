<?php

require_once __DIR__ . '/../../modelo/sst/PlanSst.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class PlanSstNegocio extends ModeloNegocioBase {

    public function listarPlanSst() {
        return PlanSst::create()->listarPlanSst();
    }

    public function crearPlanSst($codigo, $version, $comentario, $docEncode, 
            $docNombre, $estado, $usuCreacion) {
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_PLANSST, $docEncode,
                $docNombre, ConstantesNegocio::FILE_PLANSST, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
        return PlanSst::create()->insertarPlanSst($doc[0]["id"], $codigo, $version, $comentario, 
                $estado, $usuCreacion);
    }

    public function actualizarPlanSst($id, $codigo, $version, $comentario, $docEncode, 
                $docNombre, $docId, $estado, $usuCreacion) {
        if($docId == "" || $docId == null){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_PLANSST, $docEncode,
                $docNombre, ConstantesNegocio::FILE_PLANSST, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
            $docId = $doc[0]["id"];
        }
        return PlanSst::create()->actualizarPlanSst($id, $docId, $codigo, $version, 
                $comentario, ConstantesNegocio::FLUDOC_ENVIADO, $estado);
    }

    function cambiarEstado($id, $estado){
        $tabla = ConstantesNegocio::TBL_PLANSST;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    function obtenerPlanSstXid($id){
        return PlanSst::create()->obtenerPlanSstXid($id);
    }
    
    function cambiarPublicacion($documentoId, $estadoPublicacion){
        $publicado = ConstantesNegocio::FLUDOC_APROBADO;
        if($estadoPublicacion == ConstantesNegocio::PARAM_ACTIVO){
            $publicado = ConstantesNegocio::FLUDOC_PUBLICADO;
        }
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, $publicado);
    }
}
