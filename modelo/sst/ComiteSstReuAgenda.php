<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class ComiteSstReuAgenda extends ModeloBase {

    
    public function insertarComiteSstReuAgenda($comiteSstId,$comiteSstReuId,$colaboradorId,$tema,$detalle,
    $usuCreacion) {
    $this->commandPrepare("sp_comitesst_reu_agenda_insertar");
    $this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    $this->commandAddParameter(":vin_comite_sst_miembro_id", $colaboradorId);
    $this->commandAddParameter(":vin_tema", $tema);
    $this->commandAddParameter(":vin_detalle", $detalle);
    $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}
public function actualizarComiteSstReuAgenda($comiteSstReuAge,$comiteSstId,$comiteSstReuId,$colaboradorId,$tema,$detalle,
    $usuCreacion) {
    $this->commandPrepare("sp_comitesst_reu_agenda_actualizar");
    $this->commandAddParameter(":vin_comite_sst_agenda_id", $comiteSstReuAge);
    $this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
    $this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
    $this->commandAddParameter(":vin_comite_sst_miembro_id", $colaboradorId);
    $this->commandAddParameter(":vin_tema", $tema);
    $this->commandAddParameter(":vin_detalle", $detalle);
    $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
    return $this->commandGetData();
}
public function eliminarComiteSstReuAgenda($comiteSstReuAge) {
    $this->commandPrepare("sp_comitesst_reu_agenda_eliminar");
    $this->commandAddParameter(":vin_comite_sst_agenda_id", $comiteSstReuAge);
    return $this->commandGetData();
}

}
