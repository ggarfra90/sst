<?php

require_once __DIR__ . '/../../modelo/sst/Parametro.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';
require_once __DIR__ . '/../../modeloNegocio/commons/ConstantesNegocio.php';

class ParametroNegocio extends ModeloNegocioBase {

    public function obtenerParametroLegadoId($parametroId, $cod_legado, $codigo, 
            $descripcion, $estado, $usuCreacion) {
        $par = $this->obtenerParametroDetId($parametroId, $cod_legado, $codigo, $descripcion);
        if($par == null || $par[0]["vout_exito"] == ConstantesNegocio::VOUT_ERROR){
            $par = $this->insertarParametroDet($parametroId, $cod_legado, $codigo, 
                    $descripcion, $estado, $usuCreacion);
        }
        return $par;
    }

    public function obtenerParametroDetId($parametroId, $cod_legado, $codigo, $descripcion) {
        return Parametro::create()->obtenerParametroDetId($parametroId, $cod_legado, $codigo, $descripcion);
    }

    public function insertarParametroDet($parametroId, $cod_legado, $codigo, 
            $descripcion, $estado, $usuCreacion) {
        return Parametro::create()->insertarParametroDet($parametroId, $cod_legado, 
                $codigo, $descripcion, $estado, $usuCreacion);
    }

    public function obtenerParametroXparCodigo($parametroCodigo) {
        return Parametro::create()->obtenerParametroXparCodigo($parametroCodigo);
    }
}
