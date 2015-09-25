<?php
require_once __DIR__."/../core/ModeloBase.php";
require_once __DIR__."/../enumeraciones/EstadoGenerico.php";

/*
 * @author Christopher Heredia <cheredia@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará a la pregunta
 */
class Pregunta extends ModeloBase {
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
    public function getAll($evaluacionId){
        $this->commandPrepare("sp_pregunta_getAll");
        $this->commandAddParameter(":vin_evaluacion_id", $evaluacionId);
        return $this->commandGetData();
    }
    
    public function save($formatoId, $evaluacionId, $valor, $estado, $usuarioCreacion){
        $this->commandPrepare("sp_pregunta_save");
        $this->commandAddParameter(":vin_formato_id", $formatoId);
        $this->commandAddParameter(":vin_evaluacion_id", $evaluacionId);
        $this->commandAddParameter(":vin_valor", $valor); 
        $this->commandAddParameter(":vin_estado", $estado); 
        $this->commandAddParameter(":vin_usuario_creacion", $usuarioCreacion);
        return $this->commandGetData();
    }
}
