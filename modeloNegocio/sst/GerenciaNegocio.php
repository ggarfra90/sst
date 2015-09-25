<?php

require_once __DIR__ . '/../../modelo/sst/Gerencia.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class GerenciaNegocio extends ModeloNegocioBase {

    public function obtenerGerenciaXempresa($empresaId) {
        return Gerencia::create()->obtenerGerenciaXempresa($empresaId);
    }

    public function obtenerGerenciaLegado() {
        return Gerencia::create()->obtenerGerenciaLegado();
    }
    
    public function crearGerencia($empresaId, $codLegado, $descripcion, $estado, $usuCreacion, $gerenciaId = null){
        $suc = $this->obtenerGerenciaXcodLegado($codLegado);
        if(!isset($suc)){
            $suc = $this->insertarGerencia($empresaId, $codLegado, $descripcion, $estado, $usuCreacion, $gerenciaId);
        }
        return $suc;
    }
    
    public function obtenerGerenciaXcodLegado($codLegado){
        return Gerencia::create()->obtenerGerenciaXcodLegado($codLegado);
    }

    public function insertarGerencia($empresaId, $codLegado, $descripcion, $estado, $usuCreacion, $gerenciaId = null) {
        return Gerencia::create()->insertarGerencia($empresaId, $gerenciaId, $codLegado, $descripcion, $estado, $usuCreacion);
    }
}
