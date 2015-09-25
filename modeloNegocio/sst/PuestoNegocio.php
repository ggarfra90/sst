<?php

require_once __DIR__ . '/../../modelo/sst/Puesto.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class PuestoNegocio extends ModeloNegocioBase {

    public function obtenerPuestoLegado() {
        return Puesto::create()->obtenerPuestoLegado();
    }
    
    public function crearObtenerUsuarioPuestoId($usuarioId, $puesCodLegado, $puesDescripcion,
            $estado, $usuCreacion, $puestoPadreId = null){
        $pues = $this->obtenerPuestoXcodLegado($puesCodLegado);
        if(!isset($pues)){
            $pues = $this->insertarPuesto($puesCodLegado, $puesDescripcion, $estado, $usuCreacion, $puestoPadreId);
        }
        $usuPues = $this->obtenerUsuarioPuestoId($pues[0]['id'], $usuarioId);
        if(!isset($usuPues)){
            $usuPues = $this->insertarUsuarioPuesto($pues[0]['id'], $usuarioId, $estado, $usuCreacion);
        }
        return $usuPues;
    }

    public function obtenerPuestoXcodLegado($codLegado) {
        return Puesto::create()->obtenerPuestoXcodLegado($codLegado);
    }

    public function insertarPuesto($codLegado, $descripcion, $estado, $usuCreacion, $puestoPadreId = null) {
        return Puesto::create()->insertarPuesto($puestoPadreId, $codLegado, $descripcion, $estado, $usuCreacion);
    }

    public function obtenerUsuarioPuestoId($puestoId, $usuarioId) {
        return Puesto::create()->obtenerUsuarioPuestoId($puestoId, $usuarioId);
    }

    public function insertarUsuarioPuesto($puestoId, $usuarioId, $estado, $usuCreacion) {
        return Puesto::create()->insertarUsuarioPuesto($puestoId, $usuarioId, $estado, $usuCreacion);
    }
}
