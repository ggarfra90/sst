<?php

require_once __DIR__ . '/../../modelo/sst/MapaRiesgo.php';
require_once __DIR__ . '/../../modeloNegocio/sst/SucursalNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/sst/DocumentoNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/commons/SeguridadNegocio.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class MapaRiesgoNegocio extends ModeloNegocioBase {

    public function obtenerSucursalXempresa() {
        return SucursalNegocio::create()->obtenerSucursalXempresa(ConstantesNegocio::EMPRESAID);
    }

    public function obtenerSucursalLegado() {
        return SucursalNegocio::create()->obtenerSucursalLegado();
    }

    public function listarMapaRiesgo($sucursalId) {
        return MapaRiesgo::create()->listarMapaRiesgo($sucursalId);
    }

    public function crearMapaRiesgo($codigo, $version, $comentario, $sucCodLegado, 
            $sucDescripcion, $docEncode, $docNombre, $estado, $usuCreacion) {
        $suc = SucursalNegocio::create()->crearSucursal(ConstantesNegocio::EMPRESAID, $sucCodLegado, 
                $sucDescripcion, $estado, $usuCreacion);
        $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_MAPARIESGO, 
                $docEncode, $docNombre, ConstantesNegocio::FILE_MAPARIESGO, ConstantesNegocio::ES_LISTA_MAESTRA, 
                ConstantesNegocio::FLUDOC_APROBADO, $estado, $usuCreacion);
        return MapaRiesgo::create()->insertarMapaRiesgo($suc[0]["id"], $doc[0]["id"], $codigo, 
                $version, $comentario, $estado, $usuCreacion);
    }

    public function actualizarMapaRiesgo($id, $codigo, $version, $comentario, $sucCodLegado, 
            $sucDescripcion, $docEncode, $docNombre, $docId, $estado, $usuCreacion) {
        $suc = SucursalNegocio::create()->crearSucursal(ConstantesNegocio::EMPRESAID, $sucCodLegado, 
                $sucDescripcion, $estado, $usuCreacion);
        if ($docId == "" || $docId == null) {
            $doc = DocumentoNegocio::create()->crearDocumento(ConstantesNegocio::PAR_TIPODOC_MAPARIESGO, 
                    $docEncode, $docNombre, ConstantesNegocio::FILE_MAPARIESGO, ConstantesNegocio::ES_LISTA_MAESTRA, 
                    ConstantesNegocio::FLUDOC_APROBADO, $estado, $usuCreacion);
            $docId = $doc[0]["id"];
        }
        return MapaRiesgo::create()->actualizarMapaRiesgo($id, $suc[0]["id"], $docId, $codigo, 
                $version, $comentario, ConstantesNegocio::FLUDOC_APROBADO, $estado);
    }

    function cambiarEstado($id, $estado) {
        $tabla = ConstantesNegocio::TBL_MAPARIESGO;
        $campo = ConstantesNegocio::ESTADO;
        return SeguridadNegocio::create()->updateEstadoVisible($tabla, $campo, $estado, $id);
    }

    function obtenerMapaRiesgoXid($id) {
        return MapaRiesgo::create()->obtenerMapaRiesgoXid($id);
    }

    function cambiarPublicacion($documentoId, $estadoPublicacion) {
        $publicado = ConstantesNegocio::FLUDOC_APROBADO;
        if ($estadoPublicacion == ConstantesNegocio::PARAM_ACTIVO) {
            $publicado = ConstantesNegocio::FLUDOC_PUBLICADO;
        }
        return DocumentoNegocio::create()->actualizarFlujo($documentoId, $publicado);
    }

}
