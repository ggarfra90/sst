<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Capacitacion extends ModeloBase {

    public function listarCapacitacion($tipo) {
        $this->commandPrepare("sp_capacitacion_listar");
        $this->commandAddParameter(":vin_tipo_avance", $tipo);
        return $this->commandGetData();
    }
    public function listarVerCapacitacion($tipo,$usuId) {
        $this->commandPrepare("sp_capacitacion_ver_listar");
        $this->commandAddParameter(":vin_tipo_avance", $tipo);
        $this->commandAddParameter(":vin_usu_id", $usuId);
        return $this->commandGetData();
    }
    public function obtenerCapacitacionXId($id) {
        $this->commandPrepare("sp_capacitacion_obtenerXId");
        $this->commandAddParameter(":vin_cap_id", $id);
        return $this->commandGetData();
    }
   public function obtenerEvidenciaCapacitacionXId($id){
        $this->commandPrepare("sp_capacitacion_evidencia_obtenerXId");
        $this->commandAddParameter(":vin_cap_id", $id);
        return $this->commandGetData();
    }
    public function eliminarEvidencia($idDoc,$idCap) {
        $this->commandPrepare("sp_capacitacion_evidencia_eliminar");
        $this->commandAddParameter(":vin_id_doc", $idDoc);
        $this->commandAddParameter(":vin_id_cap", $idCap);
        return $this->commandGetData();
    }
    public function insertarCapacitacion($tema,$tipo,$fconvocatoria,$finicio,$ffin,$estado,$comentario,$usuCreacion) {
        $this->commandPrepare("sp_capacitacion_insertar");
        $this->commandAddParameter(":vin_tipo_cap", $tipo);
        $this->commandAddParameter(":vin_tema", $tema);
        $this->commandAddParameter(":vin_fconvocatoria", $fconvocatoria);
        $this->commandAddParameter(":vin_finicio", $finicio);
        $this->commandAddParameter(":vin_ffin", $ffin);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
    public function actualizarCapacitacion($id,$tema,$tipo,$fconvocatoria,$finicio,$ffin,$estado,$comentario,$docId,$docIdA,$idCap,$usuCreacion) {
        $this->commandPrepare("sp_capacitacion_actualizar");
        $this->commandAddParameter(":vin_id_cap", $id);
        $this->commandAddParameter(":vin_tipo_cap", $tipo);
        $this->commandAddParameter(":vin_tema", $tema);
        $this->commandAddParameter(":vin_fconvocatoria", $fconvocatoria);
        $this->commandAddParameter(":vin_finicio", $finicio);
        $this->commandAddParameter(":vin_ffin", $ffin);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        $this->commandAddParameter(":vin_documento_id_n", $docId);
        $this->commandAddParameter(":vin_documento_id", $docIdA);
        $this->commandAddParameter(":vin_doc_cap_id", $idCap);
        
        return $this->commandGetData();
    }
    
}
