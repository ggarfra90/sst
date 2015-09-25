<?php

require_once __DIR__ . '/../../modelo/sst/Documento.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';

class DocumentoNegocio extends ModeloNegocioBase {
    
    public function crearDocumento($tipoDoc, $docEncode, $docNombre, $origen, $esListaMaestra, 
            $flujo, $estado, $usuCreacion, $comentario = null){
        $docNomLen = strlen($docNombre);
        $docExtPos = strpos($docNombre, '.', $docNomLen-6);
        $docNom = substr($docNombre, 0, $docExtPos);
        $docExt = substr($docNombre, $docExtPos+1);
        $docFec = date("Ymdhisa");
        $docUrl = 'vistas/com/docs/' . $origen . '/' . $docFec . '-' . $docNombre;
        
        $doc = $this->insertarDocumento($tipoDoc, $docNom, $docExt, $docUrl,
                $esListaMaestra, $flujo, $estado, $usuCreacion, $comentario);
        $docDecode = Util::base64ToImage($docEncode);
        if ($doc[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && 
                ($docEncode != null || $docEncode != '')) {
            file_put_contents(__DIR__ . '/../../' . $docUrl, $docDecode);
        }
        return $doc;
    }
    public function crearEvidenciaDocumento($tipoDoc, $docEncode,$docNombre, $nDocumento, $origen, $esListaMaestra, 
            $flujo, $estado, $usuCreacion, $comentario){
        $docNomLen = strlen($docNombre);
        $docExtPos = strpos($docNombre, '.', $docNomLen-6);
       // $docNom = substr($docNombre, 0, $docExtPos);
        $docExt = substr($docNombre, $docExtPos+1);
        $docFec = date("Ymdhisa");
        $docUrl = 'vistas/com/docs/' . $origen . '/' . $docFec . '-' . $docNombre;
        
        $doc = $this->insertarDocumento($tipoDoc, $nDocumento, $docExt, $docUrl,
                $esListaMaestra, $flujo, $estado, $usuCreacion, $comentario);
        $docDecode = Util::base64ToImage($docEncode);
        if ($doc[0]['vout_exito'] == ConstantesNegocio::VOUT_EXITO && 
                ($docEncode != null || $docEncode != '')) {
            file_put_contents(__DIR__ . '/../../' . $docUrl, $docDecode);
        }
        return $doc;
    }
    public function insertarDocumento($tipo, $nombre, $extension, $url, $esListaMaestra, 
            $flujo, $estado, $usuCreacion, $comentario) {
        return Documento::create()->insertarDocumento($tipo, $nombre, $extension, 
                $url, $comentario, $esListaMaestra, $flujo, $estado, $usuCreacion);
    }

    public function listarDocsXrevisar($flujo) {
        return Documento::create()->listarDocsXrevisar($flujo);
    }

    public function actualizarFlujo($id, $flujo, $comentario = null) {
        return Documento::create()->actualizarFlujo($id, $flujo, $comentario);
    }

    function cambiarEstado($id, $estado){
        $tabla = ConstantesNegocio::TBL_DOCUMENTO;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }
}
