<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class ReglamentoSst extends ModeloBase {

    public function listarReglamentoSst() {
        $this->commandPrepare("sp_reglamentosst_listar");
        return $this->commandGetData();
    }

    public function insertarReglamentoSst($politicaId, $documentoId, $codigo, $version, 
            $comentario, $estado, $usuCreacion) {
        $this->commandPrepare("sp_reglamentosst_insertar");
        $this->commandAddParameter(":vin_politica_sst_id", $politicaId);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function actualizarReglamentoSst($id, $politicaId, $documentoId, $codigo, 
            $version, $comentario, $flujo, $estado) {
        $this->commandPrepare("sp_reglamentosst_actualizar");
        $this->commandAddParameter(":vin_id", $id);
        $this->commandAddParameter(":vin_politica_sst_id", $politicaId);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        return $this->commandGetData();
    }
    
    function obtenerReglamentoSst($id){
        $this->commandPrepare("sp_reglamentosst_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
}
