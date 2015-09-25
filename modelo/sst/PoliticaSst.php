<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class PoliticaSst extends ModeloBase {

    public function listarPoliticaSst() {
        $this->commandPrepare("sp_politicasst_listar");
        return $this->commandGetData();
    }

    public function insertarPoliticaSst($documentoId, $codigo, $version, $comentario, 
            $estado, $usuCreacion) {
        $this->commandPrepare("sp_politicasst_insertar");
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function actualizarPoliticaSst($id, $documentoId, $codigo, $version, 
            $comentario, $flujo, $estado) {
        $this->commandPrepare("sp_politicasst_actualizar");
        $this->commandAddParameter(":vin_id", $id);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        return $this->commandGetData();
    }
    
    function obtenerPoliticaSstXid($id){
        $this->commandPrepare("sp_politicasst_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
    
    function obtenerPoliticaSst(){
        $this->commandPrepare("sp_politicasst_obtener");
        return $this->commandGetData();
    }
}
