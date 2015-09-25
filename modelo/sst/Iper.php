<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Iper extends ModeloBase {

    public function listarIperProcedimiento() {
        $this->commandPrepare("sp_iperprocedimiento_listar");
        return $this->commandGetData();
    }

    public function insertarIperProcedimiento($documentoId, $codigo, $version, $comentario, 
            $estado, $usuCreacion) {
        $this->commandPrepare("sp_iperprocedimiento_insertar");
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function actualizarIperProcedimiento($id, $documentoId, $codigo, $version, 
            $comentario, $flujo, $estado) {
        $this->commandPrepare("sp_iperprocedimiento_actualizar");
        $this->commandAddParameter(":vin_id", $id);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        return $this->commandGetData();
    }
    
    function obtenerIperProcedimientoXid($id){
        $this->commandPrepare("sp_iperprocedimiento_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
    
    public function listarIperReqLegales() {
        $this->commandPrepare("sp_iper_req_legales_listar");
        return $this->commandGetData();
    }
    public function listarIperMedControl() {
        $this->commandPrepare("sp_iper_med_Control_listar");
        return $this->commandGetData();
    }
    public function listarIperPeligro() {
        $this->commandPrepare("sp_iper_peligro_listar");
        return $this->commandGetData();
    }
    public function listarIperPelConsecuencias() {
        $this->commandPrepare("sp_iper_pel_consecuencias_listar");
        return $this->commandGetData();
    }
     public function obtenerXIdIperFacEvaluacion($codigo) {
        $this->commandPrepare("sp_iper_fac_evaluacion_ObtenerXId");
        $this->commandAddParameter(":vin_par_det_cod", $codigo);
        return $this->commandGetData();
    }
    public function obtenerXIdIperPelCaracter($codigo) {
        $this->commandPrepare("sp_iper_pel_caracter_obtenerXId");
        $this->commandAddParameter(":vin_par_det_cod", $codigo);
        return $this->commandGetData();
    }
}
