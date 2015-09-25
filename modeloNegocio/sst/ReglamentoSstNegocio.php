<?php

require_once __DIR__ . '/../../modelo/sst/ReglamentoSst.php';
require_once __DIR__ . '/../../modeloNegocio/sst/PoliticaSstNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class ReglamentoSstNegocio extends ModeloNegocioBase {

    public function listarReglamentoSst() {
        return ReglamentoSst::create()->listarReglamentoSst();
    }
    
    public function obtenerPoliticaSst(){
        return PoliticaSstNegocio::create()->obtenerPoliticaSst();
    }

    public function crearReglamentoSst($codigo, $version, $politicaId, $comentario, 
            $docEncode, $docNombre, $estado, $usuCreacion) {
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_REGLAMENTOSST, $docEncode,
                $docNombre, ConstantesNegocio::FILE_REGLAMENTOSST, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
        return ReglamentoSst::create()->insertarReglamentoSst($politicaId, $doc[0]["id"], $codigo, $version, 
                $comentario, $estado, $usuCreacion);
    }

    public function actualizarReglamentoSst($id, $codigo, $version, $politicaId, $comentario, 
                $docEncode, $docNombre, $docId, $estado, $usuCreacion) {
        if($docId == "" || $docId == null){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_REGLAMENTOSST, $docEncode,
                $docNombre, ConstantesNegocio::FILE_REGLAMENTOSST, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
            $docId = $doc[0]["id"];
        }
        return ReglamentoSst::create()->actualizarReglamentoSst($id, $politicaId, $docId, $codigo, 
                $version, $comentario, ConstantesNegocio::FLUDOC_ENVIADO, $estado);
    }

    function cambiarEstado($id, $estado){
        $tabla = ConstantesNegocio::TBL_REGLAMENTOSST;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    function obtenerReglamentoSst($id){
        return ReglamentoSst::create()->obtenerReglamentoSst($id);
    }
    
    function cambiarPublicacion($documentoId, $estadoPublicacion){
        $publicado = ConstantesNegocio::FLUDOC_APROBADO;
        if($estadoPublicacion == ConstantesNegocio::PARAM_ACTIVO){
            $publicado = ConstantesNegocio::FLUDOC_PUBLICADO;
        }
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, $publicado);
    }
}
