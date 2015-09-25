<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class ComiteSstConvoca extends ModeloBase {

public function insertarComiteSstConvoca($documentoId,$comiteSstId,$fecConvotarioa,$comentario,$usuCreacion) {
$this->commandPrepare("sp_comitesst_convoca_insertar");
$this->commandAddParameter(":vin_documento_id", $documentoId);
$this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
$this->commandAddParameter(":vin_fec_convocatoria", $fecConvotarioa);
$this->commandAddParameter(":vin_comentario", $comentario);
$this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
return $this->commandGetData();
}

public function actualizarComiteSstConvoca($IdC,$documentoId,$comiteSstId,$fecConvotarioa,$comentario,$usuCreacion) {
$this->commandPrepare("sp_comitesst_convoca_actualizar");
$this->commandAddParameter(":vin_comite_sst_conv_id", $IdC);
$this->commandAddParameter(":vin_documento_id", $documentoId);
$this->commandAddParameter(":vin_comite_sst_id", $comiteSstId);
$this->commandAddParameter(":vin_fec_convocatoria", $fecConvotarioa);
$this->commandAddParameter(":vin_comentario", $comentario);
$this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
return $this->commandGetData();
}

}
