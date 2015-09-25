<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Ria extends ModeloBase {

    public function listarRiaProcedimiento() {
        $this->commandPrepare("sp_riaprocedimiento_listar");
        return $this->commandGetData();
    }

    public function insertarRiaProcedimiento($documentoId, $codigo, $version, $comentario, 
            $estado, $usuCreacion) {
        $this->commandPrepare("sp_riaprocedimiento_insertar");
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function actualizarRiaProcedimiento($id, $documentoId, $codigo, $version, 
            $comentario, $flujo, $estado) {
        $this->commandPrepare("sp_riaprocedimiento_actualizar");
        $this->commandAddParameter(":vin_id", $id);
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_version", $version);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_flu_documento", $flujo);
        $this->commandAddParameter(":vin_estado", $estado);
        return $this->commandGetData();
    }
    
    public function obtenerRiaProcedimientoXid($id){
        $this->commandPrepare("sp_riaprocedimiento_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
    
    public function insertarRiaDeclaracion($documentoId, $eveFecha, $eveHora, $reuLugar, $reuFecha,
            $reuHoraIni, $reuHoraFin, $regDescripcion, $archivado, $estado, $usuCreacion){
        $this->commandPrepare("sp_riadeclaracion_insertar");
        $this->commandAddParameter(":vin_documento_id", $documentoId);
        $this->commandAddParameter(":vin_fec_evento", $eveFecha);
        $this->commandAddParameter(":vin_hor_evento", $eveHora);
        $this->commandAddParameter(":vin_ubi_reunion", $reuLugar);
        $this->commandAddParameter(":vin_fec_reunion", $reuFecha);
        $this->commandAddParameter(":vin_hor_reu_inicio", $reuHoraIni);
        $this->commandAddParameter(":vin_hor_reu_fin", $reuHoraFin);
        $this->commandAddParameter(":vin_declaracion", $regDescripcion);
        $this->commandAddParameter(":vin_archivado", $archivado);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
    
    public function insertarRiaDecDetalle($riaDeclaracionId, $parDecDetId, $estado, $usuCreacion){
        $this->commandPrepare("sp_riadecdetalle_insertar");
        $this->commandAddParameter(":vin_ria_declaracion_id", $riaDeclaracionId);
        $this->commandAddParameter(":vin_par_dec_det_id", $parDecDetId);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
    
    public function insertarRiaDecPreRespuesta($riaDeclaracionId, $decPregunta1, $decPregunta2, $decPregunta3, 
            $decPregunta4, $decPregunta5, $decPregunta6, $decPregunta7, $decPregunta8, $estado, $usuCreacion){
        $this->commandPrepare("sp_riadecprerespuesta_insertar");
        $this->commandAddParameter(":vin_ria_declaracion_id", $riaDeclaracionId);
        $this->commandAddParameter(":vin_dec_pregunta1", $decPregunta1);
        $this->commandAddParameter(":vin_dec_pregunta2", $decPregunta2);
        $this->commandAddParameter(":vin_dec_pregunta3", $decPregunta3);
        $this->commandAddParameter(":vin_dec_pregunta4", $decPregunta4);
        $this->commandAddParameter(":vin_dec_pregunta5", $decPregunta5);
        $this->commandAddParameter(":vin_dec_pregunta6", $decPregunta6);
        $this->commandAddParameter(":vin_dec_pregunta7", $decPregunta7);
        $this->commandAddParameter(":vin_dec_pregunta8", $decPregunta8);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function listarRiaDeclaracion() {
        $this->commandPrepare("sp_riadeclaracion_listar");
        return $this->commandGetData();
    }
    
    public function obtenerRiaDeclaracionXid($id){
        $this->commandPrepare("sp_riadeclaracion_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
    
    public function insertarRiaRie($sucursalId, $gerenciaId, $usuarioPuestoId, $eveFecha, $eveHora,
            $descripcion, $respuesta, $comentario, $archivado, $estado, $usuCreacion){
        $this->commandPrepare("sp_riarie_insertar");
        $this->commandAddParameter(":vin_sucursal_id", $sucursalId);
        $this->commandAddParameter(":vin_gerencia_id", $gerenciaId);
        $this->commandAddParameter(":vin_usuario_puesto_id", $usuarioPuestoId);
        $this->commandAddParameter(":vin_fec_evento", $eveFecha);
        $this->commandAddParameter(":vin_hor_evento", $eveHora);
        $this->commandAddParameter(":vin_descripcion", $descripcion);
        $this->commandAddParameter(":vin_respuesta", $respuesta);
        $this->commandAddParameter(":vin_comentario", $comentario);
        $this->commandAddParameter(":vin_archivado", $archivado);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
    
    public function insertarRiaRieDetalle($riaRieId, $parDetId, $estado, $usuCreacion){
        $this->commandPrepare("sp_riariedetalle_insertar");
        $this->commandAddParameter(":vin_ria_rie_id", $riaRieId);
        $this->commandAddParameter(":vin_par_det_id", $parDetId);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }
    
    public function insertarRiaRieTestigo($riaRieId, $usuarioId, $estado, $usuCreacion){
        $this->commandPrepare("sp_riarietestigo_insertar");
        $this->commandAddParameter(":vin_ria_rie_id", $riaRieId);
        $this->commandAddParameter(":vin_usuario_id", $usuarioId);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function listarRiaRie() {
        $this->commandPrepare("sp_riarie_listar");
        return $this->commandGetData();
    }
    
    public function obtenerRiaRieXid($id){
        $this->commandPrepare("sp_riarie_obtenerXid");
        $this->commandAddParameter(":vin_id", $id);
        return $this->commandGetData();
    }
}
