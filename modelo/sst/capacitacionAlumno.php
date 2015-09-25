<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class CapacitacionAlumno extends ModeloBase {
    //`sp_capacitacion_alumno_insertar`(IN vin_capacitacion_id int,usuario_id int,nota float(3,2),
    //IN vin_usu_creacion INT)
    public function insertarCapacitacionAlumno($capaId,$usuId,$nota,$usuCreacion) {
        $this->commandPrepare("sp_capacitacion_alumno_insertar");
        $this->commandAddParameter(":vin_capacitacion_id", $capaId);
        $this->commandAddParameter(":vin_usuario_id", $usuId);
        $this->commandAddParameter(":vin_nota", $nota);
         $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
    
    public function obtnerCapacitacionAlumno($capaId) {
        $this->commandPrepare("sp_capacitacion_alumno_listarXId");
        $this->commandAddParameter(":vin_capa_id", $capaId);
        return $this->commandGetData();
    }
}
