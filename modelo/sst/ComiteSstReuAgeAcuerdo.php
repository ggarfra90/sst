<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class ComiteSstReuAgeAcuerdo extends ModeloBase {

public function insertarComiteSstReuAgeAcuerdo($comiteSstId, $comiteSstReuId,$comiteSstReuAgeId, $colaboradorId,$fecPropuesto, $detalle,
 $usuCreacion) {
$this->commandPrepare("sp_comitesst_reu_age_acuerdo_insertar");
$this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
$this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
$this->commandAddParameter(":vin_comite_sst_reu_agenda_id", $comiteSstReuAgeId);
$this->commandAddParameter(":vin_usuario_id", $colaboradorId);
$this->commandAddParameter(":vin_fec_propuesto", $fecPropuesto);
$this->commandAddParameter(":vin_acuerdo", $detalle);
$this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
return $this->commandGetData();
}

//aun falta 
public function actualizarComiteSstReuAgeAcuerdo($comiteSstReuAcuId,$comiteSstId, $comiteSstReuId,$comiteSstReuAgeId, $colaboradorId,$fecPropuesto, $detalle,
 $usuCreacion) {
$this->commandPrepare("sp_comitesst_reu_age_acuerdo_actualizar");
$this->commandAddParameter(":vin_comite_sst_reu_age_acuero_id", $comiteSstReuAcuId);
$this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
$this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReuId);
$this->commandAddParameter(":vin_comite_sst_reu_agenda_id", $comiteSstReuAgeId);
$this->commandAddParameter(":vin_usuario_id", $colaboradorId);
$this->commandAddParameter(":vin_fec_propuesto", $fecPropuesto);
$this->commandAddParameter(":vin_acuerdo", $detalle);
$this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
return $this->commandGetData();
}
public function eliminarComiteSstReuAgeAcuerdo($comiteSstReuAgeAcu) {
$this->commandPrepare("sp_comitesst_reu_age_acuerdo_eliminar");
$this->commandAddParameter(":vin_comite_sst_age_acuerdo_id", $comiteSstReuAgeAcu);
return $this->commandGetData();
}

public function obtenerXIdReuAcuerdo($comiteSstReunionId) {
    $this->commandPrepare('sp_comitesst_reu_acuerdo_obtenerXId');
$this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReunionId);
return $this->commandGetData();
    
}
public function obtenerXIdReuAcuerdoPendiente($comiteSstReunionId) {
    $this->commandPrepare('sp_comitesst_reu_acuerdo_pendientes_obtenerXId');
$this->commandAddParameter(":vin_comite_sst_reunion_id", $comiteSstReunionId);
return $this->commandGetData();
    
}
public function cumplirComiteSstReuAgeAcuerdo($comiteSstReuAcuId,$documentoId,$evidencia) {
$this->commandPrepare("sp_comitesst_reu_age_acuerdo_pendientes_actualizar");
$this->commandAddParameter(":vin_comite_sst_reu_age_acuero_id", $comiteSstReuAcuId);
$this->commandAddParameter(":vin_documento_id", $documentoId);
$this->commandAddParameter(":vin_evidencia", $evidencia);
$this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
return $this->commandGetData();
}
}
