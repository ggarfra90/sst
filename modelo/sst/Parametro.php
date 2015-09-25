<?php

require_once __DIR__ . "/../core/ModeloBase.php";

class Parametro extends ModeloBase {

    public function obtenerParametroDetId($parametroId, $cod_legado, $codigo, 
            $descripcion) {
        $this->commandPrepare("sp_parametrodet_obtenerId");
        $this->commandAddParameter(":vin_parametro_id", $parametroId);
        $this->commandAddParameter(":vin_cod_legado", $cod_legado);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_descripcion", $descripcion);
        return $this->commandGetData();
    }

    public function insertarParametroDet($parametroId, $cod_legado, $codigo, 
            $descripcion, $estado, $usuCreacion) {
        $this->commandPrepare("sp_parametrodet_insertar");
        $this->commandAddParameter(":vin_parametro_id", $parametroId);
        $this->commandAddParameter(":vin_cod_legado", $cod_legado);
        $this->commandAddParameter(":vin_codigo", $codigo);
        $this->commandAddParameter(":vin_descripcion", $descripcion);
        $this->commandAddParameter(":vin_estado", $estado);
        $this->commandAddParameter(":vin_usu_creacion", $usuCreacion);
        return $this->commandGetData();
    }

    public function obtenerParametroXparCodigo($parametroCodigo) {
        $this->commandPrepare("sp_parametrodet_obtenerXparCodigo");
        $this->commandAddParameter(":vin_parametro_codigo", $parametroCodigo);
        return $this->commandGetData();
    }
}
