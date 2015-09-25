<?php

require_once __DIR__ . '/../../modelo/sst/Sucursal.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class SucursalNegocio extends ModeloNegocioBase {

    public function obtenerSucursalXempresa($empresaId) {
        return Sucursal::create()->obtenerSucursalXempresa($empresaId);
    }

    public function obtenerSucursalLegado() {
        return Sucursal::create()->obtenerSucursalLegado();
    }
    
    public function crearSucursal($empresaId, $codLegado, $descripcion, $estado, $usuCreacion){
        $suc = $this->obtenerSucursalXcodLegado($codLegado);
        if(!isset($suc)){
            $suc = $this->insertarSucursal($empresaId, $codLegado, $descripcion, $estado, $usuCreacion);
        }
        return $suc;
    }
    
    public function obtenerSucursalXcodLegado($codLegado){
        return Sucursal::create()->obtenerSucursalXcodLegado($codLegado);
    }

    public function insertarSucursal($empresaId, $codLegado, $descripcion, $estado, $usuCreacion) {
        return Sucursal::create()->insertarSucursal($empresaId, $codLegado, $descripcion, $estado, $usuCreacion);
    }
}
