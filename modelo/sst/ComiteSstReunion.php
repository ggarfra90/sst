<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class ComiteSstReunion extends ModeloBase {

    
    public function insertarComiteSstReunion($comiteSstId,$fecha,$hora,
    $ubicacion,$usuCreacion) {
    $this->commandPrepare("sp_comitesst_reunion_insertar");
    $this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
    $this->commandAddParameter(":vin_fecha", $fecha);
    $this->commandAddParameter(":vin_hora", $hora);
    $this->commandAddParameter(":vin_ubicacion", $ubicacion);
    $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}
public function actualizarComiteSstReunion($comiteSstReuId,$comiteSstId,$fecha,$hora,
    $ubicacion,$usuCreacion) {
    $this->commandPrepare("sp_comitesst_reunion_actualizar");
    $this->commandAddParameter(":vin_comite_sst_reu_id", $comiteSstReuId);
    $this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
    $this->commandAddParameter(":vin_fecha", $fecha);
    $this->commandAddParameter(":vin_hora", $hora);
    $this->commandAddParameter(":vin_ubicacion", $ubicacion);
    $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}
public function listarComiteSstReunion() {
    $this->commandPrepare("sp_comitesst_reunion_listar");
    return $this->commandGetData();
}
 public function obtenerReunionXId($comiteSstReuId) {
    $this->commandPrepare("sp_comitesst_reunion_obtenerXId");
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    return $this->commandGetData();

}

 public function obtenerReunionAgendaXId($comiteSstReuId) {
    $this->commandPrepare("sp_comitesst_reu_agenda_obtenerXId");
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    return $this->commandGetData();

}
 public function obtenerReunionTemaXId($comiteSstReuId) {
    $this->commandPrepare("sp_comitesst_reu_tema_obtenerXId");
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    return $this->commandGetData();

}
public function obtenerAsistenciaReunionXId($comiteSstReuId) {
    $this->commandPrepare("sp_comitesst_obtner_XId_reunion_asistencia");
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    return $this->commandGetData();
}
public function asistenciaComiteSstReunion($comiteSstReuId,$miembroId,$usuCreacion) {
    $this->commandPrepare("sp_comitesst_reu_asistente_insertar");
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    $this->commandAddParameter(":vin_comite_sst_miembro_id", $miembroId);
     $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}
 }
