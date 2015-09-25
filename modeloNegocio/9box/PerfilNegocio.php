<?php

require_once __DIR__ . '/../../modelo/9box/Perfil.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class PerfilNegocio extends ModeloNegocioBase {
    
    public function getAll() {
        return Perfil::create()->getAll();
    }
}
