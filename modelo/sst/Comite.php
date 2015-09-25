<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Comite extends ModeloBase {

    public function listarComite() {
        $this->commandPrepare("sp_comitesst_listar");
        return $this->commandGetData();
    }

    public function obtenerComiteCargo() {
        $this->commandPrepare("sp_comitesst_mie_cargo_obtener");
        return $this->commandGetData();
    }
    public function obtenerComiteVigenteId() {
         $this->commandPrepare("sp_comite_sst_obtener_vigenteId");
        return $this->commandGetData();
    }
    public function insertarComite($codigo,$fec_eleccion,
    $fec_inicio,$fec_fin, $usuCreacion) {
    $this->commandPrepare("sp_comitesst_insertar");
    $this->commandAddParameter(":vin_codigo", $codigo);
    $this->commandAddParameter(":vin_fec_eleccion", $fec_eleccion);
    $this->commandAddParameter(":vin_fec_inicio", $fec_inicio);
    $this->commandAddParameter(":vin_fec_fin", $fec_fin);
    $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}

public function actualizarComite($id,$codigo,$fec_eleccion,
    $fec_inicio,$fec_fin, $usuCreacion) {
    $this->commandPrepare("sp_comitesst_actualizar");
    $this->commandAddParameter(":vin_comite_sst_id", $id);
    $this->commandAddParameter(":vin_codigo", $codigo);
    $this->commandAddParameter(":vin_fec_eleccion", $fec_eleccion);
    $this->commandAddParameter(":vin_fec_inicio", $fec_inicio);
    $this->commandAddParameter(":vin_fec_fin", $fec_fin);
    $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}

function obtenerComiteXid($id) {
    $this->commandPrepare("sp_comite_sst_obtenerXid");
    $this->commandAddParameter(":vin_comite_sst_id", $id);
    return $this->commandGetData();
}
function obtenerMiembroXId($id){
    $this->commandPrepare("sp_comitesst_obtner_XId_miembros");
    $this->commandAddParameter(":vin_comite_sst_id", $id);
    return $this->commandGetData();
    
}

public function obtenerOrganigrama() {
    $this->commandPrepare("sp_comitesst_organigrama");
    return $this->commandGetData();
}
}
