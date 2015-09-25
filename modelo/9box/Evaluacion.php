<?php
require_once __DIR__."/../core/ModeloBase.php";
require_once __DIR__."/../enumeraciones/EstadoGenerico.php";

/*
 * @author Christopher Heredia <cheredia@imaginatecperu.com>
 * @version 1.0
 * @copyright (c) 2015, IMAGINA TECHNOLOGIES S.A.C.
 * @abstract Clase donde se implementará la pregunta
 */
class Evaluacion extends ModeloBase {
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
    public function getAll($evaluacionId = 0, $usuarioId = 0){
        $this->commandPrepare("sp_evaluacion_getAll");
        $this->commandAddParameter(":vin_id", $evaluacionId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        return $this->commandGetData();
    }
    
    public function save($anioId, $usuarioId, $estado, $usuarioCreacion){
        $this->commandPrepare("sp_evaluacion_save");
        $this->commandAddParameter(":vin_anio_id", $anioId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usuario_creacion", $usuarioCreacion);
        return $this->commandGetData();
    }
    public function delete($evaluacionId){
        $this->commandPrepare("sp_evaluacion_delete");
        $this->commandAddParameter(":vin_evaluacion_id", $evaluacionId);
        return $this->commandGetData();
    }
    public function finaliza($evaluacionId){
        $this->commandPrepare("sp_evaluacion_finaliza");
        $this->commandAddParameter(":vin_id", $evaluacionId);
        return $this->commandGetData();
    } 
    public function valida($evaluacionId){
        $this->commandPrepare("sp_evaluacion_valida");
        $this->commandAddParameter(":vin_evaluacion_id", $evaluacionId);
        return $this->commandGetData();
    }
    public function reporteGetInmediato($usuarioId){
        $this->commandPrepare("sp_reporte_getInmediato");
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        return $this->commandGetData();
    }
    public function reporteGetRRHH($usuarioId){
        $this->commandPrepare("sp_reporte_getRRHH");
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        return $this->commandGetData();
    }
    public function graficoGetInmediato($usuarioId, $anioId){
        $this->commandPrepare("sp_reporte_getGraficoInmediato");
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_anio_id", $anioId);
        return $this->commandGetData();
    }
    public function updateComentario($evaluacionId, $comentario){
        $this->commandPrepare("sp_evaluacion_updateComentario");
        $this->commandAddParameter(":vin_id", $evaluacionId);
        $this->commandAddParameter(":vin_comentario", $comentario);
        return $this->commandGetData();
    }
}
