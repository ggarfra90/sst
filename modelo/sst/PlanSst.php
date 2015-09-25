<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class PlanSst extends ModeloBase {

    public function listarPlanSst() {
        $this->commandPrepare("sp_plansst_listar");
        return $this->commandGetData();
    }

    public function insertarPlanSst($documentoId, $codigo, $version, $comentario, 
            $estado, $usuCreacion) {
        $this->commandPrepare("sp_plansst_insertar");
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function actualizarPlanSst($id, $documentoId, $codigo, $version, 
            $comentario, $flujo, $estado) {
        $this->commandPrepare("sp_plansst_actualizar");
        $this->commandAddParameter(":vin_id", $id);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        return $this->commandGetData();
    }
    
    function obtenerPlanSstXid($id){
        $this->commandPrepare("sp_plansst_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
}
