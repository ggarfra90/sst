<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class MapaRiesgo extends ModeloBase {

    public function listarMapaRiesgo($sucursalId) {
        $this->commandPrepare("sp_mapariesgo_listar");
        $this->commandAddParameter(":vin_sucursal_id", $sucursalId);
        return $this->commandGetData();
    }

    public function insertarMapaRiesgo($sucursalId, $documentoId, $codigo, $version, 
            $comentario, $estado, $usuCreacion) {
        $this->commandPrepare("sp_mapariesgo_insertar");
        $this->commandAddParameter(":vin_sucursal_id", $sucursalId);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function actualizarMapaRiesgo($id, $sucursalId, $documentoId, $codigo, 
            $version, $comentario, $flujo, $estado) {
        $this->commandPrepare("sp_mapariesgo_actualizar");
        $this->commandAddParameter(":vin_id", $id);
        $this->commandAddParameter(":vin_sucursal_id", $sucursalId);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        return $this->commandGetData();
    }
    
    function obtenerMapaRiesgoXid($id){
        $this->commandPrepare("sp_mapariesgo_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
}
