<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class ComiteSstMiembro extends ModeloBase {

public function insertarComiteSstMiembro($comiteSstId,$documentoId,$usuarioId,$miembroCarId,$usuCreacion,$flag) {
$this->commandPrepare("sp_comitesst_miembro_insertar");
$this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
$this->commandAddParameter(":vin_documento_id", $documentoId);
$this->commandAddParameter(":vin_usuario_id", $usuarioId);
$this->commandAddParameter(":vin_sst_comite_mie_cargo_id", $miembroCarId);
$this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
$this->commandAddParameter(":vin_flag", $flag);
return $this->commandGetData();
}
public function actualizarComiteSstMiembro($comiteSstId,$documentoId) {
$this->commandPrepare("sp_comitesst_documento_actualizar");
$this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
$this->commandAddParameter(":vin_documento_id", $documentoId);
return $this->commandGetData();
}

}
