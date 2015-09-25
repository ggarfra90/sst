<?php
require_once __DIR__."/../core/ModeloBase.php";
require_once __DIR__."/../enumeraciones/EstadoGenerico.php";

/*
 * @author Christopher Heredia <cheredia@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará a la pregunta
 */
class PRP extends ModeloBase {
    /**
     * 
     * @return Pregunta
     */
    static function create() {
        return parent::create();
    }
    
    /**
     * @todo obtiene todas las evaluaciones
     * @return array
     */
    public function getAll($prpId, $usuarioId){
        $this->commandPrepare("sp_prp_getAll");
        $this->commandAddParameter(":vin_id", $prpId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        return $this->commandGetData();
    }
    
    public function save($anioId, $usuarioId, $valor, $estado, $usuarioCreacion){
        $this->commandPrepare("sp_prp_save");
        $this->commandAddParameter(":vin_anio_id", $anioId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_valor", $valor); 
        $this->commandAddParameter(":vin_estado", $estado); 
        $this->commandAddParameter(":vin_usuario_creacion", $usuarioCreacion);
        return $this->commandGetData();
    }
    
    public function delete($usuarioId){
        $this->commandPrepare("sp_prp_delete");
        $this->commandAddParameter(":vin_id", $usuarioId);
        return $this->commandGetData();
    }
    
    public function importPRP($xml, $usuarioCreacion) {
        $this->commandPrepare("sp_prp_importa");
        $this->commandAddParameter(":vin_XML", $xml);
        $this->commandAddParameter(":vin_usuario_creacion", $usuarioCreacion);
        return $this->commandGetData();
    }
    public function saveImporta($anio, $usuario, $valor, $usuarioCreacion) {
        $this->commandPrepare("sp_prp_saveImporta");
        $this->commandAddParameter(":vin_anio", $anio);
        $this->commandAddParameter(":vin_usuario", $usuario);
        $this->commandAddParameter(":vin_valor", $valor);
        $this->commandAddParameter(":vin_usuario_creacion", $usuarioCreacion);
        return $this->commandGetData();
    }
}
