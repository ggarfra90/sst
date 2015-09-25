<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class CapDocumento extends ModeloBase {
    public function insertarCapDocumento($capaId,$docId,$usuCreacion) {
        $this->commandPrepare("sp_doc_capacitacion_insertar");
        $this->commandAddParameter(":vin_capacitacion_id", $capaId);
        $this->commandAddParameter(":vin_documento_id", $docId);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    
}
