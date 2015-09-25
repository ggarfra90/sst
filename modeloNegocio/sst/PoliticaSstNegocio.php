<?php

require_once __DIR__ . '/../../modelo/sst/PoliticaSst.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class PoliticaSstNegocio extends ModeloNegocioBase {

    public function listarPoliticaSst() {
        return PoliticaSst::create()->listarPoliticaSst();
    }

    public function crearPoliticaSst($codigo, $version, $comentario, $docEncode, 
            $docNombre, $estado, $usuCreacion) {
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_POLITICASST, $docEncode,
                $docNombre, ConstantesNegocio::FILE_POLITICASST, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
        return PoliticaSst::create()->insertarPoliticaSst($doc[0]["id"], $codigo, $version, $comentario, 
                $estado, $usuCreacion);
    }

    public function actualizarPoliticaSst($id, $codigo, $version, $comentario, $docEncode, 
                $docNombre, $docId, $estado, $usuCreacion) {
        if($docId == "" || $docId == null){
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_POLITICASST, $docEncode,
                $docNombre, ConstantesNegocio::FILE_POLITICASST, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_ENVIADO, $estado, $usuCreacion);
            $docId = $doc[0]["id"];
        }
        return PoliticaSst::create()->actualizarPoliticaSst($id, $docId, $codigo, $version, 
                $comentario, ConstantesNegocio::FLUDOC_ENVIADO, $estado);
    }

    function cambiarEstado($id, $estado){
        $tabla = ConstantesNegocio::TBL_POLITICASST;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
    
    function obtenerPoliticaSstXid($id){
        return PoliticaSst::create()->obtenerPoliticaSstXid($id);
    }
    
    function obtenerPoliticaSst(){
        return PoliticaSst::create()->obtenerPoliticaSst();
    }
    
    function cambiarPublicacion($documentoId, $estadoPublicacion){
        $publicado = ConstantesNegocio::FLUDOC_APROBADO;
        if($estadoPublicacion == ConstantesNegocio::PARAM_ACTIVO){
            $publicado = ConstantesNegocio::FLUDOC_PUBLICADO;
        }
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, $publicado);
    }
}
